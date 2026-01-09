-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 09, 2026 at 08:10 PM
-- Server version: 8.0.44-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soccer`
--

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `id_match` int DEFAULT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `commentaire`
--

INSERT INTO `commentaire` (`id`, `user_id`, `id_match`, `createdAt`, `comment`) VALUES
(6, 6, 4, '2026-01-09 09:46:45', 'hello mate'),
(9, 5, 8, '2026-01-09 15:40:24', 'hello ! Great Match .'),
(10, 5, 8, '2026-01-09 21:05:35', 'niceeeh');

-- --------------------------------------------------------

--
-- Stand-in structure for view `list_match`
-- (See below for the actual view)
--
CREATE TABLE `list_match` (
`match_id` int
,`organizer_id` int
,`match_date` date
,`match_hour` time
,`lieu` varchar(50)
,`banner` varchar(50)
,`status` enum('validated','rejected','in progress')
,`placesMax` int
,`team1_id` int
,`team2_id` int
,`team1_logo` varchar(50)
,`team2_logo` varchar(50)
,`team1_name` varchar(20)
,`team2_name` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int NOT NULL,
  `id_team1` int DEFAULT NULL,
  `id_team2` int DEFAULT NULL,
  `banner` varchar(50) DEFAULT NULL,
  `match_date` date DEFAULT NULL,
  `lieu` varchar(50) DEFAULT NULL,
  `placesMax` int DEFAULT NULL,
  `status` enum('validated','rejected','in progress') DEFAULT NULL,
  `organizer_id` int DEFAULT NULL,
  `match_hour` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `id_team1`, `id_team2`, `banner`, `match_date`, `lieu`, `placesMax`, `status`, `organizer_id`, `match_hour`) VALUES
(2, 17, 18, '69599ce198dbc.png', '1983-01-13', 'Non eius ut voluptat', NULL, 'rejected', 3, '02:29:00'),
(3, 19, 20, '69599d49c69a6.png', '1983-01-13', 'Non eius ut voluptat', 45, 'validated', 3, '02:29:00'),
(4, 21, 22, '6959a4d97dd20.png', '1983-01-13', 'Non eius ut voluptat', 45, 'validated', 3, '02:29:00'),
(5, 25, 26, '6959b7ef63e4f.png', '2001-08-26', 'Reprehenderit et mo', 22, 'validated', 3, '20:00:00'),
(6, 27, 28, '695aa8db3f83a.jpg', '2003-02-14', 'Non vel nobis dolore', 54, 'validated', 3, '17:21:00'),
(7, 17, 22, 'whocares.png', '2026-02-02', 'maroc', 3904, 'validated', 3, '20:20:20'),
(8, 29, 30, '6960c8979c711.jpg', '1982-09-25', 'Sunt ex minim minim ', 999, 'validated', 7, '05:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `id_match` int DEFAULT NULL,
  `createDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `total_price` decimal(20,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `user_id`, `id_match`, `createDate`, `total_price`) VALUES
(4, 2, 4, '2026-01-06 14:46:19', 666.00),
(5, 2, 4, '2026-01-06 14:46:28', 1332.00),
(6, 2, 4, '2026-01-06 14:47:13', 86.00),
(7, 2, 4, '2026-01-06 14:49:36', 426.00),
(10, 2, 4, '2026-01-07 12:16:58', 86.00),
(11, 2, 4, '2026-01-07 12:18:21', 86.00),
(12, 2, 4, '2026-01-07 12:20:31', 86.00),
(13, 2, 4, '2026-01-07 12:22:56', 86.00),
(14, 2, 4, '2026-01-07 12:23:44', 1998.00),
(15, 2, 4, '2026-01-07 12:42:05', 666.00),
(16, 2, 6, '2026-01-07 12:57:02', 972.00),
(17, 2, 6, '2026-01-08 09:07:52', 603.00),
(18, 5, 5, '2026-01-08 23:32:46', 2244.00),
(19, 5, 4, '2026-01-08 23:40:04', 1998.00),
(20, 5, 4, '2026-01-08 23:41:01', 86.00),
(21, 5, 6, '2026-01-08 23:43:07', 243.00),
(22, 5, 8, '2026-01-09 15:39:47', 951.00),
(23, 5, 8, '2026-01-09 21:05:44', 3.00);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int NOT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `logo`, `name`) VALUES
(1, '6957a0c0e89c6.png', 'Geoffrey Long'),
(2, '6957a0c0e9aac.png', 'Kiona Wallace'),
(3, '69599bb09ac21.png', 'Gray Barlow'),
(4, '69599bb09ba63.png', 'Yolanda Byrd'),
(5, '69599bd0284b9.png', 'Gray Barlow'),
(6, '69599bd02b34c.png', 'Yolanda Byrd'),
(7, '69599c2dd54bf.png', 'Gray Barlow'),
(8, '69599c2ddb3e3.png', 'Yolanda Byrd'),
(9, '69599c51bf0e0.png', 'Gray Barlow'),
(10, '69599c51c1eb8.png', 'Yolanda Byrd'),
(11, '69599c6c0873a.png', 'Alyssa Mcknight'),
(12, '69599c6c0e156.png', 'Eric Witt'),
(13, '69599c882deed.png', 'Alyssa Mcknight'),
(14, '69599c8831330.png', 'Eric Witt'),
(15, '69599ca41a1ec.png', 'Phelan Hayes'),
(16, '69599ca41b105.png', 'Clare Ayers'),
(17, '69599ce195094.png', 'Phelan Hayes'),
(18, '69599ce19808e.png', 'Clare Ayers'),
(19, '69599d49c281e.png', 'Phelan Hayes'),
(20, '69599d49c5830.png', 'Clare Ayers'),
(21, '6959a4d979f48.png', 'Phelan Hayes'),
(22, '6959a4d97a16f.png', 'Clare Ayers'),
(23, '6959b7dfb98ba.png', 'Zachary Mccormick'),
(24, '6959b7dfb9ae7.png', 'Simone Castillo'),
(25, '6959b7ef60351.png', 'Hayden Greer'),
(26, '6959b7ef604fd.png', 'Sloane Carrillo'),
(27, '695aa8db3d2fe.jpg', 'Real madrid'),
(28, '695aa8db3d6e8.jpeg', 'Barcalona'),
(29, '6960c8979ad23.png', 'Valencia'),
(30, '6960c8979ae6e.png', 'Tottenam');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int NOT NULL,
  `id_reservation` int DEFAULT NULL,
  `id_category` int DEFAULT NULL,
  `price` decimal(20,2) DEFAULT NULL,
  `status` enum('reserved','not reserved') DEFAULT 'reserved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `id_reservation`, `id_category`, `price`, `status`) VALUES
(1, 4, 5, 666.00, 'reserved'),
(2, 5, 5, 666.00, 'reserved'),
(3, 5, 5, 666.00, 'reserved'),
(4, 6, 6, 86.00, 'reserved'),
(5, 7, 4, 142.00, 'reserved'),
(6, 7, 4, 142.00, 'reserved'),
(7, 7, 4, 142.00, 'reserved'),
(8, 10, 6, 86.00, 'reserved'),
(9, 11, 6, 86.00, 'reserved'),
(10, 12, 6, 86.00, 'reserved'),
(11, 13, 6, 86.00, 'reserved'),
(12, 14, 5, 666.00, 'reserved'),
(13, 14, 5, 666.00, 'reserved'),
(14, 14, 5, 666.00, 'reserved'),
(15, 15, 5, 666.00, 'reserved'),
(16, 16, 12, 243.00, 'reserved'),
(17, 16, 12, 243.00, 'reserved'),
(18, 16, 12, 243.00, 'reserved'),
(19, 16, 12, 243.00, 'reserved'),
(20, 17, 10, 201.00, 'reserved'),
(21, 17, 10, 201.00, 'reserved'),
(22, 17, 10, 201.00, 'reserved'),
(23, 18, 9, 561.00, 'reserved'),
(24, 18, 9, 561.00, 'reserved'),
(25, 18, 9, 561.00, 'reserved'),
(26, 18, 9, 561.00, 'reserved'),
(27, 19, 5, 666.00, 'reserved'),
(28, 19, 5, 666.00, 'reserved'),
(29, 19, 5, 666.00, 'reserved'),
(30, 20, 6, 86.00, 'reserved'),
(31, 21, 12, 243.00, 'reserved'),
(32, 22, 13, 317.00, 'reserved'),
(33, 22, 13, 317.00, 'reserved'),
(34, 22, 13, 317.00, 'reserved'),
(35, 23, 14, 3.00, 'reserved');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_categorie`
--

CREATE TABLE `ticket_categorie` (
  `id` int NOT NULL,
  `match_id` int DEFAULT NULL,
  `label` varchar(40) DEFAULT NULL,
  `price` decimal(20,2) DEFAULT NULL,
  `max_seats` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ticket_categorie`
--

INSERT INTO `ticket_categorie` (`id`, `match_id`, `label`, `price`, `max_seats`) VALUES
(1, 3, 'Dolores laboris erro', 142.00, 72),
(2, 3, 'Sunt ullam voluptate', 666.00, 22),
(3, 3, 'Quas magnam rerum vo', 86.00, 29),
(4, 4, 'Dolores laboris erro', 142.00, 72),
(5, 4, 'Sunt ullam voluptate', 666.00, 22),
(6, 4, 'Quas magnam rerum vo', 86.00, 29),
(7, 5, 'Lorem qui eius error', 352.00, 15),
(8, 5, 'Et sequi impedit an', 506.00, 65),
(9, 5, 'Quia ducimus libero', 561.00, 12),
(10, 6, 'Autem dolorum est ir', 201.00, 4),
(11, 6, 'Rerum qui cupiditate', 674.00, 32),
(12, 6, 'Nostrum sit laborum', 243.00, 90),
(13, 8, 'Libero veniam saepe', 317.00, 79),
(14, 8, 'Ea labore fugit ani', 3.00, 60),
(15, 8, 'Est neque ullamco q', 11.00, 69);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int NOT NULL,
  `nom` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `password` text,
  `pic` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','banned') DEFAULT 'active',
  `role` enum('acheteur','organisateur','administrateur') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `email`, `password`, `pic`, `phone`, `createdAt`, `status`, `role`) VALUES
(2, 'Rebekah Graham', 'kinuwu@mailinator.com', '$2y$10$J/Rj/ngkjHI6CJxsaLCmYepNZj07R.mm4QlhFzm1/0jLic1lnitV.', NULL, '9298049', '2026-01-01 15:45:58', 'active', 'administrateur'),
(3, 'Anika Holt', 'bimi@mailinator.com', '$2y$10$mnhhz.rX8P5vmd2XEbTitO6JZa2kOcwQUM1pxIS9uIU9LLEUlrwx6', NULL, '983498', '2026-01-01 15:46:41', 'active', 'organisateur'),
(4, 'ayoub chatads', 'ayoub@gmail.com', '$2y$10$ddmSg1C0fhjAVleJ3J52Su/.iSQ6UxqrwPzWayt2CrpxQyPG/4JFi', '6956ab5057c1f.png', '+1 (827) 361-1115', '2026-01-01 18:13:52', 'active', 'administrateur'),
(5, 'my name is tomas shelby', 'u@u.u', '$2y$10$atvPtL8rG78nS6pYfKrm1.cXpjQ8PCwQ6wvnxuDpQBZw.pSYolfCi', '6956ae967f893.png', '+1 (261) 949-9298', '2026-01-01 18:27:50', 'active', 'acheteur'),
(6, 'amine elhailaa', 'admin@admin.organizer', '$2y$10$xbm9NtXaHAKYYl2FpO6AVePaJ/WnM522Ot/ZMEHXgW5YQTswNw/n.', '695fb62dcc7b8.png', '480248092', '2026-01-08 14:50:37', 'active', 'administrateur'),
(7, 'amine elhailaa', 'o@o.o', '$2y$10$vmdPAYGjoFjiDH4aZS75l.rjtktFfYJGVhUm4bW8tVv0H/yK7I9Ja', '6960c773ca727.png', '93840293', '2026-01-09 10:16:35', 'active', 'organisateur');

-- --------------------------------------------------------

--
-- Structure for view `list_match`
--
DROP TABLE IF EXISTS `list_match`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `list_match`  AS SELECT `m`.`id` AS `match_id`, `m`.`organizer_id` AS `organizer_id`, `m`.`match_date` AS `match_date`, `m`.`match_hour` AS `match_hour`, `m`.`lieu` AS `lieu`, `m`.`banner` AS `banner`, `m`.`status` AS `status`, `m`.`placesMax` AS `placesMax`, `t1`.`id` AS `team1_id`, `t2`.`id` AS `team2_id`, `t1`.`logo` AS `team1_logo`, `t2`.`logo` AS `team2_logo`, `t1`.`name` AS `team1_name`, `t2`.`name` AS `team2_name` FROM ((`matches` `m` join `team` `t1` on((`t1`.`id` = `m`.`id_team1`))) join `team` `t2` on((`t2`.`id` = `m`.`id_team2`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id_match` (`id_match`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_matches_team1` (`id_team1`),
  ADD KEY `fk_matches_team2` (`id_team2`),
  ADD KEY `fk_matches_org` (`organizer_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id_match` (`id_match`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reservation` (`id_reservation`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `ticket_categorie`
--
ALTER TABLE `ticket_categorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `match_id` (`match_id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `ticket_categorie`
--
ALTER TABLE `ticket_categorie`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`id_match`) REFERENCES `matches` (`id`);

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `fk_matches_org` FOREIGN KEY (`organizer_id`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `fk_matches_team1` FOREIGN KEY (`id_team1`) REFERENCES `team` (`id`),
  ADD CONSTRAINT `fk_matches_team2` FOREIGN KEY (`id_team2`) REFERENCES `team` (`id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_match`) REFERENCES `matches` (`id`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`id_reservation`) REFERENCES `reservation` (`id`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `ticket_categorie` (`id`);

--
-- Constraints for table `ticket_categorie`
--
ALTER TABLE `ticket_categorie`
  ADD CONSTRAINT `ticket_categorie_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `matches` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
