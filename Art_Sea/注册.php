<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "11111111";
$dbname = "art_sea";

$connect = new mysqli($servername, $username, $password, $dbname);
if ($connect->connect_error) {
    die("连接失败: " . $connect->connect_error . "<br>");
}

$sql = "SELECT name FROM users WHERE name='" . $_GET['signUpUsername'] . "'";
$result = $connect->query($sql);
if ($result->num_rows > 0) {
    echo "fail";
} else {
    $sql = "INSERT INTO users (name,email,password,tel,address,balance) VALUE ('" . $_GET['signUpUsername'] . 
    "','" . $_GET['signUpEmail'] . "','" . $_GET['signUpPassword'] . "','" . $_GET['signUpTel'] . "','" . $_GET['signUpAddress'] . "','0')";
    if ($connect->query($sql) !== TRUE) {
        echo "insertFail";
    }
    $_SESSION['admin'] = TRUE;
    $_SESSION['name'] = $_GET['signUpUsername'];
    echo "success";
}
?>