<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Release</title>
    <!-- Bootstrap核心css文件 -->
    <link href="bootstrap-3.0.0/dist/css/bootstrap.css" rel="stylesheet">
    <!-- 其它css样式 -->
    <link href="css/公用.css" rel="stylesheet">
    <link href="css/发布.css" rel="stylesheet">

    <script src="javascript/公用.js"></script>
    <script src="javascript/发布.js"></script>
    <script>
        window.onload = function() {
            setRelease();
        }
    </script>
</head>

<body>
    <?php include('php/functions.php'); ?>

    <?php
    session_start();
    saveFootprint("Release",'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    if (!isset($_SESSION['admin']) || $_SESSION['admin'] === FALSE) {
        ?>
        <div class="jumbotron">
            <div class="container">
                <p class="text-center">The user has signed out.Please go to <a href="首页.php">Home Page</a> and sign in.</p>
            </div>
        </div>
    <?php
} else {
    ?>
        <?php include('php/header.php'); ?>
        <?php if(!isset($_GET['artworkID'])){
            ?>

        <main class="release">
            <div class="container">
                <h2 class="highLight">Release</h2>
                <hr class="featurette-divider">
                <form autocomplete="off">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                    <input type="text" id="ownerID" name="ownerID" value="<?php echo $_SESSION['userID'];?>" class="invisibleInput">
                    <div class="form-group">
                    <label for="image">Artwork Image</label>
                    <input type="file" id="image" name="image">
                    </div>
                    <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="title">
                    <p id="titleError" class="invisible">&nbsp;title must not be empty</p>
                    </div>
                    <div class="form-group">
                    <label for="artist">Artist</label>
                    <input type="text" class="form-control" id="artist" name="artist" placeholder="artist">
                    <p id="artistError" class="invisible">&nbsp;artist must not be empty</p>
                    </div>
                    <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" rows="3" id="description" name="description" placeholder="description"></textarea>
                    <p id="desError" class="invisible">&nbsp;description must not be empty</p>
                    </div>
                    <div class="form-group">
                    <label for="yearOfWork">Year of Work</label>
                    <input type="text" class="form-control" id="yearOfWork" name="yearOfWork" placeholder="year of work">
                    <p id="yearOfWorkError" class="invisible">&nbsp;year of work must not be empty</p>
                    </div>
                    <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" class="form-control" id="genre" name="genre" placeholder="genre">
                    <p id="genreError" class="invisible">&nbsp;genre must not be empty</p>
                    </div>
                    <div class="form-group">
                    <label for="width">Width</label>
                    <input type="text" class="form-control" id="width" name="width" placeholder="width">
                    <p id="widthError" class="invisible">&nbsp;width must not be empty</p>
                    </div>
                    <div class="form-group">
                    <label for="height">Height</label>
                    <input type="text" class="form-control" id="height" name="height" placeholder="height">
                    <p id="heightError" class="invisible">&nbsp;height must not be empty</p>
                    </div>
                    <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="price">
                    <p id="priceError" class="invisible">&nbsp;price must not be empty</p>
                    </div>
                        </div>                        
                    </div>
                    <div class="row text-center"><button id="releaseBtn" type="button" class="btn btn-default">Submit</button></div>
                </form>
                <hr class="featurette-divider">
            </div>
        </main>

        <?php } else {
            $artworkID = $_GET['artworkID'];
            $connect = connectDB();
            $sql = "SELECT * FROM artworks WHERE artworkID='" . $artworkID . "'";
            $result = $connect->query($sql);
            if($result->num_rows <= 0 || ($row = $result->fetch_assoc())['ownerID'] !== $_SESSION['userID'] || $row['orderID'] !== null){
            ?>

            <main class="modify">
                <div class="container">
                    <h2 class="highLight">Modify</h2>
                    <hr class="featurette-divider">
                    <div class="jumbotron">
                        <div class="container">
                            <p class="text-center"><br><br><br><br><br>This artwork has jumped to another world line<br><br><br><br><br></p>
                        </div>
                    </div>
                    <hr class="featurette-divider">
                </div>
            </main>
            
            <?php } else{
            ?>

            <main class="modify">
                <div class="container">
                    <h2 class="highLight">Modify</h2>
                    <hr class="featurette-divider">
                    <form autocomplete="off">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                        <div class="row">
                            <div class="col-md-7"><div class="form-group">
                            <label for="image">Artwork Image</label>
                            <input type="file" id="image" name="image">
                            </div></div>
                            <div class="col-md-5"><img src="resources/img/<?php echo $row['imageFileName']; ?>" class="img-responsive" alt="<?php echo $row['title']; ?>"></div>
                        </div>
                        <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="title" value="<?php echo $row['title']; ?>">
                        <p id="titleError" class="invisible">&nbsp;title must not be empty</p>
                        </div>
                        <div class="form-group">
                        <label for="artist">Artist</label>
                        <input type="text" class="form-control" id="artist" name="artist" placeholder="artist" value="<?php echo $row['artist']; ?>">
                        <p id="artistError" class="invisible">&nbsp;artist must not be empty</p>
                        </div>
                        <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="5" id="description" name="description" placeholder="description"><?php echo $row['description']; ?></textarea>
                        <p id="desError" class="invisible">&nbsp;description must not be empty</p>
                        </div>
                        <div class="form-group">
                        <label for="yearOfWork">Year of Work</label>
                        <input type="text" class="form-control" id="yearOfWork" name="yearOfWork" placeholder="year of work" value="<?php echo $row['yearOfWork']; ?>">
                        <p id="yearOfWorkError" class="invisible">&nbsp;year of work must not be empty</p>
                        </div>
                        <div class="form-group">
                        <label for="genre">Genre</label>
                        <input type="text" class="form-control" id="genre" name="genre" placeholder="genre" value="<?php echo $row['genre']; ?>">
                        <p id="genreError" class="invisible">&nbsp;genre must not be empty</p>
                        </div>
                        <div class="form-group">
                        <label for="width">Width</label>
                        <input type="text" class="form-control" id="width" name="width" placeholder="width" value="<?php echo $row['width']; ?>">
                        <p id="widthError" class="invisible">&nbsp;width must not be empty</p>
                        </div>
                        <div class="form-group">
                        <label for="height">Height</label>
                        <input type="text" class="form-control" id="height" name="height" placeholder="height" value="<?php echo $row['height']; ?>">
                        <p id="heightError" class="invisible">&nbsp;height must not be empty</p>
                        </div>
                        <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="price" value="<?php echo $row['price']; ?>">
                        <p id="priceError" class="invisible">&nbsp;price must not be empty</p>
                        </div>
                            </div>                        
                        </div>
                        <div class="row text-center"><button id="modifyBtn" type="button" class="btn btn-default">Submit</button></div>
                    </form>
                    <hr class="featurette-divider">
                </div>
            </main>

        <?php } } ?>
        <?php include('php/footer.php'); ?>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="bootstrap-3.0.0/assets/js/jquery.js"></script>
        <script src="bootstrap-3.0.0/dist/js/bootstrap.min.js"></script>
    <?php } ?>
</body>

</html>