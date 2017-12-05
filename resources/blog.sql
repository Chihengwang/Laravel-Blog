-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2017-12-05 15:43:17
-- 伺服器版本: 10.1.26-MariaDB
-- PHP 版本： 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `blog`
--

-- --------------------------------------------------------

--
-- 資料表結構 `blog_category`
--

CREATE TABLE `blog_category` (
  `cate_id` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `cate_name` varchar(50) DEFAULT NULL COMMENT '分類名稱',
  `cate_title` varchar(255) DEFAULT NULL COMMENT '分類說明',
  `cate_keywords` varchar(255) DEFAULT NULL COMMENT '分類關鍵詞',
  `cate_description` varchar(255) DEFAULT NULL COMMENT '類型描述',
  `cate_view` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '觀看次數',
  `cate_order` tinyint(4) UNSIGNED NOT NULL DEFAULT '0' COMMENT '排序',
  `cate_pid` int(11) UNSIGNED DEFAULT '0' COMMENT '父類別'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `blog_category`
--

INSERT INTO `blog_category` (`cate_id`, `cate_name`, `cate_title`, `cate_keywords`, `cate_description`, `cate_view`, `cate_order`, `cate_pid`) VALUES
(1, '新聞', '國內外大小事', NULL, NULL, 0, 2, 0),
(2, '體育', 'NBA 精彩賽事', '體育，體育新聞', 'NBA 精彩賽事', 0, 1, 0),
(3, '娛樂', '很多八卦的小天地', NULL, NULL, 0, 3, 0),
(8, '熱門新聞', '最新消息都在這裡', NULL, NULL, 0, 5, 1),
(9, '軍事新聞', '很多國防消息在這裡', NULL, NULL, 0, 1, 1),
(10, '體育彩卷', '很多賭博消息在這裡', NULL, NULL, 0, 0, 2),
(11, '體育賽事', '很多比賽相關消息在這裡', NULL, NULL, 0, 0, 2),
(12, '騰訊體育', '騰訊開發的體育職播', NULL, NULL, 0, 3, 2),
(13, '實習八卦', '感情與工作辛苦談', '實習，娛樂', '這裡可以談論八卦喔!!~~~', 0, 2, 3),
(14, '明星醜陋事件', '可以看到私密的生活內容', '娛樂，娛樂圈', '拉基社會', 0, 2, 3);

-- --------------------------------------------------------

--
-- 資料表結構 `blog_user`
--

CREATE TABLE `blog_user` (
  `user_id` int(11) NOT NULL COMMENT 'User id',
  `user_name` varchar(50) DEFAULT NULL COMMENT 'User name',
  `user_pass` varchar(255) DEFAULT NULL COMMENT 'password'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `blog_user`
--

INSERT INTO `blog_user` (`user_id`, `user_name`, `user_pass`) VALUES
(1, 'admin', 'eyJpdiI6IlwvQnNvMHVLekM5M1BCUkY3MHZseGVnPT0iLCJ2YWx1ZSI6IkVPSlNFN0doakxKK29CTnVoMm9Hanc9PSIsIm1hYyI6IjY3YzcwNGNhODFiNTFiZTg5NTRjOWQ3OGY2MDk3NmQ1MjQ1NGMzOTNjNGM1OGUwZTYyYmM0MDRmMTI1NTMyNTIifQ==');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`cate_id`);

--
-- 資料表索引 `blog_user`
--
ALTER TABLE `blog_user`
  ADD PRIMARY KEY (`user_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `cate_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=22;

--
-- 使用資料表 AUTO_INCREMENT `blog_user`
--
ALTER TABLE `blog_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'User id', AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
