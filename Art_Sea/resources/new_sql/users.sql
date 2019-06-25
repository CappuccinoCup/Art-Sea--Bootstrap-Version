-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-06-25 13:50:02
-- 服务器版本： 10.1.38-MariaDB
-- PHP 版本： 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `art_sea`
--

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `balance` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`userID`, `name`, `email`, `password`, `tel`, `address`, `balance`) VALUES
(1, 'master', 'master@gmail.com', 'mAs1er', '010-10245678', 'Master Rd No.1', 2280),
(2, 'CappuccinoCup', '969837250@qq.com', 'cc11111111', '19921270717', 'France', 14560),
(5, 'Aurora', 'aurora@gmail.com', 'aurora210', '15297904779', 'British', 660),
(7, 'Tachibana Kanade', 'kanade@cc.com', 'kanade2010', 'secret', 'Japan', 20000),
(9, 'Laffey', 'Laffey@cc.com', 'Laffey2121', '120', 'secret', 0),
(11, 'Laffey\'s friend', 'z23@cc.com', 'z23z23z23', '110', 'secret', 0),
(13, 'Laffey\'s another friend', 'javelin@cc.com', 'javelin2121', '119', 'secret', 0),
(15, 'Ayanami', 'Ayanami@cc.com', 'Ayanami2121', '19921270717', 'secret', 0);

--
-- 转储表的索引
--

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `name` (`name`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
