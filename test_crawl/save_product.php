<?php
$page_url = '';
if(isset($_GET['load_page'])){
    $page_url = $_GET['load_page'];
}

if($page_url){
    $data_html = file_get_contents($page_url);
    echo $data_html;
    ?>
    <script>
        var root_page = 'https://rainbushop.vn';
        function forceDownload(url, fileName, name, price_now, price){
            var xhr = new XMLHttpRequest();
            xhr.open("GET", url, true);
            xhr.responseType = "blob";
            xhr.onload = function(){
                var urlCreator = window.URL || window.webkitURL;
                var imageUrl = urlCreator.createObjectURL(this.response);
                var tag = document.createElement('a');
                tag.href = imageUrl;
                tag.download = fileName;
                document.body.appendChild(tag);
                tag.click();
                document.body.removeChild(tag);

                $.get(`http://localhost:8000/api/save-product-crawl?name=${name}&price_now=${price_now}&price=${price}&hinh=${fileName}`)
                    .then((data) => {
                        setTimeout(() => {
                            window.close();
                        }, 200);
                    })

                
            }
            xhr.send();
        }

        $(() => {
            console.log('test');
            //console.log($('.product-content .pro-content-head > h1').text());
            var name = $('.product-content .pro-content-head > h1').text();
            //console.log($('.product-content .pro-content-head .price-now').text().replace(/,/gi,'').replace(/₫/, ''));
            var price_now = $('.product-content .pro-content-head .price-now').text().replace(/,/gi,'').replace(/₫/, '');
            //console.log($('.product-content .pro-content-head .price-compare del').text().replace(/,/gi,'').replace(/₫/, ''));
            var price = $('.product-content .pro-content-head .price-compare del').text().replace(/,/gi,'').replace(/₫/, '');
            setTimeout(() => {
                //console.log($('.zoomWindowContainer div').css('background-image'));
                var data_url = $('.zoomWindowContainer div').css('background-image');
                //var regex = /(https?:\/\/.*\.(?:png|jpg))/i
                var matches = data_url.match( /(https?:\/\/.*\.(?:png|jpg))/i);
                //console.log(matches[0]);
                var array_name_hinh = matches[0].split('/');
                var name_hinh = array_name_hinh[array_name_hinh.length - 1];

                forceDownload(matches[0], name_hinh + '.webp', name, price_now, price);
            }, 500);
        })
    </script>
    <?php
}
?>
