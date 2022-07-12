<?php
include_once('../libraries/database.php');
class xl_nha_xuat_ban extends Database {

    function load_toan_bo_danh_sach_nha_xuat_ban($tim_kiem = false){
        $sql = "SELECT * FROM bs_nha_xuat_ban";

        if($tim_kiem !== false){
            $sql .= " WHERE ten_nha_xuat_ban LIKE '%$tim_kiem%' ";
        }

        //echo $sql;
        $this->setQuery($sql);
        $ds_nha_xuat_ban = $this->loadAllRow();
        return $ds_nha_xuat_ban;
    }

    function load_info_nha_xuat_ban($id_sua){
        $sql = 'SELECT * FROM bs_nha_xuat_ban WHERE id = ' . $id_sua;
        $this->setQuery($sql);
        $info_nha_xuat_ban_sua = $this->loadRow();
        return $info_nha_xuat_ban_sua;
    }

    function them_nha_xuat_ban_moi($ten_nha_xuat_ban, $dia_chi, $dien_thoai, $email){
        $sql = "INSERT INTO bs_nha_xuat_ban(ten_nha_xuat_ban, dia_chi, dien_thoai, email)
        VALUES(?, ?, ?, ?)";
        $this->setQuery($sql);
        $result = $this->execute(array($ten_nha_xuat_ban, $dia_chi, $dien_thoai, $email));
        return $result;
    }

    function sua_nha_xuat_ban($ten_nha_xuat_ban, $dia_chi, $dien_thoai, $email, $id_sua){
        $sql = "UPDATE bs_nha_xuat_ban
            SET ten_nha_xuat_ban = ?,
            dia_chi = ?,
            dien_thoai = ?,
            email = ?
            WHERE id = ?";
        //$result = $dbh->exec($sql);
        $this->setQuery($sql);
        $result = $this->execute(array($ten_nha_xuat_ban, $dia_chi, $dien_thoai, $email, $id_sua));
        return $result;
    }

    function xoa_nha_xuat_ban($id_xoa){
        $sql = "DELETE FROM bs_nha_xuat_ban WHERE id = " . $_GET['id_xoa'];
        $this->setQuery($sql);
        $result = $this->execute();
        return $result;
    }


}
?>