<table class="table table-striped">
<th>Action</th>
<th>Meal</th>
<th>Time</th>
<th>Calories</th>
<?php foreach($model as $row): ?>
	<tr>
		<td>
		<!--Insert Controllers-->
		</td>
		<td>
			<?=$row['meal'] ?>
		</td>
		<td>
			<?=$row['time'] ?>
		</td>
		<td>
			<?=$row['calories'] ?>
		</td>
	
	</tr>
<?php endforeach; ?>
</table>
