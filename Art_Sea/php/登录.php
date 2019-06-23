<?php
include("functions.php");

session_start();

$connect = connectDB();
$username = str_replace("'","''",$_POST['signInUsername']);
$sql = "SELECT name,password,userID FROM users WHERE name='" . $username . "'";
$result = $connect->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['password'] === $_POST['signInPassword']) {
        $_SESSION['admin'] = TRUE;
        $_SESSION['name'] = $row['name'];
        $_SESSION['userID'] = $row['userID'];
        echo "success";
    } else {
        $_SESSION['admin'] = FALSE;
        echo "fail";
    }
} else {
    $_SESSION['admin'] = FALSE;
    echo "fail";
}
$connect->close();
?>
