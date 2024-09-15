-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 15 Eyl 2024, 02:22:10
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `oylama`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kayıt`
--

CREATE TABLE `kayıt` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kayıt`
--

INSERT INTO `kayıt` (`user_id`, `name`, `surname`, `username`, `number`, `password`) VALUES
(1, 'deneme', 'deneme1', 'alpay', '12345678910', '$2y$10$lsp3xPsV/ZaEpJ.lFgltSu1W8VQRcJka1349cfpeb.vjl5z6GRV5a'),
(2, 'deneme', 'deneme1', 'alpay', '12345678910', '$2y$10$QCoabXzCup8exxBNtBdIzekwQffhcRMdrC9QkxXdRREch.9SdjMOK'),
(3, 'tarık emir', 'yağlı', 'taricemir0', '12345678911', '$2y$10$r0zIWKeXDVpbDD/dM4q5SeA4.Ku3RShjMadThCAC4GtTJUx.BPQFi'),
(4, 'tarık emir', 'yağlı', 'taricemir0', '12345678913', '$2y$10$nRqzngbE.khMd7DdmzelqOHrKc/lRozZlvTOzZxy6jYd8DHMPj8ey');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kayıt`
--
ALTER TABLE `kayıt`
  ADD PRIMARY KEY (`user_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kayıt`
--
ALTER TABLE `kayıt`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
