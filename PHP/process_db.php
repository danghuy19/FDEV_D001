<?php
    //print_r(PDO::getAvailableDrivers());

    $dbh = new PDO('mysql:host=localhost;dbname=ban_sach_online_db', 'root', '');
    //print_r($dbh);

    // $sql = 'DELETE FROM bs_sach_tam';
    // $result = $dbh->exec($sql);

    // if($result !== false){
    //     echo 'Đã xoá ' . $result . ' dòng trong CSDL';
    // }
    // else {
    //     echo 'SQL có lỗi xảy ra nên chưa xử lý được';
    // }


    // $sql = "INSERT INTO bs_menu VALUES(null, 'menu 1', 'menu-1', 1, 0)";
    // $result = $dbh->exec($sql);

    // if($result !== false){
    //     echo 'Đã thêm ' . $result . ' dòng trong bảng menu';
    // }
    // else {
    //     echo 'SQL có lỗi xảy ra nên chưa xử lý được';
    // }

    // $dbh = null;

    // $sql = "SELECT * FROM bs_loai_sach LIMIT 5";
    // $sth = $dbh->prepare($sql);
    // $sth->execute();
    // $result = $sth->fetch(PDO::FETCH_NUM);
    // $result_2 = $sth->fetch(PDO::FETCH_NUM);

    // echo '<pre>',print_r($result),'</pre>';
    // echo '<pre>',print_r($result_2),'</pre>';

    $sql = "SELECT * FROM bs_loai_sach LIMIT 5";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $results = $sth->fetchAll(PDO::FETCH_NUM);
    echo '<pre>',print_r($results),'</pre>';

    $sql = "SELECT * FROM bs_loai_sach LIMIT 5";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $results_1 = $sth->fetchAll(PDO::FETCH_ASSOC);
    echo '<pre>',print_r($results_1),'</pre>';

    $sql = "SELECT * FROM bs_loai_sach LIMIT 5";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $results = $sth->fetchAll(PDO::FETCH_BOTH);
    echo '<pre>',print_r($results),'</pre>';

    $sql = "SELECT * FROM bs_loai_sach LIMIT 5";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $results = $sth->fetchAll(PDO::FETCH_OBJ);
    echo '<pre>',print_r($results),'</pre>';

    $sql = "SELECT * FROM bs_loai_sach LIMIT 5";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $results = $sth->fetchAll(PDO::FETCH_UNIQUE);
    echo '<pre>',print_r($results),'</pre>';

    $sql = "SELECT ls.ten_loai_sach, s.* FROM bs_loai_sach ls JOIN bs_sach s ON s.id_loai_sach = ls.id";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    $results = $sth->fetchAll(PDO::FETCH_GROUP);
    echo '<pre>',print_r($results),'</pre>';
?>