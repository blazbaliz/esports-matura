-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 05. mar 2019 ob 21.09
-- Različica strežnika: 10.1.38-MariaDB
-- Različica PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `e-sports`
--

-- --------------------------------------------------------

--
-- Struktura tabele `rezultati`
--

CREATE TABLE `rezultati` (
  `st_tekme` int(11) NOT NULL,
  `igralec_1` varchar(20) DEFAULT NULL,
  `igralec_2` varchar(20) DEFAULT NULL,
  `goli_1` int(2) DEFAULT NULL,
  `goli_2` int(2) DEFAULT NULL,
  `zmagovalec` varchar(20) DEFAULT NULL,
  `prijavnina` int(11) NOT NULL COMMENT 'prijavnina na igro v €'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabele `tekme`
--

CREATE TABLE `tekme` (
  `st` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `st_odigranih_tekem` int(11) DEFAULT NULL,
  `st_zmag` int(11) DEFAULT NULL,
  `st_porazov` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabele `transakcije`
--

CREATE TABLE `transakcije` (
  `st_trs` int(11) NOT NULL COMMENT 'trs = transakcija',
  `username` varchar(20) DEFAULT NULL,
  `namen_trs` varchar(10) DEFAULT NULL COMMENT 'vplačilo/izplačilo',
  `vrednost_trs` int(4) DEFAULT NULL COMMENT 'v €',
  `staro_stanje` int(11) DEFAULT NULL COMMENT 'v €',
  `novo_stanje` int(11) DEFAULT NULL COMMENT 'v €'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabele `uporabnik`
--

CREATE TABLE `uporabnik` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `ime` varchar(20) DEFAULT NULL,
  `priimek` varchar(20) DEFAULT NULL,
  `starost` int(4) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `ulica` varchar(30) DEFAULT NULL,
  `hisna_st` int(3) DEFAULT NULL,
  `postna_st` int(11) DEFAULT NULL,
  `kraj` varchar(30) DEFAULT NULL,
  `telefonska_st` int(20) DEFAULT NULL,
  `denarnica` int(11) DEFAULT NULL COMMENT 'vrednost v €'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `rezultati`
--
ALTER TABLE `rezultati`
  ADD PRIMARY KEY (`st_tekme`);

--
-- Indeksi tabele `tekme`
--
ALTER TABLE `tekme`
  ADD PRIMARY KEY (`st`),
  ADD KEY `username` (`username`);

--
-- Indeksi tabele `transakcije`
--
ALTER TABLE `transakcije`
  ADD PRIMARY KEY (`st_trs`),
  ADD KEY `username` (`username`);

--
-- Indeksi tabele `uporabnik`
--
ALTER TABLE `uporabnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `rezultati`
--
ALTER TABLE `rezultati`
  MODIFY `st_tekme` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT tabele `tekme`
--
ALTER TABLE `tekme`
  MODIFY `st` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT tabele `transakcije`
--
ALTER TABLE `transakcije`
  MODIFY `st_trs` int(11) NOT NULL AUTO_INCREMENT COMMENT 'trs = transakcija';

--
-- AUTO_INCREMENT tabele `uporabnik`
--
ALTER TABLE `uporabnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `tekme`
--
ALTER TABLE `tekme`
  ADD CONSTRAINT `tekme_ibfk_1` FOREIGN KEY (`username`) REFERENCES `uporabnik` (`username`);

--
-- Omejitve za tabelo `transakcije`
--
ALTER TABLE `transakcije`
  ADD CONSTRAINT `transakcije_ibfk_1` FOREIGN KEY (`username`) REFERENCES `uporabnik` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
