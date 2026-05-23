<a href="<?=BASE_URL?>/payments/create">Create payment</a>
<hr>
<table>
	<tbody>
		<tr>
			<th>Id</th>
			<th>UID</th>
			<th>Value</th>
			<th>Actions</th>
		</tr>
		<?php foreach($payments as $payment): ?>
		<tr>
			<td><?=$payment->id?></td>
			<td><?=$payment->user()->name  /*  very BAD, N + 1 sql queries */  ?></td>
			<td><?=$payment->value?></td>
			<td>
				<a href="<?=BASE_URL?>/payments/<?=$payment->id?>">Show</a> | 
				<a href="<?=BASE_URL?>/payments/<?=$payment->id?>/edit">Edit</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>