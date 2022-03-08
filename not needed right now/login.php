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

<a href='login.php'><img src="../images/logo.png" class='navLogo' alt='logo'></a>
<div id="box">

	<form method="post">
		<div style="font-size: 20px;margin: 10px;color: lightgrey; text-align:center">Login</div>
		<label for="username" id="label">Username</label>
		<input id="text" type="text" name="username"><br><br>
		<label for="password" id="label">Password</label>
		<input id="text" type="password" name="password"><br><br>

		<input id="button" type="submit" value="Login"><br><br>

		<a href="signup.php">New User? Register</a><br><br>
	</form>
</div>
</body>

</html>