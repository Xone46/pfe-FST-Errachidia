<?php
include("connect.php");
session_start();

if($_SESSION['id_user'])
{
	 unset($_SESSION['id_user']);
	 session_destroy();
}

header("location:home.php");
?>