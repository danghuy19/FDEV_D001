<?php
include_once('../libraries/xl_nha_xuat_ban.php');

class c_nha_xuat_ban
{
    private $xl_nha_xuat_ban;

    function __construct()
    {
        $this->xl_nha_xuat_ban = new xl_nha_xuat_ban();
    }

    function index()
    {
        //xử lý xoá loại sách
        if (isset($_GET['id_xoa'])) {
            $result = $this->xl_nha_xuat_ban->xoa_nha_xuat_ban($_GET['id_xoa']);
        }

        if (isset($_POST['tim_kiem'])) {
            $ds_nha_xuat_ban = $this->xl_nha_xuat_ban->load_toan_bo_danh_sach_nha_xuat_ban($_POST['tim_kiem']);
        } else {
            //load danh sách loại sách
            $ds_nha_xuat_ban = $this->xl_nha_xuat_ban->load_toan_bo_danh_sach_nha_xuat_ban();
        }


        //load view
        include_once('pages/ql_nha_xuat_ban/index.php');
    }

    function them()
    {
        if (isset($_POST['ten_nha_xuat_ban'])) {
            $ten_nha_xuat_ban = $_POST['ten_nha_xuat_ban'];
            $dia_chi = $_POST['dia_chi'];
            $dien_thoai = $_POST['dien_thoai'];
            $email = $_POST['email'];

            $result = $this->xl_nha_xuat_ban->them_nha_xuat_ban_moi($ten_nha_xuat_ban, $dia_chi, $dien_thoai, $email);
        }

        $ds_nha_xuat_ban_cap_1 = $this->xl_nha_xuat_ban->load_toan_bo_danh_sach_nha_xuat_ban(0);

        foreach ($ds_nha_xuat_ban_cap_1 as $nha_xuat_ban_cap_1) {
            $ds_nha_xuat_ban_cap_2 = $this->xl_nha_xuat_ban->load_toan_bo_danh_sach_nha_xuat_ban($nha_xuat_ban_cap_1->id);
            $nha_xuat_ban_cap_1->ds_loai_con = $ds_nha_xuat_ban_cap_2;
        }

        //load view
        include_once('pages/ql_nha_xuat_ban/them.php');
    }

    function sua()
    {
        $id_sua = '';
        if (isset($_GET['id_sua'])) {
            $id_sua = $_GET['id_sua'];
        } else {
            redirect_by_javascript('nha-xuat-ban');
        }

        $info_nha_xuat_ban_sua = $this->xl_nha_xuat_ban->load_info_nha_xuat_ban($id_sua);

        //save data khi post form
        if(isset($_POST['ten_nha_xuat_ban'])){
            $ten_nha_xuat_ban = $_POST['ten_nha_xuat_ban'];
            $dia_chi = $_POST['dia_chi'];
            $dien_thoai = $_POST['dien_thoai'];
            $email = $_POST['email'];
        
            $result = $this->xl_nha_xuat_ban->sua_nha_xuat_ban($ten_nha_xuat_ban, $dia_chi, $dien_thoai, $email, $id_sua);
            
        }

        //load view
        include_once('pages/ql_nha_xuat_ban/sua.php');
    }
}
?>