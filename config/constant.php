<?php
session_start();
define('SITEURL','http://localhost:354/phpmyadmin/food/');
$servername='localhost';
$nam='root';
$pass='';
$db='quick food';
$conn=mysqli_connect($servername,$nam,$pass,$db);
?>