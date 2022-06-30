<?php
    $dbh = new PDO('mysql:host=localhost;dbname=ban_sach_online_db;charset=utf8', 'root', '');
    $sql = "SELECT * FROM bs_sach";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $ds_sach = $sth->fetchAll(PDO::FETCH_OBJ);
    //echo '<pre>',print_r($ds_sach),'</pre>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    
</head>
<body>
    <div class="container">
        <?php
        foreach($ds_sach as $sach){
            ?>
            <div class="col-sm-12 col-md-3">
                <div class="col-sm-12">
                    <div class="title_sach">
                        <?php echo $sach->ten_sach; ?>
                    </div>
                    <div class="image_sach">
                        <img src="images/sach/<?php echo $sach->hinh; ?>" alt="">
                    </div>
                    <div class="don_gia">
                        <?php
                        if($sach->don_gia < $sach->gia_bia){
                            ?>
                            <div class="detail_price">
                                <?php echo $sach->don_gia; ?>
                            </div>
                            <div class="origin_price">
                                <?php echo $sach->gia_bia; ?>
                            </div>
                            <?php
                        }
                        else {
                            ?>
                            <div class="detail_price">
                                <?php echo $sach->don_gia; ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</body>
</html>