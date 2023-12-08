-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 08 Ara 2023, 11:23:33
-- Sunucu sürümü: 10.4.27-MariaDB
-- PHP Sürümü: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `danskayit`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bilgiler`
--

CREATE TABLE `bilgiler` (
  `id` int(4) NOT NULL,
  `name` varchar(32) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `number` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `ldate` date NOT NULL,
  `tc` varchar(11) NOT NULL,
  `tür` varchar(24) NOT NULL,
  `sınıf` varchar(32) NOT NULL,
  `cinsiyet` varchar(12) NOT NULL,
  `fiyat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `bilgiler`
--

INSERT INTO `bilgiler` (`id`, `name`, `surname`, `email`, `number`, `date`, `ldate`, `tc`, `tür`, `sınıf`, `cinsiyet`, `fiyat`) VALUES
(10003, 'Asdasd', 'ASDASDS', 'asdasd', '5123123123', '2023-07-06', '2023-09-28', 'asdasdsa', 'Salsa', 'DENEME', 'erkek', 1200),
(10004, 'Kerem ', 'UYSAL', 'uysal@gmail.com', '5763274632', '2023-10-21', '2023-11-18', '39821738128', 'Salsa', 'DENEME', 'erkek', 700),
(10005, 'Mehmet', 'ERDİNÇ', 'erdinç@gmail.com', '5523123213', '2023-12-08', '2024-01-05', '12192837129', 'SALSA', 'SALSA BASIC', 'erkek', 1000),
(10006, 'Kemal', 'BAYIN', 'bayın@gmail.com', '5520320323', '2023-12-08', '2024-02-02', '81273812831', 'SALSA', 'SALSA BASIC', 'erkek', 1500),
(10007, 'Erçin', 'GÜL', 'gül@gmail.com', '5523239230', '2023-12-02', '2024-01-27', '98729838123', 'SALSA', 'SALSA BASIC', 'kadın', 2000);

--
-- Tetikleyiciler `bilgiler`
--
DELIMITER $$
CREATE TRIGGER `CopingBilgiler` BEFORE INSERT ON `bilgiler` FOR EACH ROW INSERT INTO bilgilercopy VALUES (NEW.id, NEW.name, NEW.surname, NEW.email, NEW.number, NEW.date, NEW.ldate, NEW.tc, NEW.tür, NEW.sınıf, NEW.cinsiyet, NEW.fiyat)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `bilgilercopy_kopyalama` BEFORE UPDATE ON `bilgiler` FOR EACH ROW BEGIN
    UPDATE bilgilercopy SET 
    name = NEW.name,
    surname = NEW.surname,
    email = NEW.email,
    number = NEW.number,
    date = NEW.date,
    ldate = NEW.ldate,
    tc = NEW.tc,
    tür = NEW.tür,
    sınıf = NEW.sınıf,
    cinsiyet = NEW.cinsiyet
    WHERE id = NEW.id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `paraInfo_günelleme` BEFORE UPDATE ON `bilgiler` FOR EACH ROW BEGIN
    UPDATE para SET 
    kime = New.sınıf
    WHERE user_id = NEW.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bilgilercopy`
--

CREATE TABLE `bilgilercopy` (
  `id` int(4) NOT NULL,
  `name` varchar(32) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `number` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `ldate` date NOT NULL,
  `tc` varchar(11) NOT NULL,
  `tür` varchar(24) NOT NULL,
  `sınıf` varchar(32) NOT NULL,
  `cinsiyet` varchar(12) NOT NULL,
  `fiyat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `bilgilercopy`
--

INSERT INTO `bilgilercopy` (`id`, `name`, `surname`, `email`, `number`, `date`, `ldate`, `tc`, `tür`, `sınıf`, `cinsiyet`, `fiyat`) VALUES
(9999, 'Giderler', 'null', 'null', '0', '0000-00-00', '0000-00-00', '0', 'null', 'null', 'null', 0),
(10003, 'Asdasd', 'ASDASDS', 'asdasd', '5123123123', '2023-07-06', '2023-09-28', 'asdasdsa', 'Salsa', 'DENEME', 'erkek', 1200),
(10004, 'Kerem ', 'UYSAL', 'uysal@gmail.com', '5763274632', '2023-10-21', '2023-11-18', '39821738128', 'Salsa', 'DENEME', 'erkek', 700),
(10005, 'Mehmet', 'ERDİNÇ', 'erdinç@gmail.com', '5523123213', '2023-12-08', '2024-01-05', '12192837129', 'SALSA', 'SALSA BASIC', 'erkek', 1500),
(10006, 'Kemal', 'BAYIN', 'bayın@gmail.com', '5520320323', '2023-12-08', '2024-02-02', '81273812831', 'SALSA', 'SALSA BASIC', 'erkek', 700),
(10007, 'Erçin', 'GÜL', 'gül@gmail.com', '5523239230', '2023-12-02', '2024-01-27', '98729838123', 'SALSA', 'SALSA BASIC', 'kadın', 1000),
(10008, 'Kemal', 'BAYIN', 'bayın@gmail.com', '5520320323', '2023-12-08', '2024-02-02', '81273812831', 'SALSA', 'SALSA BASIC', 'erkek', 1500),
(10009, 'Erçin', 'GÜL', 'gül@gmail.com', '5523239230', '2023-12-02', '2024-01-27', '98729838123', 'SALSA', 'SALSA BASIC', 'kadın', 2000);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `para`
--

CREATE TABLE `para` (
  `id` int(4) NOT NULL,
  `user_id` int(4) NOT NULL,
  `tarih` date NOT NULL,
  `miktar` int(11) NOT NULL,
  `kime` varchar(32) NOT NULL,
  `times` int(2) NOT NULL,
  `kalan` int(8) NOT NULL,
  `lpay` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `para`
--

INSERT INTO `para` (`id`, `user_id`, `tarih`, `miktar`, `kime`, `times`, `kalan`, `lpay`) VALUES
(87, 10003, '2023-07-06', 1200, 'DENEME', 0, 0, '2023-09-28'),
(88, 9999, '2023-07-06', -200, 'DENEME', 0, 0, '2023-07-06'),
(89, 10004, '2023-07-06', 700, 'DENEME', 0, 0, '2023-08-03'),
(90, 10005, '2023-09-19', 1500, 'SALSA BASIC', 0, 0, '2023-10-17'),
(91, 10004, '2023-10-21', 700, 'DENEME', 0, 0, '2023-11-18'),
(92, 10005, '2023-12-08', 1000, 'SALSA BASIC', 0, 0, '2024-01-05'),
(93, 10006, '2023-12-08', 1500, 'SALSA BASIC', 1, 750, '2024-01-05'),
(94, 10007, '2023-12-02', 2000, 'SALSA BASIC', 1, 1000, '2023-12-30');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `paracopy`
--

CREATE TABLE `paracopy` (
  `id` int(4) NOT NULL,
  `user_id` int(4) NOT NULL,
  `tarih` date NOT NULL,
  `miktar` int(11) NOT NULL,
  `kime` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `paracopy`
--

INSERT INTO `paracopy` (`id`, `user_id`, `tarih`, `miktar`, `kime`) VALUES
(67, 10003, '2023-07-06', 400, 'DENEME'),
(68, 10004, '2023-07-06', 700, 'düğüm dansı'),
(69, 10003, '2023-09-19', 400, 'DENEME'),
(70, 10003, '2023-09-19', 400, 'DENEME'),
(71, 10005, '2023-09-19', 1500, 'DÜĞÜN DANSI '),
(72, 10004, '2023-10-21', 700, 'DENEME'),
(73, 10005, '2023-12-08', 1000, 'SALSA BASIC'),
(74, 10006, '2023-12-08', 750, 'SALSA BASIC'),
(75, 10007, '2023-12-08', 1000, 'SALSA BASIC');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `specialclass`
--

CREATE TABLE `specialclass` (
  `id` int(4) NOT NULL,
  `tname` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `number` int(10) NOT NULL,
  `tc` int(11) NOT NULL,
  `fiyat` int(11) NOT NULL,
  `date` date NOT NULL,
  `note` varchar(248) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `specialclass`
--

INSERT INTO `specialclass` (`id`, `tname`, `name`, `surname`, `email`, `number`, `tc`, `fiyat`, `date`, `note`) VALUES
(16, 'DÜĞÜN DANSI ', 'Mehmet', 'DüğüN', 'düğün@gmail.com', 2147483647, 2147483647, 1500, '2023-09-19', 'Salı Saat 5');

--
-- Tetikleyiciler `specialclass`
--
DELIMITER $$
CREATE TRIGGER `bilgilerCopy_eklemeYapma` BEFORE INSERT ON `specialclass` FOR EACH ROW INSERT INTO bilgilercopy VALUES (NEW.id, NEW.name, NEW.surname, NEW.email, NEW.number, NEW.date, 00-00-0000, NEW.tc, "special", NEW.tname, "null", NEW.fiyat)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sınıflar`
--

CREATE TABLE `sınıflar` (
  `id` int(4) NOT NULL,
  `tname` varchar(32) NOT NULL,
  `teacher` varchar(18) NOT NULL,
  `dans` varchar(32) NOT NULL,
  `day` varchar(12) NOT NULL,
  `time` varchar(32) NOT NULL,
  `percent` int(3) NOT NULL,
  `money` int(16) NOT NULL,
  `lpay` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `sınıflar`
--

INSERT INTO `sınıflar` (`id`, `tname`, `teacher`, `dans`, `day`, `time`, `percent`, `money`, `lpay`) VALUES
(37, 'DENEME', 'Özgür Tatlıdil', 'Salsa', 'Çarşamba', '12:00 - 13:00', 30, 700, '0000-00-00'),
(38, 'SALSA BASIC', 'Samed ZAMAN', 'SALSA', 'Pazartesi', '12:00 - 13:00', 45, 2750, '0000-00-00');

--
-- Tetikleyiciler `sınıflar`
--
DELIMITER $$
CREATE TRIGGER `Sınıfların Değişimi` BEFORE UPDATE ON `sınıflar` FOR EACH ROW UPDATE para SET kime = NEW.tname WHERE kime = OLD.tname
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `bilgilerCopy_ders_değişim` BEFORE UPDATE ON `sınıflar` FOR EACH ROW UPDATE bilgilercopy SET sınıf = NEW.tname WHERE sınıf = OLD.tname
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `bilgiler_ders_değişim` BEFORE UPDATE ON `sınıflar` FOR EACH ROW UPDATE bilgiler SET sınıf = NEW.tname WHERE sınıf = OLD.tname
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `paracopy_sınıf_yenile` BEFORE UPDATE ON `sınıflar` FOR EACH ROW UPDATE paracopy SET kime = NEW.tname WHERE kime = OLD.tname
$$
DELIMITER ;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `bilgiler`
--
ALTER TABLE `bilgiler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `bilgilercopy`
--
ALTER TABLE `bilgilercopy`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `para`
--
ALTER TABLE `para`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `paracopy`
--
ALTER TABLE `paracopy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `specialclass`
--
ALTER TABLE `specialclass`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sınıflar`
--
ALTER TABLE `sınıflar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `bilgiler`
--
ALTER TABLE `bilgiler`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10008;

--
-- Tablo için AUTO_INCREMENT değeri `bilgilercopy`
--
ALTER TABLE `bilgilercopy`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10010;

--
-- Tablo için AUTO_INCREMENT değeri `para`
--
ALTER TABLE `para`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- Tablo için AUTO_INCREMENT değeri `paracopy`
--
ALTER TABLE `paracopy`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- Tablo için AUTO_INCREMENT değeri `specialclass`
--
ALTER TABLE `specialclass`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `sınıflar`
--
ALTER TABLE `sınıflar`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `para`
--
ALTER TABLE `para`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `bilgilercopy` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
