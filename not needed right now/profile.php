<?php
include 'top.php';
$user_data = check_login($dbUsername, $dbName);
?>

<h2>Welcome back <?php echo $user_data[0]['pmkUsername']; ?></h2>
<section class='userinfo'>
<?php
print '<h3 class="userinfo">' . $user_data[0]['fldFirstName'] . ' ' . $user_data[0]['fldLastName'] . '</h3>';
print '<p class="userinfo">' . $user_data[0]['fldAge'] . ' years old with ' . $user_data[0]['fldExpeirence'] . ' years of climbing experience';
print '<br>Top VGrade: V' . $user_data[0]['fldVGrade'];
print '<br>Top Sport Grade: ' . $user_data[0]['fldSportGrade'] . '</p>';
?>
</section>

<form method='post' action='newSession.php'>
	<button class='session' type='submit'>Start a new session</button>
</form>
<?php include('table.php'); ?>
<?php include('charts.php');?>
<?php
print "<script>" . PHP_EOL;
include "../static/tableTabs.js";
print PHP_EOL . "</script>";
?>
</body>
</html>