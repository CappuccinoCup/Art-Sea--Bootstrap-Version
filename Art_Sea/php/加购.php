<?php 
include("functions.php");

session_start();

if(!isset($_SESSION['admin']) || $_SESSION['admin'] === FALSE){
    echo "Please sign in first";
}else{
    $connect = connectDB();
    $artworkID = $_GET['artworkID'];
    $userID = $_SESSION['userID'];
    $sql = "SELECT orderID FROM artworks WHERE artworkID='" . $artworkID . "'";
    $result = $connect->query($sql);
    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if($row['orderID'] !== NULL){
            echo "This artwork has been sold";
        }else{
            $sql = "SELECT * FROM carts WHERE artworkID='" . $artworkID . "' AND userID='" . $userID . "'";
            $result = $connect->query($sql);
            if($result->num_rows > 0){
                echo "This artwork is already exist in your cart";
            }else{
                $sql = "INSERT INTO carts (userID,artworkID) VALUE ('" . $userID . "','" . $artworkID . "')";
                if ($connect->query($sql) === TRUE){
                    echo "Add to cart successfully";
                }else {
                    echo "Adding error:" . $connect->error;
                }
            }
        }
    }else{
        echo "This artwork doesn't exist";
    }
    $connect->close();
}
?>