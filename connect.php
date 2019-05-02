<?php 
session_start();
//Connect faylda database ilə qoşulma yaradacıq
require_once("config.php");

$con= mysqli_connect(HOST, USER, PASS);

$db_con= mysqli_select_db($con, DB);

 ?>