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
            $str .= '<img src="resources/img/' . $new[3 * $j + $i - 4]['imageFileName'] . '" class="artWorks" alt="' . $new[3 * $j + $i - 4]['title'] . '">';
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

/*展示搜索结果*/
function showSearchResult()
{
    $connect = connectDB();
    //获得关键词
    $_keyWords = explode(" ", $_GET['search']);
    $keyWords = array_filter($_keyWords);
    //获得搜索选项
    $options = array("title");
    if (isset($_GET['searchBy'])) {
        $options = $_GET['searchBy'];
    }
    
    if ($keyWords == null) {
        //如果关键词为空
        echo '<div class="jumbotron"><div class="container"><p class="text-center">(⊙ˍ⊙)? 没有任何搜索结果哦</p></div></div>';
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
        $sql .= "ORDER BY price DESC";
        //echo $sql;

        $result = $connect->query($sql);
        if ($result->num_rows <= 0) {
            echo '<div class="jumbotron"><div class="container"><p class="text-center">(⊙ˍ⊙)? 没有任何搜索结果哦</p></div></div>';
        } else {
            //输出结果
            for ($i = 0; $row = $result->fetch_assoc(); $i++) {
                $searchResult[$i] = $row;
                $searchResultDes[$i] = substr($searchResult[$i]['description'], 0, 120);
                //去除<em></em>标签，防止裁剪简介时出现错误
                $searchResultDes[$i] = preg_replace('/<em>/i','',$searchResultDes[$i]);
                $searchResultDes[$i] = preg_replace('/<\/em>/i','',$searchResultDes[$i]);
            }
            //设置$n为所有结果的大小，输出所有结果
            $n = count($searchResult);
            $nx = ($n % 3 === 0) ? $n / 3 : (int)($n / 3) + 1;
            for ($i = 1; $i <= 3; $i++) {
                $str = '<div class="col-md-4">';
                for ($j = 1; $j <= $nx && (3 * $j + $i - 3) <= $n; $j++) {
                    $str .= '<div class="row"><div class="thumbnail result">';
                    $str .= '<img src="resources/img/' . $searchResult[3 * $j + $i - 4]['imageFileName'] . '" class="artWorks" alt="' . $searchResult[3 * $j + $i - 4]['title'] . '"><div class="caption">';
                    $str .= '<h4>' . $searchResult[3 * $j + $i - 4]['title'] . '</h4>';
                    $str .= '<div class="container"><div class="col-md-6"><div class="pull-left">';
                    $str .= '<p>' . $searchResult[3 * $j + $i - 4]['artist'] . '</p>';
                    $str .= '</div></div><div class="col-md-6"><div class="pull-right"><p class="highLight">点击量：' . $searchResult[3 * $j + $i - 4]['view'] . '</p></div></div></div>';
                    $str .= '<p>' . $searchResultDes[3 * $j + $i - 4] . '...</p>';
                    $str .= '<div class="container"><div class="col-md-6"><p class="price highLight">价格：$' . $searchResult[3 * $j + $i - 4]['price'] . '</p></div>';
                    $str .= '<div class="col-md-6"><form action="详情.php" method="GET" target="_blank">';
                    $str .= '<input type="text" class="invisibleInput" name="workID" id="workID" value="' . $searchResult[3 * $j + $i - 4]['artworkID'] . '">';
                    $str .= '<button class="btn btn-default pull-right" type="submit"><a><span class="glyphicon glyphicon-chevron-right"></span> 查看详情</a></button>';
                    $str .= '</form></div></div></div></div></div>';
                }
                $str .= '</div>';
                echo $str;
            }
        }
    }
}