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

/* bài 4 */
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
WHERE id_nguoi_dung IS NOT NULL)

-- câu 3
SELECT nd.*, tong_tien
FROM bs_nguoi_dung nd JOIN bs_don_hang dh ON nd.id = dh.id_nguoi_dung
WHERE tong_tien = (SELECT MAX(tong_tien)
FROM bs_don_hang)