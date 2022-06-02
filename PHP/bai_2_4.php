<?php
function tim_min($mang){
    $min = $mang[0];
    for($i = 0; $i < count($mang); $i++){
        if($min > $mang[$i]){
            $min = $mang[$i];
        }
    }

    return $min;
}

function tim_max($mang){
    $max = $mang[0];
    for($i = 0; $i < count($mang); $i++){
        if($max < $mang[$i]){
            $max = $mang[$i];
        }
    }

    return $max;
}

function xuat_mang($mang){
    $chuoi_mang = implode(' ', $mang);
    return $chuoi_mang;
}

function tong_mang($mang){
    $tong = 0;
    for($i = 0; $i < count($mang); $i++){
        $tong += $mang[$i];
    }

    return $tong;
}

if(isset($_POST['so_phan_tu'])){
    $so_phan_tu = $_POST['so_phan_tu'];
}
else{
    $so_phan_tu = 0;
}

$mang_phan_tu = [];
if($so_phan_tu > 0){
    for($i = 0; $i < $so_phan_tu; $i ++){
        $random_number = rand(0,20);
        $mang_phan_tu[] = $random_number;
        //$mang_phan_tu
    }
}
else{
    echo 'số phần tử ảo';
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
                    <legend>Tạo mảng và tính toán</legend>
                </div>
        
                <div class="form-group">
                    <div class="col-sm-2">
                        nhập số phần tử
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="so_phan_tu" id="inputso_phan_tu" class="form-control" value="" title="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        Xuất mảng
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="" id="" class="form-control" value="<?php echo xuat_mang($mang_phan_tu); ?>" title="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        MIN
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="" id="" class="form-control" value="<?php echo tim_min($mang_phan_tu); ?>" title="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        MAX
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="" id="" class="form-control" value="<?php echo tim_max($mang_phan_tu); ?>" title="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        Tổng mảng
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="" id="" class="form-control" value="<?php echo tong_mang($mang_phan_tu); ?>" title="">
                    </div>
                </div>
        
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
        </form>
        
    </div>
</body>
</html>