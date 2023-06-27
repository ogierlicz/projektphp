-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Cze 2023, 01:48
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
(7, 1, 'Programowanie', 2, '2023-06-22', 15),
(8, 1, 'Elektronika', 5, '2023-06-22', 15),
(9, 1, 'najlepszy przedmiot', 7, '2023-06-22', 15),
(10, 1, 'Uczenie maszynowe', 3, '2023-06-22', 16);

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
(1, 'a@example.com', 'Adam', 'B', '2023-06-21', '$argon2id$v=19$m=65536,t=4,p=1$cWxvODdyOXNVRXY5WDczOQ$BG9gPSUBc5Owf5MOmXgCZl4+bk0JgzvZaDg+Xvyungw', 'student'),
(14, 'j@pl.pl', 'Jan', 'Kowalski', '2023-06-21', '$argon2id$v=19$m=65536,t=4,p=1$RElqR3poWUtYM28vNWJqeQ$2sMvHPPHx3/hSrcPzYxj/2tCq5DqWwyFoWiy573kDxQ', 'student'),
(15, 'ogierlicz@edu.cdv.pl', 'Oskar', 'Gierlicz', '2023-06-21', '$argon2id$v=19$m=65536,t=4,p=1$QUpyTjBjZU9UR3dlbzVDUw$1e8ifU/cTK6u2vNA4OWVCNRSiEdGmlfUAWm4ZQ8TYm4', 'teacher'),
(16, 'k@gmail.pl', 'kamil', 'amrah', '2023-06-22', '$argon2id$v=19$m=65536,t=4,p=1$aVgzNkRCRE5kVGdlRnVmMg$ir6ReneULP1YzEBD0MbhabT67Zn8ruOy5glo0UEosIw', 'teacher');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
