<?php
function notice_after_process($result, $mess_success, $mess_fail, $page_redirect = ''){
    if($result !== false){
        ?>
        <script>
            alert('<?= $mess_success ?>');
            window.location.href = '?page=<?= $page_redirect ?>';
        </script>
        <?php
    }
    else{
        ?>
        <script>
            alert('<?= $mess_fail ?>')
        </script>
        <?php
    }
}

function add_confirm_box_before_delete(){
    ?>
    <script>
        function check_before_delete(){
            var kq = confirm('Bạn có chắc chắn muốn xoá loại sách này không?');
            if(kq){
                return true;
            }
            else {
                return false;
            }
        }
    </script>
    <?php
}

function redirect_by_javascript($page = ''){
    ?>
    <script>
        window.location.href = '?page=<?= $page ?>';
    </script>
    <?php
}
?>