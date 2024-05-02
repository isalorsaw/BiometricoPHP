/*
Navicat MySQL Data Transfer

Source Server         : LOCAL
Source Server Version : 50720
Source Host           : localhost:3306
Source Database       : biometric

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2023-06-08 08:51:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_bio_log
-- ----------------------------
DROP TABLE IF EXISTS `tbl_bio_log`;
CREATE TABLE `tbl_bio_log` (
  `log_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `log_fecha` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `dispositivo_codigo` int(11) DEFAULT NULL,
  `log_registro1` int(11) DEFAULT NULL,
  `log_registro2` int(11) DEFAULT NULL,
  PRIMARY KEY (`log_codigo`),
  KEY `fk44` (`dispositivo_codigo`),
  CONSTRAINT `fk44` FOREIGN KEY (`dispositivo_codigo`) REFERENCES `tbl_bio_dispositivo` (`dispositivo_codigo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11437 DEFAULT CHARSET=utf8;
