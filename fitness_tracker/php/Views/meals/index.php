<a href="?action=edit" class="btn btn-success">New</a>
<br \><br \>
<table class="table table-striped">
<th>Action</th>
<th>Meal</th>
<th>Time</th>
<th>Calories</th>
<?php foreach($model as $row): ?>
	<tr>
		<td>
		<!--Insert Controllers-->
		<a class="button" href="?action=edit&id=<?=$row['id']?>">Edit</a>
		<a class="button" href="?action=delete&id=<?=$row['id']?>">Delete</a>
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
