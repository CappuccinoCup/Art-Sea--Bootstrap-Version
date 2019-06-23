<?php
include("functions.php");

session_start();

$connect = connectDB();
$username = str_replace("'","''",$_POST['signUpUsername']);
$sql = "SELECT name FROM users WHERE name='" . $username . "'";
$result = $connect->query($sql);
if ($result->num_rows > 0) {
    echo "fail";
} else {
    $email = str_replace("'","''",$_POST['signUpEmail']);
    $password = str_replace("'","''",$_POST['signUpPassword']);
    $tel = str_replace("'","''",$_POST['signUpTel']);
    $address = str_replace("'","''",$_POST['signUpAddress']);

    $sql = "INSERT INTO users (name,email,password,tel,address,balance) VALUE ('" . $username . 
    "','" . $email . "','" . $password . "','" . $tel . "','" . $address . "','0')";
    if ($connect->query($sql) !== TRUE) {
        echo "insertFail";
    }else{
        $userID = $connect->insert_id;
        $_SESSION['admin'] = TRUE;
        $_SESSION['name'] = $_POST['signUpUsername'];
        $_SESSION['userID'] = $userID;
        echo "success";
    }
}
$connect->close();
?>