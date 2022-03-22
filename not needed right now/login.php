<?php
include 'formsTop.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	$user_name = getData('username');
	$password = getData('password');

	if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

		//read from database
		$query = "SELECT `fldPassword` FROM tblUser WHERE pmkUsername = ? limit 1";
		$value = array($user_name);
		echo $databaseWriter->displayQuery($query, $value);
		$result = $databaseWriter->select($query, $value);

		if ($result && $result[0]['fldPassword'] === $password) {
			$_SESSION['id'] = $user_name;
			header("Location: profile.php");
			die;
		}

		echo "wrong username or password!";
	} else {
		echo "invalid username or password";
	}
}

?>



	<form method="post">

		<input id="button" type="submit" value="Login"><br><br>

		<a href="signup.php">New User? Register</a><br><br>
	</form>
</div>
</body>

</html>