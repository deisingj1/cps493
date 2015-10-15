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
       					Hello, Travis Bickle <a href="#">(switch)</a>&nbsp;&nbsp;
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
						<form class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-1 control-label" for="inputFood">Type of workout</label>
								<div class="col-sm-5">
									<input class="form-control" type:"text" id="inputFood" placeholder="Workout">
								</div>
								<label class="col-sm-1 control-label" for="inputCalories">Calories Burned</label>
								<div class="col-sm-2">
									<input class="form-control" type:"text" id="inputCalories" placeholder="Calories">
								</div>	
								<label class="col-sm-1 control-label" for="inputDate">Date</label>
								<div class="col-sm-2">
									<input class="form-control" type:"date" id="inputDate" placeholder="Date">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12 text-right">
									<button id="addSubmit" class="btn btn-success">
										Submit
										<span class="glyphicon glyphicon-plus"></span>
									</button>
									<button class="btn btn-danger">
										Cancel
										<span class="glyphicon glyphicon-trash"></span>	
									</button>
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
    				<a href="#"><li>9/17/15</li></a>
    			</ul>
    		</div>
    		<div class="col-sm-10">
				<div class="table-responsive">
					<table id="contentTable" class="table table-hover table-bordered">
						<tr>
							<th>Workout</th>
							<th>Date</th>
							<th>Calories</th>
						</tr>
						<tr>
							<td>Run</td>
							<td>12/17/12</td>
							<td>130</td>
						</tr>
						<tr>
							<td>Walk</td>
							<td>01/41/32</td>
							<td>410</td>
						</tr>
						<tr>
							<td>Row</td>
							<td>4/13/14</td>
							<td>810</td>
						</tr>
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