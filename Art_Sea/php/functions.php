<?php

/*连接数据库*/
function connectDB()
{
    $servername = "localhost";
    $username = "root";
    $password = "11111111";
    $dbname = "art_sea";

    $connect = new mysqli($servername, $username, $password, $dbname);
    if ($connect->connect_error) {
        die("连接失败: " . $connect->connect_error . "<br>");
    }
    return $connect;
}

/* 记录足迹 */
function saveFootprint($pageName,$pageUrl){
    if(!isset($_SESSION['footprint'])){$_SESSION['footprint'] = array(array($pageName,$pageUrl));}
    $footprint = $_SESSION['footprint'];
    $footprintLength = count($footprint);
    //检查是否有重复足迹
    $isExist = FALSE;
    for($i = 0;$i < $footprintLength;$i++){
        if($footprint[$i][0] === $pageName){
            $lastIndex = $i;
            $isExist = TRUE;
            break;
        }
    }
    //调整足迹
    if($isExist){
        for($i = 0;$i < $footprintLength - $lastIndex - 1;$i++){
            array_pop($footprint);
        }
        $footprint[$lastIndex] = array($pageName,$pageUrl);
    }else{
        array_push($footprint,array($pageName,$pageUrl));
    }
    $_SESSION['footprint'] = $footprint;
}
/* 输出足迹 */
function showFootprint(){
    if(isset($_SESSION['footprint'])){
        $footprint = $_SESSION['footprint'];
        $str ="";
        for($i = 0;$i < count($footprint) - 1;$i++){
            $str .= '<a href="' . $footprint[$i][1] . '">' . $footprint[$i][0] . ' </a>';
            $str .= '<span class="glyphicon glyphicon-arrow-right"></span>';
        }
        $str .= '<a href="' . $footprint[count($footprint) - 1][1] . '" class="currentPage">' . $footprint[count($footprint) - 1][0] . ' </a>';
        echo $str;
    }
}

/*输出热门艺术品的信息*/
function showHotWorkInfo($hot, $hotDes, $n)
{
    for ($i = 0; $i < $n; $i++) {
        $str = '<p class="self-introduction invisibleP">';
        $str .= $hot[$i]['title'] . '<br>';
        $str .= $hot[$i]['artist'] . '<br>';
        $str .= $hotDes[$i] . '...<br>';
        $str .= '</p>';
        echo $str;
    }
    for ($i = 0; $i < $n; $i++) {
        $str = '<p class="self-workID invisibleP">';
        $str .= $hot[$i]['artworkID'];
        $str .= '</p>';
        echo $str;
    }
}

/*展示最新艺术品*/
function showNewWork($new, $newDes, $n)
{
    $nx = ($n % 3 === 0) ? $n / 3 : (int)($n / 3) + 1;
    for ($i = 1; $i <= 3; $i++) {
        $str = '<div class="col-md-4">';
        for ($j = 1; $j <= $nx && (3 * $j + $i - 3) <= $n; $j++) {
            $str .= '<div class="row"><div class="thumbnail">';
            $str .= '<img src="resources/img/' . $new[3 * $j + $i - 4]['imageFileName'] . '" class="artWorks" alt="' . $new[3 * $j + $i - 4]['title'] . '" onclick="window.open(\'详情.php?workID=' . $new[3 * $j + $i - 4]['artworkID'] . '\');">';
            $str .= '<div class="caption">';
            $str .= '<h3>' . $new[3 * $j + $i - 4]['title'] . '</h3>';
            $str .= '<p>' . $newDes[3 * $j + $i - 4] . '...</p>';
            $str .= '<div class="container"><form action="详情.php" method="GET" target="_blank">';
            $str .= '<input type="text" class="invisibleInput" name="workID" id="workID" value="' . $new[3 * $j + $i - 4]['artworkID'] . '">';
            $str .= '<button class="btn btn-default pull-right" type="submit"><a><span class="glyphicon glyphicon-chevron-right"></span> Details</a></button>';
            $str .= '</form></div></div></div></div>';
        }
        $str .= '</div>';
        echo $str;
    }
}


/* 搜索 */
function search($rank,$page)
{
    $connect = connectDB();
    //获得关键词
    $_keyWords = explode(" ", $_GET['search']);
    $keyWords = array_filter($_keyWords);
    //获得搜索选项
    $options = getSearchOptions();

    if ($keyWords == null) {
        //如果关键词为空
        echo '<div class="jumbotron"><div class="container"><p class="text-center">(⊙ˍ⊙)? no searching result</p></div></div>';
    } else {
        //生成$sql字符串
        $sql = "";
        for ($i = 0; $i < count($options); $i++) {
            foreach ($keyWords as $key) {
                $sql .= "SELECT artworkID,artist,imageFileName,title,description,price,view FROM artworks WHERE " . $options[$i] . " LIKE '%" . $key . "%' UNION ";
            }
        }
        for ($i = 0; $i < 6; $i++) {
            $sql = substr($sql, 0, strlen($sql) - 1);
        }
        $sql .= "ORDER BY " . $rank;
        //echo $sql;

        $result = $connect->query($sql);
        if ($result->num_rows <= 0) {
            echo '<div class="jumbotron"><div class="container"><p class="text-center">(⊙ˍ⊙)? no searching result</p></div></div>';
        } else {
            //输出结果
            for ($i = 0; $row = $result->fetch_assoc(); $i++) {
                $searchResult[$i] = $row;
                $searchResultDes[$i] = substr($searchResult[$i]['description'], 0, 120);
                //去除<em></em>标签，防止裁剪简介时出现错误
                $searchResultDes[$i] = preg_replace('/<em>/i', '', $searchResultDes[$i]);
                $searchResultDes[$i] = preg_replace('/<\/em>/i', '', $searchResultDes[$i]);
            }
            //根据分页情况裁剪数组
            //如果 page = 1 ,裁剪下标为 0-5 的元素；如果 page = 2 ,裁剪下标为 6-11 的元素
            $numberOfPage = (count($searchResult) % 6 === 0) ? count($searchResult) / 6 : (int)(count($searchResult) / 6) + 1;
            if($page < 1 || $page > $numberOfPage){$page=1;}
            $currentPageResult = array();
            $currentPageDes = array();
            for($i = ($page - 1) * 6;$i < $page * 6 && $i < count($searchResult);$i++){
                $currentPageResult[count($currentPageResult)] = $searchResult[$i];
                $currentPageDes[count($currentPageDes)] = $searchResultDes[$i];
            }

            //设置$n为所有结果的大小，输出所有结果
            showSearchResult($currentPageResult, $currentPageDes, count($currentPageResult));
            //生成分页按钮
            showChangePageBtn($numberOfPage,$page);
        }
    }
    $connect->close();
}
/* 获得搜索选项 */
function getSearchOptions(){
    $options = array("title");
    $isOption = TRUE;
    if (isset($_GET['searchBy']) && is_array($_GET['searchBy'])) {
        foreach (($_GET['searchBy']) as $option) {
            if ($option !== "title" && $option !== "artist" && $option !== "description") {
                $isOption = FALSE;
            }
        }
        if($isOption){
            $options = $_GET['searchBy'];
        }
    }
    return $options;
}
/* 展示搜索结果 */
function showSearchResult($searchResult, $searchResultDes, $n)
{
    $nx = ($n % 3 === 0) ? $n / 3 : (int)($n / 3) + 1;
    echo '<div class="row">';
    for ($i = 1; $i <= 3; $i++) {
        $str = '<div class="col-md-4">';
        for ($j = 1; $j <= $nx && (3 * $j + $i - 3) <= $n; $j++) {
            $str .= '<div class="row"><div class="thumbnail result">';
            $str .= '<img src="resources/img/' . $searchResult[3 * $j + $i - 4]['imageFileName'] . '" class="artWorks" alt="' . $searchResult[3 * $j + $i - 4]['title'] . '" onclick="window.open(\'详情.php?workID=' . $searchResult[3 * $j + $i - 4]['artworkID'] . '\');"><div class="caption">';
            $str .= '<h4>' . $searchResult[3 * $j + $i - 4]['title'] . '</h4>';
            $str .= '<div class="container"><div class="col-md-6"><div class="pull-left">';
            $str .= '<p>' . $searchResult[3 * $j + $i - 4]['artist'] . '</p>';
            $str .= '</div></div><div class="col-md-6"><div class="pull-right"><p class="highLight">View：' . $searchResult[3 * $j + $i - 4]['view'] . '</p></div></div></div>';
            $str .= '<p>' . $searchResultDes[3 * $j + $i - 4] . '...</p>';
            $str .= '<div class="container"><div class="col-md-6"><p class="price highLight">Price：$' . $searchResult[3 * $j + $i - 4]['price'] . '</p></div>';
            $str .= '<div class="col-md-6"><form action="详情.php" method="GET" target="_blank">';
            $str .= '<input type="text" class="invisibleInput" name="workID" id="workID" value="' . $searchResult[3 * $j + $i - 4]['artworkID'] . '">';
            $str .= '<button class="btn btn-default pull-right" type="submit"><a><span class="glyphicon glyphicon-chevron-right"></span> Details</a></button>';
            $str .= '</form></div></div></div></div></div>';
        }
        $str .= '</div>';
        echo $str;
    }
    echo '</div>';
}
/* 生成分页按钮 */
function showChangePageBtn($numberOfPage,$page){
    $str = '<div class="row"><nav aria-label="Page navigation" class="text-center"><ul class="pagination" id="changePageBtn">';
    for($i = 1;$i <= $numberOfPage;$i++){
        if($i === $page){
            $str .= '<li class="active"><a href="#results" onclick="changePage(' . $i . ')">' . $i . '</a></li>';
        }
        else{
            $str .= '<li><a href="#results" onclick="changePage(' . $i . ')">' . $i . '</a></li>';
        }
    }
    $str .= '</ul></nav></div>';
    echo $str;
}

/* 获得用户购物车商品 */
function getShoppingCartArtworks(){
    $connect = connectDB();
    $sql = "SELECT artworkID FROM carts WHERE userID='" . $_SESSION['userID'] . "'";
    $result = $connect->query($sql);
    if ($result->num_rows <= 0){
        $artworkID = NULL;
    }else{
        for($i = 0;$row = $result->fetch_assoc();$i++){
            $artworkID[$i] = $row['artworkID'];
        }
    }
    $connect->close();
    return $artworkID;
}
/* 获得购物车商品信息 */
function getShoppingCart($artworkID){
    if($artworkID === NULL){
        echo '<div class="jumbotron"><div class="container"><p class="text-center"><br><br><br>(⊙ˍ⊙)? no artwork in your shopping cart<br><br><br></p></div></div>';
    }else{
        $connect = connectDB();
        $sum = 0;
        for($i = 0;$i < count($artworkID);$i++){
            $sql = "SELECT artworkID,title,artist,imageFileName,price,description FROM artworks WHERE artworkID='" . $artworkID[$i] . "'";
            $result = $connect->query($sql);
            if ($result->num_rows <= 0){
                showShoppingCart(NULL);
            }else{
                $row = $result->fetch_assoc();
                $sum += $row['price'];
                showShoppingCart($row);
            }
        }
        showPurchaseBtn($sum,$artworkID);
        $connect->close();
    }
}
/* 展示购物车内商品 */
function showShoppingCart($row){
    if($row === NULL){
        echo '<div id="cartWorks" class="row">This artwork has disappeared</div>';
    }else{
        $rowDes = substr($row['description'], 0, 200);
        $rowDes = preg_replace('/<em>/i','',$rowDes);
        $rowDes = preg_replace('/<\/em>/i','',$rowDes);
        $str = '<div id="cartWorks" class="row"><div class="col-md-3"><img src="resources/img/' . $row['imageFileName'] . '" class="cartImg pull-left"></div>';
        $str .= '<div class="col-md-3"><div class="panel panel-info"><div class="panel-heading"><h4 class="panel-title">Artwork Infomation</h4></div>';
        $str .= '<table class="table"><tr><td>title:</td><td>' . $row['title'] . '</td></tr>';
        $str .= '<tr><td>artist:</td><td>' . $row['artist'] . '</td></tr>';
        $str .= '<tr><td>price:</td><td>$' . $row['price'] . '</td></tr></table></div></div>';
        $str .= '<div class="col-md-4"><div class="panel panel-info"><div class="panel-heading"><h4 class="panel-title">Artwork Description</h4></div>';
        $str .= '<div class="panel-body">' . $rowDes . '...</div></div></div>';
        $str .= '<div class="col-md-2"><div class="btn-group pull-right" role="group">';
        $str .= '<button class="btn btn-default"><span class="glyphicon glyphicon-chevron-right"></span><a href="详情.php?workID=' . $row['artworkID'] . '"> 详情</a></button>';
        $str .= '<button type="button" class="btn btn-danger" onclick="deleteArtwork(' . $row['artworkID'] . ');"><span class="glyphicon glyphicon-trash"></span> 删除</button>';
        $str .= '</div></div></div><hr class="featurette-divider">';
        echo $str;
    }
}
/* 展示总价和下单按钮 */
function showPurchaseBtn($sum,$artworkID){
    $str = '<div class="row"><div class="col-md-2 col-md-offset-8"><p class="highLight pull-right">Sum:$' . $sum . '</p>';
    $str .= '</div><div class="col-md-2"><button type="button" class="btn btn-default purchase pull-right">';
    $str .= '<span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;下单</button></div></div>';
    echo $str;
}

/* 悬浮购物车 */
function littleShoppingCart($artworkID){
    if($artworkID === NULL){
        echo 'No artworks in your cart';
    }else{
        $connect = connectDB();
        for($i = 0;$i < count($artworkID);$i++){
            $sql = "SELECT title,price FROM artworks WHERE artworkID='" . $artworkID[$i] . "'";
            $result = $connect->query($sql);
            if ($result->num_rows <= 0){
                echo 'This artwork has disappeared';
            }else{
                $row = $result->fetch_assoc();
                echo $row['title'] . '&lt;br&gt;$' . $row['price'] . '&lt;br&gt;';
            }
        }
        $connect->close();
    }
}