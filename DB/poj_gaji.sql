/*
 Navicat Premium Data Transfer

 Source Server         : con_local_db
 Source Server Type    : MySQL
 Source Server Version : 80026
 Source Host           : localhost:3306
 Source Schema         : poj_gaji

 Target Server Type    : MySQL
 Target Server Version : 80026
 File Encoding         : 65001

 Date: 23/02/2022 14:48:27
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for karyawan
-- ----------------------------
DROP TABLE IF EXISTS `karyawan`;
CREATE TABLE `karyawan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  `kode_pt` varchar(10) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  `created` date NULL DEFAULT NULL,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  `updated` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 74 CHARACTER SET = utf8 COLLATE = utf8_croatian_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of karyawan
-- ----------------------------
INSERT INTO `karyawan` VALUES (2, 'NITA  HARDJADINATA', 'P001', '2022-01-31', 'sadmin', '2022-01-31 11:09:44');
INSERT INTO `karyawan` VALUES (3, 'FAUZIAH ULFA A', 'P001', '2022-01-31', 'sadmin', '2022-01-31 11:10:10');
INSERT INTO `karyawan` VALUES (4, 'YULIANTI SUYANTO, DRA', 'P004', '2022-01-31', 'sadmin', '2022-01-31 11:11:36');
INSERT INTO `karyawan` VALUES (5, 'SLAMET R', 'P004', '2022-01-31', 'sadmin', '2022-01-31 11:11:56');
INSERT INTO `karyawan` VALUES (6, 'FINA S', 'P004', '2022-01-31', 'sadmin', '2022-01-31 11:12:14');
INSERT INTO `karyawan` VALUES (7, 'LENNY AGUSTINA', 'P004', '2022-01-31', 'sadmin', '2022-01-31 11:12:35');
INSERT INTO `karyawan` VALUES (8, 'AGUS SULISTYO', 'P004', '2022-01-31', 'sadmin', '2022-01-31 11:12:53');
INSERT INTO `karyawan` VALUES (9, 'DARMADI', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (10, 'TITIK SURATI', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (11, 'RINI W   ', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (12, 'ARTATI', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (13, 'NURYANTO', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (14, 'FATONI', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (15, 'MUSLIMIN', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (16, 'SUPRAN', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (17, 'RISWANTO', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (18, 'NURHAYATI', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (19, 'ROBANI', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (20, 'RETNO KUSPRIYATI', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (21, 'NASOKHAH', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (22, 'ALI  ROSIDI', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (23, 'SUWARDI', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (24, 'LISDIYANTO', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (25, 'ANITA YULIANTI', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (26, 'SUUDDIYAH, SH', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (27, 'EKO SETYANTO', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (28, 'CLAIRE IRAWAN', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (29, 'SARBI', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (30, 'SUGIHARYONO', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (31, 'FRANSISKA  IRAWATI', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (32, 'WISNU IRAWAN', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (33, 'FAKHRUDIN . M', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (34, 'RIA YULIANA  M', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (35, 'NUNUNG  S.W', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (36, 'JOHN ROBERT', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (37, 'SUPARNO', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (38, 'SARJONO', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (39, 'APRILANDO. R.A', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (40, 'EKO FEBRIANTO', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (41, 'YANTI DWI. P.R', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (42, 'INDRA  R. SH', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (43, 'AGNES', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (44, 'WALDI', 'P002', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (45, 'SUMARDI . K', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (46, 'SUTARJO', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (47, 'SUWISNI', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (48, 'SUKIMAN', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (49, 'SURDIYATI', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (50, 'SUWANTO', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (51, 'BUDIYANTO', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (52, 'TRI MUJIATI', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (53, 'NANANG . Y', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (54, 'IVANT  HALLEN', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (55, 'ASNAWI', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (56, 'SUMARNO', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (57, 'ARI CAHYONO', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (58, 'CAHYADI DARYANTO', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (59, 'BAYU INDRA RAHARJO', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (60, 'HERU SIDHARTA', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (61, 'HIE, DANNY SINDORO', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (62, 'VERSEVERANDA ANGELA', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (63, 'WILLY ASWIN', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (64, 'FAJAR  H', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (66, 'ETHAM', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (67, 'YASINTHA', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (68, 'RANNY', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (69, 'ANDI RULIS .P', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (70, 'DELITA SARI', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (71, 'F. SANDRA DEWI', 'P003', '2022-01-31', 'sadmin', '2022-01-31 00:00:00');
INSERT INTO `karyawan` VALUES (72, 'IRYANTO', 'P005', '2022-01-31', 'sadmin', '2022-01-31 14:53:49');
INSERT INTO `karyawan` VALUES (73, 'LINA BUDI H.', 'P005', '2022-01-31', 'sadmin', '2022-01-31 14:54:12');

-- ----------------------------
-- Table structure for karyawan_gaji
-- ----------------------------
DROP TABLE IF EXISTS `karyawan_gaji`;
CREATE TABLE `karyawan_gaji`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `karyawan_id` int NULL DEFAULT NULL,
  `variabel_id` int NULL DEFAULT NULL,
  `nominal` double NULL DEFAULT NULL,
  `created` date NULL DEFAULT NULL,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  `updated` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 64 CHARACTER SET = utf8 COLLATE = utf8_croatian_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of karyawan_gaji
-- ----------------------------
INSERT INTO `karyawan_gaji` VALUES (46, 2, 1, 4550000, '2022-02-11', 'sadmin', '2022-02-11 14:34:13');
INSERT INTO `karyawan_gaji` VALUES (47, 2, 3, 700000, '2022-02-11', 'sadmin', '2022-02-11 14:34:13');
INSERT INTO `karyawan_gaji` VALUES (48, 2, 4, 27000, '2022-02-11', 'sadmin', '2022-02-11 14:34:13');
INSERT INTO `karyawan_gaji` VALUES (49, 2, 5, 0, '2022-02-11', 'sadmin', '2022-02-11 14:34:13');
INSERT INTO `karyawan_gaji` VALUES (50, 2, 6, 0, '2022-02-11', 'sadmin', '2022-02-11 14:34:13');
INSERT INTO `karyawan_gaji` VALUES (51, 2, 7, 9000, '2022-02-11', 'sadmin', '2022-02-11 14:34:13');
INSERT INTO `karyawan_gaji` VALUES (52, 2, 2, 0, '2022-02-11', 'sadmin', '2022-02-11 14:34:13');
INSERT INTO `karyawan_gaji` VALUES (53, 2, 10, 570000, '2022-02-11', 'sadmin', '2022-02-11 14:34:14');
INSERT INTO `karyawan_gaji` VALUES (54, 2, 11, 162000, '2022-02-11', 'sadmin', '2022-02-11 14:34:14');
INSERT INTO `karyawan_gaji` VALUES (55, 3, 1, 3100000, '2022-02-11', 'sadmin', '2022-02-11 14:35:14');
INSERT INTO `karyawan_gaji` VALUES (56, 3, 3, 0, '2022-02-11', 'sadmin', '2022-02-11 14:35:14');
INSERT INTO `karyawan_gaji` VALUES (57, 3, 4, 0, '2022-02-11', 'sadmin', '2022-02-11 14:35:15');
INSERT INTO `karyawan_gaji` VALUES (58, 3, 5, 0, '2022-02-11', 'sadmin', '2022-02-11 14:35:15');
INSERT INTO `karyawan_gaji` VALUES (59, 3, 6, 0, '2022-02-11', 'sadmin', '2022-02-11 14:35:15');
INSERT INTO `karyawan_gaji` VALUES (60, 3, 7, 9000, '2022-02-11', 'sadmin', '2022-02-11 14:35:15');
INSERT INTO `karyawan_gaji` VALUES (61, 3, 2, 0, '2022-02-11', 'sadmin', '2022-02-11 14:35:15');
INSERT INTO `karyawan_gaji` VALUES (62, 3, 10, 20000, '2022-02-11', 'sadmin', '2022-02-11 14:35:15');
INSERT INTO `karyawan_gaji` VALUES (63, 3, 11, 113400, '2022-02-11', 'sadmin', '2022-02-11 14:35:15');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` int NOT NULL,
  `menu_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  `urut` int NULL DEFAULT NULL,
  `parent_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_croatian_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------

-- ----------------------------
-- Table structure for menu_pengguna
-- ----------------------------
DROP TABLE IF EXISTS `menu_pengguna`;
CREATE TABLE `menu_pengguna`  (
  `id` int NOT NULL,
  `role_id` int NULL DEFAULT NULL,
  `menu` tinytext CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_croatian_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu_pengguna
-- ----------------------------

-- ----------------------------
-- Table structure for pengajuan_gaji
-- ----------------------------
DROP TABLE IF EXISTS `pengajuan_gaji`;
CREATE TABLE `pengajuan_gaji`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `gaji_id` int NULL DEFAULT NULL COMMENT 'id karyawan',
  `periode` date NULL DEFAULT NULL,
  `created` date NULL DEFAULT NULL,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  `hari_kerja` int NULL DEFAULT NULL,
  `jam_lembur` double NULL DEFAULT NULL,
  `jml_cuti` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 78 CHARACTER SET = utf8 COLLATE = utf8_croatian_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengajuan_gaji
-- ----------------------------
INSERT INTO `pengajuan_gaji` VALUES (74, 2, '2022-01-31', '2022-02-11', 'sadmin', 25, 0, 1);
INSERT INTO `pengajuan_gaji` VALUES (75, 3, '2022-01-31', '2022-02-11', 'sadmin', 25, 0, 0);
INSERT INTO `pengajuan_gaji` VALUES (76, 2, '2022-02-28', '2022-02-16', 'sadmin', 22, 2.5, 1);
INSERT INTO `pengajuan_gaji` VALUES (77, 3, '2022-02-28', '2022-02-16', 'sadmin', 22, 1.3, 1);

-- ----------------------------
-- Table structure for pengguna
-- ----------------------------
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_id` int NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  `nama_staf` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  `is_active` int NULL DEFAULT NULL,
  `last_login` datetime NULL DEFAULT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_croatian_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengguna
-- ----------------------------
INSERT INTO `pengguna` VALUES (1, 1, 'savutage', '$2y$10$Qi5mEZFiB0axA6Jl0/lbAur1MJqyfrvPKTWLwRZBzuNlieqQw6L1i', 'Juniar Arif W', 1, '2022-02-23 14:46:50', '::1');

-- ----------------------------
-- Table structure for perusahaan
-- ----------------------------
DROP TABLE IF EXISTS `perusahaan`;
CREATE TABLE `perusahaan`  (
  `kode` varchar(10) CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  `created` date NULL DEFAULT NULL,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  `updated` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`kode`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_croatian_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of perusahaan
-- ----------------------------
INSERT INTO `perusahaan` VALUES ('P001', 'PT SINAR CENTRA CIPTA - SCC', '2022-01-27', 'sadmin', '2022-01-31 11:03:32');
INSERT INTO `perusahaan` VALUES ('P002', 'PT INDO PERMATA USAHATAMA - IPU 1', '2022-01-31', 'sadmin', '2022-01-31 11:03:54');
INSERT INTO `perusahaan` VALUES ('P003', 'PT INDO PERMATA USAHATAMA - IPU 2', '2022-01-31', 'sadmin', '2022-01-31 11:04:09');
INSERT INTO `perusahaan` VALUES ('P004', 'PT ENDRA CITRASEJATI - ECS', '2022-01-31', 'sadmin', '2022-01-31 11:04:31');
INSERT INTO `perusahaan` VALUES ('P005', 'PT INDO MENA SAKTI', '2022-01-31', 'sadmin', '2022-01-31 11:04:52');
INSERT INTO `perusahaan` VALUES ('P006', 'PT DIBIYA JAYA MAKMUR', '2022-01-31', 'sadmin', '2022-01-31 11:05:11');
INSERT INTO `perusahaan` VALUES ('P007', 'PT PUTRA WAHID SEJAHTERA', '2022-01-31', 'sadmin', '2022-01-31 11:05:25');
INSERT INTO `perusahaan` VALUES ('P008', 'PT INDO PERMATA USAHATAMA - POJ', '2022-01-31', 'sadmin', '2022-01-31 11:05:44');
INSERT INTO `perusahaan` VALUES ('P009', 'LAIN LAIN', '2022-01-31', 'sadmin', '2022-01-31 14:55:24');
INSERT INTO `perusahaan` VALUES ('P010', 'KAPAL KERUK', '2022-01-31', 'sadmin', '2022-01-31 14:55:55');
INSERT INTO `perusahaan` VALUES ('P011', 'OFFICE BOY (OB)', '2022-01-31', 'sadmin', '2022-01-31 14:57:04');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  `crud` text CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_croatian_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES (1, 'Super Admin', 'a:4:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";i:3;s:1:\"4\";}');
INSERT INTO `role` VALUES (2, 'Operator', 'a:3:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"3\";}');

-- ----------------------------
-- Table structure for variabel_gaji
-- ----------------------------
DROP TABLE IF EXISTS `variabel_gaji`;
CREATE TABLE `variabel_gaji`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_variabel` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  `posisi` int NULL DEFAULT NULL COMMENT '1 = tunjangan , 2 = potongan',
  `publik` int NULL DEFAULT NULL,
  `created` datetime NULL DEFAULT NULL,
  `user` varchar(255) CHARACTER SET utf8 COLLATE utf8_croatian_ci NULL DEFAULT NULL,
  `updated` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_croatian_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of variabel_gaji
-- ----------------------------
INSERT INTO `variabel_gaji` VALUES (1, 'Gaji Pokok', 1, 1, '2022-01-28 00:00:00', 'sadmin', '2022-01-28 10:37:34');
INSERT INTO `variabel_gaji` VALUES (2, 'Potongan 30%', 2, 1, '2022-01-31 00:00:00', 'sadmin', '2022-01-31 14:58:20');
INSERT INTO `variabel_gaji` VALUES (3, 'Tunjangan Jabatan', 1, 1, '2022-01-31 00:00:00', 'sadmin', '2022-01-31 14:59:20');
INSERT INTO `variabel_gaji` VALUES (4, 'Tunjangan Masa Kerja', 1, 1, '2022-01-31 00:00:00', 'sadmin', '2022-01-31 14:59:35');
INSERT INTO `variabel_gaji` VALUES (5, 'Tunjangan Lain Lain', 1, 1, '2022-01-31 00:00:00', 'sadmin', '2022-01-31 15:00:07');
INSERT INTO `variabel_gaji` VALUES (6, 'Tunjangan Tidak Tetap', 1, 1, '2022-01-31 00:00:00', 'sadmin', '2022-01-31 15:00:22');
INSERT INTO `variabel_gaji` VALUES (7, 'Uang Makan', 1, 1, '2022-01-31 00:00:00', 'sadmin', '2022-01-31 15:02:23');
INSERT INTO `variabel_gaji` VALUES (10, 'Potongan Koperasi', 2, 1, '2022-01-31 00:00:00', 'sadmin', '2022-01-31 15:03:45');
INSERT INTO `variabel_gaji` VALUES (11, 'Potongan Bpjs', 2, 1, '2022-01-31 00:00:00', 'sadmin', '2022-01-31 15:04:03');

SET FOREIGN_KEY_CHECKS = 1;
