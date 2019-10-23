-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 26. avg 2019 ob 21.15
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
-- Struktura tabele `tekme1`
--

CREATE TABLE `tekme1` (
  `st` int(11) NOT NULL,
  `gostitelj` varchar(50) DEFAULT NULL,
  `izzivalec` varchar(50) DEFAULT NULL,
  `vrednost_stave` int(11) DEFAULT NULL,
  `igra` varchar(11) DEFAULT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  `gostitelj_status` varchar(50) NOT NULL COMMENT 'Nepripravljen/Pripravljen',
  `izzivalec_status` varchar(50) NOT NULL COMMENT 'Nepripravljen/Pripravljen',
  `tekma_status` varchar(20) NOT NULL COMMENT 'ni izzivalca/started/not_started/koncana',
  `rezultat_gostitelj` varchar(20) NOT NULL,
  `rezultat_izzivalec` varchar(20) NOT NULL,
  `zmagovalec` varchar(50) NOT NULL,
  `datum` date NOT NULL COMMENT '	čas začetka tekme',
  `h` varchar(20) NOT NULL COMMENT 'čas začetka tekme',
  `min` varchar(20) NOT NULL COMMENT '	čas začetka tekme',
  `sec` varchar(20) NOT NULL COMMENT '	čas začetka tekme',
  `gumb` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `tekme1`
--

INSERT INTO `tekme1` (`st`, `gostitelj`, `izzivalec`, `vrednost_stave`, `igra`, `session_id`, `gostitelj_status`, `izzivalec_status`, `tekma_status`, `rezultat_gostitelj`, `rezultat_izzivalec`, `zmagovalec`, `datum`, `h`, `min`, `sec`, `gumb`) VALUES
(28, 'kclu123', 'lizba48', 15, 'FIFA 19', '5cc774699c932', 'pripravljen', 'pripravljen', 'koncana', '2:1', '2:1', 'kclu123', '2019-04-29', '9', '04', '15', ''),
(29, 'kclu123', 'lizba48', 1, 'FIFA 19', '5cc7bc161c58c', 'pripravljen', 'pripravljen', 'koncana', '2:1', '2:1', 'kclu123', '2019-04-29', '05', '10', '44', ''),
(30, 'kclu123', 'lizba48', 22, 'FIFA 19', '5cc7bef987d4e', 'pripravljen', 'pripravljen', 'koncana', '2:4', '2:4', 'kclu123', '2019-04-29', '05', '20', '42', ''),
(32, 'kclu123', 'lizba48', 15, 'FIFA 19', '5cc8711faff4b', 'pripravljen', 'pripravljen', 'koncana', '3:1', '3:1', 'IzenaÄeno', '2019-04-29', '18', '04', '39', ''),
(33, 'kclu123', '', 4, 'NBA 2k19', '5cc87be8b73d6', 'nepripravljen', 'pripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(34, 'kclu123', 'lizba48', 12, 'FIFA 19', '5cc87c1678a57', 'pripravljen', 'pripravljen', 'koncana', '1:3', '1:3', 'IzenaÄeno', '2019-04-29', '18', '47', '31', ''),
(35, 'kclu123', 'lizba48', 100, 'UFC 3', '5cc87d0ee6511', 'pripravljen', 'pripravljen', 'koncana', '1:4', '1:4', 'IzenaÄeno', '2019-04-29', '18', '51', '39', ''),
(36, 'kclu123', 'lizba48', 22, 'NBA 2k19', '5cc87dc9ad976', 'pripravljen', 'pripravljen', 'koncana', '2:4', '2:4', 'lizba48', '2019-04-29', '18', '54', '43', ''),
(37, 'kclu123', 'lizba48', 12, 'FIFA 19', '5cc87ebb9c260', 'pripravljen', 'pripravljen', 'koncana', '2:4', '2:4', 'lizba48', '2019-04-29', '18', '58', '44', ''),
(38, 'Luka12', 'BlazBaliz', 12, 'FIFA 19', '5cd48a6044940', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(39, 'lizba48', 'BlazBaliz', 3, 'NBA 2k19', '5cd48a66e8005', 'nepripravljen', 'pripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(46, 'BlazBaliz', 'lizba48', 88, 'NBA 2k19', '5cdf693e71433', 'pripravljen', 'pripravljen', 'koncana', '3:1', '3:1', 'BlazBaliz', '2019-05-17', '04', '19', '05', ''),
(47, 'BlazBaliz', 'BlazBaliz', 123, 'FIFA 19', '5cdf6c90cb926', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(48, 'BlazBaliz', 'BlazBaliz', 3, 'NBA 2k19', '5d3a0c64e7aa1', 'pripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(49, 'BlazBaliz', 'lizba48', 1, 'NBA 2k19', '5d52ae70cda5f', 'pripravljen', 'pripravljen', 'koncana', '2:1', '2:1', 'BlazBaliz', '2019-08-13', '14', '41', '52', ''),
(50, 'BlazBaliz', 'lizba48', 35, 'FIFA 19', '5d533b0ac70e0', 'pripravljen', 'pripravljen', 'started', '/', '', '', '2019-08-14', '00', '35', '06', ''),
(51, 'BlazBaliz', 'lizba48', 2, 'UFC 3', '5d533c6408cea', 'pripravljen', 'pripravljen', 'koncana', '1:2', '1:2', 'lizba48', '2019-08-13', '00', '40', '48', ''),
(52, 'BlazBaliz', 'lizba48', 5, 'FIFA 19', '5d5344377a7a2', 'pripravljen', 'pripravljen', 'koncana', '1:2', '1:2', 'lizba48', '2019-08-13', '01', '14', '08', ''),
(53, 'lizba48', 'BlazBaliz', 234, 'FIFA 19', '5d5b282664e2a', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(54, 'BlazBaliz', 'lizba48', 2342, 'FIFA 19', '5d62e794bbb76', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(55, 'kclu123', 'lizba48', 2, 'NBA 2k19', '5d62e7a9ab684', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(56, 'lizba48', 'lizba48', 2, 'UFC 3', '5d62e8a413244', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(57, 'lizba48', 'lizba48', 12, 'UFC 3', '5d62eab9b9879', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ' sadsad'),
(58, 'lizba48', 'lizba48', 23, 'UFC 3', '5d62eef4b34f5', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ' '),
(59, 'lizba48', 'lizba48', 23, 'NBA 2k19', '5d62ef27210a8', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ' '),
(60, 'lizba48', 'lizba48', 23, 'UFC 3', '5d62ef4b7161e', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ' '),
(61, 'lizba48', 'lizba48', 22, 'NBA 2k19', '5d62f02993b2a', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(62, 'lizba48', 'lizba48', 44, 'UFC 3', '5d62f12680406', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(63, 'lizba48', 'lizba48', 1223, 'NBA 2k19', '5d62f186d9b87', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(64, 'lizba48', 'lizba48', 32, 'FIFA 19', '5d62f285058b4', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(65, 'lizba48', 'lizba48', 1, 'NBA 2k19', '5d62f46d87153', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(66, 'lizba48', 'lizba48', 3, 'UFC 3', '5d62f4733e2a1', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(67, 'lizba48', 'lizba48', 2312, 'FIFA 19', '5d62f578a4eb1', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(68, 'lizba48', 'lizba48', 2312, 'FIFA 19', '5d62f578b96d5', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(69, 'lizba48', 'lizba48', 13, 'UFC 3', '5d62f59f0aa78', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(70, 'lizba48', 'lizba48', 1, 'NBA 2k19', '5d62f63e2c94a', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(71, 'lizba48', 'lizba48', 2, 'NBA 2k19', '5d62f6bdc2098', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(72, 'lizba48', 'lizba48', 22, 'UFC 3', '5d62f703067c4', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', ''),
(73, 'lizba48', 'lizba48', 55, 'NBA 2k19', '5d62f8407e6f4', 'nepripravljen', 'nepripravljen', 'not_started', '/', '', '', '0000-00-00', '', '', '', '');

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
  `novo_stanje` int(11) DEFAULT NULL COMMENT 'v €',
  `bancni_racun` varchar(50) NOT NULL,
  `Status` varchar(10) NOT NULL COMMENT 'Aktivna/Neaktivna'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `transakcije`
--

INSERT INTO `transakcije` (`st_trs`, `username`, `namen_trs`, `vrednost_trs`, `staro_stanje`, `novo_stanje`, `bancni_racun`, `Status`) VALUES
(8, 'lizba48', 'IzplaÄilo', 15, 1111, 1096, 'sad', 'KonÄana'),
(9, 'lizba48', 'IzplaÄilo', 12, 1111, 1099, '323232', 'KonÄana'),
(10, 'lizba48', 'IzplaÄilo', 0, 1111, 996, 'si 5235423 234', 'KonÄana'),
(11, 'lizba48', 'IzplaÄilo', 0, 1111, 988, '213123', 'KonÄana'),
(12, 'lizba48', 'IzplaÄilo', 0, 1111, 1000, '233', 'KonÄana'),
(13, 'lizba48', 'IzplaÄilo', 12, 1111, 1099, '123123', 'KonÄana'),
(14, 'lizba48', 'IzplaÄilo', 24, 1111, 1087, '12321', 'KonÄana'),
(15, 'lizba48', 'IzplaÄilo', 6, 1087, 1081, '3222222', 'KonÄana'),
(16, 'lizba48', 'IzplaÄilo', 34, 1081, 1047, 'SI 323', 'KonÄana'),
(17, 'lizba48', 'IzplaÄilo', 14, 1047, 1033, 'SI 32432 23234 2', 'KonÄana'),
(18, 'BlazBaliz', 'IzplaÄilo', 30, 172, 142, 'SI 3242432', 'KonÄana'),
(19, 'BlazBaliz', 'IzplaÄilo', 0, 142, 142, 'SI ', 'V procesu'),
(20, 'BlazBaliz', 'IzplaÄilo', 12, 142, 130, 'SI 5654654645', 'V procesu');

-- --------------------------------------------------------

--
-- Struktura tabele `uporabnik`
--

CREATE TABLE `uporabnik` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `ime` varchar(20) DEFAULT NULL,
  `priimek` varchar(20) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `starost` int(4) DEFAULT NULL,
  `ulica` varchar(30) DEFAULT NULL,
  `hisna_st` int(3) DEFAULT NULL,
  `postna_st` int(11) DEFAULT NULL,
  `kraj` varchar(30) DEFAULT NULL,
  `telefonska_st` int(20) DEFAULT NULL,
  `denarnica` int(11) DEFAULT NULL COMMENT 'vrednost v €'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `uporabnik`
--

INSERT INTO `uporabnik` (`id`, `username`, `ime`, `priimek`, `mail`, `password`, `starost`, `ulica`, `hisna_st`, `postna_st`, `kraj`, `telefonska_st`, `denarnica`) VALUES
(40, 'lizba48', 'BlaÅ¾', 'BaliÅ¾', 'blaz.baliz@gmail.com', '7fc604665251ac98ebb671950ddf6f37', 23, 'Ob jami ', 6, 1217, 'Vodice', 70805818, 1048),
(41, 'mojster', 'mojster', 'miha', 'mojsd', '7fc604665251ac98ebb671950ddf6f37', 22, NULL, NULL, NULL, 'Vodice', NULL, NULL),
(42, 'kclu123', 'luka', 'baliz', 'blalsdasd', '25d55ad283aa400af464c76d713c07ad', 10, NULL, NULL, NULL, 'Vodice', NULL, 9902),
(43, 'Lizbon', 'S', 'D', 'D', '7fc604665251ac98ebb671950ddf6f37', 25, NULL, NULL, NULL, 'Vodice', NULL, NULL),
(44, 'BlazBaliz', 'BlaÅ¾', 'BaliÅ¾', 'baliz.blaz@gmail.com', '7fc604665251ac98ebb671950ddf6f37', 24, 'Ob jami ', 6, 1217, 'Vodice', 70805818, 130);

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `rezultati`
--
ALTER TABLE `rezultati`
  ADD PRIMARY KEY (`st_tekme`);

--
-- Indeksi tabele `tekme1`
--
ALTER TABLE `tekme1`
  ADD UNIQUE KEY `st` (`st`);

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
-- AUTO_INCREMENT tabele `tekme1`
--
ALTER TABLE `tekme1`
  MODIFY `st` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT tabele `transakcije`
--
ALTER TABLE `transakcije`
  MODIFY `st_trs` int(11) NOT NULL AUTO_INCREMENT COMMENT 'trs = transakcija', AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT tabele `uporabnik`
--
ALTER TABLE `uporabnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `transakcije`
--
ALTER TABLE `transakcije`
  ADD CONSTRAINT `transakcije_ibfk_1` FOREIGN KEY (`username`) REFERENCES `uporabnik` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
