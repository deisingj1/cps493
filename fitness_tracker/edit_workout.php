<!DOCTYPE html>
<?php 
	session_start();
	$name = "Jesse Deisinger";
	
	$workout = $_SESSION['workouts'][$_GET['id']];
	
	$id = $_GET['id'];
	var_dump($id);

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
					<li class="active">
						<a href="meals.php">Meals</a>
					</li>
					<li>
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
					</form>
       			</nav>
       		</div>
    	</div>

    	<div class="row">
    		<div class="col-sm-2 date-nav">

    		</div>
    		<div class="col-sm-10">
				<form class="form-horizontal" method="post" action="workouts.php">
					<div class="form-group">
						<label class="col-sm-1 control-label" for="workout">Food:</label>
						<div class="col-sm-5">
							<input class="form-control" type:"text" name="workout" id="workout" value="<?=$workout['workout']?>">
						</div>
						<label class="col-sm-1 control-label" for="calories">Calories:</label>
						<div class="col-sm-2">
							<input class="form-control" type:"text" name="calories" id="calories" value="<?=$workout['calories']?>">
						</div>	
						<label class="col-sm-1 control-label" for="time">Date:</label>
						<div class="col-sm-2">
							<input class="form-control" type:"date" name="time" id="time" value="<?=$workout['time']?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-right">
							<input class="hidden" name="op" value="3">
							<input class="hidden" name="id" value="<?=$id?>">
							<button class="btn btn-success" method="post" action="workouts.php?id=<?=$id?>">
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
    	<div class="row">
    		<footer>Copyright 2015 Fitness Tracker.biz</footer>
    	</div>
    </div>
	<!-- Javascript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="extern.js"></script>
</body>