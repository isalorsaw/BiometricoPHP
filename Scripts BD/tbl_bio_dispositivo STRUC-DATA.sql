/*
Navicat MySQL Data Transfer

Source Server         : LOCAL
Source Server Version : 50720
Source Host           : localhost:3306
Source Database       : biometric

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2023-06-08 08:51:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_bio_dispositivo
-- ----------------------------
DROP TABLE IF EXISTS `tbl_bio_dispositivo`;
CREATE TABLE `tbl_bio_dispositivo` (
  `dispositivo_codigo` int(11) NOT NULL,
  `dispositivo_descrip` varchar(45) DEFAULT NULL,
  `dispositivo_ip` varchar(45) DEFAULT NULL,
  `dispositivo_estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`dispositivo_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_bio_dispositivo
-- ----------------------------
INSERT INTO `tbl_bio_dispositivo` VALUES ('1', 'Admin', '192.168.1.71', 'ACTIVO');
INSERT INTO `tbl_bio_dispositivo` VALUES ('2', 'Docente', '192.168.1.72', 'ACTIVO');
