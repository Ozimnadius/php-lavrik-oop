<h1>Create payment</h1>
<form method="post">
  <input type="text" name="value" value="<?=$fields['value']?>">
  <input type="text" name="inn" placeholder="ИНН (12 цифр)" value="<?= $_POST['inn'] ?? '' ?>">
  <input type="text" name="snils" placeholder="СНИЛС (11 цифр)" value="<?= $_POST['snils'] ?? '' ?>">
  <?php if (!empty($errors)): ?>
    <ul style="color:red">
      <?php foreach ($errors as $error): ?>
        <li><?= htmlspecialchars($error) ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  <button>Create</button>
</form>