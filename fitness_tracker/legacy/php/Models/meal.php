<?php
require_once "../inc/global.php";
class Meal {
	public static function Get($id = null) {
		$sql = "SELECT * FROM `FT_meals`";
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
			$sql = "UPDATE `FT_meals` SET 
				meal=\"" . $id['meal'] . "\",
				time=\"" . $id['time'] . "\",
				calories=\"" . $id['calories'] . "\" 
				WHERE id={$id['id']}";
		}
		else {
			$sql = "INSERT INTO `FT_meals`
			(user_id, meal, time, calories, create_time)
			VALUES ('1', '$id[meal]', '$id[time]', '$id[calories]', NOW() )";
		}
		$results = $conn->query($sql);
		$conn->close();
		echo "Edit complete";	
		return NULL;
	}
	static public function Delete($id) {
		$conn = getConnection();
		$sql = "DELETE FROM FT_meals WHERE id = $id";
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
