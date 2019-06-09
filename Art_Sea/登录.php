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

$sql = "SELECT password FROM users WHERE name='" . $_GET['signInUsername'] . "'";
$result = $connect->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['password'] === $_GET['signInPassword']) {
        $_SESSION['admin'] = TRUE;
        $_SESSION['name'] = $_GET['signInUsername'];
        echo "success";
    }
} else {
    $_SESSION['admin'] = FALSE;
    echo "fail";
}
?>