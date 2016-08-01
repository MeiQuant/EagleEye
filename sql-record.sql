-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-08-01 08:20:44
-- 服务器版本： 5.7.12
-- PHP Version: 5.6.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `EagleEye`
--

-- --------------------------------------------------------

--
-- 表的结构 `assets`
--

CREATE TABLE IF NOT EXISTS `assets` (
  `id` bigint(24) NOT NULL,
  `product_id` int(11) NOT NULL COMMENT '所属产品id',
  `name` varchar(500) NOT NULL COMMENT '资产名称',
  `amount` bigint(24) NOT NULL COMMENT '投资金额(单位为分)',
  `profit` int(11) NOT NULL COMMENT '预期收益率(*100)',
  `loan_life` int(11) NOT NULL COMMENT '还款期限',
  `start_date` int(11) NOT NULL COMMENT '还款开始时间(时间戳)',
  `end_date` int(11) NOT NULL COMMENT '还款结束时间(时间戳)',
  `loan_amount` bigint(24) NOT NULL COMMENT '债券总额(单位为分)',
  `type` varchar(100) NOT NULL COMMENT '资产类型',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='资产表';

-- --------------------------------------------------------

--
-- 表的结构 `platforms`
--

CREATE TABLE IF NOT EXISTS `platforms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT '平台的名字',
  `site` varchar(100) NOT NULL COMMENT '平台地址',
  `total_invest_amounts` bigint(24) NOT NULL COMMENT '总的交易金额(单位为分)',
  `total_invest_persons` int(11) NOT NULL COMMENT '总的投资人数',
  `total_profits` bigint(24) NOT NULL COMMENT '为用户产生的利益(单位为分)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='平台表';

-- --------------------------------------------------------

--
-- 表的结构 `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `platform_id` int(11) NOT NULL COMMENT '所属平台',
  `total_invest_amounts` bigint(24) NOT NULL COMMENT '总的交易金额(单位为分)',
  `total_invest_persons` int(11) NOT NULL COMMENT '总的投资人数',
  `total_profits` bigint(24) NOT NULL COMMENT '为用户产生的总收益(单位为分)',
  `asset_count` int(11) NOT NULL COMMENT '资产总数',
  `plat_count` int(11) NOT NULL COMMENT '平台总数',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='产品表';

-- --------------------------------------------------------

--
-- 表的结构 `rules`
--

CREATE TABLE IF NOT EXISTS `rules` (
  `id` bigint(24) NOT NULL,
  `platform_id` int(11) NOT NULL COMMENT '所属平台id',
  `code` text NOT NULL COMMENT '需要执行的php代码',
  `type` varchar(100) NOT NULL COMMENT '规则所属类型',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` bigint(24) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
