-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-07-29 07:07:56
-- 服务器版本： 5.6.26
-- PHP Version: 5.5.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `EgleEye`
--

-- --------------------------------------------------------

--
-- 表的结构 `cron_tasks`
--

CREATE TABLE IF NOT EXISTS `cron_tasks` (
  `id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL COMMENT '脚本内容',
  `description` varchar(500) NOT NULL COMMENT '脚本的描述',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='计划任务表';

-- --------------------------------------------------------

--
-- 表的结构 `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `id` bigint(20) NOT NULL,
  `rule_id` int(11) NOT NULL COMMENT '所属规则',
  `hash_id` int(11) NOT NULL COMMENT '对应规则表的hash_id',
  `content` text NOT NULL COMMENT '采集的内容',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='采集的数据表';

--
-- 转存表中的数据 `data`
--

INSERT INTO `data` (`id`, `rule_id`, `hash_id`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1, 1, 1001, '25831843470', '2016-07-28 10:00:03', '2016-07-28 10:00:03', '0000-00-00 00:00:00'),
  (2, 2, 1002, '1734418', '2016-07-28 10:00:04', '2016-07-28 10:00:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `platform`
--

CREATE TABLE IF NOT EXISTS `platform` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '平台名称',
  `url` varchar(100) NOT NULL COMMENT '平台地址',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='监测平台表';

--
-- 转存表中的数据 `platform`
--

INSERT INTO `platform` (`id`, `name`, `url`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1, '真融宝', 'https://www.zhenrongbao.com', '2016-07-28 09:18:35', '2016-07-28 09:18:23', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `rules`
--

CREATE TABLE IF NOT EXISTS `rules` (
  `id` int(11) NOT NULL,
  `platform_id` int(11) NOT NULL COMMENT '所属平台id',
  `code` text COMMENT '一段需要执行的php代码',
  `hash_id` int(11) DEFAULT NULL COMMENT '区分类型的,方便以后分类展示,具体有哪些数值需要最后确定',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='抓取规则表';

--
-- 转存表中的数据 `rules`
--

INSERT INTO `rules` (`id`, `platform_id`, `code`, `hash_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
  (1, 1, '$content = file_get_contents(''https://www.zhenrongbao.com'');\n$pattern = ''/<p><span class="icon"><\\/span>累计投资总额：<span>￥(.*?)<\\/span><\\/p>/'';\npreg_match_all($pattern, $content, $matches);\nif (!empty($matches) && is_array($matches)) {\n    return str_replace('','', '''', $matches[1][0]);\n}\n', 1001, '2016-07-28 09:56:27', '2016-07-28 09:19:01', NULL),
  (2, 1, '$content = file_get_contents(''https://www.zhenrongbao.com'');\r\n$pattern = ''/投资人数：<span>(.*?)人<\\/span>/i'';\r\npreg_match_all($pattern, $content, $matches);\r\nif (!empty($matches) && is_array($matches)) {\r\n    return str_replace('','', '''', $matches[1][0]);\r\n}', 1002, '2016-07-28 09:59:45', '2016-07-28 09:59:37', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cron_tasks`
--
ALTER TABLE `cron_tasks`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `platform`
--
ALTER TABLE `platform`
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
-- AUTO_INCREMENT for table `cron_tasks`
--
ALTER TABLE `cron_tasks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `platform`
--
ALTER TABLE `platform`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
