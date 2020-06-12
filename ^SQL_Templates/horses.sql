-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 10 jun 2020 om 08:32
-- Serverversie: 8.0.18
-- PHP-versie: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manege`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `horses`
--

CREATE TABLE `horses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `race` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `age` int(11) NOT NULL,
  `height` int(50) NOT NULL,
  `canSport` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `horses`
--

INSERT INTO `horses` (`id`, `name`, `race`, `age`, `height`, `canSport`) VALUES
(3, 'paard 1', 'Paard', 17, 122, 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `horses`
--
ALTER TABLE `horses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `horses`
--
ALTER TABLE `horses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
