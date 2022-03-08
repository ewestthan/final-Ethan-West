<?php
include 'top.php';

if(isset($_SESSION['id']))
{
	unset($_SESSION['id']);
}

header("Location: login.php", true, 303);
die;