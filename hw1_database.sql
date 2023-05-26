-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 26, 2023 alle 22:51
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hw1_database`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `carrelli`
--

CREATE TABLE `carrelli` (
  `utente` varchar(64) NOT NULL,
  `nome_prodotto` varchar(256) NOT NULL,
  `taglia` char(1) NOT NULL,
  `n_pezzi` int(11) DEFAULT NULL,
  `prezzo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini`
--

CREATE TABLE `ordini` (
  `id` int(11) NOT NULL,
  `utente` varchar(64) DEFAULT NULL,
  `indirizzo` varchar(128) DEFAULT NULL,
  `data_ordine` datetime DEFAULT NULL,
  `importo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini_prodotti`
--

CREATE TABLE `ordini_prodotti` (
  `ordine` int(11) NOT NULL,
  `nome_prodotto` varchar(256) NOT NULL,
  `taglia` char(1) NOT NULL,
  `n_pezzi` int(11) DEFAULT NULL,
  `prezzo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti`
--

CREATE TABLE `prodotti` (
  `nome` varchar(256) NOT NULL,
  `descrizione` varchar(1024) DEFAULT NULL,
  `prezzo` float DEFAULT NULL,
  `image_src` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `prodotti`
--

INSERT INTO `prodotti` (`nome`, `descrizione`, `prezzo`, `image_src`) VALUES
('Charles Leclerc - Cavallo di Denari (2) - Carte da gioco siciliane - Unisex T-Shirt', 'Un mix di tradizioni e passione. Carte da gioco siciliane e Formula 1. Charles Leclerc in sella al suo cavallo di denari rampante alza al cielo il trofeo del Gran Premio d\'Australia (2022) che sostituisce la classica moneta d\'oro.', 29.99, 'thumbnails/Cavallo di Denari - Leclerc (TROFEO AUS).jpg'),
('Charles Leclerc - Cavallo di Denari - Carte da gioco siciliane - Unisex T-Shirt', 'Un mix di tradizioni e passione. Carte da gioco siciliane e Formula 1. Charles Leclerc in sella al suo cavallo di denari rampante.', 29.99, 'thumbnails/Cavallo di Denari - Leclerc (MONETA).jpg'),
('Charles Leclerc - Re di Coppe - Carte da gioco siciliane - Unisex T-Shirt', 'Un mix di tradizioni e passione. Carte da gioco siciliane e Formula 1. Charles Leclerc in veste del re di coppe delle carte da gioco regionali siciliane.', 29.99, 'thumbnails/Re di Coppe - Leclerc.jpg'),
('Charles Leclerc -Belgian GP 2019 - POP ART style - Unisex T-Shirt', '8 giugno 2019: Sebastian Vettel a bordo della sua SF-90 ottiene la Pole Position del Gran Premio del Canada. Sceso dalla macchina alza il suo classico indice davanti alla telecamera. Il giorno dopo sarà una penalità molto discussa a togliergli la vittoria.\r\n\r\nStile ispirato ai più famosi pezzi d\'arte POP di Andy Warhol', 29.99, 'thumbnails/Charles SPA POP.jpg'),
('F1 Tire - Asso di Denari - Carte da gioco siciliane - Unisex T-Shirt', 'Un mix di tradizioni e passione. Carte da gioco siciliane e Formula 1. L\'asso di denari reinterpretato, sostituendo la grande moneta d\'oro con la gomma hard di F1 con copricerchio AlphaTauri', 29.99, 'thumbnails/Asso di denari.jpg'),
('F1 Tires - Cinque di Denari - Carte da gioco siciliane - Unisex T-Shirt', 'Un mix di tradizioni e passione. Carte da gioco siciliane e Formula 1. Il cinque di denari reinventato utilizzando gli pneumatici utilizzati in Formula 1 con copricerchi appartenenti a monoposto differenti (2023):\r\n\r\nIntermediate: Aston Martin\r\nMedium: Ferrari\r\nHard: AlphaTauri\r\nSoft: Alfa Romeo\r\nWet: McLaren', 29.99, 'thumbnails/5 di denari.jpg'),
('San Charles - Unisex T-Shirt', 'In Italia, Ferrari non è un semplice cognome o una semplice casa automobilistica: è un concetto che va ben oltre. Si tratta di una religione, un culto...\r\nIl santo protettore dei tifosi Ferrari: San Charles. Ispirato alla immaginette della tradizione cristiana', 29.99, 'thumbnails/San Charles.jpg'),
('Sebastian Vettel - Canadian GP 2019 - POP ART Style - Unisex T-Shirt', '8 giugno 2019: Sebastian Vettel a bordo della sua SF-90 ottiene la Pole Position del Gran Premio del Canada. Sceso dalla macchina alza il suo classico indice davanti alla telecamera. Il giorno dopo sarà una penalità molto discussa a togliergli la vittoria.\r\n\r\nStile ispirato ai più famosi pezzi d\'arte POP di Andy Warhol', 29.99, 'thumbnails/SEB1 Canada POP.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti_con_taglia`
--

CREATE TABLE `prodotti_con_taglia` (
  `nome` varchar(256) NOT NULL,
  `taglia` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `prodotti_con_taglia`
--

INSERT INTO `prodotti_con_taglia` (`nome`, `taglia`) VALUES
('Charles Leclerc - Cavallo di Denari (2) - Carte da gioco siciliane - Unisex T-Shirt', 'l'),
('Charles Leclerc - Cavallo di Denari (2) - Carte da gioco siciliane - Unisex T-Shirt', 'm'),
('Charles Leclerc - Cavallo di Denari (2) - Carte da gioco siciliane - Unisex T-Shirt', 's'),
('Charles Leclerc - Cavallo di Denari - Carte da gioco siciliane - Unisex T-Shirt', 'l'),
('Charles Leclerc - Cavallo di Denari - Carte da gioco siciliane - Unisex T-Shirt', 'm'),
('Charles Leclerc - Cavallo di Denari - Carte da gioco siciliane - Unisex T-Shirt', 's'),
('Charles Leclerc - Re di Coppe - Carte da gioco siciliane - Unisex T-Shirt', 'l'),
('Charles Leclerc - Re di Coppe - Carte da gioco siciliane - Unisex T-Shirt', 'm'),
('Charles Leclerc - Re di Coppe - Carte da gioco siciliane - Unisex T-Shirt', 's'),
('Charles Leclerc -Belgian GP 2019 - POP ART style - Unisex T-Shirt', 'l'),
('Charles Leclerc -Belgian GP 2019 - POP ART style - Unisex T-Shirt', 'm'),
('Charles Leclerc -Belgian GP 2019 - POP ART style - Unisex T-Shirt', 's'),
('F1 Tire - Asso di Denari - Carte da gioco siciliane - Unisex T-Shirt', 'l'),
('F1 Tire - Asso di Denari - Carte da gioco siciliane - Unisex T-Shirt', 'm'),
('F1 Tire - Asso di Denari - Carte da gioco siciliane - Unisex T-Shirt', 's'),
('F1 Tires - Cinque di Denari - Carte da gioco siciliane - Unisex T-Shirt', 'l'),
('F1 Tires - Cinque di Denari - Carte da gioco siciliane - Unisex T-Shirt', 'm'),
('F1 Tires - Cinque di Denari - Carte da gioco siciliane - Unisex T-Shirt', 's'),
('San Charles - Unisex T-Shirt', 'l'),
('San Charles - Unisex T-Shirt', 'm'),
('San Charles - Unisex T-Shirt', 's'),
('Sebastian Vettel - Canadian GP 2019 - POP ART Style - Unisex T-Shirt', 'l'),
('Sebastian Vettel - Canadian GP 2019 - POP ART Style - Unisex T-Shirt', 'm'),
('Sebastian Vettel - Canadian GP 2019 - POP ART Style - Unisex T-Shirt', 's');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `email` varchar(64) NOT NULL,
  `nome` varchar(64) DEFAULT NULL,
  `cognome` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `carrelli`
--
ALTER TABLE `carrelli`
  ADD PRIMARY KEY (`utente`,`nome_prodotto`,`taglia`),
  ADD KEY `nome_prodotto` (`nome_prodotto`,`taglia`);

--
-- Indici per le tabelle `ordini`
--
ALTER TABLE `ordini`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ordini_prodotti`
--
ALTER TABLE `ordini_prodotti`
  ADD PRIMARY KEY (`ordine`,`nome_prodotto`,`taglia`),
  ADD KEY `nome_prodotto` (`nome_prodotto`,`taglia`);

--
-- Indici per le tabelle `prodotti`
--
ALTER TABLE `prodotti`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `prodotti_con_taglia`
--
ALTER TABLE `prodotti_con_taglia`
  ADD PRIMARY KEY (`nome`,`taglia`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `ordini`
--
ALTER TABLE `ordini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `carrelli`
--
ALTER TABLE `carrelli`
  ADD CONSTRAINT `carrelli_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utenti` (`email`),
  ADD CONSTRAINT `carrelli_ibfk_2` FOREIGN KEY (`nome_prodotto`) REFERENCES `prodotti_con_taglia` (`nome`),
  ADD CONSTRAINT `carrelli_ibfk_3` FOREIGN KEY (`nome_prodotto`,`taglia`) REFERENCES `prodotti_con_taglia` (`nome`, `taglia`);

--
-- Limiti per la tabella `ordini_prodotti`
--
ALTER TABLE `ordini_prodotti`
  ADD CONSTRAINT `ordini_prodotti_ibfk_1` FOREIGN KEY (`nome_prodotto`,`taglia`) REFERENCES `prodotti_con_taglia` (`nome`, `taglia`),
  ADD CONSTRAINT `ordini_prodotti_ibfk_2` FOREIGN KEY (`ordine`) REFERENCES `ordini` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `prodotti_con_taglia`
--
ALTER TABLE `prodotti_con_taglia`
  ADD CONSTRAINT `prodotti_con_taglia_ibfk_1` FOREIGN KEY (`nome`) REFERENCES `prodotti` (`nome`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
