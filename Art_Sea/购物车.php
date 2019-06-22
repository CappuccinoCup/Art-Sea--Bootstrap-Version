<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Bootstrap核心css文件 -->
    <link href="bootstrap-3.0.0/dist/css/bootstrap.css" rel="stylesheet">
    <!-- 其它css样式 -->
    <link href="css/公用.css" rel="stylesheet">
    <link href="css/购物车.css" rel="stylesheet">

    <script src="javascript/公用.js"></script>
    <script src="javascript/购物车.js"></script>
</head>

<body>
    <?php include('php/functions.php'); ?>

    <?php
    session_start();
    saveFootprint("Shopping Cart",'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    if (!isset($_SESSION['admin']) || $_SESSION['admin'] === FALSE) {
        ?>
        <div class="jumbotron">
            <div class="container">
                <p class="text-center">The user has signed out.Please go to <a href="首页.php">Home Page</a> and sign in.</p>
            </div>
        </div>
    <?php
} else {
    $artworkID = getShoppingCartArtworks();
    ?>
        <?php include('php/modal_purchase.php'); ?>
        <?php include('php/header.php'); ?>

        <main class="shoppingCart">
            <div class="container">
                <h2 class="highLight">Shopping Cart</h2>
                <hr class="featurette-divider">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">My Shopping Cart</h3>
                    </div>
                    <div class="panel-body container">
                        <?php getShoppingCart($artworkID); ?>
                    </div>
                </div>
                <hr class="featurette-divider">
            </div>
        </main>

        <?php include('php/footer.php'); ?>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="bootstrap-3.0.0/assets/js/jquery.js"></script>
        <script src="bootstrap-3.0.0/dist/js/bootstrap.min.js"></script>
    <?php } ?>
</body>

</html>