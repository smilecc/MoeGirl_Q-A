-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 02 月 27 日 03:17
-- 服务器版本: 5.5.40
-- PHP 版本: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `moegirlqa`
--

-- --------------------------------------------------------

--
-- 表的结构 `mgqa_answer`
--

CREATE TABLE IF NOT EXISTS `mgqa_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(10000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `agree` int(11) NOT NULL,
  `unagree` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `mgqa_answer_agree`
--

CREATE TABLE IF NOT EXISTS `mgqa_answer_agree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer_id` int(11) NOT NULL,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_agree` int(11) NOT NULL COMMENT '1表示赞同 2反对',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `mgqa_comment`
--

CREATE TABLE IF NOT EXISTS `mgqa_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mode` int(2) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `mgqa_inbox`
--

CREATE TABLE IF NOT EXISTS `mgqa_inbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usname1` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `usname2` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `from` int(2) NOT NULL,
  `content` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `mgqa_inbox_alert`
--

CREATE TABLE IF NOT EXISTS `mgqa_inbox_alert` (
  `usname` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `numb` int(11) NOT NULL,
  PRIMARY KEY (`usname`),
  UNIQUE KEY `uid` (`usname`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `mgqa_inbox_index`
--

CREATE TABLE IF NOT EXISTS `mgqa_inbox_index` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inbox_id` int(11) NOT NULL,
  `usname1` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `usname2` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `from` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `numb` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `mgqa_question`
--

CREATE TABLE IF NOT EXISTS `mgqa_question` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `mgqa_question_user_status`
--

CREATE TABLE IF NOT EXISTS `mgqa_question_user_status` (
  `username` varchar(64) NOT NULL,
  `question_id` int(11) NOT NULL,
  `follow` int(11) NOT NULL,
  `anonymous` int(11) NOT NULL,
  PRIMARY KEY (`question_id`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `mgqa_timeline`
--

CREATE TABLE IF NOT EXISTS `mgqa_timeline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `question_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `mgqa_timeline_self`
--

CREATE TABLE IF NOT EXISTS `mgqa_timeline_self` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timeline_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `mgqa_topic`
--

CREATE TABLE IF NOT EXISTS `mgqa_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `introduce` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `father_topic` int(11) NOT NULL,
  `lock` int(11) NOT NULL,
  `byname` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '别名',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `mgqa_topic_follow`
--

CREATE TABLE IF NOT EXISTS `mgqa_topic_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `mgqa_user_login`
--

CREATE TABLE IF NOT EXISTS `mgqa_user_login` (
  `username` varchar(64) NOT NULL,
  `random` int(11) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
