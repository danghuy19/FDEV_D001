<?php
$gio_bat_dau = 12;
$gio_ket_thuc = 20;

if($gio_bat_dau >= 10 && $gio_ket_thuc <= 24 && $gio_bat_dau < $gio_ket_thuc){
    if($gio_ket_thuc < 17){
        $tien_tra = ($gio_ket_thuc - $gio_bat_dau) * 20000;
    }
    else if($gio_ket_thuc <= 24 && $gio_bat_dau < 17){
        $tien_tra_1 = (17 - $gio_bat_dau) * 20000;
        $tien_tra_2 = ($gio_ket_thuc - 17) * 45000;
        $tien_tra = $tien_tra_1 + $tien_tra_2;
    }
    else {
        $tien_tra = ($gio_ket_thuc - $gio_bat_dau) * 45000;
    }
    echo $tien_tra;
}
else{
    echo 'tào lao vì chưa ai làm việc';
}

?>