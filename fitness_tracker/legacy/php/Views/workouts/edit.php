<form class="form-horizontal" action="?action=save" method="post">
	<div class="form-group">
		<label for="inputMeal" class="col-sm-2 control-label">Workout</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="inputWorkout" name="workout" value="<?=$model['workout']?>">
		</div>
	</div>	
	<div class="form-group">
		<label for="inputTime" class="col-sm-2 control-label">Time</label>
		<div class="col-sm-10">
			<input type="text" id="inputTime" class="form-control" name="time" value="<?=$model['time']?>">
		</div>
	</div> 	
	<div class="form-group">
		<label for="inputCalories" class="col-sm-2 control-label">Calories</label>
		<div class="col-sm-10">
			<input type="text" id="inputCalories" class="form-control" name="calories" value="<?=$model['calories']?>">
		</div>
	</div>	
	<input type="hidden" name="id" value="<?=$model['id']?>">
	<input type="submit" class="btn btn-default form-control" value="Submit">
</form>
