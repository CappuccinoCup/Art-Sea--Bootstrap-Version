<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shopping Cart</title>
    <!-- Bootstrap核心css文件 -->
    <link href="bootstrap-3.0.0/dist/css/bootstrap.css" rel="stylesheet">
    <!-- 其它css样式 -->
    <link href="css/公用.css" rel="stylesheet">
    <link href="css/购物车.css" rel="stylesheet">

    <script src="javascript/公用.js"></script>
    <script src="javascript/购物车.js"></script>
</head>

<body>
    <?php
    session_start();
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

        <main class="shoppingCart">
            <div class="container">
                <h2 class="highLight">Shopping Cart</h2>
                <hr class="featurette-divider">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">我的购物车</h3>
                    </div>
                    <div class="panel-body container">
                        <div id="cartWorks" class="row">
                            <div class="col-md-3"><img src="073010.jpg" class="cartImg pull-left"></div>
                            <div class="col-md-3">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">商品信息</h4>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <td>名称：</td>
                                            <td>这里是艺术品名称</td>
                                        </tr>
                                        <tr>
                                            <td>作家：</td>
                                            <td>这里是作家名字</td>
                                        </tr>
                                        <tr>
                                            <td>价格：</td>
                                            <td>这里是艺术品价格</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">商品简介</h4>
                                    </div>
                                    <div class="panel-body">
                                        这里是商品简介<br>这里是商品简介<br>这里是商品简介<br>这里是商品简介<br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <form action="详情.html" method="GET" target="_blank">
                                    <input type="text" class="invisibleInput" name="workID" id="workID" value="000001">
                                    <div class="btn-group pull-right" role="group">
                                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-chevron-right"></span> 详情</button>
                                        <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> 删除</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr class="featurette-divider">
                        <div id="cartWorks" class="row">
                            <div class="col-md-3"><img src="073010.jpg" class="cartImg pull-left"></div>
                            <div class="col-md-3">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">商品信息</h4>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <td>名称：</td>
                                            <td>这里是艺术品名称</td>
                                        </tr>
                                        <tr>
                                            <td>作家：</td>
                                            <td>这里是作家名字</td>
                                        </tr>
                                        <tr>
                                            <td>价格：</td>
                                            <td>这里是艺术品价格</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">商品简介</h4>
                                    </div>
                                    <div class="panel-body">
                                        这里是商品简介<br>这里是商品简介<br>这里是商品简介<br>这里是商品简介<br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <form action="详情.html" method="GET" target="_blank">
                                    <input type="text" class="invisibleInput" name="workID" id="workID" value="000001">
                                    <div class="btn-group pull-right" role="group">
                                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-chevron-right"></span> 详情</button>
                                        <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> 删除</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr class="featurette-divider">
                        <div class="row">
                            <div class="col-md-2 col-md-offset-8">
                                <p class="highLight pull-right">总计：$100000</p>
                            </div>
                            <div class="col-md-2"><button type="button" class="btn btn-default purchase pull-right"><span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;下单</button></div>
                        </div>
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