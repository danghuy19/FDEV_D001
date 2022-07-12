<?php
include_once('../libraries/database.php');
class xl_tac_gia extends Database {

    function load_toan_bo_danh_sach_tac_gia($tim_kiem = false){
        $sql = "SELECT * FROM bs_tac_gia";

        if($tim_kiem !== false){
            $sql .= " WHERE ten_tac_gia LIKE '%$tim_kiem%' ";
        }

        //echo $sql;
        $this->setQuery($sql);
        $ds_tac_gia = $this->loadAllRow();
        return $ds_tac_gia;
    }

    function load_info_tac_gia($id_sua){
        $sql = 'SELECT * FROM bs_tac_gia WHERE id = ' . $id_sua;
        $this->setQuery($sql);
        $info_tac_gia_sua = $this->loadRow();
        return $info_tac_gia_sua;
    }

    function them_tac_gia_moi($ten_tac_gia, $dia_chi, $dien_thoai, $email){
        $sql = "INSERT INTO bs_tac_gia(ten_tac_gia, dia_chi, dien_thoai, email)
        VALUES(?, ?, ?, ?)";
        $this->setQuery($sql);
        $result = $this->execute(array($ten_tac_gia, $dia_chi, $dien_thoai, $email));
        return $result;
    }

    function sua_tac_gia($ten_tac_gia, $dia_chi, $dien_thoai, $email, $id_sua){
        $sql = "UPDATE bs_tac_gia
            SET ten_tac_gia = ?,
            dia_chi = ?,
            dien_thoai = ?,
            email = ?
            WHERE id = ?";
        //$result = $dbh->exec($sql);
        $this->setQuery($sql);
        $result = $this->execute(array($ten_tac_gia, $dia_chi, $dien_thoai, $email, $id_sua));
        return $result;
    }

    function xoa_tac_gia($id_xoa){
        $sql = "DELETE FROM bs_tac_gia WHERE id = " . $_GET['id_xoa'];
        $this->setQuery($sql);
        $result = $this->execute();
        return $result;
    }


}
?>