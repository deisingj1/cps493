<form class="form-horizontal" action="?action=save" method="post">
	<input type="text" class="form-control" name="meal" value="<?=$model['meal']?>">
	<input type="text" class="form-control" name="time" value="<?=$model['time']?>">
	<input type="text" class="form-control" name="calories" value="<?=$model['calories']?>">
	<input type="hidden" name="id" value="<?=$model['id']?>">
	<input type="submit" class="btn btn-default form-control" value="Submit">
</form>
