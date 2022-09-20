<?php
$data_html = file_get_contents('https://rainbushop.vn/products/nike-pg-6-blue-paisley-dh8447-400');
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
        //$('#menu-desktop').remove();
        $('#menu-desktop > li')[0].remove();

        $('#menu-desktop > li')[$('#menu-desktop > li').length - 1].remove();
        $('#menu-desktop > li')[$('#menu-desktop > li').length - 1].remove();

        //console.log($('#menu-desktop > li'));
        var run = 0;

        if(run < $('#menu-desktop > li').length){
            var url_page = root_page + $($('#menu-desktop > li')[run]).find(' > a').attr('href');
            if(url_page){
                console.log(url_page);
                window.open('/test_crawl/load_data_per_page.php?load_page=' + url_page);
            }
        }
        run++;

        // setInterval(() => {
        //     //console.log();root_page
        //     if(run < $('#menu-desktop > li').length){
        //         var url_page = root_page + $($('#menu-desktop > li')[run]).find(' > a').attr('href');
        //         if(url_page){
        //             console.log(url_page);
        //             window.open('/test_crawl/load_data_per_page.php?load_page=' + url_page);
        //         }
        //     }
        //     run++;
        // }, 300000);

        // var url_page = root_page + $($('#menu-desktop > li')[0]).find(' > a').attr('href');
        // console.log(url_page);
        // window.open('/test_crawl/load_data_per_page.php?load_page=' + url_page);
    })
</script>