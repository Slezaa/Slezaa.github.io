-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2025 at 06:11 AM
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
-- Database: `uzivatele_fapol`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(50) NOT NULL,
  `id_produktu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `objednavky_fapol`
--

CREATE TABLE `objednavky_fapol` (
  `id_objednavky` int(11) NOT NULL,
  `produkty_objednavky` int(11) NOT NULL,
  `cena_objednavky` int(11) NOT NULL,
  `id_uzivatele` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produkty_fapol`
--

CREATE TABLE `produkty_fapol` (
  `id_produktu` int(11) NOT NULL,
  `jmeno_produktu` varchar(50) NOT NULL,
  `category_produktu` varchar(50) NOT NULL,
  `rozmery_produktu` varchar(10) NOT NULL,
  `cena_produktu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uzivatele_fapol`
--

CREATE TABLE `uzivatele_fapol` (
  `id` int(11) NOT NULL,
  `jmeno` varchar(20) DEFAULT NULL,
  `prijmeni` varchar(20) DEFAULT NULL,
  `telefon` varchar(9) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `adresa` varchar(50) DEFAULT NULL,
  `mesto` varchar(20) DEFAULT NULL,
  `heslo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzivatele_fapol`
--

INSERT INTO `uzivatele_fapol` (`id`, `jmeno`, `prijmeni`, `telefon`, `email`, `adresa`, `mesto`, `heslo`) VALUES
(5, 'Ondřej', 'Slezák', '123456789', 'slezon17@gmail.com', 'Purkyňova 23', 'Brno', '2yG9q7O7s42BI'),
(6, 'Filip', 'Takáč', '637213464', 'filewowko@gmail.com', 'Halasák 11', 'Telnice', '2yEm4TsxJAphE'),
(8, 'Denis', 'Penis', '678543219', 'boban@gmail.com', 'Komárov 68', 'Brno', '2ySz/j9Yl3Z3Y'),
(12, 'Petr', 'Marek', '878 313 4', 'petr.mara@seznam.cz', 'Bieblova 59', 'Brno', '2yG9q7O7s42BI'),
(13, '', '', '', '', '', '', '2y7V9UQMD9zmk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`),
  ADD UNIQUE KEY `id_produktu` (`id_produktu`);

--
-- Indexes for table `objednavky_fapol`
--
ALTER TABLE `objednavky_fapol`
  ADD PRIMARY KEY (`id_objednavky`),
  ADD UNIQUE KEY `id_uzivatele` (`id_uzivatele`),
  ADD UNIQUE KEY `produkty_objednavky` (`produkty_objednavky`);

--
-- Indexes for table `produkty_fapol`
--
ALTER TABLE `produkty_fapol`
  ADD PRIMARY KEY (`id_produktu`),
  ADD UNIQUE KEY `category_produktu` (`category_produktu`);

--
-- Indexes for table `uzivatele_fapol`
--
ALTER TABLE `uzivatele_fapol`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `uzivatele_fapol`
--
ALTER TABLE `uzivatele_fapol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `objednavky_fapol`
--
ALTER TABLE `objednavky_fapol`
  ADD CONSTRAINT `objednavky_fapol_ibfk_1` FOREIGN KEY (`id_uzivatele`) REFERENCES `uzivatele_fapol` (`id`);

--
-- Constraints for table `produkty_fapol`
--
ALTER TABLE `produkty_fapol`
  ADD CONSTRAINT `produkty_fapol_ibfk_1` FOREIGN KEY (`id_produktu`) REFERENCES `category` (`id_produktu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
