# ДЗ — Урок 7: Валидация данных (rakit/validation)

## Цель

Встроить библиотеку валидации [rakit/validation](https://github.com/rakit/validation) в текущую систему.
Научиться описывать правила валидации через конфиг, ловить ошибки и отображать их рядом с полями формы.

---

## Шаг 1 — Установить пакет

```bash
composer require rakit/validation
```

---

## Шаг 2 — Базовый вариант: валидация в `CashPayments`

Контроллер: [`App/Controllers/CashPayments.php`](App/Controllers/CashPayments.php)

Два места, где нужна валидация — метод `create` (строка ~27) и метод `edit` (строка ~46, там уже есть `//todo: validation here`).

### Что нужно сделать:

1. Подключить валидатор через `use Rakit\Validation\Validator;`
2. В методах `create` и `edit` до записи в БД создать экземпляр валидатора и описать правила:

```php
$validator = new Validator();
$validation = $validator->make($_POST, [
    'value' => 'required|numeric|min:0',
]);
$validation->validate();

if ($validation->fails()) {
    $errors = $validation->errors()->all(); // массив сообщений об ошибках
    // передать $errors в шаблон
}
```

3. При наличии ошибок — не сохранять в БД, а рендерить форму снова, передав `$errors` в шаблон.
4. В шаблонах [`resources/views/cash-payments/create.php`](resources/views/cash-payments/create.php) и [`update.php`](resources/views/cash-payments/update.php) вывести ошибки рядом с полями:

```php
<?php if (!empty($errors)): ?>
    <ul style="color:red">
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
```

---

## Шаг 3 — Расширенный вариант: `required_without` на существующей сущности

Чтобы прочувствовать смысл библиотеки — добавить в `cash_payments` два новых поля с зависимой обязательностью.

**Пример:** идентификатор плательщика можно указать через ИНН **или** СНИЛС — достаточно одного из двух.

### Что нужно сделать:

1. Добавить колонки `inn` и `snils` в таблицу `cash_payments` в БД (оба `VARCHAR`, `nullable`).
2. Добавить поля в форму создания и редактирования.
3. Прописать правила с `required_without`:

```php
$validation = $validator->make($_POST, [
    'value'  => 'required|numeric|min:0',
    'inn'    => 'required_without:snils|digits:12',
    'snils'  => 'required_without:inn|digits:11',
]);
```

**Смысл:** если `inn` не заполнен — `snils` становится обязательным, и наоборот. Оба могут быть заполнены — это не запрещено.

---

## Шаг 4 — Опциональный вариант: новая сущность `visits`

Если хватает времени — вместо расширения `cash_payments` создать отдельную сущность.

**Сущность:** заявка на техосмотр.

| Поле       | Тип     | Обязательность |
|------------|---------|----------------|
| `name`     | string  | всегда         |
| `phone`    | string  | всегда         |
| `plate`    | string  | обязателен, если не указаны `brand` и `model` |
| `brand`    | string  | обязателен, если не указан `plate`            |
| `model`    | string  | обязателен, если не указан `plate`            |

**Правила:**

```php
$validation = $validator->make($_POST, [
    'name'  => 'required',
    'phone' => 'required',
    'plate' => 'required_without:brand,model',
    'brand' => 'required_without:plate',
    'model' => 'required_without:plate',
]);
```

**Что создать:**
- Таблицу `visits` в БД
- Модель [`App/Models/Visit.php`](App/Models/Visit.php) (extends `Model`)
- Контроллер [`App/Controllers/Visits.php`](App/Controllers/Visits.php) с методами `index`, `create`, `show`, `edit`
- Шаблоны в [`resources/views/visits/`](resources/views/visits/)
- Роуты в [`bootstrap.php`](bootstrap.php)

---

## Итог — минимальный результат

- Пакет `rakit/validation` установлен через Composer
- В методе `create` **или** `edit` контроллера `CashPayments` есть валидация с проверкой ошибок
- При невалидных данных форма рендерится снова с сообщениями об ошибках рядом с полями
- При валидных данных — запись сохраняется в БД как и раньше
