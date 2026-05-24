<h1>Edit payment #<?=$payment->id?></h1>
<form method="post">
	<div>Сумма: <input type="text" name="value" value="<?=$payment->value?>" ></div>
	<div><?=$errors['value'] ?? ''?></div>
	<h2>Write INN or passport data</h2>
	<div>Inn<input type="text" name="inn" value="<?=$payment->inn?>" ></div>
	<div><?=$errors['inn'] ?? ''?></div>
	<div>Or</div>
	<div>Passport serie<input type="text" name="pass_serie" value="<?=$payment->pass_serie?>" ></div>
	<div><?=$errors['pass_serie'] ?? ''?></div>
	<div>Passport number<input type="text" name="pass_number" value="<?=$payment->pass_number?>" ></div>
	<div><?=$errors['pass_number'] ?? ''?></div>
	<hr>
	<button>Save</button>
</form>