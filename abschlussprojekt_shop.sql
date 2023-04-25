-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 18. Apr 2023 um 09:43
-- Server-Version: 10.4.27-MariaDB
-- PHP-Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `abschlussprojekt_shop`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `roughcategory` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`id`, `name`, `picture`, `description`, `roughcategory`, `category`, `price`) VALUES
(1, 'teststift', 'stift.jpg', '12345', 'Schreibbedarf', 'Stift', 1.88),
(2, 'lineal', 'lineal.jpg', 'ein lineal', 'Schreibbedarf', 'Lineal', 4.67),
(3, 'Radiergummi', 'radiergummi.jpg', 'Ein gutes Radiergummi', 'Schreibbedarf', 'Radiergummi', 3.07),
(4, 'Herlitz Buntstifte 12 Stk', 'herlitz_buntstifte.jpg', '12 bunte Buntstifte', 'Schreibbedarf', 'Stift', 1.22),
(5, 'M+R Spitzer', 'm-r_spitzer.jpg', 'Ein räudiger Spitzer', 'Schreibbedarf', 'Spitzer', 0.69),
(6, 'Faber Castell Spitzer', 'faber-castell_spitzer.jpg', 'Davon werden nicht nur die Stifte spitz', 'Schreibbedarf', 'Spitzer', 2.95),
(7, 'Betzold Buntstifte 144 Stk', 'betzold_buntstifte.jpg', 'Mehr Farben als die LGBTQ Flagge aufweisen kann', 'Schreibbedarf', 'Stift', 59.95),
(8, 'Faber Castell Radiergummi', 'faber-castell_radiergummi.jpg', 'Radiert garnicht', 'Schreibbedarf', 'Radiergummi', 1.75),
(9, 'Stabilo Fineliner schwarz 0,4mm', 'stabilo_fineliner-black.jpg', 'so dick wie mein schwanz', 'Schreibbedarf', 'Stift', 0.65),
(10, 'Faber Castell Dosenspitzer', 'faber-castell_dosenspitzer.jpg', 'Brech bitte nicht ab', 'Schreibbedarf', 'Spitzer', 3.32),
(11, 'Brunnen Collegeblock kariert DIN A4', 'brunnen_collegeblock-kariert-dina4.jpg', '80 Blätter um kein Mathe zu machen', 'Papier', 'Collegeblock', 2.73),
(12, 'Oxford Collegeblock kariert DIN A4', 'oxford_collegeblock-kariert-dina4.jpg', 'Teuer, cool und einfach cleane Blätter', 'Papier', 'Collegeblock', 3.32),
(13, 'Oxford Collegeblock liniert DIN A4', 'oxford_collegeblock-liniert-dina4.jpg', 'Oxford', 'Papier', 'Collegeblock', 3.32),
(14, 'Landre Collegeblock liniert DIN A4', 'landre_collegeblock-liniert-dina4.jpg', 'Cooler Spruch ^-^', 'Papier', 'Collegeblock', 2.01),
(15, 'Bantext Notizbuch kariert DIN A5', 'bantex_notizbuch-kariert-dina5.jpg', 'Kleines feines Notizbuch um Notizen zu notieren', 'Papier', 'Notizbuch', 3.32),
(16, 'Brunnen Notizbuch kariert DIN A5', 'brunnen_notizbuch-kariert-dina5.jpg', 'Teurer als Oxford', 'Papier', 'Notizbuch', 4.94),
(17, 'Avery Notizbuch kariert DIN A4', 'avery_notizbuch-kariert-dina4.jpg', 'Für nur 22€ leuchtet sogar das Lesezeichen!!!SCHNAPPER!!!', 'Papier', 'Notizbuch', 22.36),
(18, 'Stabilo Textmarker gelb', 'stabilo_textmarker-gelb.jpg', 'Kommt aus China', 'Schreibbedarf', 'Stift', 0.89),
(19, 'BIC Kugelschreiber blau', 'bic_kugelschreiber-blau.jpg', 'Diesmal kein Feuerzeug', 'Schreibbedarf', 'Stift', 0.35),
(20, 'Faber Castell Kugelschreiber blau', 'faber-castell_kugelschreiber-blau.jpg', '', 'Schreibbedarf', 'Stift', 4.58),
(21, 'BIC Kugelschreiber blau', 'bic_kugelschreiber-blau02.jpg', 'Kauf nicht die sind scheiße', 'Schreibbedarf', 'Stift', 0.23),
(22, 'Edding 500 Permanentmarker schwarz', 'edding_500-schwarz.jpg', 'Wie der Edding eines Mannes...', 'Schreibbedarf', 'Stift', 3.27);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `stars` int(1) NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `ratings`
--

INSERT INTO `ratings` (`id`, `userid`, `productid`, `stars`, `text`) VALUES
(1, 2, 2, 2, ''),
(2, 1, 2, 5, ''),
(3, 5, 2, 3, ''),
(4, 4, 3, 3, ''),
(5, 2, 3, 1, ''),
(6, 1, 5, 5, ''),
(7, 5, 4, 4, ''),
(8, 4, 7, 5, ''),
(9, 1, 1, 1, ''),
(10, 1, 4, 3, ''),
(11, 1, 4, 3, '123'),
(12, 1, 4, 3, '123'),
(13, 2, 4, 3, ''),
(14, 2, 4, 3, ''),
(15, 1, 3, 3, 'tolles produkt!'),
(16, 5, 7, 4, 'ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd'),
(17, 1, 7, 4, 'penisstifte');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `shoppingcart`
--

INSERT INTO `shoppingcart` (`id`, `userid`, `productid`, `amount`) VALUES
(6, 1, 7, 4),
(7, 1, 5, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `zipcode`, `city`, `street`, `country`, `firstname`, `lastname`) VALUES
(1, 'baba', 'baba@gmail.com', '$2y$10$nA2/9HNUhvD2mz4abvB6teg0THWY.s49tLiu.w7Hhm50YmGbNISlC', '56414', 'meudt', 'schulstr 6', 'deutschland', 'gabriel', 'behnert'),
(2, 'test', 'test@gmx.de', '$2y$10$nA2/9HNUhvD2mz4abvB6teg0THWY.s49tLiu.w7Hhm50YmGbNISlC', '', '', '', '', '', ''),
(3, 'testuser', '123123@12', '$2y$10$nA2/9HNUhvD2mz4abvB6teg0THWY.s49tLiu.w7Hhm50YmGbNISlC', '', '', '', '', '', ''),
(4, 'testbenutzer', 'gabrielbehnert3@gmail.com', '$2y$10$HsfpKJc69EcqB8vWTI2E0euShh/P4aamKaGCXk9eKpeaOIqabfh9C', '', '', '', '', '', ''),
(5, '123', '12312123123@12', '$2y$10$9kn6vKIRuTzm5GItXNabA.vlGmVPksSh1yr1fCgOzn6.itya4JZe6', '', '', '', '', '', '');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT für Tabelle `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT für Tabelle `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
