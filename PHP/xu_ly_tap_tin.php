<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .noi_dung_tho {
            text-align: center;
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background: #ccc;
            color: #ff0;
            font-size:30px;
        }
    </style>
</head>
<body>
    <div class="noi_dung_tho">
    <?php
    // $f = fopen('data/test.txt', 'r');
    // while(!feof($f)){
    //     $row = fgets($f);
    //     echo $row . '<br/>';
    // }
    // fclose($f);
    
    //echo str_replace("\n", '<br/>', readfile('data/test.txt'));
    //echo str_replace("\n", '<br/>', file_get_contents('data/test.txt'));

    $f = fopen('data/test.txt', 'w');
    fwrite($f, 'File đã ghi mới ' . PHP_EOL . ' và xoá nội dụng cũ');
    fclose($f);
    ?>
    </div>
</body>
</html>