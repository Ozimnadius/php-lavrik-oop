<h1>Edit payment #<?=$payment->id?></h1>
<form method="post">
  <input type="text" name="value" value="<?=$payment->value?>">
  <input type="text" name="inn" placeholder="ИНН (12 цифр)" value="<?= $payment->inn ?? '' ?>">
  <input type="text" name="snils" placeholder="СНИЛС (11 цифр)" value="<?= $payment->snils ?? '' ?>">
  <?php if (!empty($errors)): ?>
    <ul style="color:red">
      <?php foreach ($errors as $error): ?>
        <li><?= htmlspecialchars($error) ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  <button>Save</button>
</form>