/*
Navicat MySQL Data Transfer

Source Server         : LOCAL
Source Server Version : 50720
Source Host           : localhost:3306
Source Database       : biometric

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2023-06-08 08:52:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_bio_marcaje
-- ----------------------------
DROP TABLE IF EXISTS `tbl_bio_marcaje`;
CREATE TABLE `tbl_bio_marcaje` (
  `dispositivo_codigo` int(11) NOT NULL,
  `marcaje_id` int(11) NOT NULL,
  `emp_codigo` int(11) DEFAULT NULL,
  `marcaje_fecha` datetime DEFAULT NULL,
  `marcaje_fecharef` varchar(45) DEFAULT NULL,
  `marcaje_tipo` varchar(45) DEFAULT NULL,
  `eos_id` int(11) DEFAULT NULL,
  `marcaje_estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`dispositivo_codigo`,`marcaje_id`),
  KEY `f34` (`eos_id`),
  KEY `fk35` (`emp_codigo`),
  KEY `indice1` (`marcaje_fecharef`) USING BTREE,
  CONSTRAINT `f34` FOREIGN KEY (`eos_id`) REFERENCES `tbl_bio_eos` (`eos_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk33` FOREIGN KEY (`dispositivo_codigo`) REFERENCES `tbl_bio_dispositivo` (`dispositivo_codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk35` FOREIGN KEY (`emp_codigo`) REFERENCES `tbl_bio_empleado` (`emp_codigo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
