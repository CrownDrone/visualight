-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2023 at 10:03 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `visualight2`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('ADMIN', '1', 1689780894),
('ADMIN', '20', 1690011233),
('ADMIN', '39', 1690012712),
('ADMIN', '40', 1690012718),
('ADMIN', '41', 1690012726),
('ADMINISTRATOR', '1', 1689777903),
('ADMINISTRATOR', '11', 1689947821),
('ADMINISTRATOR', '20', 1690011232),
('ADMINISTRATOR', '39', 1690012712),
('ADMINISTRATOR', '40', 1690012718),
('ADMINISTRATOR', '41', 1690012726);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/admin/*', 2, NULL, NULL, NULL, 1689961959, 1689961959),
('/debug/*', 2, NULL, NULL, NULL, 1689961948, 1689961948),
('/gii/*', 2, NULL, NULL, NULL, 1689961945, 1689961945),
('/rbac/*', 2, NULL, NULL, NULL, 1689961950, 1689961950),
('/site/*', 2, NULL, NULL, NULL, 1689961944, 1689961944),
('/user/*', 2, NULL, NULL, NULL, 1689961942, 1689961942),
('ADMIN', 2, NULL, NULL, NULL, 1689777863, 1689777863),
('ADMINISTRATOR', 1, NULL, NULL, NULL, 1689777881, 1689777881);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('ADMIN', '/admin/*'),
('ADMIN', '/debug/*'),
('ADMIN', '/gii/*'),
('ADMIN', '/rbac/*'),
('ADMIN', '/site/*'),
('ADMIN', '/user/*'),
('ADMINISTRATOR', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1689773537),
('m130524_201442_init', 1689773539),
('m140506_102106_rbac_init', 1689774849),
('m140602_111327_create_menu_table', 1689775049),
('m160312_050000_create_user', 1689775049),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1689774849),
('m180523_151638_rbac_updates_indexes_without_prefix', 1689774850),
('m190124_110200_add_verification_token_column_to_user_table', 1689773539),
('m200409_110543_rbac_update_mssql_trigger', 1689774850);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'super_admin', 'ZEE6NAhDein0tnHGLhu24aJbKQKuA2_i', '$2y$13$mChefM6x9w2YEl.rU4rWe.qT/p4LR8sBRoJ4nhudB6/29zJz4sy2.', NULL, 'admin@example.com', 10, 1689773613, 1689773652, 'q8RIC25Tq39pvTF7sHOsbLVCnIBpKcYD_1689773613'),
(12, 'user', 'v3NRTzPdCKEu0YKZhpQVh1hCR7Helbm3', '$2y$13$3MMydkq.I9zCxkdyoIUX1.eQOeiMEWGV/moJ3As8r5SYoY8LhhSqO', NULL, 'user@test.com', 10, 1689952133, 1689957754, 'wlb5Z-LI5UtKsY8g1s4u9tYH3OAClenI_1689952133'),
(39, 'Vivi', 'IGMJr07yXlEP3rBLgEntHAoQ0ouD58R8', '$2y$13$WIDah2ecfOrpvmwyHZJJ3uJPt2h.oL33saB9ybVcIRbqUkNVJYseq', NULL, 'vivi@email.com', 10, 1690012628, 1690012628, 'naGcpXfzmgB9oGJp8chcq5rDST-DtxkV_1690012628'),
(40, 'Levi', 'zi0W2dBunaiXVPItkvuH2Y7OFCBJkDHF', '$2y$13$mZcdsFSZzDmTwu2mCncqD.8Vs49aVSXwtPrSjRpdYYyI8kDn4t.ee', NULL, 'levi@email.com', 10, 1690012662, 1690012662, '3_ZWa6swWoBW4Q8HUh9-62K3pXukcMkH_1690012662'),
(41, 'rannelskie', 'jL2mtIbt-M-TZ2VCaQw1wMuX0wTUW0K3', '$2y$13$dJC63q38Ath.7rtKIbZScec2/zpKMZfc6jFoenxelMXYR07LoBM/e', NULL, 'rannel@email.com', 10, 1690012687, 1690012687, 'AlEU7BYoOZlSSAuXPwGEpEI6WrxByNUQ_1690012687');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent` (`parent`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
