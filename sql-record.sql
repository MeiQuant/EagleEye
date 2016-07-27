SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
--  监测平台表
--

CREATE TABLE IF NOT EXISTS `platform` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '平台名称',
  `url` varchar(100) NOT NULL COMMENT '平台地址',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='监测平台表';

ALTER TABLE `platform` ADD PRIMARY KEY (`id`);

ALTER TABLE `platform` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;





