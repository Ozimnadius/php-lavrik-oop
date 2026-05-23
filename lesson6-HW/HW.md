# Домашнее задание — Урок 6: Active Record (методы `destroy` и `create`)

## Цель

Дополнить базовую модель [`Core\Model`](Core/Model.php) двумя методами, реализующими паттерн Active Record: удаление и создание сущностей через объект модели.

---

## Задание 1 — Метод `destroy`

### Что нужно сделать

В классе `Core\Model` добавить метод:

```php
public function destroy(): void
```

- **Не статический** — вызывается на конкретном экземпляре сущности, которая уже была найдена через `find()`.
- Выполняет `DELETE`-запрос к базе данных, удаляя строку с `id` текущего объекта.

### Пример использования

```php
$payment = CashPayment::find(5);
$payment->destroy(); // DELETE FROM cash_payments WHERE id = 5
```

### Как проверить

В контроллере [`App\Controllers\CashPayments`](App/Controllers/CashPayments.php) заполнить метод `destroy()`:

1. Считать `id` из `$_GET` (или `$_POST`).
2. Найти сущность через `find()`.
3. Вызвать `destroy()` на ней.
4. Перенаправить обратно на `index.php`.

```php
public function destroy(): void
{
    $payment = CashPayment::find($_GET['id']);
    $payment->destroy();
    header('Location: index.php');
    exit();
}
```

Убедиться: запись исчезла из базы данных.

---

## Задание 2 — Метод `create`

### Что нужно сделать

В классе `Core\Model` добавить метод:

```php
public static function create(array $fields): static
```

- **Статический** — вызывается на классе модели, не требует существующего объекта.
- Принимает ассоциативный массив полей (без первичного ключа — он задаётся автоинкрементом).
- Выполняет `INSERT INTO`-запрос, подставляя названия и значения полей.
- Возвращает экземпляр сущности (либо с данными из базы после вставки, либо с переданными полями + новый `id`).

### Пример SQL-запроса, который должен формироваться

```sql
INSERT INTO cash_payments (user_id, value) VALUES (:user_id, :value)
```

### Пример использования

```php
$payment = CashPayment::create(['user_id' => 1, 'value' => 500]);
// $payment->id — id только что созданной записи
```

### Как проверить

В контроллере дополнить метод `create()`:

- `GET`-запрос → показывает пустую форму.
- `POST`-запрос → вызывает `CashPayment::create($_POST)` и редиректит на страницу записи.

```php
public function create()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $payment = CashPayment::create($_POST);
        header('Location: index.php?action=show&id=' . $payment->id);
        exit();
    }

    // показать пустую форму
    return Template::getInstance()->render('cash-payments/create', []);
}
```

Создать шаблон `resources/views/cash-payments/create.php` с формой (поля `user_id` и `value`).

---

## Советы

- **Начинайте с `destroy`** — он значительно проще и поможет разобраться с механикой без лишнего стресса.
- Внутри методов — обычный процедурный PHP + SQL-запросы через `DB::getInstance()->query(...)`. Ничего изобретать не нужно.
- Посмотрите, как устроен метод `save()` в [`Core/Model.php`](Core/Model.php) — `create` строится по похожей логике, но проще: не нужно отделять `pk` от остальных полей, не нужен `UPDATE`.
- `lastInsertId()` у PDO возвращает `id` только что вставленной строки — пригодится в `create`.
