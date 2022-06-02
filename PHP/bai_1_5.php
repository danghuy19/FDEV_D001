<?php
// echo 'POST';
// echo '<pre>',print_r($_POST),'</pre>';

// echo 'GET';
// echo '<pre>',print_r($_GET),'</pre>';

// echo 'REQUEST';
// echo '<pre>',print_r($_REQUEST),'</pre>';

$canh_a = '';
$canh_b = '';
$canh_huyen = '';

if(isset($_POST['canh_a']) && isset($_POST['canh_b'])){
    
    $canh_a = $_POST['canh_a'];
    $canh_b = $_POST['canh_b'];

    $canh_huyen = sqrt(pow($canh_a,2) + pow($canh_b,2));
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
                    <legend>Tinh Cạnh huyền tam giác</legend>
                </div>
        
                <div class="form-group">
                    <div class="col-sm-10">
                        Cạnh A
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="canh_a" id="input" class="form-control" value="<?php echo $canh_a; ?>" title="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10">
                        Cạnh B
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="canh_b" id="input" class="form-control" value="<?php echo $canh_b; ?>" title="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10">
                        Cạnh Huyền
                    </div>
                    <div class="col-sm-10">
                        <input type="text" name="" id="input"  class="form-control" value="<?php echo $canh_huyen; ?>" readonly="true">
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