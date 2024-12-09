-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 31. Juli 2011 um 06:49
-- Server Version: 5.5.8
-- PHP-Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `tunisomat`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `9b1r88bu3qko6n82fdej8ssrh3`
--

CREATE TABLE IF NOT EXISTS `9b1r88bu3qko6n82fdej8ssrh3` (
  `ID` int(2) DEFAULT NULL,
  `answer` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `9b1r88bu3qko6n82fdej8ssrh3`
--

INSERT INTO `9b1r88bu3qko6n82fdej8ssrh3` (`ID`, `answer`) VALUES
(1, 2),
(2, 3),
(3, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `9lvsbqdjdequ4benqsg3ou5kl6`
--

CREATE TABLE IF NOT EXISTS `9lvsbqdjdequ4benqsg3ou5kl6` (
  `ID` int(2) DEFAULT NULL,
  `answer` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `9lvsbqdjdequ4benqsg3ou5kl6`
--

INSERT INTO `9lvsbqdjdequ4benqsg3ou5kl6` (`ID`, `answer`) VALUES
(1, 2),
(2, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kojvse491755gv2b80ni0nikr3`
--

CREATE TABLE IF NOT EXISTS `kojvse491755gv2b80ni0nikr3` (
  `ID` int(2) DEFAULT NULL,
  `answer` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `kojvse491755gv2b80ni0nikr3`
--

INSERT INTO `kojvse491755gv2b80ni0nikr3` (`ID`, `answer`) VALUES
(1, 3),
(2, 2),
(3, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mse50ab4o3v9vmautrf1hhte97`
--

CREATE TABLE IF NOT EXISTS `mse50ab4o3v9vmautrf1hhte97` (
  `ID` int(2) DEFAULT NULL,
  `answer` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `mse50ab4o3v9vmautrf1hhte97`
--

INSERT INTO `mse50ab4o3v9vmautrf1hhte97` (`ID`, `answer`) VALUES
(1, 2),
(2, 3),
(3, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `parties`
--

CREATE TABLE IF NOT EXISTS `parties` (
  `name` varchar(50) NOT NULL,
  `web` varchar(255) NOT NULL,
  `1` int(1) NOT NULL,
  `2` int(1) NOT NULL,
  `3` int(1) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `parties`
--

INSERT INTO `parties` (`name`, `web`, `1`, `2`, `3`, `ID`) VALUES
('Die Piraten', 'http://www.piraten.de', 1, 2, 3, 1),
('CDU', 'www.cdu.de', 2, 4, 1, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `qjd6uurihedhoskg4mh578pjs2`
--

CREATE TABLE IF NOT EXISTS `qjd6uurihedhoskg4mh578pjs2` (
  `ID` int(2) DEFAULT NULL,
  `answer` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `qjd6uurihedhoskg4mh578pjs2`
--

INSERT INTO `qjd6uurihedhoskg4mh578pjs2` (`ID`, `answer`) VALUES
(1, 2),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ID` int(11) NOT NULL,
  `question` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `questions`
--

INSERT INTO `questions` (`title`, `ID`, `question`) VALUES
('Demokratie', 1, 'Wie findest du Demokratie ?'),
('Tunis', 2, 'Würdest du in Tunis leben wollen ?'),
('حملة ضد كراهية', 3, 'وقالت مراسلة الجزيرة في بنغازي ديمة الخطيب إن ملابسات مقتل يونس ما زالت غامضة ولا تعرف بالضبط الجهة التي تقف وراء عملية الاغتيال, في حين ذكرت وكالة رويترز أنه لم يتضح بعد المكان الذي قتل فيه يونس وحراسه أو الكيفية التي عرف بها رئيس المجلس الانتقالي نبأ مصرعهم.\r\n');
