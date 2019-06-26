<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <!-- Bootstrap核心css文件 -->
    <link href="bootstrap-3.0.0/dist/css/bootstrap.css" rel="stylesheet">
    <!-- 其它css样式 -->
    <link href="css/公用.css" rel="stylesheet">
    <link href="css/详情.css" rel="stylesheet">

    <script src="javascript/公用.js"></script>
    <script src="javascript/详情.js"></script>
    <script>
        window.onload = function() {
            setSign();
            background();
        }
    </script>
</head>

<body>
    <?php include('php/functions.php'); ?>

    <?php
    session_start();
    saveFootprint("Details",'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    if (!isset($_GET['workID'])) {
        ?>
        <div class="jumbotron">
            <div class="container">
                <p class="text-center">(*^_^*) It's good for young people to have ideas</p>
            </div>
        </div>
    <?php
} else {
    $connect = connectDB();

    $sql = "SELECT * FROM artworks WHERE artworkID='" . $_GET['workID'] . "'";
    $result = $connect->query($sql);
    if ($result->num_rows <= 0) {
        ?>
            <div class="jumbotron">
                <div class="container">
                    <p class="text-center">ԅ(¯﹃¯ԅ) This artwork has jumped to another world line</p>
                </div>
            </div>
        <?php
    } else {
        $row = $result->fetch_assoc();
        ?>

            <?php include('php/modal.php'); ?>

            <?php include('php/header_details.php'); ?>

            <section id="work">
                <div class="container">
                    <h2><?php echo $row['title']; ?></h2>
                    <p>By <a href="搜索.php?search=<?php echo $row['artist']; ?>&searchBy%5B%5D=artist"><?php echo $row['artist']; ?></a></p>
                    <div class="row">
                        <div class="col-md-10">
                            <?php
                            if ($row['width'] * 1.7 <= $row['height']) {
                                ?>
                                <div class="row">
                                    <img src="resources/img/<?php echo $row['imageFileName']; ?>" class="img-thumbnail img-responsive" alt="<?php echo $row['imageFileName']; ?>">
                                </div>
                                <p>&nbsp;</p>
                                <div class="row">
                                    <div class="col-md-7">
                                        <p><?php echo $row['description']; ?></p>
                                    </div>
                                    <div class="col-md-5">
                                        <p class="highLight">$<?php echo $row['price']; ?></p>                                
                                        <button type="button" class="btn btn-default" onclick="addToShoppingCart(<?php echo $row['artworkID']; ?>);">
                                            <a><span class="glyphicon glyphicon-shopping-cart"></span> Add to Shopping Cart</a>
                                        </button>
                                        <p class="sold"><?php if(($row['orderID']) !== null){echo "This artwork has been sold.";} ?>&nbsp;</p>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Product Details</div>
                                            <table class="table">
                                                <tr>
                                                    <th>Date:</th>
                                                    <td><?php echo $row['yearOfWork']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Dimensions:</th>
                                                    <td><?php echo $row['width']; ?>cm x <?php echo $row['height']; ?>cm</td>
                                                </tr>
                                                <tr>
                                                    <th>Genres:</th>
                                                    <td><?php echo $row['genre']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>View:</th>
                                                    <td><?php $view = $row['view'] + 1; echo $view; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        } else {
                            ?>
                                <div class="row">
                                    <div class="col-md-<?php if ($row['width'] >= $row['height']) {
                                                            echo 5;
                                                        } else {
                                                            echo 7;
                                                        } ?>">
                                        <img src="resources/img/<?php echo $row['imageFileName']; ?>" class="img-thumbnail img-responsive" alt="<?php echo $row['imageFileName']; ?>">
                                    </div>
                                    <div class="col-md-<?php if ($row['width'] >= $row['height']) {
                                                            echo 7;
                                                        } else {
                                                            echo 5;
                                                        } ?>">
                                        <p><?php echo $row['description']; ?></p>
                                        <p class="highLight">$<?php echo $row['price']; ?></p>                                        
                                        <button type="button" class="btn btn-default" onclick="addToShoppingCart(<?php echo $row['artworkID']; ?>);">
                                            <a><span class="glyphicon glyphicon-shopping-cart"></span> Add to Shopping Cart</a>
                                        </button>                                       
                                        <p class="sold"><?php if(($row['orderID']) !== null){echo "This artwork has been sold.";} ?>&nbsp;</p>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Product Details</div>
                                            <table class="table">
                                                <tr>
                                                    <th>Date:</th>
                                                    <td><?php echo $row['yearOfWork']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Dimensions:</th>
                                                    <td><?php echo $row['width']; ?>cm x <?php echo $row['height']; ?>cm</td>
                                                </tr>
                                                <tr>
                                                    <th>Genres:</th>
                                                    <td><?php echo $row['genre']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>View:</th>
                                                    <td><?php $view = $row['view'] + 1; echo $view; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <p>&nbsp;</p>
                            <?php 
                            } 
                        ?>
                        </div>
                        <div class="col-md-2">
                            <div class="panel panel-info">
                                <h3 class="panel-heading">Famous Artists</h3>
                                <ul class="panel-body list-group">
                                    <li class="list-group-item"><a href="搜索.php?search=Michelangelo&searchBy%5B%5D=artist">Michelangelo</a></li>
                                    <li class="list-group-item"><a href="搜索.php?search=Picasso&searchBy%5B%5D=artist">Picasso</a></li>
                                    <li class="list-group-item"><a href="搜索.php?search=Raphael&searchBy%5B%5D=artist">Raphael</a></li>
                                    <li class="list-group-item"><a href="搜索.php?search=Van Gogh&searchBy%5B%5D=artist">Van Gogh</a></li>
                                </ul>
                            </div>
                            <div class="panel panel-info">
                                <h3 class="panel-heading">Popular Artworks</h3>
                                <ul class="panel-body list-group">
                                    <li class="list-group-item"><a href="详情.php?workID=392">The Creation of Adam</a></li>
                                    <li class="list-group-item"><a href="详情.php?workID=174">Guernica</a></li>
                                    <li class="list-group-item"><a href="详情.php?workID=400">The School of Athens</a></li>
                                    <li class="list-group-item"><a href="详情.php?workID=60">Sunflowers</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr class="featurette-divider">
                </div>
            </section>

            <?php include('php/footer.php'); ?>
            <?php 
            $artworkID = $row['artworkID'];
            $sql = "UPDATE artworks SET view='" . $view . "' WHERE artworkID='" . $artworkID . "'";
            $connect->query($sql);
            $connect->close(); 
            ?>

            <!-- Bootstrap core JavaScript
            ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="bootstrap-3.0.0/assets/js/jquery.js"></script>
            <script src="bootstrap-3.0.0/dist/js/bootstrap.min.js"></script>

            <script>
                $(function() {
                    $('[data-toggle="popover"]').popover({
                        html: true,
                        trigger: 'hover'
                    })
                }); //设置弹出框
            </script>
        <?php
    }
}
?>

</body>

</html>