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
    saveFootprint("Personal Center", 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
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
    $sql = "SELECT name,email,tel,address,balance FROM users WHERE userID='" . $_SESSION['userID'] . "'";
    $result = $connect->query($sql);
    if ($result->num_rows <= 0) {
        ?>
            <div class="jumbotron">
                <div class="container">
                    <p class="text-center">(￣_￣|||) This user has jumped to another world line</p>
                </div>
            </div>
        <?php } else {

        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $tel = $row['tel'];
        $address = $row['address'];
        $balance = $row['balance'];
        $connect->close();
        ?>
            <!-- 修改个人信息 -->
            <div class="modal fade" id="modifyInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <form class="form-horizontal" autocomplete="off" id="formOfModifyInfo">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title">修改个人信息</h3>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="signUpUsername" class="col-md-3">用户名</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="signUpUsername" name="signUpUsername" value="<?php echo $name; ?>">
                                        <p class="signUpError" id="signUpError1"><br></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="signUpEmail" class="col-md-3">邮箱</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" id="signUpEmail" name="signUpEmail" value="<?php echo $email; ?>">
                                        <p class="signUpError" id="signUpError2"><br></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="signUpPassword0" class="col-md-3">原密码</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" id="signUpPassword0" name="signUpPassword0" placeholder="请输入原密码">
                                        <p class="signUpError" id="signUpError0"><br></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="signUpPassword" class="col-md-3">新密码</label>
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
                                        <input type="tel" class="form-control" id="signUpTel" name="signUpTel" value="<?php echo $tel; ?>">
                                        <p class="signUpError" id="signUpError5"><br></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="signUpAddress" class="col-md-3">地址</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="signUpAddress" name="signUpAddress" value="<?php echo $address; ?>">
                                        <p class="signUpError" id="signUpError6"><br></p>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" id="signUpCancel">取消</button>
                                <button type="button" class="btn btn-primary" id="modifyInfoBtn">修改</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- 充值 -->
            <div class="modal fade" id="deposit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">用户充值</h4>
                        </div>
                        <div class="modal-body">
                            <form autocomplete="off">
                                <div class="form-group">
                                    <label for="depositNumber">充值金额</label><br><br>
                                    <input type="text" class="form-control" id="depositNumber" name="depositNumber" placeholder="请输入一个正整数">
                                    <br>
                                    <p class="invisible" id="numberError">请输入一个正整数！</p>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="button" class="btn btn-primary" id="depositBtn" onclick="deposit();">充值</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                setModifyInfo();
            </script>
            <?php include('php/header.php'); ?>

            <main id="personalInfo">
                <div class="container">
                    <h2 class="highLight">Personal Center</h2>
                    <hr class="featurette-divider">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Personal Infomation</h3>
                                </div>
                                <div class="panel-body">
                                    <img id="icon" class="img-responsive" src="icon.jpg">
                                </div>
                                <table class="table">
                                    <tr>
                                        <td>Username:</td>
                                        <td><?php echo $name; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td><?php echo $email; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tel:</td>
                                        <td><?php echo $tel; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Address:</td>
                                        <td><?php echo $address; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Balance:</td>
                                        <td>$<?php echo $balance; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div class="btn-group pull-right" role="group">
                                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modifyInfo"><span class="glyphicon glyphicon-pencil"></span> Modify</button>
                                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#deposit"><span class="glyphicon glyphicon-qrcode"></span> Recharge</button>
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
                                        <h3 class="panel-title container">My artworks list
                                            <button type="button" class="btn btn-default pull-right" onclick="window.open('发布.php','_self');"><span class="glyphicon glyphicon-share-alt"></span> Release</button>
                                        </h3>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <td>artwork title</td>
                                            <td>time uploaded</td>
                                            <td></td>
                                        </tr>

                                        <?php showMyArtworks(); ?>

                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">My order list</h3>
                                    </div>
                                    <table class="table">
                                        <tr>
                                            <td>order ID</td>
                                            <td>artwork information</td>
                                            <td>time created</td>
                                            <td>artwork price</td>
                                        </tr>

                                        <?php showOrders(); ?>

                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">My sell list</h3>
                                    </div>
                                    <table class="table soldWorks">
                                        <tr>
                                            <td>artwork information</td>
                                            <td>time sold</td>
                                            <td>price</td>
                                            <td>buyer information</td>
                                        </tr>

                                        <?php showSells(); ?>

                                    </table>
                                </div>
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