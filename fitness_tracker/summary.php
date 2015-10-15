<!DOCTYPE html>
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
					<li class="active">
						<a href="summary.php">Summary</a>
					</li>
					<li>
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
       					Hello, Travis Bickle <a href="#">(switch)</a>
       				</form>
       			</nav>
       		</div>
    	</div>    	
    	<div class="row">
    		<div class="col-sm-2 date-nav">
                <h5> View date: </h5>
    			<ul class="dates">
    				<a href="#"><li>9/17/15</li></a>
    				<a href="#"><li>9/17/15</li></a>
    				<a href="#"><li>9/17/15</li></a>
    				<a href="#"><li>9/17/15</li></a>
    			</ul>
    		</div>
    		<div class="col-sm-10">
				<h5> Today: 1 Workout, 300 calories, 3 Meals, 1400 Calories </h5>
				<h5> This week: 4 Workouts, 1400 calories, 7 Meals, 4000 calories</h5>
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