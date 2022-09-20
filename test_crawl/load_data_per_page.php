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
        function forceDownload(url, fileName){
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
            }
            xhr.send();
        }

        $(() => {
            var list_tag_a = $('.product-block .product-img a');

            // for(var i = 0; i < list_tag_a.length; i++){
            //     //console.log();root_page
            //     var url_page = root_page + $(list_tag_a[i]).attr('href');
            //     console.log(url_page);
            //     window.open('/test_crawl/save_product.php?load_page=' + url_page);
            // }
            var run = 0;
            // var url_page = root_page + $(list_tag_a[run]).attr('href');
            //         if(url_page){
            //             window.open('/test_crawl/save_product.php?load_page=' + url_page);
            //         }

            setInterval(() => {
                if(run < list_tag_a.length){
                    var url_page = root_page + $(list_tag_a[run]).attr('href');
                    if(url_page){
                        window.open('/test_crawl/save_product.php?load_page=' + url_page);
                    }
                }
                run += 1;
            }, 2000);
            
            // setTimeout(() => {
            //     window.close();
            // }, 2000);

            // console.log('test');
            // console.log($('.product-content .pro-content-head > h1').text());
            // console.log($('.product-content .pro-content-head .price-now').text().replace(/,/gi,'').replace(/₫/, ''));
            // console.log($('.product-content .pro-content-head .price-compare del').text().replace(/,/gi,'').replace(/₫/, ''));
            // setTimeout(() => {
            //     //console.log($('.zoomWindowContainer div').css('background-image'));
            //     var data_url = $('.zoomWindowContainer div').css('background-image');
            //     //var regex = /(https?:\/\/.*\.(?:png|jpg))/i
            //     var matches = data_url.match( /(https?:\/\/.*\.(?:png|jpg))/i);
            //     //console.log(matches[0]);
            //     var array_name_hinh = matches[0].split('/');
            //     var name_hinh = array_name_hinh[array_name_hinh.length - 1];

            //     forceDownload(matches[0], name_hinh + '.webp');
            // }, 1000);
        })
    </script>
    <?php
}
?>
