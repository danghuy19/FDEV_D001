<?php
// echo 'POST';
// echo '<pre>',print_r($_POST),'</pre>';

// echo 'GET';
// echo '<pre>',print_r($_GET),'</pre>';

// echo 'REQUEST';
// echo '<pre>',print_r($_REQUEST),'</pre>';

$noi_dung = '';
$mau_chu = '';
$mau_nen = '';

if(isset($_POST['noi_dung']) && isset($_POST['mau_chu']) && isset($_POST['mau_nen'])){
    if(empty($_POST['noi_dung'])){
        echo 'vui lòng nhập nội dung';
    }
    else if(empty($_POST['mau_chu'])){
        echo 'vui lòng nhập màu chữ';
    }
    else if(empty($_POST['mau_nen'])){
        echo 'vui lòng nhập màu nền';
    }
    else{
        $noi_dung = $_POST['noi_dung'];
        $mau_chu = $_POST['mau_chu'];
        $mau_nen = $_POST['mau_nen'];
    }
}
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
        
        <form action="" method="POST" class="form-horizontal" role="form">
                <div class="form-group">
                    <legend>Hiển thị nội dung</legend>
                </div>
        
                <div class="form-group">
                    <div class="col-sm-10">
                        Nội dung
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="noi_dung" id="input" class="form-control" value="<?php echo $noi_dung; ?>" title="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10">
                        Màu chữ
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="mau_chu" id="input" class="form-control" value="<?php echo $mau_chu; ?>" title="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10">
                        Màu nền
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="mau_nen" id="input" class="form-control" value="<?php echo $mau_nen; ?>" title="">
                    </div>
                </div>
        
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
        </form>
        
        <div class="hien_thi" style="color: #<?php echo $mau_chu ?>; background-color: #<?php echo $mau_nen ?>">
            <?php echo $noi_dung ?>
        </div>
    </div>
</body>
</html>