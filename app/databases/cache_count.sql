/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_sosanhgia

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-09-06 16:07:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for cache_count
-- ----------------------------
DROP TABLE IF EXISTS `cache_count`;
CREATE TABLE `cache_count` (
  `cac_id` int(11) NOT NULL AUTO_INCREMENT,
  `cac_key` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `cac_value` int(11) DEFAULT '0',
  `cac_update_time` int(11) DEFAULT '0',
  PRIMARY KEY (`cac_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cache_count
-- ----------------------------
