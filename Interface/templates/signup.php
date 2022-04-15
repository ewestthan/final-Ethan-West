<?php
include 'formsTop.php';
//something was posted
if(isset($_POST['btnUpdate'])){
	if(DEBUG){
		print '<p>POST array:</p><pre>';
		print_r($_POST);
		print'</pre>';
	}
	$txtUsername = filter_var($_POST['txtUsername']);
	$txtPassword = filter_var($_POST['txtPassword']);
	$txtFirst = filter_var($_POST['txtFirst']);
	$txtLast = filter_var($_POST['txtLast']);
	$txtEmail = filter_var($_POST['txtEmail']);
	$txtAge = filter_var($_POST['txtAge']);

	$saveData = true;

	if(!filter_var($txtUsername)){
		print '<p class="mistake">Please enter a valid username.</p>';
		$saveData = false;
	}
	if(!filter_var($txtFirst)){
		print '<p class="mistake">Please enter a valid first name.</p>';
		$saveData = false;
	}
	if(!filter_var($txtUsername)){
		print '<p class="mistake">Please enter a valid last name.</p>';
		$saveData = false;
	}
	if(!filter_var($txtUsername)){
		print '<p class="mistake">Please enter a valid email.</p>';
		$saveData = false;
	}
	if(!filter_var($txtUsername)){
		print '<p class="mistake">Please enter a valid Password.</p>';
		$saveData = false;
	}
	if(!filter_var($txtUsername)){
		print '<p class="mistake">Please enter a valid age.</p>';
		$saveData = false;
	}
	
	if($saveData){
		$sql = 'INSERT INTO tblUsers SET ';
		$sql .= 'pmkUsername = ?, ';
		$sql .= 'fldFirstName = ?, ';
		$sql .= 'fldLastName = ?, ';
		$sql .= 'fldEmail = ?, ';
		$sql .= 'fldPassword = ?, ';
		$sql .= 'fldAge = ?';
		
		$data = array();
		$data[] = $txtUsername;
		$data[] = $txtFirst;
		$data[] = $txtLast;
		$data[] = $txtEmail;
		$data[] = $txtPassword;
		$data[] = $txtAge;

		if($thisDatabaseWriter->insert($sql, $data)){
			$_SESSION['id'] = $txtUsername;
			header("Location: profile.php", true, 303);
			exit();
		}
		else {
			print '<p>Please enter some valid information!</p>';
			if (DEBUG) {
				print '<p>' . $thisDatabaseWriter->displayQuery($query2, $values) . '</p>';
			}
		}
	}
}
?>


<a href='login.php'><img src="../images/logo.png" class='navLogo' alt='logo'></a>
<div id="box">

	<form action="<?php print PHP_SELF?>" id="frmSignup" method="post">
		<div style="font-size: 20px;margin: 10px;color: lightgrey;">Signup</div>

		<label for="txtFirst" id="label">First Name</label>
		<input id="text" type="text" name="txtFirst"><br><br>
		<label for="txtLast" id="label">Last Name</label>
		<input id="text" type="text" name="txtLast"><br><br>
		<label for="txtUsername" id="label">Username</label>
		<input id="text" type="text" name="txtUsername"><br><br>
		<label for="txtEmail" id="label">Email</label>
		<input id="text" type="txtEmail" name="txtEmail"><br><br>
		<label for="txtPassword" id="label">Password</label>
		<input id="text" type="txtPassword" name="txtPassword"><br><br>
		<label for="txtAge" id="label">Age</label>
		<input id="text" type="text" name="txtAge"><br><br>

		<input name="btnSubmit" id="button" type="submit" value="Signup"><br><br>

		<a href="login.php">Click to Login</a><br><br>

	</form>
</div>
</body>

</html>