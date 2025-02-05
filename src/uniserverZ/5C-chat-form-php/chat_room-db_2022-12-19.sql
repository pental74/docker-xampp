-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Dic 19, 2022 alle 10:06
-- Versione del server: 8.0.18
-- Versione PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat_room`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggi`
--

CREATE TABLE `messaggi` (
  `data` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `stanza` int(11) NOT NULL,
  `utente` varchar(10) NOT NULL,
  `messaggio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `messaggi`
--

INSERT INTO `messaggi` (`data`, `stanza`, `utente`, `messaggio`) VALUES
('2022-12-11 23:00:00', 73, 'marco', 'Primo messaggio di prova.'),
('2022-12-15 23:00:00', 24, 'Pippp', 'Secondo messaggio di prova'),
('2022-12-17 05:03:09', 73, 'marco', 'Prova inserimento automatico della data'),
('2022-12-17 05:26:05', 73, 'marco', 'Prova da phpmyadmin perché non funziona da form'),
('2022-12-17 05:27:39', 73, 'marco', 'Prova da phpmyadmin perché non funziona da form'),
('2022-12-17 05:29:02', 73, 'marco', 'Prova da phpmyadmin perché non funziona da form'),
('2022-12-17 05:30:01', 73, 'Marco', 'Ora dovrebbe funzionare'),
('2022-12-17 06:17:18', 73, 'Marco', 'Prova con include'),
('2022-12-17 09:10:02', 55, 'Marco', 'Da scuola'),
('2022-12-19 00:42:28', 73, 'Marco', 'Prova con tabella'),
('2022-12-19 02:47:51', 73, 'Marco', 'Questo è un messaggio di prova'),
('2022-12-19 03:05:36', 73, 'Marco', 'Questo è un messaggio di prova');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
