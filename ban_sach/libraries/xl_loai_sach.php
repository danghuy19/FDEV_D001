<?php
include_once('../libraries/database.php');
class xl_loai_sach extends Database {

    function load_toan_bo_danh_sach_loai_sach($id_loai_cha = false){
        $sql = "SELECT * FROM bs_loai_sach";

        if($id_loai_cha !== false){
            $sql .= " WHERE id_loai_cha = " . $id_loai_cha;
        }

        $this->setQuery($sql);
        $ds_loai_sach = $this->loadAllRow();
        return $ds_loai_sach;
    }

    function load_info_loai_sach($id_sua){
        $sql = 'SELECT * FROM bs_loai_sach WHERE id = ' . $id_sua;
        $this->setQuery($sql);
        $info_loai_sach_sua = $this->loadRow();
        return $info_loai_sach_sua;
    }

    function them_loai_sach_moi($ten_loai_sach, $id_loai_cha, $trang_thai){
        $sql = "INSERT INTO bs_loai_sach(ten_loai_sach, id_loai_cha, trang_thai)
        VALUES(?, ?, ?)";
        $this->setQuery($sql);
        $result = $this->execute(array($ten_loai_sach, $id_loai_cha, $trang_thai));
        return $result;
    }

    function sua_loai_sach($ten_loai_sach, $id_loai_cha, $trang_thai, $id_sua){
        $sql = "UPDATE bs_loai_sach
            SET ten_loai_sach = ?,
                id_loai_cha = ?,
                trang_thai = ?
            WHERE id = ?";
        //$result = $dbh->exec($sql);
        $this->setQuery($sql);
        $result = $this->execute(array($ten_loai_sach, $id_loai_cha, $trang_thai, $id_sua));
        return $result;
    }

    function xoa_loai_sach($id_xoa){
        $sql = "DELETE FROM bs_loai_sach WHERE id = " . $_GET['id_xoa'];
        $this->setQuery($sql);
        $result = $this->execute();
        return $result;
    }


}
?>