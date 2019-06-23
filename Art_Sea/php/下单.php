<?php
include('functions.php');

session_start();

if (isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE) {
    $userID = $_SESSION['userID'];
    $price = $_GET['price'];
    $artworkID = $_GET['artworkID'];

    $connect = connectDB();
    $sum = 0;
    $str = "";
    for ($i = 0; $i < count($artworkID); $i++) {
        $available[$i][0] = FALSE;
        $sql = "SELECT title,price,orderID,ownerID FROM artworks WHERE artworkID='" . $artworkID[$i] . "'";
        $result = $connect->query($sql);
        if ($result->num_rows <= 0) {
            $str .= "第" . ($i + 1) . "件商品已被删除！\n";
        } else {
            $row = $result->fetch_assoc();
            if ($row['orderID'] !== NULL) {
                $str .= $row['title'] . "已被他人抢先购买！\n";
            } else {
                if ($row['price'] !== $price[$i]) {
                    $str .= $row['title'] . "价格发生变动！原价：$" . $price[$i] . "，现价：$" . $row['price'] . "\n";
                }
                $available[$i][0] = $row['price'];
                $available[$i][1] = $row['title'];
                $available[$i][2] = $row['ownerID'];
                $sum += $row['price'];
            }
        }
    }
    $sql = "SELECT balance FROM users WHERE userID='" . $userID . "'";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['balance'] < $sum) {
            $str .= "余额不足，请先充值！\n";
        } else {
            $sql = "UPDATE users SET balance='" . ($row['balance'] - $sum) . "' WHERE userID='" . $userID . "'";
            $connect->query($sql);
            for ($i = 0; $i < count($available); $i++) {
                if($available[$i][0] !== FALSE){
                $sql = "INSERT INTO orders (ownerID,sum) VALUE ('" . $userID . "','" . $available[$i][0] . "')";
                if ($connect->query($sql)) {
                    $orderID = $connect->insert_id;
                    $sql = "UPDATE artworks SET orderID='" . $orderID . "' WHERE artworkID='" . $artworkID[$i] . "'";
                    if ($connect->query($sql)) {
                        $sql = "SELECT balance FROM users WHERE userID='" . $available[$i][2] . "'";
                        $result = $connect->query($sql);
                        $row = $result->fetch_assoc();
                        $ownerBalance = $row['balance'];
                        $sql = "UPDATE users SET balance='" . ($ownerBalance + $available[$i][0]) . "' WHERE userID='" . $available[$i][2] . "'";
                        if ($connect->query($sql)) {
                            $str .= $available[$i][1] . "  ";
                        }
                    }
                }
            }
            }
            $str .= "购买成功！共花费$" . $sum . "\n";
        }
    }
    echo $str;

    $connect->close();
}
?>