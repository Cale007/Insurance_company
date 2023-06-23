-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 19. čen 2023, 20:19
-- Verze serveru: 10.4.27-MariaDB
-- Verze PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `insurance_company`
--
CREATE DATABASE IF NOT EXISTS `insurance_company` DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci;
USE `insurance_company`;

-- --------------------------------------------------------

--
-- Struktura tabulky `insurance`
--

CREATE TABLE `insurance` (
  `Insurance_ID` int(11) NOT NULL,
  `name` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `insurance`
--

INSERT INTO `insurance` (`Insurance_ID`, `name`) VALUES
(1, 'Pojištění domu'),
(2, 'Pojištění auta'),
(3, 'Pojištění domácnosti'),
(4, 'Cestovní pojištění');

-- --------------------------------------------------------

--
-- Struktura tabulky `policyholder`
--

CREATE TABLE `policyholder` (
  `policyholder_ID` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `surname` varchar(60) NOT NULL,
  `address` varchar(75) NOT NULL,
  `town` varchar(60) NOT NULL,
  `age` int(11) NOT NULL,
  `phone` int(11) NOT NULL,
  `password` varchar(60) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `policyholder`
--

INSERT INTO `policyholder` (`policyholder_ID`, `name`, `surname`, `address`, `town`, `age`, `phone`, `password`, `admin`) VALUES
(18, 'Ty', 'Onan', 'Hujer 24', 'Prah', 45, 147258369, '$2y$10$hx8kLWoe19BmaTVj53wvDumi9Nt0l04oiFs4QZkYxEpj1sBPMTujK', 0),
(19, 'Já', 'Jsem', 'Na Větvi 25', 'Praha', 25, 607526415, '$2y$10$TNKmLuKSvEOp.4UMn7p0OOglPYOOZySCuOnUciz8Uzb.V4KWIrUAy', 0),
(20, 'Erik', 'Typ', 'Genger 15', 'Praha', 24, 147258369, '$2y$10$LQxit1v4BqQgofrnHKMqo.JZ1INW9g5YHSp0nO2ujk0Waxw2kGeL6', 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `policyholder_has_insurance`
--

CREATE TABLE `policyholder_has_insurance` (
  `policyholder_has_insurance_ID` int(11) NOT NULL,
  `policyholder_ID` int(11) NOT NULL,
  `insurance_ID` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `policyholder_has_insurance`
--

INSERT INTO `policyholder_has_insurance` (`policyholder_has_insurance_ID`, `policyholder_ID`, `insurance_ID`, `amount`, `from`, `to`) VALUES
(1, 2, 18, 250000, '2023-06-01', '2023-06-30'),
(2, 3, 19, 1500000, '2023-07-01', '2023-07-30');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `insurance`
--
ALTER TABLE `insurance`
  ADD PRIMARY KEY (`Insurance_ID`);

--
-- Indexy pro tabulku `policyholder`
--
ALTER TABLE `policyholder`
  ADD PRIMARY KEY (`policyholder_ID`);

--
-- Indexy pro tabulku `policyholder_has_insurance`
--
ALTER TABLE `policyholder_has_insurance`
  ADD PRIMARY KEY (`policyholder_has_insurance_ID`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `insurance`
--
ALTER TABLE `insurance`
  MODIFY `Insurance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pro tabulku `policyholder`
--
ALTER TABLE `policyholder`
  MODIFY `policyholder_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pro tabulku `policyholder_has_insurance`
--
ALTER TABLE `policyholder_has_insurance`
  MODIFY `policyholder_has_insurance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
