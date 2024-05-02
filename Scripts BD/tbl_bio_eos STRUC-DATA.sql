/*
Navicat MySQL Data Transfer

Source Server         : LOCAL
Source Server Version : 50720
Source Host           : localhost:3306
Source Database       : biometric

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2023-06-08 08:51:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_bio_eos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_bio_eos`;
CREATE TABLE `tbl_bio_eos` (
  `eos_id` int(11) NOT NULL,
  `eos_descrip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`eos_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_bio_eos
-- ----------------------------
INSERT INTO `tbl_bio_eos` VALUES ('1', 'Entrada');
INSERT INTO `tbl_bio_eos` VALUES ('2', 'Salida');
