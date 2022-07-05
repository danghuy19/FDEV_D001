<?php
include_once('../libraries/xl_loai_sach.php');

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
                    $xl_loai_sach = new xl_loai_sach();

                    if($chuc_nang == 'them'){
                        include_once('pages/ql_loai_sach/them.php');
                    }
                    else if($chuc_nang == 'sua'){
                        include_once('pages/ql_loai_sach/sua.php');
                    }
                    else{
                        include_once('pages/ql_loai_sach/index.php');
                    }
                }
                else if($page == 'sach'){
                    include_once('pages/ql_sach/index.php');
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
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>

</body>

</html>
