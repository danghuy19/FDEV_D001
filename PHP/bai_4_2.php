<?php
echo '<pre>',print_r($_POST),'</pre>';
if(isset($_POST['ten_file'])){
    $f = fopen('data/' . $_POST['ten_file'], 'w');
    fwrite($f, $_POST['noi_dung_file']);
    fclose($f);
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
    
    <style>
        .noi_dung_file {
            background: #ccc;
            font-size: 16px;
            padding: 20px;
            max-width: 500px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <form action="" method="POST" class="form-horizontal" role="form">
                <div class="form-group">
                    <legend>Xử lý tập tin</legend>
                </div>
        
                <div class="form-group">
                    <div class="col-sm-2">
                        Tên tập tin:
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="ten_file" id="input" class="form-control" value="<?php if(isset($_POST['ten_file'])){ echo $_POST['ten_file']; } ?>" title="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2">
                        Nội dung File:
                    </div>
                    <div class="col-sm-10">
                        <textarea name="noi_dung_file" id="" cols="30" rows="10" class="form-control"><?php if(isset($_POST['noi_dung_file'])){ echo $_POST['noi_dung_file']; } ?></textarea>
                    </div>
                </div>
        
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
        </form>
        <div class="noi_dung_file">
            <?php
            if(isset($_POST['ten_file'])){
                echo str_replace(PHP_EOL, '<br/>', file_get_contents('data/' . $_POST['ten_file']));
            }
            ?>
        </div>
    </div>
</body>
</html>