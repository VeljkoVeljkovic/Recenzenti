-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 29, 2019 at 09:26 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recezenti`
--

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

DROP TABLE IF EXISTS `anketa`;
CREATE TABLE IF NOT EXISTS `anketa` (
  `idAnketa` int(11) NOT NULL AUTO_INCREMENT,
  `nazivAnkete` varchar(45) CHARACTER SET utf8 NOT NULL,
  `statusAnkete` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idAnketa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anketa`
--

INSERT INTO `anketa` (`idAnketa`, `nazivAnkete`, `statusAnkete`) VALUES
(1, 'PHP', '');

-- --------------------------------------------------------

--
-- Table structure for table `anketa_odgovori`
--

DROP TABLE IF EXISTS `anketa_odgovori`;
CREATE TABLE IF NOT EXISTS `anketa_odgovori` (
  `idAnketaOdgovor` int(11) NOT NULL AUTO_INCREMENT,
  `idAnketuRadi` int(11) NOT NULL,
  `idAnketaPitanje` int(11) NOT NULL,
  `odgovor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idAnketaOdgovor`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `anketa_pitanja`
--

DROP TABLE IF EXISTS `anketa_pitanja`;
CREATE TABLE IF NOT EXISTS `anketa_pitanja` (
  `idAnketaPitanje` int(11) NOT NULL AUTO_INCREMENT,
  `idAnketa` int(11) NOT NULL,
  `pitanje` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `odgovor1` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `odgovor2` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `odgovor3` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `odgovor4` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idAnketaPitanje`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anketa_pitanja`
--

INSERT INTO `anketa_pitanja` (`idAnketaPitanje`, `idAnketa`, `pitanje`, `odgovor1`, `odgovor2`, `odgovor3`, `odgovor4`) VALUES
(2, 1, 'Koji je najjači, stvarno najjači programski jezik?', NULL, NULL, NULL, NULL),
(3, 1, 'Php metod je?', 'Post', 'Mrs', 'Kukulele', 'Undefined'),
(5, 1, '500 Internal Server Error je?', 'Baš nemaš sreće.', 'Neko ti je dirao kod.', 'Napravio si grešku u kodu.', 'Sa 3 reči i 1. br.  upropastiš nekome dan :-/');

-- --------------------------------------------------------

--
-- Table structure for table `anketu_radi`
--

DROP TABLE IF EXISTS `anketu_radi`;
CREATE TABLE IF NOT EXISTS `anketu_radi` (
  `idAnketuRadi` int(11) NOT NULL AUTO_INCREMENT,
  `idAnketa` int(11) NOT NULL,
  `idKorisnik` int(11) NOT NULL,
  `status` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idAnketuRadi`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anketu_radi`
--

INSERT INTO `anketu_radi` (`idAnketuRadi`, `idAnketa`, `idKorisnik`, `status`) VALUES
(1, 1, 28, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

DROP TABLE IF EXISTS `korisnici`;
CREATE TABLE IF NOT EXISTS `korisnici` (
  `idKorisnik` int(11) NOT NULL AUTO_INCREMENT,
  `korIme` varchar(45) COLLATE utf8_bin NOT NULL,
  `lozinka` varchar(255) COLLATE utf8_bin NOT NULL,
  `mejl` varchar(45) COLLATE utf8_bin NOT NULL,
  `rola` varchar(45) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idKorisnik`),
  UNIQUE KEY `korIme_UNIQUE` (`korIme`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`idKorisnik`, `korIme`, `lozinka`, `mejl`, `rola`) VALUES
(1, 'micko', '$2y$10$Z3b7TXe3W/dSHD9Qk8CYY.mMIy5trR/UZZangsW5WSCMVjAVTS6HG', 'mica@gmail.com', 'recezent'),
(2, 'pera1', '$2y$10$HDrd11y0/CIrfpwkOFf4IeB9FH0oR.Qch5C5AYGjM7QKTU801rflC', 'aaa@bbb.ccc', 'recezent'),
(5, 'pera2', '$2y$10$3xJnIuFEnuVb/hiG3TB7BOLwm.5PyDEA/CeYpCtjxwFEQmVe.MJe.', 'veljkoveljkovic.mdi@yahoo.com', 'recezent'),
(12, 'micko2', '$2y$10$dg3tbbqe0YNOf18lftKP5OWjYEHbMVyg1GS4kysZBYxr8nqbeQJES', 'mic@gmail.com', 'recezent'),
(17, '', '$2y$10$a97ZIfxSX1DWFkXyaNqPh.zLMCQlJmE/E2lXrwvQBO0hJHkYmy9ie', '', 'recezent'),
(24, 'giki123', '$2y$10$gMUtGVstBUf4B3e3vf/t4eFTHNxWrXAv/jLedh0Z9zPIwBWfbINfm', 'aaa@bbb.ccc', 'recenzent'),
(25, 'Velja', '$2y$10$nfONgtf9g1usZhlsOC30wuS70u389mN/54tmSU9zgouJ8GgY/h11e', 'veveljko@gmail.com', 'recenzent'),
(26, 'Petar', '$2y$10$qgeV1e3cGpyMatpGuxCRYeVZC4Pv3auZ/SVbqb/UwS2gozAFg013W', 'petar@gmail.com', 'administrator'),
(27, 'Veljko', '$2y$10$7NieR7qBq6vN/K6Kitx9FuICG.hZhigOobXLEd9znnHyAzui911j2', 'ghfdh@gmail.com', 'administrator'),
(28, 'Petarr', '$2y$10$kk6TuB5RDzhZOWXC7wbkSOKqfBJduhn05orIXvwkKQuRFXQBro7O2', 'petar@gmail.com', 'recenzent'),
(29, 'petraa', '$2y$10$I90iR1sPNH9.x78p1xrTteAFP3DA7bazJdNqSa6fjhcP8ZIHvgzUa', 'petraa@gmail.com', 'recenzent'),
(30, 'Proba', '$2y$10$TSQW09jk8Zhub8/FXBTqGe7tLyxkIdSvk0ioIvaW3Fh1asQA0QpcC', 'proba@gmail.com', 'recenzent');

-- --------------------------------------------------------

--
-- Table structure for table `obavestenja`
--

DROP TABLE IF EXISTS `obavestenja`;
CREATE TABLE IF NOT EXISTS `obavestenja` (
  `idObavestenja` int(11) NOT NULL AUTO_INCREMENT,
  `tekst` varchar(45) CHARACTER SET utf8 NOT NULL,
  `naslov` varchar(45) CHARACTER SET utf8 NOT NULL,
  `datum` datetime NOT NULL,
  `potpis` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`idObavestenja`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oblast_strucnosti`
--

DROP TABLE IF EXISTS `oblast_strucnosti`;
CREATE TABLE IF NOT EXISTS `oblast_strucnosti` (
  `idOblastiStrucnosti` int(11) NOT NULL AUTO_INCREMENT,
  `oblastStrucnosti` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idOblastiStrucnosti`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oblast_strucnosti`
--

INSERT INTO `oblast_strucnosti` (`idOblastiStrucnosti`, `oblastStrucnosti`) VALUES
(1, 'PHP'),
(2, 'Java');

-- --------------------------------------------------------

--
-- Table structure for table `ocene`
--

DROP TABLE IF EXISTS `ocene`;
CREATE TABLE IF NOT EXISTS `ocene` (
  `idOcena` int(11) NOT NULL AUTO_INCREMENT,
  `komentarOcene` varchar(45) CHARACTER SET utf8 NOT NULL,
  `ocenaProjekta` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `statusOcene` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `idPitanja` int(11) NOT NULL,
  `idPrijava` int(11) NOT NULL,
  PRIMARY KEY (`idOcena`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ocene`
--

INSERT INTO `ocene` (`idOcena`, `komentarOcene`, `ocenaProjekta`, `statusOcene`, `idPitanja`, `idPrijava`) VALUES
(1, 'Ispunjava uslove', '9', NULL, 20, 9);

-- --------------------------------------------------------

--
-- Table structure for table `pitanja_poziv`
--

DROP TABLE IF EXISTS `pitanja_poziv`;
CREATE TABLE IF NOT EXISTS `pitanja_poziv` (
  `idPitanja` int(11) NOT NULL AUTO_INCREMENT,
  `idPoziv` int(11) NOT NULL,
  `pitanje` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idPitanja`),
  KEY `idpoziv_idx` (`idPoziv`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pitanja_poziv`
--

INSERT INTO `pitanja_poziv` (`idPitanja`, `idPoziv`, `pitanje`) VALUES
(12, 1, 'HTML, CSS osnove'),
(13, 1, 'Proceduralni i OOP PHP'),
(17, 1, 'Mysqli osnove.'),
(19, 1, 'Obučenost Nastavnog kadra.'),
(20, 5, 'HTML, CSS osnove'),
(21, 5, 'OOP Java'),
(22, 5, 'Budžet');

-- --------------------------------------------------------

--
-- Table structure for table `poslata_obavestenja`
--

DROP TABLE IF EXISTS `poslata_obavestenja`;
CREATE TABLE IF NOT EXISTS `poslata_obavestenja` (
  `idPoslataObavestenja` int(11) NOT NULL AUTO_INCREMENT,
  `idObavestenje` int(11) NOT NULL,
  `idKorisnik` int(11) NOT NULL,
  `datum` datetime NOT NULL,
  PRIMARY KEY (`idPoslataObavestenja`),
  KEY `idObavestenja_idx` (`idObavestenje`),
  KEY `idOba_idx` (`idKorisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prijava_projekta`
--

DROP TABLE IF EXISTS `prijava_projekta`;
CREATE TABLE IF NOT EXISTS `prijava_projekta` (
  `idPrijava` int(11) NOT NULL AUTO_INCREMENT,
  `idProjekat` int(11) NOT NULL,
  `idKorisnik` int(11) NOT NULL,
  `datumPodnosenja` date NOT NULL,
  `stanjePrijave` varchar(45) CHARACTER SET utf8 NOT NULL,
  `datumDodele` date NOT NULL,
  `rokZaIzvestaj` date DEFAULT NULL,
  `prijavaProjektacol` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idPrijava`),
  KEY `idprojekta_idx` (`idProjekat`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `prijava_projekta`
--

INSERT INTO `prijava_projekta` (`idPrijava`, `idProjekat`, `idKorisnik`, `datumPodnosenja`, `stanjePrijave`, `datumDodele`, `rokZaIzvestaj`, `prijavaProjektacol`) VALUES
(1, 2, 27, '2019-08-01', 'dodeljen', '2019-08-01', '2019-08-30', 'da'),
(5, 2, 0, '2019-08-14', 'dodeljen', '0000-00-00', '2019-08-23', NULL),
(6, 2, 0, '2019-08-14', 'dodeljen', '0000-00-00', '2019-08-23', NULL),
(7, 2, 1, '2019-08-14', 'dodeljen', '0000-00-00', '2019-08-16', NULL),
(8, 7, 5, '2019-08-14', 'dodeljen', '0000-00-00', '2019-08-16', NULL),
(9, 7, 28, '2019-08-22', 'dodeljen', '0000-00-00', '0000-00-00', 'da');

-- --------------------------------------------------------

--
-- Table structure for table `programski_poziv`
--

DROP TABLE IF EXISTS `programski_poziv`;
CREATE TABLE IF NOT EXISTS `programski_poziv` (
  `idpoziv` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idpoziv`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `programski_poziv`
--

INSERT INTO `programski_poziv` (`idpoziv`, `naziv`) VALUES
(1, 'PHP UNDP'),
(5, 'UNDP Java'),
(7, 'Linux administracija'),
(10, 'Programski jezici');

-- --------------------------------------------------------

--
-- Table structure for table `projekti`
--

DROP TABLE IF EXISTS `projekti`;
CREATE TABLE IF NOT EXISTS `projekti` (
  `idProjekat` int(11) NOT NULL AUTO_INCREMENT,
  `nazivProjekta` varchar(45) CHARACTER SET utf8 NOT NULL,
  `rukovodiocProjekta` varchar(45) CHARACTER SET utf8 NOT NULL,
  `NIOrukovodioc` varchar(45) CHARACTER SET utf8 NOT NULL,
  `zvanjeRukovodioca` varchar(45) CHARACTER SET utf8 NOT NULL,
  `angazovanjeRukovodioca` varchar(45) CHARACTER SET utf8 NOT NULL,
  `oblastProjekta` varchar(45) CHARACTER SET utf8 NOT NULL,
  `datumPodnosenja` date NOT NULL,
  `odlukaProjekta` varchar(45) CHARACTER SET utf8 NOT NULL,
  `idPoziv` int(11) NOT NULL,
  PRIMARY KEY (`idProjekat`),
  KEY `idpoz_idx` (`idPoziv`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `projekti`
--

INSERT INTO `projekti` (`idProjekat`, `nazivProjekta`, `rukovodiocProjekta`, `NIOrukovodioc`, `zvanjeRukovodioca`, `angazovanjeRukovodioca`, `oblastProjekta`, `datumPodnosenja`, `odlukaProjekta`, `idPoziv`) VALUES
(2, 'PHP kurs', 'Boško Nikolić', 'Računarski centar ETF-a', 'prof.dr.', 'redovni profesor', 'PHP', '2019-07-22', 'prihvaćen', 1),
(7, 'Java kurs', 'Boško Nikolić', 'Računarski centar ETF-a', 'prof.dr.', 'redovni profesor', 'Java', '2019-08-14', 'prihvaćen', 5);

-- --------------------------------------------------------

--
-- Table structure for table `recenzenti`
--

DROP TABLE IF EXISTS `recenzenti`;
CREATE TABLE IF NOT EXISTS `recenzenti` (
  `idRecezent` int(11) NOT NULL AUTO_INCREMENT,
  `idKorisnik` int(11) NOT NULL,
  `ime` varchar(45) CHARACTER SET utf8 NOT NULL,
  `prezime` varchar(45) CHARACTER SET utf8 NOT NULL,
  `nacionalnost` varchar(45) CHARACTER SET utf8 NOT NULL,
  `zemlja` varchar(45) CHARACTER SET utf8 NOT NULL,
  `NIO` varchar(100) CHARACTER SET utf8 NOT NULL,
  `trenutnaFirma` varchar(100) CHARACTER SET utf8 NOT NULL,
  `naucnoZvanje` varchar(45) CHARACTER SET utf8 NOT NULL,
  `angazovanje` varchar(45) CHARACTER SET utf8 NOT NULL,
  `idOblastiStrucnosti` int(45) NOT NULL,
  `telefon` varchar(45) CHARACTER SET utf8 NOT NULL,
  `adresa` varchar(100) CHARACTER SET utf8 NOT NULL,
  `vebStranica` varchar(45) CHARACTER SET utf8 NOT NULL,
  `statusPrijave` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'stigla',
  PRIMARY KEY (`idRecezent`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `recenzenti`
--

INSERT INTO `recenzenti` (`idRecezent`, `idKorisnik`, `ime`, `prezime`, `nacionalnost`, `zemlja`, `NIO`, `trenutnaFirma`, `naucnoZvanje`, `angazovanje`, `idOblastiStrucnosti`, `telefon`, `adresa`, `vebStranica`, `statusPrijave`) VALUES
(1, 1, 'Mica', 'Micic', 'srbin', 'Srbija', 'aaa', 'bbb', 'ccc', 'ddd', 2, '123456', 'fff123', 'iii', 'registrovan'),
(2, 2, 'Pera', 'Peric', 'srbija', 'srbin', 'aaaaa', 'bbbbb', 'ccccc', 'ddddd', 2, '123456', 'fffff', 'wwwww', 'registrovan'),
(3, 5, 'Pera', 'Peric', 'srbija', 'srbin', 'aaaaa', 'bbbbb', 'ccccc', 'ddddd', 1, '01234567', 'fffff', 'wwwww', 'registrovan'),
(10, 12, 'mica', 'micic', 'srbija', 'srbin', 'aaaaa', 'bbbbb', 'ccccc', 'ddddd', 2, '01234567', 'fffff', 'wwwww', 'registrovan'),
(16, 24, 'Igor', 'Peric', 'srbija', 'srbin', 'aaaaa', 'bbbbb', 'ccccc', 'ddddd', 2, '087654321', 'fffff', 'wwwww', 'stigla'),
(17, 25, 'Veljko', 'Veljkovic', 'Srbija', 'Srbin', 'UNDP PHP', 'Eurobank', 'dip..ecc', 'analiticar', 1, '0691567555', 'Brace Jerkovic', 'www.proba.com', 'registrovan'),
(18, 26, 'Petar', 'Petar', 'Srbin', 'Srbin', 'Srbin', 'Srbin', 'Srbin', 'Srbin', 2, '011222333', 'fsadsfdsad', 'www.proba.com', 'stigla'),
(19, 27, 'Veljko', 'Veljašin', 'gregrrgr', 'grgrerg', 'gregreg', 'gregreg', 'gregrge', 'grergr', 2, '012111222', 'gergrgr', 'gfdfgfdg', 'registrovan'),
(25, 28, 'Petar', 'Petar', 'Petar', 'Petar', 'Petar', 'Petar', 'Petar', 'Petar', 2, '011222333', 'Petar', 'www.petar.com', 'registrovan'),
(26, 29, 'Petra', 'Petrovic', 'petraa', 'petraa', 'petraa', 'petraa', 'petraa', 'petraa', 0, '011224455', 'petraa@gmail.com', 'petraa@gmail.com', 'registrovan'),
(27, 30, 'Proba', 'Proba', 'Proba', 'Proba', 'Proba', 'Proba', 'Proba', 'Proba', 1, '011224455', 'Brace Jerkovic', 'Proba', 'stigla');

-- --------------------------------------------------------

--
-- Table structure for table `reset`
--

DROP TABLE IF EXISTS `reset`;
CREATE TABLE IF NOT EXISTS `reset` (
  `idReset` int(11) NOT NULL AUTO_INCREMENT,
  `idKorisnik` int(11) NOT NULL,
  `lozinka` varchar(255) CHARACTER SET utf8 NOT NULL,
  `datum` datetime NOT NULL,
  PRIMARY KEY (`idReset`),
  KEY `idKor_idx` (`idKorisnik`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reset`
--

INSERT INTO `reset` (`idReset`, `idKorisnik`, `lozinka`, `datum`) VALUES
(1, 2, '$2y$10$qYykp90Z5X4suBZGIxyeQuicOxW/TisrM3ysI/', '2019-07-20 21:00:43'),
(2, 2, '$2y$10$8EEjPl0w9woZGU1PgBepx.rbVLnX.nBIKNzj9IV.hWHmMzubrzhFm', '2019-07-20 21:12:56'),
(3, 2, '$2y$10$HDrd11y0/CIrfpwkOFf4IeB9FH0oR.Qch5C5AYGjM7QKTU801rflC', '2019-07-20 21:15:11'),
(4, 2, '$2y$10$ybhKbTaJ/VZ.rqeSXTwh3OxihU5hwu7R7vR4XFke6I3FTXLh3MIzq', '2019-07-22 16:04:45'),
(5, 2, '$2y$10$lEq3V.kSrWrSc2m8NdT6SuodLNByp2PyPOCzzjSeEMTkBI5StFKU6', '2019-07-22 17:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `status_ankete`
--

DROP TABLE IF EXISTS `status_ankete`;
CREATE TABLE IF NOT EXISTS `status_ankete` (
  `idStatusAnkete` int(11) NOT NULL AUTO_INCREMENT,
  `idKorisnik` int(11) NOT NULL,
  `idAnketa` int(11) NOT NULL,
  `statusAnkete` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idStatusAnkete`),
  KEY `idAnketa_idx` (`idAnketa`),
  KEY `idKori_idx` (`idKorisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pitanja_poziv`
--
ALTER TABLE `pitanja_poziv`
  ADD CONSTRAINT `idpoziv` FOREIGN KEY (`idPoziv`) REFERENCES `programski_poziv` (`idpoziv`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `poslata_obavestenja`
--
ALTER TABLE `poslata_obavestenja`
  ADD CONSTRAINT `idOba` FOREIGN KEY (`idKorisnik`) REFERENCES `korisnici` (`idKorisnik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idObavestenja` FOREIGN KEY (`idObavestenje`) REFERENCES `obavestenja` (`idObavestenja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prijava_projekta`
--
ALTER TABLE `prijava_projekta`
  ADD CONSTRAINT `idprojekt` FOREIGN KEY (`idProjekat`) REFERENCES `projekti` (`idProjekat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projekti`
--
ALTER TABLE `projekti`
  ADD CONSTRAINT `idpoz` FOREIGN KEY (`idPoziv`) REFERENCES `programski_poziv` (`idpoziv`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reset`
--
ALTER TABLE `reset`
  ADD CONSTRAINT `idReset_Kor` FOREIGN KEY (`idKorisnik`) REFERENCES `korisnici` (`idKorisnik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `status_ankete`
--
ALTER TABLE `status_ankete`
  ADD CONSTRAINT `idAnketa` FOREIGN KEY (`idAnketa`) REFERENCES `anketa` (`idAnketa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idKori` FOREIGN KEY (`idKorisnik`) REFERENCES `korisnici` (`idKorisnik`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
