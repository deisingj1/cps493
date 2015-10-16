<!DOCTYPE html>
<?php 
	session_start();

	$name = "Jesse Deisinger";
	
	$workouts = $_SESSION['workouts'];
	$op = $_POST['op'];
	$id = $_POST['id'];
	if(!$workouts) {
		$_SESSION['workouts'] = $workouts = array(
			array( 'workout' => "Running", 'time' => strtotime("now"), 'calories' => 123), 
			array( 'workout' => "Walking", 'time' => strtotime("now + 1 hour"), 'calories' => 321), 
			array( 'workout' => "Rowing", 'time' => strtotime("now + 2 hours"), 'calories' => 111), 
		);
	}
	if($_GET['op'] == 2) {
		unset($workouts[$_GET['id']]);
	}
	if($_POST) {
		if($op == 3) {
			$workouts[intval($id)] = array( 'workout' => $_POST['workout'], 'time' => strtotime($_POST['time']), 'calories' => $_POST['calories']);
		}
		else {
			$workouts[] = array( 'workout' => $_POST['workout'], 'time' => strtotime($_POST['time']), 'calories' => $_POST['calories']);
		}
	}
	$_SESSION['workouts'] = $workouts;

?>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fitness Tracker</title>
	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<link href="style.css" type="text/css" rel="stylesheet"/>
	
	<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
  	<div class="container">
   		<div class="row">
   			<div class="col-sm-12">
		   		<header>
		   			<h1>
		   				Fitness Tracker.biz
		   			</h1>
		   		</header>
		   		</div>
    	</div>
    	<div class="row">
       		<div class="col-sm-12">
				<ul class="nav nav-tabs nav-justified">
					<li>
						<a href="summary.php">Summary</a>
					</li>
					<li>
						<a href="meals.php">Meals</a>
					</li>
					<li class="active">
						<a href="workouts.php">Workouts</a>
					</li>
					<li>
						<a href="stats.php">Stats</a>
					</li>
				</ul>
       			<nav class="navbar navbar-default top-menu">
					<form class="navbar-form navbar-right" role="search">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">
									<span class="glyphicon glyphicon-search"></span>
								</button> 
							</span>
						</div>
					</form>
       				<form class="navbar-form navbar-left user-loggedin" role="records">
       					Hello, <?=$name?> <a href="#">(switch)</a>&nbsp;&nbsp;
						<button class="btn btn-default" type="button" id="addButton">
							Add
							<span class="glyphicon glyphicon-plus"></span>
						</button>
					</form>
       			</nav>
       		</div>
    	</div>
    	<div class="row" id="addDropdown">
    		<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<form class="form-horizontal" method="post" action="workouts.php">
							<div class="form-group">
								<label class="col-sm-1 control-label" for="workout">Workout: </label>
								<div class="col-sm-5">
									<input class="form-control" type:"text" name="workout" id="workout" placeholder="Workout">
								</div>
								<label class="col-sm-1 control-label" for="calories">Calories Burned:</label>
								<div class="col-sm-2">
									<input class="form-control" type:"text" name="calories" id="calories" placeholder="Calories">
								</div>	
								<label class="col-sm-1 control-label" for="time">Date:</label>
								<div class="col-sm-2">
									<input class="form-control" type:"date" name="time" id="time" placeholder="MM/dd/yyyy">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12 text-right">
									<button class="btn btn-success">
										Submit
										<span class="glyphicon glyphicon-plus"></span>
									</button>
									<!--
									<button class="btn btn-danger">
										Cancel
										<span class="glyphicon glyphicon-trash"></span>	
									</button>
									-->
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
	   	</div>
    	<div class="row">
    		<div class="col-sm-2 date-nav">
    			<h5>
    				View date:
    			</h5>
    			<ul class="dates">
    				<?php foreach($workouts as $i => $workout): ?>
    					<a href="#"><li><?=date("M d Y", $workout['time'])?></li></a>
    				<?php endforeach;?>
    			</ul>
    		</div>
    		<div class="col-sm-10">
				<div class="table-responsive">
		            <table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Action</th>
		                  <th>Workout</th>
		                  <th>Time</th>
		                  <th>Calories</th>
		                </tr>
		              </thead>
		              <tbody>
		                <?php foreach($workouts as $i => $workout): ?>
		                <tr id="data-row-<?=$i?>">
		                  <th scope="row">
		                    <div class="btn-group" role="group">
		                      <a href="edit_workout.php?id=<?=$i?>" title="Edit" type="button" class="btn btn-default btn-xs edit"><i class="glyphicon glyphicon-edit"></i></a>
		                      <a href="workouts.php?id=<?=$i?>&op=2" title="Delete" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
		                    </div>
		                  </th>
		                  <td><?=$workout['workout']?></td>
		                  <td><?=date("M d Y  h:i:sa", $workout['time'])?></td>
		                  <td><?=$workout['calories']?></td>
		                </tr>
		                <?php endforeach; ?>
		              </tbody>
		            </table>  
				</div>
			</div>
    	</div>
    	<div class="row">
    		<footer>Copyright 2015 Fitness Tracker.biz</footer>
    	</div>
    </div>
	<!-- Javascript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="extern.js"></script>
</body>