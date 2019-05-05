-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 05. mar 2019 ob 21.09
-- Različica strežnika: 10.1.38-MariaDB-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 30. apr 2019 ob 00.20
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
  `tekma_status` varchar(20) NOT NULL COMMENT 'started/not_started',
  `rezultat_gostitelj` varchar(20) NOT NULL,
  `rezultat_izzivalec` varchar(20) NOT NULL,
  `datum` date NOT NULL COMMENT '	čas začetka tekme',
  `h` varchar(20) NOT NULL COMMENT 'čas začetka tekme',
  `min` varchar(20) NOT NULL COMMENT '	čas začetka tekme',
  `sec` varchar(20) NOT NULL COMMENT '	čas začetka tekme'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Odloži podatke za tabelo `tekme1`
--

INSERT INTO `tekme1` (`st`, `gostitelj`, `izzivalec`, `vrednost_stave`, `igra`, `session_id`, `gostitelj_status`, `izzivalec_status`, `tekma_status`, `rezultat_gostitelj`, `rezultat_izzivalec`, `datum`, `h`, `min`, `sec`) VALUES
(28, 'kclu123', 'lizba48', 15, 'FIFA 19', '5cc774699c932', 'pripravljen', 'pripravljen', 'koncana', '1:1', '1:1', '2019-04-29', '9', '04', '15');

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
(17, 'lizba48', 'IzplaÄilo', 14, 1047, 1033, 'SI 32432 23234 2', 'KonÄana');

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
(40, 'lizba48', 'BlaÅ¾', 'BaliÅ¾', 'blaz.baliz@gmail.com', '7fc604665251ac98ebb671950ddf6f37', 23, 'Ob jami ', 6, 1217, 'Vodice', 70805818, 1033),
(41, 'mojster', 'mojster', 'miha', 'mojsd', '7fc604665251ac98ebb671950ddf6f37', 22, NULL, NULL, NULL, 'Vodice', NULL, NULL),
(42, 'kclu123', 'luka', 'baliz', 'blalsdasd', '25d55ad283aa400af464c76d713c07ad', 10, NULL, NULL, NULL, 'Vodice', NULL, NULL),
(43, 'Lizbon', 'S', 'D', 'D', '7fc604665251ac98ebb671950ddf6f37', 25, NULL, NULL, NULL, NULL, NULL, NULL);

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
  MODIFY `st` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT tabele `transakcije`
--
ALTER TABLE `transakcije`
  MODIFY `st_trs` int(11) NOT NULL AUTO_INCREMENT COMMENT 'trs = transakcija', AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT tabele `uporabnik`
--
ALTER TABLE `uporabnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

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
