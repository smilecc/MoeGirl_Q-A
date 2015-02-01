-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 02 月 01 日 10:22
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
CREATE DATABASE `moegirlqa` DEFAULT CHARACTER SET gbk COLLATE gbk_chinese_ci;
USE `moegirlqa`;

-- --------------------------------------------------------

--
-- 表的结构 `mgqa_question`
--

CREATE TABLE IF NOT EXISTS `mgqa_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(2048) NOT NULL,
  `agree` int(11) NOT NULL,
  `unagree` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subject` varchar(128) NOT NULL,
  `keyword` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '猜测的关键词',
  `baike_title` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `baike_content` varchar(256) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `mgqa_subject`
--

CREATE TABLE IF NOT EXISTS `mgqa_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `introduce` varchar(512) NOT NULL,
  `father_subject` int(11) NOT NULL,
  `lock` int(11) NOT NULL,
  `byname` varchar(32) NOT NULL COMMENT '别名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `mgqa_timeline_self`
--

CREATE TABLE IF NOT EXISTS `mgqa_timeline_self` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timeline_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `mgqa_user_login`
--

CREATE TABLE IF NOT EXISTS `mgqa_user_login` (
  `username` varchar(64) NOT NULL,
  `random` int(11) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `mgqa_user_login`
--

INSERT INTO `mgqa_user_login` (`username`, `random`) VALUES
('SmileC', 6474);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
