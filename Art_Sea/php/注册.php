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

$sql = "SELECT name FROM users WHERE name='" . $_POST['signUpUsername'] . "'";
$result = $connect->query($sql);
if ($result->num_rows > 0) {
    echo "fail";
} else {
    $sql = "INSERT INTO users (name,email,password,tel,address,balance) VALUE ('" . $_POST['signUpUsername'] . 
    "','" . $_POST['signUpEmail'] . "','" . $_POST['signUpPassword'] . "','" . $_POST['signUpTel'] . "','" . $_POST['signUpAddress'] . "','0')";
    if ($connect->query($sql) !== TRUE) {
        echo "insertFail";
    }
    $_SESSION['admin'] = TRUE;
    $_SESSION['name'] = $_POST['signUpUsername'];
    echo "success";
}
?>