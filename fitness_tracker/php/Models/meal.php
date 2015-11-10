<?php
require_once "../inc/global.php";
class Meal {
	public static function Get($id = null){
	$sql = "SELECT * FROM `meals`";
	if($id){
		$sql .= " WHERE id=$id ";
		$ret = fetchAll($sql);
		return $ret[0];
	}	
	else {
		return fetchAll($sql);
	}

}
        
static public function Delete($id)
{
	echo "Save function";
	$conn = getConnection();
	$sql = "DELETE FROM 2015Fall_Persons WHERE id = $id";
	echo $sql;
	$results = $conn->query($sql);
	$error = $conn->error;
	$conn->close();

	return $error ? array ('sql error' => $error) : false;
}

static public function Blank()
	{
		return array();
	}
}
