<?php
$ds_loai_mon = ["Chiên", "Xào", "Nấu", "Nướng", "Hấp", "Luộc"];
$file_mon_an = 'data/mon_an.txt';

// echo '<pre>',print_r($_POST),'</pre>';
// echo '<pre>',print_r($_FILES),'</pre>';

class mon_an {
    public $ten_mon_an, $loai_mon, $cach_che_bien, $hinh;

    function __construct($ten_mon_an = '', $loai_mon = '', $cach_che_bien = '', $hinh = ''){
        $this->ten_mon_an = $ten_mon_an;
        $this->loai_mon = $loai_mon;
        $this->cach_che_bien = $cach_che_bien;
        $this->hinh = $hinh;
    }

    function khoi_tao_mon_an_tu_string($string_mon_an){
        if($string_mon_an){
            $mang_thong_tin = explode('|',$string_mon_an);
            $this->ten_mon_an = $mang_thong_tin[0];
            $this->loai_mon = $mang_thong_tin[1];
            $this->cach_che_bien = $mang_thong_tin[2];
            $this->hinh = $mang_thong_tin[3];
        }
    }

    function string_save(){
        return implode('|', [$this->ten_mon_an, $this->loai_mon, $this->cach_che_bien, $this->hinh]) . PHP_EOL;
    }

    function save_into_file($file_mon_an){
        $f = fopen($file_mon_an, 'a');
        fwrite($f, $this->string_save());
        fclose($f);
    }

    function xuat_ra_man_hinh(){
        ?>
        <div class="info_mon_an">
            <div class="col-sm-4">
                <img src="images/<?= $this->hinh ?>" alt="">
            </div>
            <div class="col-sm-8">
                <div class="title_mon_an">
                    <?= $this->ten_mon_an ?>
                </div>
                <div class="cach_che_bien_mon_an">
                    <?= $this->cach_che_bien ?>
                </div>
            </div>
        </div>
        <?php
    }
}

if(isset($_POST['ten_mon_an'])){
    try {
        $hinh = '';
        if(isset($_FILES['hinh']['name'])){
            if($_FILES['hinh']['error'] == 0){
                move_uploaded_file($_FILES['hinh']['tmp_name'], 'images/' . $_FILES['hinh']['name']);
                //echo 'Đã upload file thành công';
                $hinh = $_FILES['hinh']['name'];
            }
            else{
                echo 'File bị lỗi trong quá trình upload';
            }
        }

        $mon_an_moi = new mon_an($_POST['ten_mon_an'], $_POST['loai_mon'], $_POST['cach_che_bien'], $hinh);
        $mon_an_moi->save_into_file($file_mon_an);
        ?>
        <script>
            alert('thêm món ăn mới thành công');
        </script>
        <?php
    }
    catch(Exception $err){
        ?>
        <script>
            alert('Bị lỗi trong quá trình thêm món ăn');
        </script>
        <?php
    }
}

function sap_xep_mon_an_theo_nhom($mang_mon_an, $ds_loai_mon){
    $mang_mon_an_theo_nhom = [];
    foreach($ds_loai_mon as $loai_mon){
        $mang_temp = [];
        foreach($mang_mon_an as $mon_an){
            if($mon_an->loai_mon == $loai_mon){
                $mang_temp[] = $mon_an;
            }
        }

        $mang_mon_an_theo_nhom[$loai_mon] = $mang_temp;
    }

    return $mang_mon_an_theo_nhom;
}


$string_mang_mon_an = file_get_contents($file_mon_an);
$mang_mon_an = explode(PHP_EOL, $string_mang_mon_an);
for($i = 0; $i < count($mang_mon_an); $i++){
    $info_mon_an = new mon_an();
    $info_mon_an->khoi_tao_mon_an_tu_string($mang_mon_an[$i]);
    $mang_mon_an[$i] = $info_mon_an;
}

//echo '<pre>',print_r($mang_mon_an),'</pre>';
$mang_mon_an_theo_nhom = sap_xep_mon_an_theo_nhom($mang_mon_an, $ds_loai_mon);
//echo '<pre>',print_r($mang_mon_an_theo_nhom),'</pre>';

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

    <style>
        .chua_hinh_minh_hoa {
            text-align: center;
            padding: 10px;
        }

        #hinh_minh_hoa {
            width: 200px;
        }

        .info_mon_an img {
            width: 100%;
        }

        .info_mon_an {
            display: flex;
            flex-wrap: wrap;
            margin: 10px auto;
        }

        .title_mon_an {
            font-weight: bold;
        }
    </style>
    
</head>
<body>
    <div class="container">
    
        
        <form action="" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
            <div class="form-group">
                <legend>Nhập thông tin món ăn</legend>
            </div>
            <div class="col-sm-4">
                <img src="" />
                <div>
                    <div class="chua_hinh_minh_hoa">
                        <img id="hinh_minh_hoa" src="" alt="">
                    </div>
                    <input id="hinh" class="form-control" type="file" name="hinh">
                    <script>
                        var outImage ="hinh_minh_hoa";
                        document.getElementById('hinh').onchange = function (evt) {
                            var tgt = evt.target || window.event.srcElement,
                                files = tgt.files;

                            // FileReader support
                            if (FileReader && files && files.length) {
                                var fr = new FileReader();
                                fr.onload = function () {
                                    document.getElementById(outImage).src = fr.result;
                                }
                                fr.readAsDataURL(files[0]);
                            }

                            // Not supported
                            else {
                                // fallback -- perhaps submit the input to an iframe and temporarily store
                                // them on the server until the user's session ends.
                            }
                        }
                    </script>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="include_input">
                    <div class="col-sm-2">
                        Tên món ăn:
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="ten_mon_an" id="input" class="form-control">
                    </div>
                </div>
                <div class="include_input">
                    <div class="col-sm-2">
                        Loại món:
                    </div>
                    <div class="col-sm-10">
                        <select name="loai_mon" id="" class="form-control">
                        <?php
                        foreach($ds_loai_mon as $loai_mon){
                            ?>
                            <option value="<?= $loai_mon ?>"><?= $loai_mon ?></option>
                            <?php
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="include_input">
                    <div class="col-sm-2">
                        Cách chế biến:
                    </div>
                    <div class="col-sm-10">
                        <textarea name="cach_che_bien" id="" cols="30" rows="10"  class="form-control"></textarea>
                    </div>
                </div>
                <div class="include_input">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-10">
                        
                        <button type="submit" class="btn btn-success">Lưu thông tin</button>
                        
                    </div>
                </div>
            </div>
        </form>
        
        <div class="ds_mon_an_theo_nhom">
            <div class="col-sm-4">
                <div class="title">
                    Danh mục loại món ăn
                </div>
                <div class="ds_loai_mon_an">
                    <?php
                    foreach($ds_loai_mon as $loai_mon){
                        ?>
                        <div>
                            <a href="?loai-mon=<?= $loai_mon ?>"><?= $loai_mon ?></a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="title">
                    Thông Tin Danh Sách món ăn
                </div>
                <div class="ds_mon_an_theo_loai">
                    <?php
                    if(isset($_GET['loai-mon'])){
                        $loai_mon_an_duoc_chon = $_GET['loai-mon'];
                    }
                    else {
                        $loai_mon_an_duoc_chon = $ds_loai_mon[0];
                    }

                    if(count($mang_mon_an_theo_nhom[$loai_mon_an_duoc_chon]) > 0){
                        foreach($mang_mon_an_theo_nhom[$loai_mon_an_duoc_chon] as $mon_an_hien_thi){
                            $mon_an_hien_thi->xuat_ra_man_hinh();
                        }
                    }
                    else {
                        echo 'chưa có món nào thuộc nhóm này';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>