-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Cze 2023, 07:27
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projekt_db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oceny`
--

CREATE TABLE `oceny` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `przedmiot` varchar(60) DEFAULT NULL,
  `ocena` int(2) DEFAULT NULL,
  `data_oceny` date DEFAULT curdate(),
  `nauczyciel_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Zrzut danych tabeli `oceny`
--

INSERT INTO `oceny` (`id`, `user_id`, `przedmiot`, `ocena`, `data_oceny`, `nauczyciel_id`) VALUES
(11, 1, 'Matematyka', 5, '2023-06-28', 17),
(12, 1, 'Programowanie', 4, '2023-06-28', 17),
(13, 1, 'Technologie Internetowe', 5, '2023-06-28', 15);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(60) NOT NULL,
  `firstName` varchar(60) NOT NULL,
  `lastName` varchar(60) NOT NULL,
  `birthday` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `firstName`, `lastName`, `birthday`, `password`, `role`) VALUES
(1, 'a@example.com', 'Adam', 'Burdelski', '2023-06-21', '$argon2id$v=19$m=65536,t=4,p=1$NmxMUzM2Z211VEcwSnQyNQ$dBNlKKsTSlDWeC1W0SXHWIWMyCeDjqlO/bnUW0ANvhA', 'student'),
(15, 'ogierlicz@edu.cdv.pl', 'Oskar', 'Gierlicz', '2023-06-21', '$argon2id$v=19$m=65536,t=4,p=1$aFpxOW5XR0svZ1NGR1JyYw$d2Zk+Xzuk6sONPcMKLpCPpdvtpwBafuLBV61u0dPhGw', 'teacher'),
(17, 'pnowak@example.com', 'Piotr', 'Nowak', '2023-06-06', '$argon2id$v=19$m=65536,t=4,p=1$TXp6b3pBTkVJV3pVREg5dg$9uAOFp0sc6VGT23BtwUNvVmneGt0XpmolJeRGo7E9uo', 'admin');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `oceny`
--
ALTER TABLE `oceny`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `oceny`
--
ALTER TABLE `oceny`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `oceny`
--
ALTER TABLE `oceny`
  ADD CONSTRAINT `oceny_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
