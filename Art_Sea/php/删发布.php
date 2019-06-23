<?php
include("functions.php");

session_start();

if (isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE) {
    $userID = $_SESSION['userID'];
    $artworkID = $_GET['artworkID'];
    $connect = connectDB();
    $sql = "DELETE FROM artworks WHERE artworkID='" . $artworkID . "' AND ownerID='" . $userID . "'";
    if($connect->query($sql)){
        $sql = "DELETE FROM carts WHERE artworkID='" . $artworkID . "'";
        if($connect->query($sql)){
            echo "delete successfully";
        }else{
            echo "what are you doing";
        }
    }else{
        echo "what are you doing";
    }
    $connect->close();
}
?>