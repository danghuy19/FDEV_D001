/*SELECT <tên cột, field mà chúng ta cần>, SUM(abc) as so_luong
FROM <tên bảng> banga JOIN <tên bảng khác> bangb ON banga.<tên cột kết nối> = b.<tên cột kết nối>
WHERE (<tên cột> <toán tử so sánh> <giá trị>/điều kiện) AND/OR (điều kiện) ...
GROUP BY <tên cột cần gom nhóm>
HAVING <điều kiện sau khi gom nhóm>
ORDER BY <tên cột> (ASC/DESC)
LIMIT <index>, <số lượng cần lấy> (ex: 0,10 - lấy từ phần tử đầu tiên và lấy 10 phần tử)
UNION ALL*/

SELECT ten_sach, DISTINCT ten_loai_sach
FROM bs_sach s LEFT JOIN bs_loai_sach ls ON s.id_loai_sach = ls.id

-- thêm 1 nhà xuất bản
INSERT INTO bs_nha_xuat_ban (ten_nha_xuat_ban, dien_thoai, email, dia_chi) 
VALUES('test', '0909090909', 'test@super.com', '123 Nguyễn Đình Chiểu, P4, Q3');

INSERT INTO bs_nha_xuat_ban 
VALUES(null, 'test123', '123 Nguyễn Đình Chiểu, P4, Q3', '0909090909', 'test@super.com');

--copy toàn bộ nhà xuất bản sang bảng backup
INSERT INTO bs_nha_xuat_ban_backup
SELECT *
FROM bs_nha_xuat_ban


-- demo lấy sách có trọng lượng lớn nhất
SELECT *
FROM bs_sach
WHERE trong_luong = (SELECT MAX(trong_luong)
FROM bs_sach)

-- demo lấy người dùng chưa mua hàng
SELECT *
FROM bs_nguoi_dung
WHERE id NOT IN (SELECT DISTINCT id_nguoi_dung
FROM bs_don_hang
WHERE id_nguoi_dung IS NOT NULL)


-- demo update toàn bộ giá sách tăng vì xăng tăng
UPDATE bs_sach
SET 
don_gia = don_gia + 5000,
gia_bia = gia_bia + 5000


-- demo xoá bs_nha_xuat_ban_backup
DELETE FROM bs_nha_xuat_ban_backup
WHERE id = 7;





/* bài 3 */
-- câu 1
SELECT ten_nha_xuat_ban, dia_chi, email, dien_thoai
FROM bs_nha_xuat_ban;

-- câu 2
SELECT ho_ten, dia_chi, dien_thoai
FROM bs_nguoi_dung;

-- câu 3
SELECT ten_tac_gia, gioi_thieu
FROM bs_tac_gia;

-- câu 4
SELECT ho_ten, email, ngay_sinh, dia_chi, dien_thoai
FROM bs_nguoi_dung
ORDER BY ho_ten;

-- câu 5
SELECT ten_sach, sku, gioi_thieu, kich_thuoc, trong_luong, don_gia, gia_bia
FROM bs_sach
ORDER BY ten_sach ASC, don_gia DESC, gia_bia DESC;

-- câu 6
SELECT ten_sach, sku, gioi_thieu, kich_thuoc, trong_luong, don_gia, gia_bia
FROM bs_sach
WHERE ten_sach LIKE 'series%';

-- câu 7
SELECT id, tieu_de_tin, noi_dung_tom_tat, noi_dung_chi_tiet, hinh_dai_dien, trang_thai
FROM bs_tin_tuc
WHERE hinh_dai_dien LIKE '%.jpg';

-- câu 8
SELECT *
FROM bs_sach
WHERE ten_sach LIKE '%Tái bản%';

-- câu 9
SELECT ten_sach, sku, gioi_thieu, kich_thuoc, trong_luong, don_gia, gia_bia
FROM bs_sach
WHERE don_gia > 100000
ORDER BY ten_sach DESC;

-- câu 10
SELECT ten_sach, sku, gioi_thieu, kich_thuoc, trong_luong, don_gia, gia_bia
FROM bs_sach
WHERE id_loai_sach = 17 AND id_nha_xuat_ban = 11
ORDER BY ten_sach;

-- câu 11
SELECT *
FROM bs_sach
WHERE trong_luong >= 500 OR gia_bia > 150000;

-- câu 12
SELECT *
FROM bs_sach
WHERE don_gia BETWEEN 500000 AND 2500000;

-- câu 13
SELECT *
FROM bs_sach
WHERE (id_loai_sach IN (56, 90, 92)) AND trong_luong >= 350
ORDER BY trong_luong;

-- câu 14
SELECT *
FROM bs_sach
WHERE id_loai_sach = 45 AND don_gia <= 60000

-- câu 15
SELECT ten_sach, sku, gioi_thieu, kich_thuoc, trong_luong, don_gia, gia_bia
FROM bs_sach
WHERE gioi_thieu LIKE '%huyền bí%' OR gioi_thieu LIKE '%du lịch%';

-- câu 16
SELECT *
FROM bs_sach
WHERE trong_luong IN (280, 350, 380);

-- câu 17
SELECT ten_sach, sku, kich_thuoc, trong_luong, don_gia, gia_bia
FROM bs_sach
ORDER BY don_gia DESC
LIMIT 10;

-- câu 18
SELECT ten_sach, gioi_thieu, trong_luong, don_gia, gia_bia
FROM bs_sach
WHERE gioi_thieu LIKE '%mạnh%' OR gioi_thieu LIKE '%magic%'
ORDER BY don_gia DESC
LIMIT 3;

-- câu 19
SELECT *
FROM bs_nha_xuat_ban
WHERE ten_nha_xuat_ban IS NOT NULL
AND dia_chi IS NOT NULL
AND email IS NOT NULL
AND dien_thoai IS NOT NULL;

SELECT *
FROM bs_nha_xuat_ban
WHERE  (ten_nha_xuat_ban + dia_chi + email + dien_thoai) IS NOT NULL

-- câu 20
SELECT *
FROM bs_sach
WHERE so_trang >= 500 AND trong_luong >= 500



/* bài 4 */
-- câu 1
SELECT ten_nha_xuat_ban, email, dia_chi, dien_thoai, COUNT(s.id) AS so_luong_sach
FROM bs_nha_xuat_ban nxb JOIN bs_sach s ON nxb.id = s.id_nha_xuat_ban
GROUP BY nxb.id;

-- câu 2
SELECT ten_loai_sach, id_loai_cha, COUNT(s.id) AS so_luong_sach
FROM bs_loai_sach ls JOIN bs_sach s ON ls.id = s.id_loai_sach
WHERE id_loai_cha = 2
GROUP BY ls.id;

-- câu 3
SELECT ten_nha_xuat_ban, AVG(s.don_gia) AS gia_trung_binh
FROM bs_nha_xuat_ban nxb JOIN bs_sach s ON nxb.id = s.id_nha_xuat_ban
GROUP BY nxb.id;

-- câu 4
SELECT ten_nha_xuat_ban, MIN(don_gia)
FROM bs_nha_xuat_ban nxb JOIN bs_sach s ON nxb.id = s.id_nha_xuat_ban
GROUP BY nxb.id;

SELECT ten_nha_xuat_ban, MAX(don_gia)
FROM bs_nha_xuat_ban nxb JOIN bs_sach s ON nxb.id = s.id_nha_xuat_ban
GROUP BY nxb.id;

-- câu 5
SELECT ten_sach, SUM(so_luong) as so_luong_ban
FROM bs_sach s JOIN bs_chi_tiet_don_hang ctdh ON s.id = ctdh.id_sach
    JOIN bs_don_hang dh ON dh.id = ctdh.id_don_hang
WHERE YEAR(ngay_dat) = 2016
GROUP BY s.id
ORDER BY so_luong_ban DESC
LIMIT 10;

-- câu 6
SELECT ten_sach, SUM(thanh_tien) as doanh_thu
FROM bs_sach s JOIN bs_chi_tiet_don_hang ctdh ON s.id = ctdh.id_sach
    JOIN bs_don_hang dh ON dh.id = ctdh.id_don_hang
WHERE YEAR(ngay_dat) = 2016
GROUP BY s.id
ORDER BY doanh_thu DESC
LIMIT 10;

-- câu 7
SELECT ten_sach, SUM(thanh_tien) as doanh_thu
FROM bs_sach s JOIN bs_chi_tiet_don_hang ctdh ON s.id = ctdh.id_sach
    JOIN bs_don_hang dh ON dh.id = ctdh.id_don_hang
WHERE YEAR(ngay_dat) = 2016 AND MONTH(ngay_dat) = 3
GROUP BY s.id
ORDER BY doanh_thu DESC
LIMIT 3;

-- câu 8
SELECT id_don_hang, ngay_dat, tong_tien, SUM(so_luong) AS tong_so_luong
FROM bs_don_hang dh JOIN bs_chi_tiet_don_hang ctdh ON ctdh.id_don_hang = dh.id
GROUP BY dh.id

-- câu 9
SELECT id, ngay_dat, tong_tien
FROM bs_don_hang
WHERE tong_tien > 500000

-- câu 10
SELECT ten_tac_gia, COUNT(s.id) tong_so_sach
FROM bs_sach s JOIN bs_tac_gia tg ON tg.id = s.id_tac_gia
GROUP BY tg.id;

-- câu 11
SELECT ten_tac_gia, ten_sach, MAX(don_gia)
FROM bs_sach s JOIN bs_tac_gia tg ON tg.id = s.id_tac_gia
GROUP BY tg.id;

-- câu 12
SELECT ten_tac_gia, COUNT(DISTINCT nxb.id) so_luong_nxb_sach
FROM bs_sach s JOIN bs_tac_gia tg ON tg.id = s.id_tac_gia
    JOIN bs_nha_xuat_ban nxb ON nxb.id = s.id_nha_xuat_ban
GROUP BY tg.id
ORDER by so_luong_nxb_sach DESC
LIMIT 3;

-- câu 13
SELECT ten_nha_xuat_ban, dia_chi, COUNT(DISTINCT s.id) so_sach_xuat_ban
FROM bs_sach s JOIN bs_nha_xuat_ban nxb ON s.id_nha_xuat_ban = nxb.id
GROUP BY nxb.id
ORDER BY so_sach_xuat_ban DESC
LIMIT 5;

-- câu 14
SELECT ten_nha_xuat_ban, COUNT(DISTINCT tg.id) so_luong_tac_gia
FROM bs_sach s JOIN bs_tac_gia tg ON tg.id = s.id_tac_gia
    JOIN bs_nha_xuat_ban nxb ON nxb.id = s.id_nha_xuat_ban
GROUP BY nxb.id
ORDER BY so_luong_tac_gia DESC
LIMIT 3;



/* bài 5 */
-- câu 1
SELECT *
FROM bs_nha_xuat_ban
WHERE id NOT IN (SELECT DISTINCT nxb.id
FROM bs_nha_xuat_ban nxb JOIN bs_sach s ON nxb.id = s.id_nha_xuat_ban
WHERE trong_luong IN (280, 300, 350));

-- câu 2
SELECT *
FROM bs_nguoi_dung
WHERE id NOT IN (SELECT DISTINCT id_nguoi_dung
FROM bs_don_hang
WHERE id_nguoi_dung IS NOT NULL);

-- câu 3
SELECT nd.*, tong_tien
FROM bs_nguoi_dung nd JOIN bs_don_hang dh ON nd.id = dh.id_nguoi_dung
WHERE tong_tien = (SELECT MAX(tong_tien)
FROM bs_don_hang);

-- câu 4
SELECT *
FROM bs_sach
WHERE id_loai_sach IN (
    SELECT id
    FROM bs_loai_sach
    WHERE id_loai_cha = (SELECT id
        FROM bs_loai_sach
        WHERE ten_loai_sach = 'Sách Văn Học - Tiểu Thuyết')
);

-- câu 5
SELECT *
FROM bs_sach
WHERE id_nha_xuat_ban = (
    SELECT id_nha_xuat_ban
    FROM bs_sach
    WHERE sku = '9780723295273'
);

-- câu 6
SELECT *
FROM bs_loai_sach
WHERE id NOT IN(
    SELECT DISTINCT ls.id
    FROM bs_loai_sach ls JOIN bs_sach s ON ls.id = s.id_loai_sach
);

-- câu 7
SELECT *
FROM bs_sach
WHERE id_loai_sach = (
    SELECT id
    FROM (
        SELECT ls.id, COUNT(DISTINCT s.id) so_sach
        FROM bs_loai_sach ls JOIN bs_sach s ON s.id_loai_sach = ls.id
        GROUP BY ls.id
        ORDER BY so_sach DESC
        LIMIT 1
    ) AS temp
);

-- câu 8
SELECT *
FROM bs_sach
WHERE id_tac_gia IN (
    SELECT id
    FROM (
        SELECT tg.id, COUNT(DISTINCT nxb.id) AS so_luong_nxb_sach
        FROM bs_tac_gia tg JOIN bs_sach s ON s.id_tac_gia = tg.id
            JOIN bs_nha_xuat_ban nxb ON nxb.id = s.id_nha_xuat_ban
        GROUP BY tg.id
        HAVING so_luong_nxb_sach = (
            SELECT COUNT(DISTINCT nxb.id) AS so_luong_nxb_sach
            FROM bs_tac_gia tg JOIN bs_sach s ON s.id_tac_gia = tg.id
                JOIN bs_nha_xuat_ban nxb ON nxb.id = s.id_nha_xuat_ban
            GROUP BY tg.id
            ORDER BY so_luong_nxb_sach DESC
            LIMIT 1
        )
    ) AS temp
);

-- câu 9
SELECT *
FROM bs_sach
WHERE id_nha_xuat_ban IN (
    SELECT id
    FROM (
        SELECT nxb.id, COUNT(DISTINCT tg.id) AS so_luong_tac_gia
        FROM bs_tac_gia tg JOIN bs_sach s ON s.id_tac_gia = tg.id
            JOIN bs_nha_xuat_ban nxb ON nxb.id = s.id_nha_xuat_ban
        GROUP BY nxb.id
        HAVING so_luong_tac_gia >= (
            SELECT MIN(so_luong_tac_gia)
            FROM (
                SELECT ten_nha_xuat_ban, COUNT(DISTINCT tg.id) AS so_luong_tac_gia
                FROM bs_tac_gia tg JOIN bs_sach s ON s.id_tac_gia = tg.id
                    JOIN bs_nha_xuat_ban nxb ON nxb.id = s.id_nha_xuat_ban
                GROUP BY nxb.id
                ORDER BY so_luong_tac_gia DESC
                LIMIT 3
            ) AS temp
        )
    ) AS temp2
);
    



-- bài 6
-- câu 1
SELECT ROUND(AVG(tong_tien), -3)
FROM bs_don_hang;

-- câu 2
SELECT *
FROM bs_don_hang
WHERE MONTH(ngay_dat) = 2 AND YEAR(ngay_dat) = 2016;


-- câu 3
SELECT *, DATEDIFF(CURDATE(), ngay_dat) as so_ngay_cach_day
FROM bs_don_hang

-- câu 4
SELECT UPPER(ten_nha_xuat_ban), dia_chi, dien_thoai
FROM bs_nha_xuat_ban

-- CÂU 5
SELECT ten_sach, CONCAT(trong_luong, ' gr'), CONCAT(s.don_gia, ' VNĐ')
FROM bs_sach s JOIN bs_chi_tiet_don_hang ctdh ON s.id = ctdh.id_sach
    JOIN bs_don_hang dh ON dh.id = ctdh.id_don_hang
WHERE MONTH(ngay_dat) = 3 AND YEAR(ngay_dat) = 2016;


-- câu 6
SELECT CONCAT(id, ' - ', ho_ten), IF(id_loai_user >= 4, 'quản trị', 'thành viên' )
FROM bs_nguoi_dung;

--câu 7
SELECT *, IF(gia_bia < 100000, 'giá sách trung bình', 'giá sách cao')
FROM bs_sach
WHERE trong_luong BETWEEN 200 AND 500;

-- câu 8
SELECT *, 
    CONCAT(CASE 
        WHEN DAYOFWEEK(ngay_dat) = 1 THEN 'chủ nhật'
        WHEN DAYOFWEEK(ngay_dat) = 2 THEN 'thứ hai'
        WHEN DAYOFWEEK(ngay_dat) = 3 THEN 'thứ ba'
        WHEN DAYOFWEEK(ngay_dat) = 4 THEN 'thứ tư'
        WHEN DAYOFWEEK(ngay_dat) = 5 THEN 'thứ năm'
        WHEN DAYOFWEEK(ngay_dat) = 6 THEN 'thứ sáu' 
        WHEN DAYOFWEEK(ngay_dat) = 7 THEN 'thứ bảy'
    END, ' ngày ', DAY(ngay_dat), ' tháng ', MONTH(ngay_dat), ' năm ', YEAR(ngay_dat)) as ngay_dat_duoc_dinh_dang
FROM bs_don_hang;

-- câu 9
SELECT tai_khoan, thoi_gian_dang_nhap, 
    CASE
        WHEN DATEDIFF(CURDATE(), thoi_gian_dang_nhap) > 35 THEN 'Đã lâu rồi bạn chưa đăng nhập'
        WHEN DATEDIFF(CURDATE(), thoi_gian_dang_nhap) <= 35 THEN ''
        ELSE 'Bạn chưa đăng nhập lần nào'
    END AS trang_thai
FROM bs_nguoi_dung;




-- bài 7
-- câu 1
SELECT s.*, SUM(so_luong) AS so_luong_ban
FROM bs_sach s JOIN bs_chi_tiet_don_hang ctdh ON s.id = ctdh.id_sach
    JOIN bs_don_hang dh ON dh.id = ctdh.id_don_hang
WHERE MONTH(ngay_dat) = 3 AND YEAR(ngay_dat) = 2016
GROUP BY s.id;

-- câu 2
SELECT nxb.*, count(s.id) AS so_luong_sach
FROM bs_nha_xuat_ban nxb JOIN bs_sach s ON s.id_nha_xuat_ban = nxb.id
GROUP BY nxb.id
HAVING so_luong_sach > 9;

-- câu 3
SELECT nxb.*, count(s.id) AS so_luong_sach,
    CASE
        WHEN count(s.id) < 5 THEN 'có ít sách'
        WHEN count(s.id) <= 10 THEN 'có khá nhiều sách'
        ELSE 'có rất nhiều sách'
    END
FROM bs_nha_xuat_ban nxb JOIN bs_sach s ON s.id_nha_xuat_ban = nxb.id
GROUP BY nxb.id;

-- câu 4
SELECT tg.*, count(s.id) AS so_luong_sach,
    CASE
        WHEN count(s.id) < 5 THEN 'có ít sách'
        WHEN count(s.id) <= 10 THEN 'có khá nhiều sách'
        ELSE 'có rất nhiều sách'
    END
FROM bs_tac_gia tg JOIN bs_sach s ON s.id_tac_gia = tg.id
GROUP BY tg.id;




-- bài 8
-- câu 1
INSERT INTO bs_nguoi_dung(
tai_khoan,
mat_khau,
id_loai_user,
id_phan_quyen,
ho_ten,
email,
ngay_sinh,
dia_chi)
VALUES('linhnguyen', 'e10adc3949ba59abbe56e057f20f883e', 2, null, 'Linh Nguyễn', 'linhnguyen@gmail.com', '1992-06-13', '20 Đường 3/2 P5, Quận 10, TPHCM')


-- câu 3
INSERT INTO bs_sach_tam
SELECT *
FROM bs_sach;

-- câu 4
INSERT INTO bs_nxb_tre
SELECT *
FROM bs_sach
WHERE id_nha_xuat_ban = (
    SELECT id
    FROM bs_nha_xuat_ban
    WHERE ten_nha_xuat_ban = 'NXB Trẻ'
);



-- bài 9
-- câu 1
UPDATE bs_sach_tam
SET don_gia = 999000
--WHERE ten_sach = 'Harry Potter 7 Volume Children\'S Paperback Boxed Set'


-- bài 10
-- câu 1
DELETE FROM bs_sach_tam
WHERE id = 91



-- bài 11
-- câu 1
SELECT ho_ten, ngay_sinh, dia_chi
FROM nhan_vien;

-- câu 2
SELECT ho_ten, cmnd, muc_luong
FROM nhan_vien
WHERE ho_ten LIKE 'N%';

-- câu 3
SELECT *
FROM nhan_vien
ORDER BY muc_luong DESC, ho_ten ASC

-- câu 4
SELECT nv.*
FROM nhan_vien nv JOIN phieu_phan_cong ppc ON nv.id = ppc.id_nhan_vien
WHERE id_don_vi = 1 AND id_loai_cong_viec = 2
GROUP BY nv.id;

-- câu 5
SELECT *
FROM phieu_phan_cong
WHERE MONTH(ngay_bat_dau) = 11 AND YEAR(ngay_bat_dau) = 2014;

-- câu 6
SELECT ppc.*
FROM nhan_vien nv JOIN phieu_phan_cong ppc ON nv.id = ppc.id_nhan_vien
WHERE MONTH(ngay_bat_dau) IN (10,11,12) AND YEAR(ngay_bat_dau) = 2014
    AND ho_ten = 'Trần thanh thụy Lan';

-- câu 7
SELECT *
FROM nhan_vien
WHERE ho_ten LIKE '%Trang%';

-- câu 8
SELECT *
FROM nhan_vien
WHERE muc_luong BETWEEN 5000000 AND 8000000
ORDER BY muc_luong DESC

-- câu 9
SELECT *
FROM nhan_vien
WHERE muc_luong > 9000000;

-- câu 10
SELECT nv.*, COUNT(kn.id) AS so_ngoai_ngu
FROM nhan_vien nv JOIN kha_nang kn ON nv.id = kn.id_nhan_vien
GROUP BY nv.id
HAVING so_ngoai_ngu >= 2;

-- câu 11
SELECT nv.*, COUNT(kn.id) AS so_ngoai_ngu
FROM nhan_vien nv JOIN kha_nang kn ON nv.id = kn.id_nhan_vien
    JOIN ngoai_ngu nn ON nn.id = kn.id_ngoai_ngu
WHERE nn.ten IN ('Anh','Pháp','Đức')
GROUP BY nv.id
HAVING so_ngoai_ngu >= 3;

-- câu 12
SELECT dv.ten, COUNT(nv.id) as so_nhan_vien
FROM nhan_vien nv JOIN don_vi dv ON nv.id_don_vi = dv.id
GROUP BY dv.id;

-- câu 13
SELECT dv.ten, AVG(nv.muc_luong) as luong_trung_binh
FROM nhan_vien nv JOIN don_vi dv ON nv.id_don_vi = dv.id
WHERE dv.ten = 'Đơn vị C'
GROUP BY dv.id;

-- câu 14
SELECT lcv.*, COUNT(ppc.id) AS so_phieu_phan_cong
FROM loai_cong_viec lcv JOIN phieu_phan_cong ppc ON lcv.id = ppc.id_loai_cong_viec
GROUP BY lcv.id
ORDER BY so_phieu_phan_cong DESC
LIMIT 1;

-- câu 15
SELECT nv.*, (YEAR(CURDATE()) - YEAR(ngay_sinh)) AS tuoi
FROM nhan_vien nv JOIN don_vi dv ON nv.id_don_vi = dv.id
WHERE dv.ten = 'Đơn vị D'
ORDER BY tuoi
LIMIT 1;

-- câu 16
SELECT dv.*, MIN(muc_luong) AS luong_thap_nhat, MAX(muc_luong) AS luong_cao_nhat
FROM nhan_vien nv JOIN don_vi dv ON nv.id_don_vi = dv.id
GROUP BY dv.id;

-- câu 17
SELECT lcv.*
FROM loai_cong_viec lcv JOIN yeu_cau yc ON yc.id_loai_cong_viec = lcv.id
    JOIN ngoai_ngu nn ON nn.id = yc.id_ngoai_ngu
WHERE nn.ten = 'Brazil'
GROUP BY lcv.id;

-- câu 18
SELECT lcv.*, COUNT(yc.id_ngoai_ngu) AS so_ngoai_ngu_yc
FROM loai_cong_viec lcv JOIN yeu_cau yc ON yc.id_loai_cong_viec = lcv.id
GROUP BY lcv.id
HAVING so_ngoai_ngu_yc = 1;

-- câu 19
SELECT IF(COUNT(*) > 0, 'Nhân viên không đủ khả năng ngoại ngữ', 'nhân viên đủ đáp ứng ngoại ngữ')
FROM (
    SELECT nv.ho_ten, kn.id_ngoai_ngu
    FROM nhan_vien nv JOIN kha_nang kn ON nv.id = kn.id_nhan_vien
    WHERE nv.id = 10
) temp
RIGHT JOIN
(
    SELECT lcv.ten, yc.id_ngoai_ngu
    FROM loai_cong_viec lcv JOIN yeu_cau yc ON lcv.id = yc.id_loai_cong_viec
    WHERE lcv.id = 1
) temp2
ON temp.id_ngoai_ngu = temp2.id_ngoai_ngu
WHERE temp.ho_ten IS NULL


SELECT nv.ho_ten, ppc.id, ppc.ngay_bat_dau, so_ngay, ADDDATE(ngay_bat_dau, so_ngay) AS ngay_ket_thuc,
    IF('2015-01-20' > ngay_bat_dau && '2015-01-20' < ADDDATE(ngay_bat_dau, so_ngay), 'Nhân viên đã bận', 'Nhân viên còn trống lịch'),
    IF('2015-01-20' > ngay_bat_dau && '2015-01-20' < ADDDATE(ngay_bat_dau, so_ngay), 0, 1) AS ket_luan
FROM nhan_vien nv JOIN phieu_phan_cong ppc ON nv.id = ppc.id_nhan_vien
WHERE nv.id = 10
HAVING ket_luan = 0;


-- câu 20
INSERT INTO nhan_vien
VALUES(null, 'Trần thạch Anh', 1, '1980-10-10', '023485214', 7900000, '357 Lê Hồng Phong phường 2 Quận 10', 1)

-- câu 21
INSERT INTO kha_nang(id_nhan_vien, id_ngoai_ngu)
SELECT *
FROM (
    SELECT id AS id_nhan_vien
    FROM nhan_vien
    WHERE ho_ten = 'Trần thạch Anh'
) nhan_vien_temp
JOIN 
(
    SELECT id AS id_ngoai_ngu
    FROM ngoai_ngu
    WHERE ten IN ('Anh', 'Pháp')
) ngoai_ngu_temp
ON 1 = 1;