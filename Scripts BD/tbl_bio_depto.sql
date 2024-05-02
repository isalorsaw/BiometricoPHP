/*
Navicat MySQL Data Transfer

Source Server         : LOCAL
Source Server Version : 50720
Source Host           : localhost:3306
Source Database       : biometric

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2023-06-08 08:50:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_bio_depto
-- ----------------------------
DROP TABLE IF EXISTS `tbl_bio_depto`;
CREATE TABLE `tbl_bio_depto` (
  `depto_id` int(11) NOT NULL,
  `depto_descripcion` varchar(45) DEFAULT NULL,
  `depto_estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`depto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
