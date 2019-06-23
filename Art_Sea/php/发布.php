<?php
include("functions.php");

session_start();

if (isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE) {
    $connect = connectDB();

    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $description = $_POST['description'];
    $yearOfWork = $_POST['yearOfWork'];
    $genre = $_POST['genre'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    $price = $_POST['price'];
    $imageFileName = $_FILES['image']['name'];//若无文件上传则为空字符串
    //防止文件同名
    if($imageFileName !== ""){
        $sql = "SELECT imageFileName FROM artworks WHERE imageFileName='" . $imageFileName . "'";
        while(($result = $connect->query($sql))->num_rows > 0){
            $imageFileName = "ex" . $imageFileName;
            $sql = "SELECT imageFileName FROM artworks WHERE imageFileName='" . $imageFileName . "'";
        }
    }

    if (isset($_POST['ownerID'])) {
        //发布
        $ownerID = $_POST['ownerID'];
        $sql = "INSERT INTO artworks (artist,imageFileName,title,description,yearOfWork,genre,width,height,price,view,ownerID) VALUE ";
        $sql .= "('" . $artist . "','" . $imageFileName . "','" . $title. "','" . $description. "','" . $yearOfWork . "','" . $genre . "',";
        $sql .= "'" . $width . "','" . $height . "','" . $price . "','0','" . $ownerID . "')";
        if($connect->query($sql)){
            move_uploaded_file($_FILES["image"]["tmp_name"],"../resources/img/" . $imageFileName);
            echo "success";
        }else{
            echo "fail";
        }
    } elseif (isset($_POST['artworkID'])) {
        //修改
        $artworkID = $_POST['artworkID'];
        if($imageFileName !== ""){
            $sql = "UPDATE artworks SET artist='" . $artist . "',imageFileName='" . $imageFileName . "',";
        }else{
            $sql = "UPDATE artworks SET artist='" . $artist . "',";
        }
        $sql .= "title='" . $title . "',description='" . $description . "',yearOfWork='" . $yearOfWork . "',";
        $sql .= "genre='" . $genre . "',width='" . $width . "',height='" . $height . "',price='" . $price . "' ";
        $sql .= "WHERE artworkID='" . $artworkID . "'";
        if($connect->query($sql)){
            if($imageFileName != ""){
                move_uploaded_file($_FILES["image"]["tmp_name"],"../resources/img/" . $imageFileName);
            }
            echo "success";
        }else{
            echo "fail";
        }
    } else {
        echo "fail";
    }
    $connect->close();
}
?>