-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-12-17 21:08:59
-- 伺服器版本： 10.4.16-MariaDB
-- PHP 版本： 7.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `snail_project`
--

-- --------------------------------------------------------

--
-- 資料表結構 `snail_admins`
--

CREATE TABLE `snail_admins` (
  `sid` int(11) NOT NULL,
  `account` int(11) NOT NULL,
  `email` int(11) NOT NULL,
  `password` int(11) NOT NULL,
  `mobile` int(11) NOT NULL,
  `address` int(11) NOT NULL,
  `birthday` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `snail_class`
--

CREATE TABLE `snail_class` (
  `sid` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `classname` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `snail_class`
--

INSERT INTO `snail_class` (`sid`, `category`, `classname`, `date`, `amount`) VALUES
(1, '初級', '初級捏陶', '2020-12-17 20:39:55', 1),
(2, '中級', '中級拉胚', '2020-12-19 20:40:31', 2),
(3, '體驗DIY', '陶碗製作', '2020-12-19 20:41:59', 3),
(4, '體驗DIY', '陶碗製作', '2020-12-19 20:41:59', 3),
(5, '體驗DIY', '盤子製作', '2020-12-19 20:41:59', 5),
(6, '體驗DIY', '花器製作', '2020-12-20 20:41:59', 1),
(7, '體驗DIY', '壓花彩繪', '2020-12-19 20:41:59', 3);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `snail_admins`
--
ALTER TABLE `snail_admins`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `snail_class`
--
ALTER TABLE `snail_class`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `snail_admins`
--
ALTER TABLE `snail_admins`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `snail_class`
--
ALTER TABLE `snail_class`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
