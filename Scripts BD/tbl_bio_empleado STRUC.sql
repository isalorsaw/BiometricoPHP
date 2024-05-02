/*
Navicat MySQL Data Transfer

Source Server         : LOCAL
Source Server Version : 50720
Source Host           : localhost:3306
Source Database       : biometric

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2023-06-08 08:51:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_bio_empleado
-- ----------------------------
DROP TABLE IF EXISTS `tbl_bio_empleado`;
CREATE TABLE `tbl_bio_empleado` (
  `emp_codigo` int(11) NOT NULL,
  `dispositivo_codigo` int(11) NOT NULL,
  `emp_nombre` varchar(255) DEFAULT NULL,
  `depto_codigo` int(11) DEFAULT NULL,
  `emp_celular` varchar(45) DEFAULT NULL,
  `emp_estado` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`emp_codigo`,`dispositivo_codigo`),
  KEY `fkey33` (`dispositivo_codigo`),
  CONSTRAINT `fkey33` FOREIGN KEY (`dispositivo_codigo`) REFERENCES `tbl_bio_dispositivo` (`dispositivo_codigo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
