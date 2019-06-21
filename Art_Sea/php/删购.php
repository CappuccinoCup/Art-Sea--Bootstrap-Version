<?php
include("functions.php");

session_start();

$connect = connectDB();
$artworkID = $_GET['artworkID'];
$userID = $_SESSION['userID'];
$sql = "DELETE FROM carts WHERE userID='" . $userID . "' AND artworkID='" . $artworkID . "'";
if ($connect->query($sql)) {
    echo 'delete from cart successfully';
}else{
    echo "deleting error:" . $connect->error;
}
?>