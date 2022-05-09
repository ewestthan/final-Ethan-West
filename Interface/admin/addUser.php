<?php
include 'top.php';
//something was posted

$userId = isset($_GET['usr']) ? (int) htmlspecialchars($_GET['usr']) : 0;
//validate record exists
if (isset($_POST['hidUsernameId'])) {
	$userId = (int) htmlspecialchars($_POST['hidUsernameId']);
}

if ($userId != 0) {
	$sql = 'SELECT * FROM tblUsers WHERE pmkUserId = "' . $userId . '"';
	if (DEBUG) {
		print $thisDatabaseWriter->displayQuery($sql);
	}
	if ($list = $thisDatabaseWriter->select($sql)) {
		$txtUsername = $list[0]['fldUsername'];
		$txtFirst = $list[0]['fldFirstName'];
		$txtLast = $list[0]['fldLastName'];
		$txtEmail = $list[0]['fldEmail'];
		$txtPassword = $list[0]['fldPassword'];
		$txtAge = $list[0]['fldAge'];
		$enteredBy = $netId;
	}
} else {
	$txtUsername = '';
	$txtFirst = '';
	$txtLast = '';
	$txtEmail = '';
	$txtPassword = '';
	$txtAge = '';
	$enteredBy = $netId;
}


if (isset($_POST['btnSubmit'])) {
	if (DEBUG) {
		print '<p>POST array:</p><pre>';
		print_r($_POST);
		print '</pre>';
	}
	$txtUsername = filter_var($_POST['txtUsername']);
	$txtPassword = filter_var($_POST['txtPassword']);
	$txtFirst = filter_var($_POST['txtFirst']);
	$txtLast = filter_var($_POST['txtLast']);
	$txtEmail = filter_var($_POST['txtEmail']);
	$txtAge = filter_var($_POST['txtAge']);
	$enteredBy = filter_var($_POST['hidEnteredBy']);
	$userId = filter_var($_POST['hidUserId']);

	$saveData = true;
	print $txtUsername;

	if (!filter_var($txtUsername)) {
		print '<p class="mistake">Please enter a valid username.</p>';
		$saveData = false;
	}
	if (!filter_var($txtFirst)) {
		print '<p class="mistake">Please enter a valid first name.</p>';
		$saveData = false;
	}
	if (!filter_var($txtLast)) {
		print '<p class="mistake">Please enter a valid last name.</p>';
		$saveData = false;
	}
	if (!filter_var($txtEmail)) {
		print '<p class="mistake">Please enter a valid email.</p>';
		$saveData = false;
	}
	if (!filter_var($txtPassword)) {
		print '<p class="mistake">Please enter a valid Password.</p>';
		$saveData = false;
	}
	if (!filter_var($txtAge)) {
		print '<p class="mistake">Please enter a valid age.</p>';
		$saveData = false;
	}

	if ($saveData) {
		$sql = 'INSERT INTO tblUsers SET ';
		$sql .= 'pmkUserId = ?, ';
		$sql .= 'fldUsername = ?, ';
		$sql .= 'fldFirstName = ?, ';
		$sql .= 'fldLastName = ?, ';
		$sql .= 'fldEmail = ?, ';
		$sql .= 'fldPassword = ?, ';
		$sql .= 'fldAge = ?, ';
		$sql .= 'fldEnteredBy = ?';

		$data = array();
		$data[] = $userId;
		$data[] = $txtUsername;
		$data[] = $txtFirst;
		$data[] = $txtLast;
		$data[] = $txtEmail;
		$data[] = $txtPassword;
		$data[] = $txtAge;
		$data[] = $enteredBy;

		$sql .= ' ON DUPLICATE KEY UPDATE ';
		$sql .= 'fldUsername = ?, ';
		$sql .= 'fldFirstName = ?, ';
		$sql .= 'fldLastName = ?, ';
		$sql .= 'fldEmail = ?, ';
		$sql .= 'fldPassword = ?, ';
		$sql .= 'fldAge = ?, ';
		$sql .= 'fldEnteredBy = ?';

		$data = array();
		$data[] = $txtFirst;
		$data[] = $txtLast;
		$data[] = $txtEmail;
		$data[] = $txtPassword;
		$data[] = $txtAge;
		$data[] = $enteredBy;


		if (DEBUG) {
			print '<p>' . $thisDatabaseWriter->displayQuery($sql, $data) . '</p>';
		}

		if ($thisDatabaseWriter->insert($sql, $data)) {
			print '<p>Data Saved</p>';
		} else {
			print '<p>Please enter some valid information!</p>';
		}
	}
}

?>


<div id="box">

	<form action="<?php print PHP_SELF ?>" id="frmSignup" method="post">
		<div style="font-size: 20px;margin: 10px;color: black;">Add User</div>

		<label for="txtFirst" id="label">First Name</label>
		<input id="text" type="text" name="txtFirst" value="<?php print $txtFirst; ?>">
		<label for="txtLast" id="label">Last Name</label>
		<input id="text" type="text" name="txtLast" value="<?php print $txtLast ?>">
		<label for="txtUsername" id="label">Username</label>
		<input id="text" type="text" name="txtUsername" value="<?php print $txtUsername; ?>">
		<label for="txtEmail" id="label">Email</label>
		<input id="text" type="email" name="txtEmail" value="<?php print $txtEmail; ?>">
		<label for="txtPassword" id="label">Password</label>
		<input id="text" type="password" name="txtPassword" value="<?php print $txtPassword; ?>">
		<label for="txtAge" id="label">Age</label>
		<input id="text" type="text" name="txtAge" value="<?php print $txtAge; ?>">

		<input type="hidden" id="hidUserId" name="hidUserId" value="<?php print $userId; ?>">
		<input type="hidden" id="hidEnteredBy" name="hidEnteredBy" value="<?php print $enteredBy; ?>">

		<input name="btnSubmit" id="button" type="submit" value="Add User">
	</form>
</div>
</body>
<?php include "footer.php"; ?>

</html>