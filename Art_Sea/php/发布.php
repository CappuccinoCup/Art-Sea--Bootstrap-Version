<?php
include("functions.php");

session_start();

if (isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE) {
    $connect = connectDB();

    $title = str_replace("'","''",$_POST['title']);
    $artist = str_replace("'","''",$_POST['artist']);
    $description = str_replace("'","''",$_POST['description']);
    $yearOfWork = str_replace("'","''",$_POST['yearOfWork']);
    $genre = str_replace("'","''",$_POST['genre']);
    $width = str_replace("'","''",$_POST['width']);
    $height = str_replace("'","''",$_POST['height']);
    $price = str_replace("'","''",$_POST['price']);
    $imageFileName = str_replace("'","''",$_FILES['image']['name']);//若无文件上传则为空字符串
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
            echo $connect->error;
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