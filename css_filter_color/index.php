<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .change_style {
            position: fixed;
            top:0;
            left: 0;
            z-index: 0;
        }

        .change_style img {
            width: 100%;
            filter: brightness(100%);
        }

        .content {
            height: 10000px;
            background: transparent;
        }
    </style>

    
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    
</head>
<body>
    <div class="change_style">
        <img src="./iStock-517188688.jpg" alt="">
    </div>
    <div class="content">
    </div>
    <script>
        $(window).scroll((e) => {
            var scroll = $(window).scrollTop();
            //console.log(scroll);
            var root_value = 100;
            var value_brightness = root_value + Math.round(scroll/100);
            console.log(value_brightness);

            $('.change_style img').css({
                'filter': `brightness(${value_brightness}%)`
            })
        })
    </script>
</body>
</html>