<?php
function check_login($dbUsername, $dbName)
{
	if(isset($_SESSION['id']))
	{
    	$databaseWriter = new DataBase($dbUsername, 'w', $dbName);

		$id = array($_SESSION['id']);
		$query = "SELECT `pmkUsername` FROM tblUser WHERE `pmkUsername` = ? limit 1";
		print $databaseWriter->displayQuery($query, $id);
		$result = $databaseWriter->select($query, $id);
		if($result) 
		{
			$query = "SELECT * FROM tblUser WHERE `pmkUsername` = ?";
			$user_data = $databaseWriter->select($query, $id);
			return $user_data;
		}
	} else {
		//redirect to login
		header("Location: login.php", true, 303);
		die;
	}
}

//Get trim and sanatize data
function getData($field)
{
    if (!isset($_POST[$field])) {
        $data = "";
    } else {
        $data = htmlspecialchars(trim($_POST[$field]));
    }
    return $data;
} 

?>