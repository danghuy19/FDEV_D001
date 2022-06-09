<?php
$mang_string = '';
$mang_duy_nhat = [];
$mang_dem_so_phan_tu = [];

function tim_mang_duy_nhat($mang){
    $mang_duy_nhat = [];

    for($i = 0; $i < count($mang); $i++){
        $flag = 0;
        for($j = 0; $j < count($mang_duy_nhat); $j++){
            if($mang[$i] == $mang_duy_nhat[$j]){
                $flag = 1;
                break;
            }
        }

        if($flag == 0){
            $mang_duy_nhat[] = $mang[$i];
        }
    }

    return $mang_duy_nhat;
}

function dem_so_phan_tu($mang){
    //$mang_dem_so_phan_tu[2] = 3;
    $mang_dem_so_phan_tu = [];
    $mang_duy_nhat = [];

    for($i = 0; $i < count($mang); $i++){
        $flag = 0;
        for($j = 0; $j < count($mang_duy_nhat); $j++){
            if($mang[$i] == $mang_duy_nhat[$j]){
                $flag = 1;
                $mang_dem_so_phan_tu[$mang[$i]] += 1;
                break;
            }
        }

        if($flag == 0){
            $mang_duy_nhat[] = $mang[$i];
            $mang_dem_so_phan_tu[$mang[$i]] = 1;
        }
    }

    return $mang_dem_so_phan_tu;
}

if(isset($_POST['mang'])){
    $mang_string = $_POST['mang'];
    $mang = explode(', ', $mang_string);

    $mang_duy_nhat = tim_mang_duy_nhat($mang);
    $mang_dem_so_phan_tu = dem_so_phan_tu($mang);
    //echo '<pre>',print_r($mang_dem_so_phan_tu),'</pre>';
}

function xuat_mang($mang){
    $chuoi_mang = implode(' ', $mang);
    return $chuoi_mang;
}

function xuat_mang_dem($mang_dem) {
    $chuoi_mang = '';
    foreach($mang_dem as $key => $value){
        $chuoi_mang .= $key . ':' . $value . '  ';
    }
    return $chuoi_mang;
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
                        nhập mảng
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="mang" id="input_mang" class="form-control" value="" title="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        Số lần xuất hiện
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="" id="" class="form-control" value="<?php echo xuat_mang_dem($mang_dem_so_phan_tu); ?>" title="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        Mảng duy nhất
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="" id="" class="form-control" value="<?php echo xuat_mang($mang_duy_nhat); ?>" title="">
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