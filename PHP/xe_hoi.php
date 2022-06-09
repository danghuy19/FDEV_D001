<?php
class xe {
    public $loai_xe, $so_khung, $so_may, $bien_so, $nam_san_xuat, $nha_san_xuat;

    function __construct($loai_xe, $so_khung, $so_may, $bien_so, $nam_san_xuat, $nha_san_xuat){
        $this->loai_xe = $loai_xe;
        $this->so_khung = $so_khung;
        $this->so_may = $so_may;
        $this->bien_so = $bien_so;
        $this->nam_san_xuat = $nam_san_xuat;
        $this->nha_san_xuat = $nha_san_xuat;
    }

    function in_bien_so(){
        echo $this->bien_so . '<br/>';
    }

    function in_loai_xe(){
        echo $this->loai_xe . '<br/>';
    }

    function in_nam_san_xuat(){
        echo $this->nam_san_xuat . '<br/>';
    }
}

class xe_hoi extends xe {
    public $so_banh;

    function __construct($loai_xe, $so_khung, $so_may, $bien_so, $nam_san_xuat, $nha_san_xuat, $so_banh){
        parent::__construct($loai_xe, $so_khung, $so_may, $bien_so, $nam_san_xuat, $nha_san_xuat);
        $this->so_banh = $so_banh;
    }
}

class xe_sedan extends xe_hoi {
    public $cho_ngoi;

    function __construct($loai_xe, $so_khung, $so_may, $bien_so, $nam_san_xuat, $nha_san_xuat, $so_banh, $cho_ngoi){
        parent::__construct($loai_xe, $so_khung, $so_may, $bien_so, $nam_san_xuat, $nha_san_xuat, $so_banh);
        $this->cho_ngoi = $cho_ngoi;
    }

    function in_thong_tin_xe(){
        parent::in_loai_xe();
        parent::in_bien_so();
        parent::in_nam_san_xuat();
    }
}

$xe_hoi_1 = new xe_sedan('G63','abc0123', 'bcd1234', '59F123.45', 2022, 'Mecedes', 4, 5);
$xe_hoi_1->in_thong_tin_xe();
?>