<div class="modal fade" id="purchase" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" id="formOfSignIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Purchase</h3>
                </div>
                <div class="modal-body">
                
                <?php 
                if($artworkID === NULL){
                    echo 'No artworks in your cart';
                }else{
                    $connect = connectDB();
                    $price = array();
                    $str = '<ul class="list-group">';
                    for($i = 0;$i < count($artworkID);$i++){
                        $sql = "SELECT title,price FROM artworks WHERE artworkID='" . $artworkID[$i] . "'";
                        $result = $connect->query($sql);
                        if ($result->num_rows <= 0){
                            $price[$i] = 0;
                            $str .= '<li class="list-group-item">This artwork has disappeared</li>';
                        }else{
                            $row = $result->fetch_assoc();
                            $price[$i]= $row['price'];
                            $str .= '<li class="list-group-item">Artwork:' . $row['title'] . '&nbsp;&nbsp;&nbsp;';
                            $str .= 'Price:$ ' . $row['price'] . '</li>';
                        }
                    }
                    $sum = array_sum($price);
                    $str .= '<li class="list-group-item">Total:$ ' . $sum . '</li>';
                    $str .= '</ul>';
                    echo $str;
                    $connect->close();
                    $url = "./php/下单.php?price[]=" . $price[0];
                    for($i = 1;$i < count($price);$i++){
                        $url .= "&price[]=" . $price[$i];
                    }
                    for($i = 0;$i < count($artworkID);$i++){
                        $url .= "&artworkID[]=" . $artworkID[$i];
                    }
                }
                ?>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" onclick="purchase('<?php echo $url; ?>');">下单</button>
                </div>
            </form>
        </div>
    </div>
</div>