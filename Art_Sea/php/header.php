<header>
    <div class="container">
        <nav class="navbar navbar-inverse">
            <div class="row">
                <div class="col-md-5">
                    <p class="navbar-text">Welcome to <strong>Art Sea</strong>, enjoy yourself in the sea of masterpieces!</p>
                </div>
                <div class="col-md-7">
                    <ul class="nav navbar-nav pull-right">
                        <li><a href="首页.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                        <li><a href="搜索.php"><span class="glyphicon glyphicon-search"></span> Search</a></li>
                        <li><a href="个人中心.php"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['name']; ?></a></li>
                        <li><a href="购物车.php" data-toggle="popover" data-placement="bottom" title="<?php echo $_SESSION['name']; ?>'sShoppingCart" data-content="商品1名称&lt;br&gt;商品1价格&lt;br&gt;商品2名称&lt;br&gt;商品2价格"><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</a></li>
                        <li><a href="./php/登出.php"><span class="glyphicon glyphicon-log-out"></span> Sign out</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="logoRow">
            <h1><strong>Art Sea </strong><small>swim in the sea of masterpieces</small></h1>
            <div id="footPath"><span class="glyphicon glyphicon-time"></span> Your Footprint:
                <?php showFootprint(); ?>
            </div>
        </div>
        <hr class="featurette-divider">
    </div>
</header>