<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Sea</title>
    <!-- Bootstrap核心css文件 -->
    <link href="bootstrap-3.0.0/dist/css/bootstrap.css" rel="stylesheet">
    <!-- 其它css样式 -->
    <link href="css/公用.css" rel="stylesheet">
    <link href="css/首页.css" rel="stylesheet">

    <script src="javascript/公用.js"></script>
    <script src="javascript/首页.js"></script>
    <script>
        window.onload = function() {
            setImageChange();
            setSign();
            background();
        }
    </script>
</head>

<body>
    <?php include('php/functions.php'); ?>
    <?php
    session_start();
    saveFootprint("Home",'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    $connect = connectDB();
    //获取热门作品前三
    $sql = "SELECT artworkID,artist,imageFileName,title,description FROM artworks WHERE orderID is NULL ORDER BY view DESC LIMIT 0,3";
    $result1 = $connect->query($sql);
    if ($result1->num_rows > 0) {
        for ($i = 0; $i < 3; $i++) {
            $hot[$i] = $result1->fetch_assoc();
            $hotDes[$i] = substr($hot[$i]['description'], 0, 270);
            $hotDes[$i] = preg_replace('/<em>/i','',$hotDes[$i]);
            $hotDes[$i] = preg_replace('/<\/em>/i','',$hotDes[$i]);
        }
    }
    //获取最新作品前六
    $sql = "SELECT artworkID,artist,imageFileName,title,description FROM artworks WHERE orderID is NULL ORDER BY timeReleased DESC LIMIT 0,6";
    $result2 = $connect->query($sql);
    if ($result2->num_rows > 0) {
        for ($i = 0; $i < 6; $i++) {
            $new[$i] = $result2->fetch_assoc();
            $newDes[$i] = substr($new[$i]['description'], 0, 220);
            $newDes[$i] = preg_replace('/<em>/i','',$newDes[$i]);
            $newDes[$i] = preg_replace('/<\/em>/i','',$newDes[$i]);
        }
    }
    ?>

    <?php include('php/modal.php'); ?>

    <header>
        <nav class="self-nav">
            <div class="self-container">
                <a class="self-brand" href="首页.php">Art Sea </a>swim in the sea of masterpieces
                <div class="pull-right self-linkGroup">
                    <a href="首页.php" class="currentPage">Home</a>
                    <a href="搜索.php">Search</a>
                    <!-- 以下的代码结构很有用 -->
                    <?php
                    if (!isset($_SESSION['admin']) || $_SESSION['admin'] === FALSE) {
                        ?>
                        <a href="#" data-toggle="modal" data-target="#signIn">Sign in</a>
                        <a href="#" data-toggle="modal" data-target="#signUp">Sign up</a>
                    <?php
                } else {
                    ?>
                        <a href="个人中心.php"><?php echo $_SESSION['name']; ?></a>
                        <a href="购物车.php">Shopping Cart</a>
                        <a href="./php/登出.php">Sign out</a>
                    <?php
                } ?>
                </div>
            </div>
        </nav>
    </header>

    <section class="self-scrollScreen">
        <img src="resources/img/<?php echo $hot[0]['imageFileName']; ?>" alt="<?php echo $hot[0]['title']; ?>" class="onShow">
        <img src="resources/img/<?php echo $hot[1]['imageFileName']; ?>" alt="<?php echo $hot[1]['title']; ?>">
        <img src="resources/img/<?php echo $hot[2]['imageFileName']; ?>" alt="<?php echo $hot[2]['title']; ?>">

        <!-- 生成简介内容及作品ID -->
        <?php showHotWorkInfo($hot, $hotDes, count($hot)); ?>

        <div class="self-container">
            <div class="self-details">
                <p class="text-center self-introduction">
                    <?php
                    $str = $hot[0]['title'] . '<br>';
                    $str .= $hot[0]['artist'] . '<br>';
                    $str .= $hotDes[0] . '...<br>';
                    echo $str;
                    ?>
                </p>
                <form action="详情.php" method="GET">
                    <input type="text" class="invisibleInput" name="workID" id="workID" value="<?php echo $hot[0]['artworkID']; ?>">
                    <button class="btn btn-default" type="submit"><a>Details</a></button>
                </form>
            </div>
        </div>
        <div class="self-container">
            <div class="self-iconButton">
                <button class="active"></button>
                <button></button>
                <button></button>
            </div>
        </div>
    </section>

    <section id="newestWorks">
        <div class="container">
            <h2>Newest Artworks</h2>
            <hr class="featurette-divider">
            <div class="row">

                <!-- 生成最新艺术品简介框 -->
                <?php showNewWork($new, $newDes, count($new)); ?>

            </div>
            <hr class="featurette-divider">
        </div>
    </section>

    <?php include('php/footer.php'); ?>
    <?php $connect->close(); ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap-3.0.0/assets/js/jquery.js"></script>
    <script src="bootstrap-3.0.0/dist/js/bootstrap.min.js"></script>

</body>

</html>