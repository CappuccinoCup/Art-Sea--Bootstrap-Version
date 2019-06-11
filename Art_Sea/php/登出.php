<?php
session_start();
$_SESSION['admin'] = FALSE;
header("Location:" . $_SERVER['HTTP_REFERER']);
?>
