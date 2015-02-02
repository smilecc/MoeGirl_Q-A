-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 02 月 03 日 00:27
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
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `mgqa_answer`
--

INSERT INTO `mgqa_answer` (`id`, `question_id`, `username`, `content`, `agree`, `unagree`, `time`) VALUES
(1, 5, 'SmileC', '{:2015-02-02/54cf916b83309.jpg!}', 0, 0, '2015-02-02 15:35:59'),
(2, 3, 'SmileC', '答案的测试\r\n{:2015-02-03/54cfa50cb5f2c.png!}\r\n这只企鹅是linx的logo\r\n和腾讯有点像', 0, 0, '2015-02-02 16:26:08');

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
  `follow` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `mgqa_question`
--

INSERT INTO `mgqa_question` (`id`, `username`, `anonymous`, `title`, `content`, `follow`, `answer`, `status`, `time`, `topic`) VALUES
(1, 'SmileC', 0, '123', '', 0, 0, 0, '2015-02-02 06:16:53', '{"0":"2","count":1}'),
(2, 'SmileC', 0, '请问这幅画是哪部作品中的', '这个图是哪里的？{:2015-02-02/54cf1738ab99e.jpg!}', 0, 0, 0, '2015-02-02 06:21:02', '{"0":"2","count":1}'),
(3, 'SmileC', 1, '请问这幅画是哪部作品中的', '这个图是哪里的？{:2015-02-02/54cf1738ab99e.jpg!}123123', 0, 0, 0, '2015-02-02 06:21:46', '{"0":"1","1":"2","count":2}'),
(4, 'SmileC', 1, '请问这幅画是哪部作品中的', '这个图是哪里的？{:2015-02-02/54cf1738ab99e.jpg!}123123', 0, 0, 0, '2015-02-02 06:26:58', '{"0":"1","1":"2","count":2}'),
(5, 'SmileC', 0, '请问这幅画是哪部作品中的？', '{:2015-02-02/54cf3311175fa.jpg!}测试\r\n换行的测试\r\n{:2015-02-02/54cf3311175fa.jpg!}\r\n提示：如果是询问图片所属作品可以在标题中包含“是哪部作品”的关键词，并上传图片，系统会有一定几率自动识别出图片所属的作品。系统会自动识别本答案的第一张图并给出识别答案。\r\n例如标题为：请问这幅画是哪部作品中的？', 0, 0, 0, '2015-02-02 08:19:54', '{"0":"2","count":1}'),
(6, 'SmileC', 1, '问题的测试', '{:2015-02-02/54cf6836c806d.jpg!}', 0, 0, 0, '2015-02-02 12:06:20', '{"0":"2","count":1}'),
(7, 'SmileC', 0, '请问这幅画是哪部作品中的？', '{:2015-02-02/54cf8ba439aac.jpg!}', 0, 0, 0, '2015-02-02 14:37:28', '{"0":"2","count":1}');

-- --------------------------------------------------------

--
-- 表的结构 `mgqa_question_user_status`
--

CREATE TABLE IF NOT EXISTS `mgqa_question_user_status` (
  `username` varchar(64) NOT NULL,
  `question_id` int(11) NOT NULL,
  `follow` int(11) NOT NULL,
  `anonymous` int(11) NOT NULL,
  PRIMARY KEY (`username`),
  KEY `question_id` (`question_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `mgqa_question_user_status`
--

INSERT INTO `mgqa_question_user_status` (`username`, `question_id`, `follow`, `anonymous`) VALUES
('SmileC', 5, 1, 0);

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
-- 表的结构 `mgqa_topic`
--

CREATE TABLE IF NOT EXISTS `mgqa_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `introduce` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `father_subject` int(11) NOT NULL,
  `lock` int(11) NOT NULL,
  `byname` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '别名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `mgqa_topic`
--

INSERT INTO `mgqa_topic` (`id`, `name`, `introduce`, `father_subject`, `lock`, `byname`) VALUES
(1, '未分类', '存放未分类或不易于分类的问题。', 0, 1, NULL),
(2, '作品询问', '询问资料、图片所属的作品。', 0, 1, NULL);

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
('SmileC', 14324);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
