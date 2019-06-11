<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Center</title>
    <!-- Bootstrap核心css文件 -->
    <link href="bootstrap-3.0.0/dist/css/bootstrap.css" rel="stylesheet">
    <!-- 其它css样式 -->
    <link href="css/公用.css" rel="stylesheet">
    <link href="css/个人中心.css" rel="stylesheet">

    <script src="javascript/公用.js"></script>
    <script src="javascript/个人中心.js"></script>
</head>

<body>
    <?php include('php/functions.php'); ?>

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
    $connect = connectDB();
    $sql = "SELECT name,email,tel,address,balance FROM users WHERE name='" . $_SESSION['name'] . "'";
    $result = $connect->query($sql);
    if ($result->num_rows <= 0) {
        ?>
            <div class="jumbotron">
                <div class="container">
                    <p class="text-center">(￣_￣|||) This user does not exist</p>
                </div>
            </div>
        <?php } else {

        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $tel = $row['tel'];
        $address = $row['address'];
        $balance = $row['balance'];
        ?>
            <!-- 充值 -->
            <div class="modal fade" id="deposit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">用户充值</h4>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="POST" autocomplete="off">
                                <div class="form-group">
                                    <label for="depositNumber">充值金额</label>
                                    <input type="text" class="form-control" id="depositNumber" name="depositNumber" placeholder="请输入整数">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="button" class="btn btn-primary" id="depositBtn">充值</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('php/header.php'); ?>

            <main id="personalInfo">
                <div class="container">
                    <h2 class="highLight">Personal Center</h2>
                    <hr class="featurette-divider">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">个人信息</h3>
                                </div>
                                <div class="panel-body">
                                    <img id="icon" class="img-responsive" src="icon.jpg">
                                </div>
                                <table class="table">
                                    <tr>
                                        <td>用户名：</td>
                                        <td><?php echo $name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>电子邮箱：</td>
                                        <td><?php echo $email; ?></td>
                                    </tr>
                                    <tr>
                                        <td>电话：</td>
                                        <td><?php echo $tel; ?></td>
                                    </tr>
                                    <tr>
                                        <td>地址：</td>
                                        <td><?php echo $address; ?></td>
                                    </tr>
                                    <tr>
                                        <td>余额：</td>
                                        <td>$<?php echo $balance; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="btn-group pull-right" role="group">
                                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> 修改</button>
                                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#deposit"><span class="glyphicon glyphicon-qrcode"></span> 充值</button>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">我的艺术品列表</h3>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <td>艺术品名</td>
                                            <td>上传时间</td>
                                            <td></td>
                                        </tr>
                                        <tr class="myWorks">
                                            <td>
                                                <p>
                                                    <form action="详情.html" method="GET" target="_blank">
                                                        <input type="text" class="invisibleInput" name="workID" id="workID" value="000001">
                                                        <button class="btn btn-link" type="submit">这里展示艺术品名</button>
                                                    </form>
                                                </p>
                                            </td>
                                            <td>
                                                <p>这里展示上传时间</p>
                                            </td>
                                            <td>
                                                <div class="btn-group pull-right" role="group">
                                                    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> 修改</button>
                                                    <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> 删除</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="myWorks">
                                            <td>
                                                <p>
                                                    <form action="详情.html" method="GET" target="_blank">
                                                        <input type="text" class="invisibleInput" name="workID" id="workID" value="000001">
                                                        <button class="btn btn-link" type="submit">这里展示艺术品名</button>
                                                    </form>
                                                </p>
                                            </td>
                                            <td>
                                                <p>这里展示上传时间</p>
                                            </td>
                                            <td>
                                                <div class="btn-group pull-right" role="group">
                                                    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> 修改</button>
                                                    <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> 删除</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">我的订单列表</h3>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <td>订单编号</td>
                                            <td>商品信息</td>
                                            <td>订单时间</td>
                                            <td>订单总金额</td>
                                        </tr>
                                        <tr>
                                            <td>这里展示订单编号</td>
                                            <td>
                                                <form action="详情.html" method="GET" target="_blank">
                                                    <input type="text" class="invisibleInput" name="workID" id="workID" value="000001">
                                                    <button class="btn btn-link" type="submit">这里展示商品信息</button>
                                                </form>
                                            </td>
                                            <td>这里展示订单时间</td>
                                            <td>这里展示订单总金额</td>
                                        </tr>
                                        <tr>
                                            <td>这里展示订单编号</td>
                                            <td>
                                                <form action="详情.html" method="GET" target="_blank">
                                                    <input type="text" class="invisibleInput" name="workID" id="workID" value="000001">
                                                    <button class="btn btn-link" type="submit">这里展示商品信息</button>
                                                </form>
                                            </td>
                                            <td>这里展示订单时间</td>
                                            <td>这里展示订单总金额</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">我的卖出列表</h3>
                                    </div>
                                    <table class="table soldWorks">
                                        <tr>
                                            <td>艺术品信息</td>
                                            <td>卖出时间</td>
                                            <td>卖出价格</td>
                                            <td>购买人信息</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <form action="详情.html" method="GET" target="_blank">
                                                    <input type="text" class="invisibleInput" name="workID" id="workID" value="000001">
                                                    <button class="btn btn-link" type="submit">这里展示艺术品信息</button>
                                                </form>
                                            </td>
                                            <td>这里展示卖出时间</td>
                                            <td>这里展示卖出价格</td>
                                            <td><a data-toggle="popover" data-placement="top" title="@CappuccinoCup" data-content="邮箱：969837250@qq.com&lt;br&gt;电话：secret&lt;br&gt;地址：法国">购买人用户名</a>
                                        </tr>
                                        <tr>
                                            <td>
                                                <form action="详情.html" method="GET" target="_blank">
                                                    <input type="text" class="invisibleInput" name="workID" id="workID" value="000001">
                                                    <button class="btn btn-link" type="submit">这里展示艺术品信息</button>
                                                </form>
                                            </td>
                                            <td>这里展示卖出时间</td>
                                            <td>这里展示卖出价格</td>
                                            <td><a data-toggle="popover" data-placement="top" title="@CappuccinoCup" data-content="邮箱：969837250@qq.com&lt;br&gt;电话：secret&lt;br&gt;地址：法国">购买人用户名</a>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="featurette-divider">
                </div>
            </main>

            <?php include('php/footer.php'); ?>
            <?php $connect->close(); ?>

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
        <?php }
} ?>

</body>

</html>