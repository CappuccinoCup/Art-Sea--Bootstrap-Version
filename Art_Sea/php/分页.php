<?php 
include("functions.php");

$rank = $_GET['rankBy'];
$page = $_GET['page'];
search($rank,$page);
?>