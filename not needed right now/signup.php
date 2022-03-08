<?php
include 'formsTop.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	$username = getData('username');
	$password = getData('password');
	$first = getData('first');
	$last = getData('last');
	$email = getData('email');
	$yearsClimbing = getData('yearsClimbing');
	$age = getData('age');
	$weight = getData('weight');
	$Vgrade = getData('Vgrade');
	$leadGrade = getData('leadGrade');


	if (!empty($username) && !empty($password) && !is_numeric($username)) {
		//save to database
		$query2 = "INSERT INTO `tblUser` (`pmkUsername`, `fldFirstName`, ";
		$query2 .= "`fldLastName`, `fldEmail`, `fldPassword`, `fldAge`, `fldWeight`, `fldExpeirence`, `fldVGrade`, `fldSportGrade`) ";
		$query2 .= "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$values = array($username, $first, $last, $email, $password, $age, $weight, $yearsClimbing, $Vgrade, $leadGrade);

		if ($databaseWriter->insert($query2, $values)) {
			$_SESSION['id'] = $username;
			header("Location: profile.php", true, 303);
			exit();
		} else {
			print '<p>Please enter some valid information!</p>';
			if (DEBUG) {
				print '<p>' . $databaseWriter->displayQuery($query2, $values) . '</p>';
			}
		}
	}
}
?>


<a href='login.php'><img src="../images/logo.png" class='navLogo' alt='logo'></a>
<div id="box">

	<form method="post">
		<div style="font-size: 20px;margin: 10px;color: lightgrey;">Signup</div>

		<label for="first" id="label">First Name</label>
		<input id="text" type="text" name="first"><br><br>
		<label for="last" id="label">Last Name</label>
		<input id="text" type="text" name="last"><br><br>
		<label for="username" id="label">Username</label>
		<input id="text" type="text" name="username"><br><br>
		<label for="email" id="label">Email</label>
		<input id="text" type="email" name="email"><br><br>
		<label for="password" id="label">Password</label>
		<input id="text" type="password" name="password"><br><br>
		<label for="age" id="label">Age</label>
		<input id="text" type="text" name="age"><br><br>
		<label for="weight" id="label">Weight</label>
		<input id="text" type="text" name="weight"><br><br>
		<label for="yearsClimbing" id="label">Climbing Experience (Years)</label>
		<input id="text" type="text" name="yearsClimbing"><br><br>
		<label for="Vgrade" id="label">V-Grade</label>
		<input id="text" type="text" name="Vgrade"><br><br>
		<label for="leadGrade" id="label">Lead Grade</label>
		<input id="text" type="text" name="leadGrade"><br><br>

		<input id="button" type="submit" value="Signup"><br><br>

		<a href="login.php">Click to Login</a><br><br>

	</form>
</div>
</body>

</html>