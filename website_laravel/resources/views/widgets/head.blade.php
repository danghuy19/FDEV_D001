<head>
    <title>Cửa hàng sách online</title>
    <base href="/">
    
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap_combie.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="icon" href="images/logo.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    
    {{-- <script async="" type="text/javascript" src="https://app.purechat.com/VisitorWidget/WidgetScript"></script> --}}
    <script src="/js/main.js"></script>
    <script>
        var sessionid = "@if(session()->has('id_anonymous')){{(session('id_anonymous')[0])?session('id_anonymous')[0]:''}}@endif";
    </script>
    
</head>