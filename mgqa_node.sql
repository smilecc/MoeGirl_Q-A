/*
Navicat MySQL Data Transfer

Source Server         : loc
Source Server Version : 50538
Source Host           : localhost:3306
Source Database       : moegirlqa

Target Server Type    : MYSQL
Target Server Version : 50538
File Encoding         : 65001

Date: 2015-07-10 00:30:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mgqa_node
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_node`;
CREATE TABLE `mgqa_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `intro` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of mgqa_node
-- ----------------------------
INSERT INTO `mgqa_node` VALUES ('1', '机械之境', '机械电子世界');
INSERT INTO `mgqa_node` VALUES ('2', '意识之城', '艺术小说聚集地');
INSERT INTO `mgqa_node` VALUES ('3', '次元裂缝', '二次元空间');
INSERT INTO `mgqa_node` VALUES ('4', '极乐之地', '游戏取乐之地');
INSERT INTO `mgqa_node` VALUES ('5', '梦醒时分', '现实生活之景');
