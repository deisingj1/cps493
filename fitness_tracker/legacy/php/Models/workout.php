<?php
require_once "../inc/global.php";
class Workout {
	public static function Get($id = null) {
		$sql = "SELECT * FROM `FT_workouts`";
		if($id){
			$sql .= " WHERE id=$id ";
			$ret = fetchAll($sql);
			return $ret[0];
		}	
		else {
			return fetchAll($sql);
		}
	}
        
	static public function Save($id) {
		$conn = getConnection();
		if(!empty($id['id'])) {
			$sql = "UPDATE `FT_workouts` SET 
				workout=\"" . $id['workout'] . "\",
				time=\"" . $id['time'] . "\",
				calories=\"" . $id['calories'] . "\" 
				WHERE id={$id['id']}";
		}
		else {
			$sql = "INSERT INTO `FT_workouts`
			(user_id, workout, time, calories, create_time)
			VALUES ('1', '$id[workout]', '$id[time]', '$id[calories]', NOW() )";
		}
		$results = $conn->query($sql);
		$conn->close();
		return NULL;
	}
	static public function Delete($id) {
		$conn = getConnection();
		$sql = "DELETE FROM FT_workouts WHERE id = $id";
		echo $sql;
		$results = $conn->query($sql);
		$error = $conn->error;
		$conn->close();
		return $error ? array ('sql error' => $error) : false;
	}

	static public function Blank() {
		return array();
	}
}
