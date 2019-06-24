<?php
include("functions.php");

session_start();

if (isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE) {
    $userID = $_SESSION['userID'];
    $connect = connectDB();
    $username = str_replace("'", "''", $_POST['signUpUsername']);
    $email = str_replace("'", "''", $_POST['signUpEmail']);
    $password0 = str_replace("'", "''", $_POST['signUpPassword0']);
    $password = str_replace("'", "''", $_POST['signUpPassword']);
    $tel = str_replace("'", "''", $_POST['signUpTel']);
    $address = str_replace("'", "''", $_POST['signUpAddress']);
    $sql = "SELECT name,userID FROM users WHERE name='" . $username . "'";
    $result = $connect->query($sql);
    if ($result->num_rows > 0 && ($row = $result->fetch_assoc())['userID'] !== $userID) {
        echo "fail1";
    } else {
        $sql = "SELECT password FROM users WHERE userID='" . $userID . "'";
        $result = $connect->query($sql);
        if ($result->num_rows > 0 && (($row = $result->fetch_assoc())['password']) !== $password0) {
            echo "fail2";
        } else {
            $sql = "UPDATE users SET name='" . $username . "',email='" . $email . "',password='" . $password . "',";
            $sql .= "tel='" . $tel . "',address='" . $address . "' WHERE userID='" . $userID . "'";
            if ($connect->query($sql) !== TRUE) {
                echo "modifyFail";
            } else {
                $_SESSION['name'] = $username;
                echo "success";
            }
        }
    }
    $connect->close();
}
