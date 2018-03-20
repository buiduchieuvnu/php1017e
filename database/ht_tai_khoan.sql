/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1 - mysql
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : itp_trananh

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-03-20 18:32:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ht_tai_khoan
-- ----------------------------
DROP TABLE IF EXISTS `ht_tai_khoan`;
CREATE TABLE `ht_tai_khoan` (
  `id_tai_khoan` int(11) NOT NULL AUTO_INCREMENT,
  `tai_khoan` varchar(32) CHARACTER SET utf8 NOT NULL,
  `mat_khau` varchar(32) CHARACTER SET utf8 NOT NULL,
  `ngay_dang_ky` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `ho_ten` varchar(150) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_tai_khoan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of ht_tai_khoan
-- ----------------------------
INSERT INTO `ht_tai_khoan` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', null, null, 'Administrator');
INSERT INTO `ht_tai_khoan` VALUES ('2', 'giaovien', 'e10adc3949ba59abbe56e057f20f883e', null, null, 'Giao Vien');
INSERT INTO `ht_tai_khoan` VALUES ('4', 'lannt', '123456', '2018-01-21 11:02:58', null, 'Nguyễn Thị Lan');
INSERT INTO `ht_tai_khoan` VALUES ('5', 'buiduchieuvnu', '1234', '2018-01-21 14:04:47', null, 'Bùi Đức Hiếu');
INSERT INTO `ht_tai_khoan` VALUES ('6', 'nhuynt', '123456', '2018-01-21 14:05:53', null, 'Nguyễn Như Ý');
INSERT INTO `ht_tai_khoan` VALUES ('10', 'taikhoan', 'e10adc3949ba59abbe56e057f20f883e', '2018-01-21 15:48:02', null, 'Tài khoản test 01');
