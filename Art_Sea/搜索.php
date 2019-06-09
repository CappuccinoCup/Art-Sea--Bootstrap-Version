<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>搜索</title>
    <!-- Bootstrap核心css文件 -->
    <link href="bootstrap-3.0.0/dist/css/bootstrap.css" rel="stylesheet">
    <!-- 其它css样式 -->
    <link href="css/公用.css" rel="stylesheet">
    <link href="css/搜索.css" rel="stylesheet">

    <script src="javascript/公用.js"></script>
    <script src="javascript/搜索.js"></script>
    <script>
        window.onload = function() {
            setSign();
        }
    </script>
    <?php session_start(); ?>
</head>

<body>

    <!-- 登录 -->
    <div class="modal fade" id="signIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form autocomplete="off" id="formOfSignIn">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">用户登录</h3>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="signInUsername">用户名</label>
                            <input type="text" class="form-control" id="signInUsername" name="signInUsername">
                        </div>
                        <p class="invisible" id="signInError1">用户名为空！</p>
                        <div class="form-group">
                            <label for="signInPassword">密码</label>
                            <input type="password" class="form-control" id="signInPassword" name="signInPassword">
                        </div>
                        <p class="invisible" id="signInError2">密码为空!</p>
                        <p class="invisible" id="signInError3">用户名或密码错误！</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="signInCancel">取消</button>
                        <button type="button" class="btn btn-primary" id="signInBtn">登录</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 注册 -->
    <div class="modal fade" id="signUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <form class="form-horizontal" autocomplete="off" id="formOfSignUp">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title">用户注册</h3>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="signUpUsername" class="col-md-3">用户名</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="signUpUsername" name="signUpUsername" placeholder="请输入用户名">
                                <p class="signUpError" id="signUpError1"><br></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signUpEmail" class="col-md-3">邮箱</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" id="signUpEmail" name="signUpEmail" placeholder="请输入正确的邮箱">
                                <p class="signUpError" id="signUpError2"><br></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signUpPassword" class="col-md-3">密码</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="signUpPassword" name="signUpPassword" placeholder="请输入大于等于六位的非纯数字">
                                <p class="signUpError" id="signUpError3"><br></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signUpPassword" class="col-md-3">确认密码</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="signUpRePassword" name="signUpRePassword" placeholder="请再次输入密码">
                                <p class="signUpError" id="signUpError4"><br></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signUpTel" class="col-md-3">电话</label>
                            <div class="col-md-9">
                                <input type="tel" class="form-control" id="signUpTel" name="signUpTel" placeholder="请输入正确的电话">
                                <p class="signUpError" id="signUpError5"><br></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="signUpAddress" class="col-md-3">地址</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="signUpAddress" name="signUpAddress" placeholder="请输入正确的邮寄地址">
                                <p class="signUpError" id="signUpError6"><br></p>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="signUpCancel">取消</button>
                        <button type="button" class="btn btn-primary" id="signUpBtn">注册</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <header>
        <div class="container">
            <nav class="navbar navbar-inverse">
                <div class="row">
                    <div class="col-md-5">
                        <p class="navbar-text">Welcome to <strong>Art Sea</strong>, enjoy yourself in the sea of masterpieces!</p>
                    </div>
                    <div class="col-md-7">
                        <ul class="nav navbar-nav pull-right">
                            <li><a href="首页.php"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
                            <li><a href="搜索.php"><span class="glyphicon glyphicon-search"></span> 搜索</a></li>
                            <?php
                            if (!isset($_SESSION['admin']) || $_SESSION['admin'] === FALSE) {
                                ?>
                                <li><a href="#" data-toggle="modal" data-target="#signIn"><span class="glyphicon glyphicon-log-in"></span> 登录</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#signUp"><span class="glyphicon glyphicon-list-alt"></span> 注册</a></li>
                            <?php
                        } else {
                            ?>
                                <li><a href="个人中心.php"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['name']; ?></a></li>
                                <li><a href="购物车.php" data-toggle="popover" data-placement="bottom" title="<?php echo $_SESSION['name']; ?>'sShoppingCart" data-content="商品1名称&lt;br&gt;商品1价格&lt;br&gt;商品2名称&lt;br&gt;商品2价格"><span class="glyphicon glyphicon-shopping-cart"></span> 购物车</a></li>
                                <li><a href="登出.php"><span class="glyphicon glyphicon-log-out"></span> 登出</a></li>
                            <?php
                        } ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="logoRow">
                <h1><strong>Art Sea </strong><small>swim in the sea of masterpieces</small></h1>
                <div id="footPath"><span class="glyphicon glyphicon-time"></span> 您的足迹：
                    <a href="首页.html">首页 </a>
                    <span class="glyphicon glyphicon-arrow-right"></span>
                    <a href="搜索.html" class="currentPage">搜索 </a>
                </div>
            </div>
            <hr class="featurette-divider">
        </div>
    </header>

    <section class="searchRow">
        <div class="container">
            <form class="form-horizontal" id="formOfSearch" action="#" method="GET">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-1 col-md-offset-3"><label for="searchWorks" class="control-label pull-right">Search</label></div>
                        <div class="col-md-4"><input type="text" class="form-control" id="search" name="search"></div>
                        <div class="col-md-1"><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> 搜索</button></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="searchBy" value="byWork" checked> 搜索作品
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="searchBy" value="byArtist"> 搜索艺术家
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="searchBy" value="byDescri"> 搜索简介
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <hr class="featurette-divider">
        </div>
    </section>

    <section class="hotWorks">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-md-offset-1">
                    <h3>热门搜索</h3>
                </div>
                <div class="col-md-8">
                    <div id="rank" class="pull-right">
                        <label class="radio-inline">
                            <input type="radio" name="rankBy" id="rankBy1" value="priceDown" checked> 价格降序
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="rankBy" id="rankBy2" value="priceUp"> 价格升序
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="rankBy" id="rankBy3" value="hot"> 点击量
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="thumbnail result">
                                <img src="073010.jpg" class="artWorks" alt="热门1">
                                <div class="caption">
                                    <h4>艺术品标题</h4>
                                    <div class="container">
                                        <div class="col-md-6">
                                            <div class="pull-left">
                                                <p>艺术家</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="pull-right">
                                                <p class="highLight">点击量：1000</p>
                                            </div>
                                        </div>
                                    </div>
                                    <p>这里是简介这里是简介<br>这里是简介这里是简介<br></p>
                                    <div class="container">
                                        <div class="col-md-6">
                                            <p class="price highLight">价格：$10000</p>
                                        </div>
                                        <div class="col-md-6">
                                            <form action="详情.php" method="GET" target="_blank">
                                                <input type="text" class="invisibleInput" name="workID" id="workID" value="000001">
                                                <button class="btn btn-default pull-right" type="submit"><a><span class="glyphicon glyphicon-chevron-right"></span> 查看详情</a></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="thumbnail result">
                                <img src="073010.jpg" class="artWorks" alt="热门1">
                                <div class="caption">
                                    <h4>艺术品标题</h4>
                                    <div class="container">
                                        <div class="col-md-6">
                                            <div class="pull-left">
                                                <p>艺术家</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="pull-right">
                                                <p class="highLight">点击量：1000</p>
                                            </div>
                                        </div>
                                    </div>
                                    <p>这里是简介这里是简介<br>这里是简介这里是简介<br></p>
                                    <div class="container">
                                        <div class="col-md-6">
                                            <p class="price highLight">价格：$10000</p>
                                        </div>
                                        <div class="col-md-6">
                                            <form action="详情.php" method="GET" target="_blank">
                                                <input type="text" class="invisibleInput" name="workID" id="workID" value="000001">
                                                <button class="btn btn-default pull-right" type="submit"><a><span class="glyphicon glyphicon-chevron-right"></span> 查看详情</a></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="thumbnail result">
                                <img src="073010.jpg" class="artWorks" alt="热门1">
                                <div class="caption">
                                    <h4>艺术品标题</h4>
                                    <div class="container">
                                        <div class="col-md-6">
                                            <div class="pull-left">
                                                <p>艺术家</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="pull-right">
                                                <p class="highLight">点击量：1000</p>
                                            </div>
                                        </div>
                                    </div>
                                    <p>这里是简介这里是简介<br>这里是简介这里是简介<br></p>
                                    <div class="container">
                                        <div class="col-md-6">
                                            <p class="price highLight">价格：$10000</p>
                                        </div>
                                        <div class="col-md-6">
                                            <form action="详情.php" method="GET" target="_blank">
                                                <input type="text" class="invisibleInput" name="workID" id="workID" value="000001">
                                                <button class="btn btn-default pull-right" type="submit"><a><span class="glyphicon glyphicon-chevron-right"></span> 查看详情</a></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="featurette-divider">
        </div>
    </section>

    <footer>
        <div class="container">
            <p>2019©Art&nbsp;Sea&nbsp;&nbsp;&nbsp;&nbsp;@CappuccinoCup</p>
        </div>
    </footer>

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


</body>

</html>