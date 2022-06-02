<?php
$so = 85;

$mang_doc_so = array('Không', 'Một', 'Hai', 'Ba', 'Bốn', 'Năm', 'Sáu', 'Bảy', 'Tám', 'Chín');
$mang_doc_so_don_vi = array('Không', 'Mốt', 'Hai', 'Ba', 'Bốn', 'Lăm', 'Sáu', 'Bảy', 'Tám', 'Chín');

$hang_don_vi = $so % 10;
$hang_chuc = (($so - $hang_don_vi)/10) % 10;
$hang_tram = (((($so - $hang_don_vi)/10) - $hang_chuc) / 10 ) % 10;

echo $hang_tram . ' - ' . $hang_chuc . ' - ' . $hang_don_vi . '<br/>';

function doc_so($so, $don_vi_moi = 0){
    global $mang_doc_so;
    global $mang_doc_so_don_vi;
    if($don_vi_moi == 1){
        return $mang_doc_so_don_vi[$so];
    }
    else{
        return $mang_doc_so[$so];
    }
}

if($hang_tram == 0){
    if($hang_chuc == 0 && $hang_don_vi == 0){
        echo 'Không';
    }
    else if($hang_chuc == 0 &&  $hang_don_vi != 0){
        echo doc_so($hang_don_vi);
    }
    else {
        echo doc_so($hang_chuc) . ' mươi ' . doc_so($hang_don_vi, 1);
    }
}
else {
    if($hang_chuc == 0 && $hang_don_vi == 0){
        echo doc_so($hang_tram) . ' trăm ';
    }
    else if($hang_chuc == 0 &&  $hang_don_vi != 0){
        echo doc_so($hang_tram) . ' trăm lẻ ' . doc_so($hang_don_vi);
    }
    else{
        echo doc_so($hang_tram) . ' trăm ' . doc_so($hang_chuc) . ' mươi ' . doc_so($hang_don_vi, 1);
    }
}
?>