-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2025 at 12:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fapol_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorie`
--

CREATE TABLE `kategorie` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jmeno` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`id`, `jmeno`) VALUES
(4, 'Doypack sáčky'),
(3, 'Odtrhávací sáčky'),
(1, 'Papírové sáčky'),
(5, 'Plastové sáčky'),
(2, 'ZIP sáčky');

-- --------------------------------------------------------

--
-- Table structure for table `objednavky`
--

CREATE TABLE `objednavky` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uzivatel_email` varchar(100) DEFAULT NULL,
  `stav_objednavky` varchar(50) DEFAULT 'pending',
  `celkova_cena` decimal(10,2) DEFAULT NULL,
  `vytvoreno` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `objednavky`
--

INSERT INTO `objednavky` (`id`, `uzivatel_email`, `stav_objednavky`, `celkova_cena`, `vytvoreno`) VALUES
(21, 'petr.mara@seznam.cz', 'pending', 4033.00, '2025-02-02 10:32:31'),
(22, 'slez@gmail.com', 'pending', 476.00, '2025-02-02 10:35:55'),
(23, 'petr.mara@seznam.cz', 'pending', 978.00, '2025-02-02 10:33:30'),
(30, 'admin@fapol.cz', 'pending', 2534.00, '2025-04-22 09:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `produkty`
--

CREATE TABLE `produkty` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jmeno` varchar(255) NOT NULL,
  `popis_produktu` text DEFAULT NULL,
  `cena` decimal(10,2) NOT NULL,
  `pocet_v_baleni` int(11) DEFAULT NULL,
  `velikost` varchar(50) DEFAULT NULL,
  `image_url` text DEFAULT NULL,
  `kategorie_id` int(11) DEFAULT NULL,
  `vytvoreno` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`id`, `jmeno`, `popis_produktu`, `cena`, `pocet_v_baleni`, `velikost`, `image_url`, `kategorie_id`, `vytvoreno`) VALUES
(1, 'Černý doypack sáček', 'Doypack sáčky například na kávu, s ventilkem, černý, balení 10 ks.', 83.00, 10, '20x30', 'uploads/id1.jpg', 4, '2025-04-18 09:06:23'),
(2, 'Průhledný ZIP sáček', 'ZIP sáčky, průhledné, balení 500ks', 160.00, 500, '6x9', 'uploads/id2.jpg', 2, '2025-04-18 10:23:39'),
(3, 'Hnědé papírové sáčky', 'Papírové sáčky, 100% recyklované, hnědé, 250 ks', 810.00, 250, '10x21,5x6', 'uploads/id3.webp', 1, '2025-04-18 10:32:15'),
(4, 'Hnědý doypack sáček', 'Doypack sáčky, objem 500 ml, hnědý, balení 10 ks', 310.00, 100, '13x22,5', 'uploads/id4.jpg', 4, '2025-04-18 10:37:18'),
(5, 'Hnědé papírové sáčky', 'Papírové sáčky, 100% recyklované, hnědé, 250 ks', 1005.00, 300, '15x25x6', 'uploads/id3.webp', 1, '2025-04-18 10:39:32'),
(13, 'Černý doypack sáček', 'Doypack sáčky například na kávu, s ventilkem, černý, balení 10 ks.', 83.00, 10, '20x30', 'uploads/Doypack_cerny.jpg', 4, '2025-04-21 16:32:28');

-- --------------------------------------------------------

--
-- Table structure for table `produkty_objednavky`
--

CREATE TABLE `produkty_objednavky` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `objednavka_id` int(11) DEFAULT NULL,
  `produkt_id` int(11) DEFAULT NULL,
  `pocet` int(11) NOT NULL,
  `cena_za_kus` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produkty_objednavky`
--

INSERT INTO `produkty_objednavky` (`id`, `objednavka_id`, `produkt_id`, `pocet`, `cena_za_kus`) VALUES
(58, 21, 1, 1, 83.00),
(59, 21, 2, 1, 160.00),
(60, 21, 3, 1, 810.00),
(61, 21, 4, 1, 310.00),
(62, 21, 5, 1, 1005.00),
(63, 21, 7, 1, 59.00),
(64, 21, 8, 1, 99.00),
(65, 22, 1, 1, 83.00),
(66, 22, 2, 2, 160.00),
(67, 22, 3, 3, 810.00),
(68, 22, 4, 3, 310.00),
(69, 23, 2, 2, 160.00),
(70, 23, 3, 2, 810.00),
(71, 24, 2, 1, 160.00),
(72, 24, 3, 1, 810.00),
(73, 25, 2, 3, 160.00),
(74, 26, 2, 3, 160.00),
(75, 27, 2, 2, 160.00),
(76, 27, 3, 2, 810.00),
(77, 27, 5, 2, 1005.00),
(78, 27, 13, 1, 83.00),
(79, 28, 1, 2, 83.00),
(80, 28, 4, 1, 310.00),
(81, 29, 1, 4, 83.00),
(82, 29, 2, 3, 160.00),
(83, 29, 13, 2, 83.00),
(84, 30, 1, 3, 83.00),
(85, 30, 2, 1, 160.00),
(86, 30, 3, 1, 810.00),
(87, 30, 4, 1, 310.00),
(88, 30, 5, 1, 1005.00);

-- --------------------------------------------------------

--
-- Table structure for table `uzivatel`
--

CREATE TABLE `uzivatel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jmeno` varchar(100) NOT NULL,
  `prijmeni` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefon` varchar(20) DEFAULT NULL,
  `heslo` text NOT NULL,
  `ulice` varchar(255) DEFAULT NULL,
  `mesto` varchar(100) DEFAULT NULL,
  `psc` varchar(20) DEFAULT NULL,
  `vytvoreno` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzivatel`
--

INSERT INTO `uzivatel` (`id`, `jmeno`, `prijmeni`, `email`, `telefon`, `heslo`, `ulice`, `mesto`, `psc`, `vytvoreno`) VALUES
(2, 'Admin', 'Admin', 'admin@fapol.cz', '123 456 789', '$2y$10$9DaxscvcUL/kLZ/Pqcfi8evUOQrpnlinvuhPxEmijOhagkd45bFzS', 'Fapol 1', 'Brno', '613 00', '2025-04-20 15:26:05'),
(3, 'Franta', 'Pepa', 'franta.pepa@seznam.cz', '123 456 789', '$2y$10$wPo4Ko/6Svri1jUvxV/PM.3D.UAxPQTp0hIVNjGUrHK6LqtMMWKxC', 'Lesnická 11', 'Brno', '612 00', '2025-04-18 09:34:46'),
(4, 'Petr', 'Marek', 'petr.mara@seznam.cz', '932 681 330', '$2y$10$K7xBRvBrKxllhW0i6XKRp.fWPCvNw8n/4OBTl/1lMwdOyI4YlgF8m', 'Kuldova 42', 'Brno', '123 46', '2025-04-19 10:33:15'),
(1, 'Ondřej', 'Slezák', 'slez@gmail.com', '987 614 321', '$2y$10$BFD7FtI7TJFPmU4FahXFv.CcS62sXvC4nktdDFuvgvkJ0LkMUqZNy', 'Jugoslávská 32', 'Brno', '620 00', '2025-04-18 23:01:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jmeno` (`jmeno`);

--
-- Indexes for table `objednavky`
--
ALTER TABLE `objednavky`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produkty_objednavky`
--
ALTER TABLE `produkty_objednavky`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `objednavky`
--
ALTER TABLE `objednavky`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `produkty_objednavky`
--
ALTER TABLE `produkty_objednavky`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `uzivatel`
--
ALTER TABLE `uzivatel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
