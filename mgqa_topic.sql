/*
Navicat MySQL Data Transfer

Source Server         : loc
Source Server Version : 50538
Source Host           : localhost:3306
Source Database       : moegirlqa

Target Server Type    : MYSQL
Target Server Version : 50538
File Encoding         : 65001

Date: 2015-07-10 00:31:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mgqa_topic
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_topic`;
CREATE TABLE `mgqa_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creater` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `introduce` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `father_topic` int(11) NOT NULL,
  `lock` int(11) NOT NULL,
  `byname` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '别名',
  `node` int(2) NOT NULL,
  PRIMARY KEY (`id`,`node`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of mgqa_topic
-- ----------------------------
INSERT INTO `mgqa_topic` VALUES ('1', 'SmileC', '未分类', '存放未分类或不易于分类的问题。', '0', '1', null, '0');
INSERT INTO `mgqa_topic` VALUES ('2', 'SmileC', '作品询问', '询问资料、图片所属的作品。', '0', '1', null, '3');
INSERT INTO `mgqa_topic` VALUES ('3', 'SmileC', '图片询问', '询问图片所属的作品', '2', '1', null, '3');
INSERT INTO `mgqa_topic` VALUES ('4', 'SmileC', '命运石之门', '命运石之门Steins;Gate（命运石之门，日语：シュタインズゲート）是2009年10月15日发售的一款Xbox 360游戏', '1', '0', null, '3');
INSERT INTO `mgqa_topic` VALUES ('0', 'SmileC', '总话题', '所有一级话题的父话题', '0', '0', null, '0');
INSERT INTO `mgqa_topic` VALUES ('9', 'SmileC', '软件工程', '软件工程是一门研究用工程化方法构建和维护有效的、实用的和高质量的软件的学科', '8', '0', null, '1');
INSERT INTO `mgqa_topic` VALUES ('8', 'SmileC', '计算机', '电子计算机', '0', '0', null, '1');
INSERT INTO `mgqa_topic` VALUES ('10', 'SmileC', 'C++', 'C++是在C语言的基础上开发的一种通用编程语言', '9', '0', null, '1');
INSERT INTO `mgqa_topic` VALUES ('11', 'SmileC', '动漫', '动漫是动画和漫画的合称的缩写', '0', '0', null, '3');
INSERT INTO `mgqa_topic` VALUES ('12', 'SmileC', '动画', '动画是一种综合艺术，它是集合了绘画、漫画、电影、数字媒体、摄影、音乐、文学等众多艺术门类于一身的艺术表现形式', '11', '0', null, '3');
