<table>
	<tbody>
		<tr>
			<th>Id</th>
			<th>UID</th>
			<th>Value</th>
		</tr>
		<?php foreach($payments as $payment): ?>
		<tr>
			<th><?=$payment->id?></th>
			<th><?=$payment->user()->name  /*  very BAD, N + 1 sql queries */  ?></th>
			<th><?=$payment->value?></th>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>