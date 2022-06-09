<?php
//echo '<pre>',print_r($_FILES),'</pre>';
if(isset($_FILES['file_upload']['name'])){
    if($_FILES['file_upload']['error'] == 0){
        move_uploaded_file($_FILES['file_upload']['tmp_name'], 'images/' . $_FILES['file_upload']['name']);
        echo 'Đã upload file thành công';
    }
    else{
        echo 'File bị lỗi trong quá trình upload';
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
        
        <form action="" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
                <div class="form-group">
                    <legend>Upload</legend>
                </div>
        
                <div class="form-group">
                    <div class="col-sm-2">
                        Chọn file:
                    </div>
                    <div class="col-sm-10">
                        <input type="file" name="file_upload" id="input" class="form-control">
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