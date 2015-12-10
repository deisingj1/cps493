<?php 
	include_once '../Models/workout.php';

	$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
	$method = $_SERVER['REQUEST_METHOD'];
	$format = isset($_REQUEST['format']) ? $_REQUEST['format'] : 'web';
	$view = null;

	switch ($action . '_' . $method) {
		case 'create_GET':
			$model = Workout::Blank();
			$view = "meals/edit.php";
			break;
		case 'save_POST':
			//$sub_action = empty($_REQUEST['id']) ? 'created' : 'updated';
			//$errors = Workout::Validate($_REQUEST);
			if(!$errors) {
				$errors = Workout::Save($_REQUEST);
			}
			if(!$errors) {
				if($format == 'json') {
					header("Location: ?action=edit&format=json&id=$_REQUEST[id]");
				}
				else {
					header("Location: ?sub_action=$sub_action&id=$_REQUEST[id]");
				}
				die();
			}
			else {
				$model = $_REQUEST;
				$view = "workouts/edit.php";
			}
			break;
		case 'edit_GET':
			$model = Workout::Get($_REQUEST['id']);
			$view = "workouts/edit.php";
			break;
		case 'delete_GET':
			$model = Workout::Get($_REQUEST['id']);
			$view = "workouts/delete.php";
			break;
		case 'delete_POST':
			$errors = Workout::Delete($_REQUEST['id']);
			if($errors) {
				$model = Workout::Get($_REQUEST['id']);
				$view = "workouts/delete.php";
			}
			else {
				header("Location: ?sub_action=$sub_action&id=$_REQUEST[id]");
				die();
			}
			break;
		case 'search_GET':
			$model = Workout::Search($_REQUEST['q']);
			$view = 'workouts/index.php';
			break;
		case 'index_GET':
		default:
			$model = Workout::Get();
			$view = 'workouts/index.php';
			break;
	}
	switch ($format) {
		case 'json':	
			echo json_encode($model);
			break;
		case 'plain':
			include __DIR__ . "/../Views/$view";
			break;
		case 'web':
		default:
			include __DIR__ . "/../Views/shared/_Template.php";
			break;
	}
