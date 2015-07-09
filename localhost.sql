/*
Navicat MySQL Data Transfer

Source Server         : loc
Source Server Version : 50538
Source Host           : localhost:3306
Source Database       : moegirlqa

Target Server Type    : MYSQL
Target Server Version : 50538
File Encoding         : 65001

Date: 2015-07-10 00:26:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mgqa_admin
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_admin`;
CREATE TABLE `mgqa_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pemission` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for mgqa_answer
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_answer`;
CREATE TABLE `mgqa_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(10000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `agree` int(11) NOT NULL,
  `unagree` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mgqa_answer_agree
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_answer_agree`;
CREATE TABLE `mgqa_answer_agree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer_id` int(11) NOT NULL,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_agree` int(11) NOT NULL COMMENT '1表示赞同 2反对',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Table structure for mgqa_comment
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_comment`;
CREATE TABLE `mgqa_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tousername` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `mode` int(2) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Table structure for mgqa_find
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_find`;
CREATE TABLE `mgqa_find` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer_id` int(11) DEFAULT NULL,
  `orderNumber` int(11) DEFAULT NULL,
  `answer_sub` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer_author` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer_question_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for mgqa_follow
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_follow`;
CREATE TABLE `mgqa_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `us1` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `us2` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `relation` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Table structure for mgqa_inbox
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_inbox`;
CREATE TABLE `mgqa_inbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usname1` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `usname2` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `from` int(2) NOT NULL,
  `content` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Table structure for mgqa_inbox_alert
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_inbox_alert`;
CREATE TABLE `mgqa_inbox_alert` (
  `usname` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `numb` int(11) NOT NULL,
  PRIMARY KEY (`usname`),
  UNIQUE KEY `uid` (`usname`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Table structure for mgqa_inbox_index
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_inbox_index`;
CREATE TABLE `mgqa_inbox_index` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inbox_id` int(11) NOT NULL,
  `usname1` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `usname2` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `from` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `numb` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

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
-- Table structure for mgqa_question
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_question`;
CREATE TABLE `mgqa_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `anonymous` int(11) NOT NULL,
  `title` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(2048) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer` int(11) NOT NULL,
  `follow` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic1` int(11) NOT NULL,
  `topic2` int(11) DEFAULT NULL,
  `topic3` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Table structure for mgqa_question_user_status
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_question_user_status`;
CREATE TABLE `mgqa_question_user_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `question_id` int(11) NOT NULL,
  `follow` int(11) NOT NULL,
  `anonymous` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `question_id` (`question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Table structure for mgqa_system
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_system`;
CREATE TABLE `mgqa_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for mgqa_timeline
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_timeline`;
CREATE TABLE `mgqa_timeline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mode` int(11) NOT NULL COMMENT '1 - question 2 - answer',
  `project_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT 'Question: 1 提交问题 2 关注问题 3 推送问题 Answer: 1 提交回答 2 赞同回答 3 推送回答',
  `pushtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Table structure for mgqa_timeline_agree
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_timeline_agree`;
CREATE TABLE `mgqa_timeline_agree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tousername` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `answer_id` int(11) NOT NULL,
  `fromusername` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for mgqa_timeline_follow
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_timeline_follow`;
CREATE TABLE `mgqa_timeline_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tousername` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `fromusername` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for mgqa_timeline_question
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_timeline_question`;
CREATE TABLE `mgqa_timeline_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tousername` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `fromusername` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for mgqa_timeline_time
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_timeline_time`;
CREATE TABLE `mgqa_timeline_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `temp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Table structure for mgqa_topic_follow
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_topic_follow`;
CREATE TABLE `mgqa_topic_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Table structure for mgqa_user
-- ----------------------------
DROP TABLE IF EXISTS `mgqa_user`;
CREATE TABLE `mgqa_user` (
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `page` varchar(64) NOT NULL,
  `password` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `random` int(11) NOT NULL,
  `introduce_short` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `introduce_long` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `weibo` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `agree` int(11) NOT NULL,
  `follow` int(11) NOT NULL,
  `fans` int(11) NOT NULL,
  `moegirl_wiki` varchar(255) NOT NULL,
  `moegirl_wiki_ischeck` int(1) unsigned zerofill NOT NULL,
  PRIMARY KEY (`username`,`page`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;
