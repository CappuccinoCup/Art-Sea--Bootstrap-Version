<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
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
</head>

<body>
    <?php include('php/functions.php'); ?>

    <?php session_start(); ?>

    <?php include('php/modal.php'); ?>

    <?php include('php/header_search.php'); ?>

    <section class="searchRow">
        <div class="container">
            <form class="form-horizontal" id="formOfSearch" action="搜索.php" method="GET" autocomplete="off">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-1 col-md-offset-3"><label for="searchWorks" class="control-label pull-right">Search</label></div>
                        <div class="col-md-4"><input type="text" class="form-control" id="search" name="search"<?php if(isset($_GET['search'])){echo ' value="'.$_GET['search'].'"';} ?>>
                        </div>
                        <div class="col-md-1"><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="searchBy[]" value="title"> artworks
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="searchBy[]" value="artist"> artists
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="searchBy[]" value="description"> descriptions
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
                    <h3>Search Results</h3>
                </div>
                <div class="col-md-8">
                    <div id="rank" class="pull-right">
                        <label class="radio-inline">
                            <input type="radio" name="rankBy" id="rankBy1" value="priceDown" checked> price DESC
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="rankBy" id="rankBy2" value="priceUp"> price ASC
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="rankBy" id="rankBy3" value="hot"> view
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <!-- 搜索结果 -->
                    <?php
                    if (!isset($_GET['search'])) {
                        ?>
                        <div class="jumbotron">
                            <div class="container">
                                <p class="text-center">=￣ω￣= You don't seem to have searched for anything</p>
                            </div>
                        </div>
                    <?php
                } else {
                    showSearchResult();
                } ?>

                </div>
            </div>
            <hr class="featurette-divider">
        </div>
    </section>

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

</body>

</html>