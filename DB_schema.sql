-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 30, 2018 at 02:21 PM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 5.6.34-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DB_schema`
--

-- --------------------------------------------------------

--
-- Table structure for table `Asmuo`
--

CREATE TABLE `Asmuo` (
  `asmens_kodas` int(11) NOT NULL,
  `vardas` varchar(255) NOT NULL,
  `pavarde` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Aukstai`
--

CREATE TABLE `Aukstai` (
  `Pavadinimas` varchar(255) NOT NULL,
  `Kodas` int(11) NOT NULL,
  `fk_Blokas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Blokai`
--

CREATE TABLE `Blokai` (
  `Pavadinimas` varchar(255) NOT NULL,
  `Kodas` int(11) NOT NULL,
  `Signalizacija` tinyint(1) NOT NULL,
  `fk_Kalejimas` int(11) NOT NULL,
  `fk_Koridorius` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Daiktas`
--

CREATE TABLE `Daiktas` (
  `Pavadinimas` varchar(255) NOT NULL,
  `Kodas` int(11) NOT NULL,
  `Gavimo_data` date NOT NULL,
  `Kaina` double NOT NULL,
  `Spalva` varchar(255) NOT NULL,
  `Tipas` char(0) NOT NULL,
  `Bukle` char(0) DEFAULT NULL,
  `fk_PatalpaId` int(11) NOT NULL,
  `fk_RegistracijaIsdavimo_kodas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Darbuotojas`
--

CREATE TABLE `Darbuotojas` (
  `tabelio_nr` int(11) NOT NULL,
  `telefono_numeris` int(11) NOT NULL,
  `gyvenamoji_vieta` varchar(255) NOT NULL,
  `sutarties_pradzia` date NOT NULL,
  `sutarties_pabaiga` date NOT NULL,
  `pareigos` char(0) NOT NULL,
  `fk_Pamainapamainos_id` int(11) NOT NULL,
  `fk_Asmuoasmens_kodas` int(11) NOT NULL,
  `fk_RegistracijaIsdavimo_kodas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Grafiko_laikas`
--

CREATE TABLE `Grafiko_laikas` (
  `grafiko_id` int(11) NOT NULL,
  `grafiko_pradzia` timestamp NOT NULL DEFAULT '2010-10-10 07:10:10',
  `grafiko_pabaiga` timestamp NOT NULL DEFAULT '2010-10-10 07:10:10'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Kalejimai`
--

CREATE TABLE `Kalejimai` (
  `Pavadinimas` varchar(255) NOT NULL,
  `id_Kalejimas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Kalinys`
--

CREATE TABLE `Kalinys` (
  `kalinio_id` int(11) NOT NULL,
  `kalejimo_priezastis` varchar(255) NOT NULL,
  `kalejimo_pradzios_laikotarpis` date NOT NULL,
  `numatoma_paleidimo_data` date NOT NULL,
  `fk_KameraKodas` int(11) NOT NULL,
  `fk_Asmuoasmens_kodas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Kameros`
--

CREATE TABLE `Kameros` (
  `Kodas` int(11) NOT NULL,
  `fk_Aukstas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Klientas`
--

CREATE TABLE `Klientas` (
  `vardas` varchar(255) DEFAULT NULL,
  `id_Klientas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Koridoriai`
--

CREATE TABLE `Koridoriai` (
  `Pavadinimas` varchar(255) NOT NULL,
  `Kodas` int(11) NOT NULL,
  `fk_Koridorius` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Korteles`
--

CREATE TABLE `Korteles` (
  `Isdavimo_data` date NOT NULL,
  `Galiojimo_data` date NOT NULL,
  `ID` int(11) NOT NULL,
  `Lygis` char(0) NOT NULL,
  `fk_Darbuotojastabelio_nr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `KortelesVartai`
--

CREATE TABLE `KortelesVartai` (
  `Uzklausa_sekminga` tinyint(1) NOT NULL,
  `Kreipimasis` char(0) NOT NULL,
  `fk_Vartai` int(11) NOT NULL,
  `fk_Kortele` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Lankytojas`
--

CREATE TABLE `Lankytojas` (
  `lankytojo_id` int(11) NOT NULL,
  `lankytojo_telefono_numeris` int(11) NOT NULL,
  `lankytojo_gyvenamoji_vieta` varchar(255) NOT NULL,
  `lankymo_data` date NOT NULL,
  `fk_Kalinyskalinio_id` int(11) NOT NULL,
  `fk_Asmuoasmens_kodas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Pamaina`
--

CREATE TABLE `Pamaina` (
  `pamainos_id` int(11) NOT NULL,
  `pavadinimas` varchar(255) NOT NULL,
  `fk_Grafiko_laikasgrafiko_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Patalpa`
--

CREATE TABLE `Patalpa` (
  `Id` int(11) NOT NULL,
  `Pavadinimas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Registracija`
--

CREATE TABLE `Registracija` (
  `Isdavimo_kodas` int(11) NOT NULL,
  `Isdavimo_d` date NOT NULL,
  `Pridavimo_d` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Rezervacija`
--

CREATE TABLE `Rezervacija` (
  `pradia` date DEFAULT NULL,
  `pabaiga` date DEFAULT NULL,
  `id_Rezervacija` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Vartai`
--

CREATE TABLE `Vartai` (
  `Kodas` int(11) NOT NULL,
  `Atidaryti` tinyint(1) NOT NULL,
  `Lygis` char(0) NOT NULL,
  `fk_Blokas` int(11) NOT NULL,
  `fk_Koridorius` int(11) NOT NULL,
  `fk_Kamera` int(11) NOT NULL,
  `fk_Aukstas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Vartotojai`
--

CREATE TABLE `Vartotojai` (
  `id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `fk_Darbuotojastabelio_nr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Asmuo`
--
ALTER TABLE `Asmuo`
  ADD PRIMARY KEY (`asmens_kodas`);

--
-- Indexes for table `Aukstai`
--
ALTER TABLE `Aukstai`
  ADD PRIMARY KEY (`Kodas`),
  ADD KEY `fk_Blokas` (`fk_Blokas`);

--
-- Indexes for table `Blokai`
--
ALTER TABLE `Blokai`
  ADD PRIMARY KEY (`Kodas`),
  ADD KEY `turi5` (`fk_Kalejimas`),
  ADD KEY `jungia1` (`fk_Koridorius`);

--
-- Indexes for table `Daiktas`
--
ALTER TABLE `Daiktas`
  ADD PRIMARY KEY (`Kodas`),
  ADD KEY `priklauso_daiktas` (`fk_PatalpaId`),
  ADD KEY `iregistruotas_daiktas` (`fk_RegistracijaIsdavimo_kodas`);

--
-- Indexes for table `Darbuotojas`
--
ALTER TABLE `Darbuotojas`
  ADD PRIMARY KEY (`tabelio_nr`),
  ADD KEY `turi_pamaina` (`fk_Pamainapamainos_id`),
  ADD KEY `dirba` (`fk_Asmuoasmens_kodas`),
  ADD KEY `registruojamas_darbuotojas` (`fk_RegistracijaIsdavimo_kodas`);

--
-- Indexes for table `Grafiko_laikas`
--
ALTER TABLE `Grafiko_laikas`
  ADD PRIMARY KEY (`grafiko_id`);

--
-- Indexes for table `Kalejimai`
--
ALTER TABLE `Kalejimai`
  ADD PRIMARY KEY (`id_Kalejimas`);

--
-- Indexes for table `Kalinys`
--
ALTER TABLE `Kalinys`
  ADD PRIMARY KEY (`kalinio_id`),
  ADD UNIQUE KEY `fk_Asmuoasmens_kodas` (`fk_Asmuoasmens_kodas`),
  ADD KEY `gyvena` (`fk_KameraKodas`);

--
-- Indexes for table `Kameros`
--
ALTER TABLE `Kameros`
  ADD PRIMARY KEY (`Kodas`),
  ADD KEY `turi3` (`fk_Aukstas`);

--
-- Indexes for table `Klientas`
--
ALTER TABLE `Klientas`
  ADD PRIMARY KEY (`id_Klientas`);

--
-- Indexes for table `Koridoriai`
--
ALTER TABLE `Koridoriai`
  ADD PRIMARY KEY (`Kodas`),
  ADD KEY `jungia` (`fk_Koridorius`);

--
-- Indexes for table `Korteles`
--
ALTER TABLE `Korteles`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `fk_Darbuotojastabelio_nr` (`fk_Darbuotojastabelio_nr`);

--
-- Indexes for table `KortelesVartai`
--
ALTER TABLE `KortelesVartai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Atidaro1` (`fk_Vartai`),
  ADD KEY `atidaro` (`fk_Kortele`);

--
-- Indexes for table `Lankytojas`
--
ALTER TABLE `Lankytojas`
  ADD PRIMARY KEY (`lankytojo_id`),
  ADD KEY `lanko_kalini` (`fk_Kalinyskalinio_id`),
  ADD KEY `lanko` (`fk_Asmuoasmens_kodas`);

--
-- Indexes for table `Pamaina`
--
ALTER TABLE `Pamaina`
  ADD PRIMARY KEY (`pamainos_id`),
  ADD KEY `turi_grafika` (`fk_Grafiko_laikasgrafiko_id`);

--
-- Indexes for table `Patalpa`
--
ALTER TABLE `Patalpa`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Registracija`
--
ALTER TABLE `Registracija`
  ADD PRIMARY KEY (`Isdavimo_kodas`);

--
-- Indexes for table `Rezervacija`
--
ALTER TABLE `Rezervacija`
  ADD PRIMARY KEY (`id_Rezervacija`);

--
-- Indexes for table `Vartai`
--
ALTER TABLE `Vartai`
  ADD PRIMARY KEY (`Kodas`),
  ADD UNIQUE KEY `fk_Kamera` (`fk_Kamera`),
  ADD UNIQUE KEY `fk_Aukstas` (`fk_Aukstas`),
  ADD KEY `turi1` (`fk_Blokas`),
  ADD KEY `turi4` (`fk_Koridorius`);

--
-- Indexes for table `Vartotojai`
--
ALTER TABLE `Vartotojai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fk_Darbuotojastabelio_nr` (`fk_Darbuotojastabelio_nr`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Aukstai`
--
ALTER TABLE `Aukstai`
  ADD CONSTRAINT `Aukstai_ibfk_1` FOREIGN KEY (`fk_Blokas`) REFERENCES `Blokai` (`Kodas`);

--
-- Constraints for table `Blokai`
--
ALTER TABLE `Blokai`
  ADD CONSTRAINT `jungia1` FOREIGN KEY (`fk_Koridorius`) REFERENCES `Koridoriai` (`Kodas`),
  ADD CONSTRAINT `turi5` FOREIGN KEY (`fk_Kalejimas`) REFERENCES `Kalejimai` (`id_Kalejimas`);

--
-- Constraints for table `Daiktas`
--
ALTER TABLE `Daiktas`
  ADD CONSTRAINT `iregistruotas_daiktas` FOREIGN KEY (`fk_RegistracijaIsdavimo_kodas`) REFERENCES `Registracija` (`Isdavimo_kodas`),
  ADD CONSTRAINT `priklauso_daiktas` FOREIGN KEY (`fk_PatalpaId`) REFERENCES `Patalpa` (`Id`);

--
-- Constraints for table `Darbuotojas`
--
ALTER TABLE `Darbuotojas`
  ADD CONSTRAINT `dirba` FOREIGN KEY (`fk_Asmuoasmens_kodas`) REFERENCES `Asmuo` (`asmens_kodas`),
  ADD CONSTRAINT `registruojamas_darbuotojas` FOREIGN KEY (`fk_RegistracijaIsdavimo_kodas`) REFERENCES `Registracija` (`Isdavimo_kodas`),
  ADD CONSTRAINT `turi_pamaina` FOREIGN KEY (`fk_Pamainapamainos_id`) REFERENCES `Pamaina` (`pamainos_id`);

--
-- Constraints for table `Kalinys`
--
ALTER TABLE `Kalinys`
  ADD CONSTRAINT `gyvena` FOREIGN KEY (`fk_KameraKodas`) REFERENCES `Kameros` (`Kodas`),
  ADD CONSTRAINT `kali` FOREIGN KEY (`fk_Asmuoasmens_kodas`) REFERENCES `Asmuo` (`asmens_kodas`);

--
-- Constraints for table `Kameros`
--
ALTER TABLE `Kameros`
  ADD CONSTRAINT `turi3` FOREIGN KEY (`fk_Aukstas`) REFERENCES `Aukstai` (`Kodas`);

--
-- Constraints for table `Koridoriai`
--
ALTER TABLE `Koridoriai`
  ADD CONSTRAINT `jungia` FOREIGN KEY (`fk_Koridorius`) REFERENCES `Koridoriai` (`Kodas`);

--
-- Constraints for table `Korteles`
--
ALTER TABLE `Korteles`
  ADD CONSTRAINT `turi10` FOREIGN KEY (`fk_Darbuotojastabelio_nr`) REFERENCES `Darbuotojas` (`tabelio_nr`);

--
-- Constraints for table `KortelesVartai`
--
ALTER TABLE `KortelesVartai`
  ADD CONSTRAINT `Atidaro1` FOREIGN KEY (`fk_Vartai`) REFERENCES `Vartai` (`Kodas`),
  ADD CONSTRAINT `atidaro` FOREIGN KEY (`fk_Kortele`) REFERENCES `Korteles` (`ID`);

--
-- Constraints for table `Lankytojas`
--
ALTER TABLE `Lankytojas`
  ADD CONSTRAINT `lanko` FOREIGN KEY (`fk_Asmuoasmens_kodas`) REFERENCES `Asmuo` (`asmens_kodas`),
  ADD CONSTRAINT `lanko_kalini` FOREIGN KEY (`fk_Kalinyskalinio_id`) REFERENCES `Kalinys` (`kalinio_id`);

--
-- Constraints for table `Pamaina`
--
ALTER TABLE `Pamaina`
  ADD CONSTRAINT `turi_grafika` FOREIGN KEY (`fk_Grafiko_laikasgrafiko_id`) REFERENCES `Grafiko_laikas` (`grafiko_id`);

--
-- Constraints for table `Vartai`
--
ALTER TABLE `Vartai`
  ADD CONSTRAINT `turi` FOREIGN KEY (`fk_Aukstas`) REFERENCES `Aukstai` (`Kodas`),
  ADD CONSTRAINT `turi1` FOREIGN KEY (`fk_Blokas`) REFERENCES `Blokai` (`Kodas`),
  ADD CONSTRAINT `turi2` FOREIGN KEY (`fk_Kamera`) REFERENCES `Kameros` (`Kodas`),
  ADD CONSTRAINT `turi4` FOREIGN KEY (`fk_Koridorius`) REFERENCES `Koridoriai` (`Kodas`);

--
-- Constraints for table `Vartotojai`
--
ALTER TABLE `Vartotojai`
  ADD CONSTRAINT `Vartotojai_ibfk_1` FOREIGN KEY (`fk_Darbuotojastabelio_nr`) REFERENCES `Darbuotojas` (`tabelio_nr`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
