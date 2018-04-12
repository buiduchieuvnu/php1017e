DROP PROCEDURE IF EXISTS `ht_tai_khoan_khoa`;

CREATE  PROCEDURE `ht_tai_khoan_khoa`(p_id_tai_khoan int,
	p_trang_thai char(1))
BEGIN 
/*
	Sua thong tin tai khoan
*/

DECLARE ma CHAR(5) DEFAULT '00000';
DECLARE thong_bao TEXT;
DECLARE ket_qua TEXT;
	
DECLARE EXIT HANDLER FOR SQLEXCEPTION
BEGIN
	ROLLBACK;
	GET DIAGNOSTICS CONDITION 1
		ma = RETURNED_SQLSTATE, thong_bao = MESSAGE_TEXT;
	select ma, thong_bao, ket_qua;
END;

START TRANSACTION;

	UPDATE ht_tai_khoan SET 
		trang_thai = p_trang_thai
	WHERE id_tai_khoan = p_id_tai_khoan;
	
COMMIT;

	SET ket_qua = CONVERT(LAST_INSERT_ID(), CHAR(50));
	SET thong_bao = 'Cap nhat thành công!';
	select ma, thong_bao, ket_qua;

END;

DROP PROCEDURE IF EXISTS `ht_tai_khoan_lay`;

CREATE  PROCEDURE `ht_tai_khoan_lay`(p_id_tai_khoan int)
BEGIN 
	/*
		Lấy  tai khoan theo id_tai_khoan
    */
  SELECT
		*
	FROM 
		ht_tai_khoan a
	WHERE a.id_tai_khoan = p_id_tai_khoan;

END;



DROP PROCEDURE IF EXISTS `ht_tai_khoan_sua`;

CREATE  PROCEDURE `ht_tai_khoan_sua`(p_id_tai_khoan int,
	p_ho_ten varchar(150),
	p_mat_khau varchar(32),
	p_trang_thai char(1))
BEGIN 
/*
	Sua thong tin tai khoan
*/ 

DECLARE ma CHAR(5) DEFAULT '00000';
DECLARE thong_bao TEXT;
DECLARE ket_qua TEXT;
	
DECLARE EXIT HANDLER FOR SQLEXCEPTION
BEGIN
	ROLLBACK;
	GET DIAGNOSTICS CONDITION 1
		ma = RETURNED_SQLSTATE, thong_bao = MESSAGE_TEXT;
	select ma, thong_bao, ket_qua;
END;

START TRANSACTION;

	UPDATE ht_tai_khoan SET 
		ho_ten = p_ho_ten,
		mat_khau = p_mat_khau,
		trang_thai = p_trang_thai
	WHERE id_tai_khoan = p_id_tai_khoan;
	
COMMIT;

	SET ket_qua = CONVERT(LAST_INSERT_ID(), CHAR(50));
	SET thong_bao = 'Sửa thành công!';
	select ma, thong_bao, ket_qua;

END;

DROP PROCEDURE IF EXISTS `ht_tai_khoan_tim`;

CREATE  PROCEDURE `ht_tai_khoan_tim`()
BEGIN 
	/*
		Lấy danh sách các sản phẩm 
    */
  SELECT
		a.id_tai_khoan,
		a.ho_ten,
		a.tai_khoan,
		a.ngay_dang_ky,
		a.trang_thai,
		a.last_login
	FROM 
		ht_tai_khoan a
	ORDER BY a.id_tai_khoan DESC;

END;

DROP PROCEDURE IF EXISTS `ht_tai_khoan_them`;

CREATE  PROCEDURE `ht_tai_khoan_them`(p_tai_khoan varchar(32),
	p_mat_khau varchar(32),
	p_ho_ten varchar(150),
	p_trang_thai char(1))
BEGIN
/*     
	Thêm mới tai khoan
*/
DECLARE ma CHAR(5) DEFAULT '00000';
DECLARE thong_bao TEXT;
DECLARE ket_qua TEXT;
	
DECLARE EXIT HANDLER FOR SQLEXCEPTION
BEGIN
  ROLLBACK;
  GET DIAGNOSTICS CONDITION 1
	ma = RETURNED_SQLSTATE, thong_bao = MESSAGE_TEXT;
END;
	
START TRANSACTION;

	insert into ht_tai_khoan(
		tai_khoan,
		mat_khau,
		ngay_dang_ky,
		ho_ten,
		trang_thai
  )values(
		p_tai_khoan,
		p_mat_khau,
		now(),
		p_ho_ten,
		p_trang_thai
   );
	
COMMIT;	
	SET ket_qua = CONVERT(LAST_INSERT_ID(), CHAR(50));
	SET thong_bao = 'Thêm thành công!';
	select ma, thong_bao, ket_qua;

END;



