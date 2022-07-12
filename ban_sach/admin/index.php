<?php
include_once('../libraries/functions_support_view.php');

$page = $_GET['page'];
$chuc_nang = $_GET['chuc_nang'];
?>
<!DOCTYPE html>
<html>

<?php
include_once('widgets/head.php');
?>

<body>
    <!--  wrapper -->
    <div id="wrapper">
        <?php
        include_once('widgets/header.php');
        ?>

        <?php
        include_once('widgets/sidebar.php');
        ?>

        
        <!--  page-wrapper -->
        <div id="page-wrapper">

            
                <?php
                if($page == 'loai-sach'){

                    include_once('controllers/c_loai_sach.php');
                    $controller = new c_loai_sach();

                    if($chuc_nang == 'them'){
                        $controller->them();
                    }
                    else if($chuc_nang == 'sua'){
                        $controller->sua();
                    }
                    else{
                        $controller->index();
                    }
                }
                else if($page == 'nha-xuat-ban'){

                    include_once('controllers/c_nha_xuat_ban.php');
                    $controller = new c_nha_xuat_ban();

                    if($chuc_nang == 'them'){
                        $controller->them();
                    }
                    else if($chuc_nang == 'sua'){
                        $controller->sua();
                    }
                    else{
                        $controller->index();
                    }
                }
                else if($page == 'sach'){
                    include_once('controllers/c_sach.php');
                    $controller = new c_sach();

                    if($chuc_nang == 'them'){
                        $controller->them();
                    }
                    else if($chuc_nang == 'sua'){
                        $controller->sua();
                    }
                    else{
                        $controller->index();
                    }
                }
                else {
                    include_once('pages/thong_ke/index.php');
                }
                ?>
            </div>

            

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <!-- <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script> -->

</body>

</html>
