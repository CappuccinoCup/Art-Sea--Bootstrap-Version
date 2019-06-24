<?php 
include("functions.php");

session_start();

if (isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE){
    $userID = $_SESSION['userID'];
    $number = $_GET['number'];

    $connect = connectDB();
    $sql = "SELECT balance FROM users WHERE userID='" . $userID . "'";
    $result = $connect->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $userBalance = $row['balance'];
        $userBalance += $number;
        $sql = "UPDATE users SET balance='" . $userBalance . "' WHERE userID='" . $userID . "'";
        if($connect->query($sql)){
            echo "充值成功！";
        }else{
            echo "充值失败！";
        }
    }else{
        echo "充值失败！";
    }
    $connect->close();
}
?>