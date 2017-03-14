-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2017 at 05:11 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `g2_vesti`
--

-- --------------------------------------------------------

--
-- Table structure for table `galerije`
--

CREATE TABLE `galerije` (
  `id` int(2) UNSIGNED NOT NULL,
  `nazivGalerije` varchar(250) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `galerije`
--

INSERT INTO `galerije` (`id`, `nazivGalerije`, `autor`, `datum`) VALUES
(1, 'Prva', 'vmiljkovic', '2017-02-22 09:54:13'),
(2, 'MOJA GALERIJA', 'vmiljkovic', '2017-02-24 17:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `galerijeslike`
--

CREATE TABLE `galerijeslike` (
  `id` int(3) UNSIGNED NOT NULL,
  `idGalerije` int(2) NOT NULL,
  `slika` varchar(100) NOT NULL,
  `komentar` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `galerijeslike`
--

INSERT INTO `galerijeslike` (`id`, `idGalerije`, `slika`, `komentar`) VALUES
(1, 1, '1487762865_1.jpg', NULL),
(2, 1, '1487762865_2.jpg', NULL),
(3, 1, '1487762954_1.jpg', NULL),
(4, 1, '1487762954_2.jpg', NULL),
(5, 1, '1487763121_1.jpg', NULL),
(6, 1, '1487763121_2.jpg', NULL),
(7, 1, '1487955762_1.jpg', NULL),
(8, 1, '1487955762_2.', NULL),
(9, 2, '1487955785_1.jpg', NULL),
(10, 2, '1487955785_2.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ime`
--

CREATE TABLE `ime` (
  `id` int(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) DEFAULT NULL,
  `jmbg` int(13) NOT NULL,
  `privilegije` varchar(45) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `id` int(4) UNSIGNED NOT NULL,
  `idVesti` int(3) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `tekst` text NOT NULL,
  `volime` int(4) NOT NULL DEFAULT '0',
  `nevolime` int(4) NOT NULL DEFAULT '0',
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id`, `idVesti`, `autor`, `tekst`, `volime`, `nevolime`, `datum`) VALUES
(1, 11, 'Vladimir', 'Ovo je dobra vest', 0, 0, '2017-02-08 10:55:39'),
(3, 11, 'a<sfdasfafs', 'FA<EFAEFWegRWGAERDFGAWERSFVCA', 0, 0, '2017-02-08 11:13:02'),
(4, 11, 'a<sfdasfafs', 'FA<EFAEFWegRWGAERDFGAWERSFVCA', 0, 0, '2017-02-08 11:14:15'),
(5, 11, 'a<sfdasfafs', 'FA<EFAEFWegRWGAERDFGAWERSFVCA', 0, 0, '2017-02-08 11:21:43'),
(6, 11, 'a<sfdasfafs', 'FA<EFAEFWegRWGAERDFGAWERSFVCA', 0, 0, '2017-02-08 11:22:13'),
(7, 11, 'a<sfdasfafs', 'FA<EFAEFWegRWGAERDFGAWERSFVCA', 0, 0, '2017-02-08 11:22:29'),
(8, 12, 'Rastko', 'Ovo je moj prvi komentar', 20, 0, '2017-02-08 11:22:47'),
(9, 12, 'Rastko', 'Ovo je moj prvi komentar', 0, 0, '2017-02-08 11:24:50'),
(10, 9, 'dfggg', 'dfgdf', 0, 0, '2017-02-20 19:10:20'),
(11, 9, 'fhdhdhd', 'dhdhdh', 0, 0, '2017-02-20 19:10:30'),
(12, 9, 'rad', 'radi', 0, 0, '2017-02-21 11:27:21');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(3) UNSIGNED NOT NULL,
  `korime` varchar(50) NOT NULL,
  `lozinka` varchar(50) NOT NULL,
  `ime` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `korime`, `lozinka`, `ime`, `status`) VALUES
(1, 'bbosko', 'bbosko', 'Бошко Богојевић', 'Administrator'),
(2, 'vmiljkovic', 'vmiljkovic', 'Vladimir Miljkovic', 'Urednik');

-- --------------------------------------------------------

--
-- Table structure for table `vesti`
--

CREATE TABLE `vesti` (
  `id` int(4) UNSIGNED NOT NULL,
  `naslov` varchar(200) NOT NULL,
  `sadrzaj` text NOT NULL,
  `autor` varchar(50) NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kategorija` enum('Politika','Sport','Hronika','Zabava') NOT NULL,
  `komentar` varchar(250) DEFAULT NULL,
  `obrisan` int(1) NOT NULL DEFAULT '0',
  `izmena` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `slika` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vesti`
--

INSERT INTO `vesti` (`id`, `naslov`, `sadrzaj`, `autor`, `datum`, `kategorija`, `komentar`, `obrisan`, `izmena`, `slika`) VALUES
(1, 'Naslov 1. vesti iz hronike', 'Lorem ipsum dolor sit amet, usu id idque mucius, est ne soluta torquatos, splendide dissentias et est. Semper regione ponderum in sea. Sit te unum accommodare, hendrerit interpretaris sit cu. Sed ne brute verterem. Paulo liberavisse ad nam. Civibus iudicabit comprehensam at ius, assum mucius pertinax ei mei.', 'bbosko', '2017-01-10 03:21:29', 'Hronika', NULL, 0, '2017-02-08 11:31:52', NULL),
(2, 'Naslov 2. vesti iz politike', 'Ne usu propriae insolens gloriatur. Et pro soleat option electram, cu etiam quaestio eos, ut cum eius phaedrum. No pri vidit similique, sit laudem dissentiet eu. Eam cu appareat gubergren. Perfecto perpetua gloriatur duo ea, cu eos meliore patrioque. Nibh quaestio scriptorem eos ex.', 'bbosko', '2017-01-10 09:00:00', 'Politika', 'Neki komentar', 0, '2017-02-08 11:31:55', NULL),
(3, 'naslov iz update-a iz hronike', 'Lorem ipsum dolor sit amet, usu id idque mucius, est ne soluta torquatos, splendide dissentias et est. Semper regione ponderum in sea. Sit te unum accommodare, hendrerit interpretaris sit cu. Sed ne brute verterem. Paulo liberavisse ad nam. Civibus iudicabit comprehensam at ius, assum mucius pertinax ei mei.', 'Autor iz update-a', '2017-01-10 03:21:29', 'Hronika', NULL, 0, '2017-02-08 11:03:26', NULL),
(4, 'Naslov 4. vesti iz politike', 'Ne usu propriae insolens gloriatur. Et pro soleat option electram, cu etiam quaestio eos, ut cum eius phaedrum. No pri vidit similique, sit laudem dissentiet eu. Eam cu appareat gubergren. Perfecto perpetua gloriatur duo ea, cu eos meliore patrioque. Nibh quaestio scriptorem eos ex.', 'pera', '2017-01-10 09:00:00', 'Politika', 'Neki komentar', 0, '2017-02-08 11:03:31', NULL),
(5, 'Opet neki naslov iz zabave', 'Lorem ipsum is a pseudo-Latin text used in web design, typography, layout, and printing in place of English to emphasise design elements over content. It\'s also called placeholder (or filler) text. It\'s a convenient tool for mock-ups. It helps to outline the visual elements of a document or presentation, eg typography, font, or layout. Lorem ipsum is mostly a part of a Latin text by the classical author and philosopher Cicero. Its words and letters have been changed by addition or removal, so to deliberately render its content nonsensical; it\'s not genuine, correct, or comprehensible Latin anymore. While lorem ipsum\'s still resembles classical Latin, it actually has no meaning whatsoever. As Cicero\'s text doesn\'t contain the letters K, W, or Z, alien to latin, these, and others are often inserted randomly to mimic the typographic appearence of European languages, as are digraphs not to be found in the original.', 'bbosko', '2017-01-10 07:00:00', 'Zabava', 'dfsdgfsdgfsdg', 0, '2017-02-08 11:03:36', 'slika1.jpg'),
(6, 'Opet neki naslov 2 iz zabave', 'Lorem ipsum is a pseudo-Latin text used in web design, typography, layout, and printing in place of English to emphasise design elements over content. It\'s also called placeholder (or filler) text. It\'s a convenient tool for mock-ups. It helps to outline the visual elements of a document or presentation, eg typography, font, or layout. Lorem ipsum is mostly a part of a Latin text by the classical author and philosopher Cicero. Its words and letters have been changed by addition or removal, so to deliberately render its content nonsensical; it\'s not genuine, correct, or comprehensible Latin anymore. While lorem ipsum\'s still resembles classical Latin, it actually has no meaning whatsoever. As Cicero\'s text doesn\'t contain the letters K, W, or Z, alien to latin, these, and others are often inserted randomly to mimic the typographic appearence of European languages, as are digraphs not to be found in the original.', 'bbosko', '2017-01-10 07:00:00', 'Zabava', 'dfsdgfsdgfsdg', 0, '2017-02-08 11:03:42', NULL),
(7, 'Dodato iz insert upita iz hronike', 'SadrzajLorem ipsum is a pseudo-Latin text used in web design, typography, layout, and printing in place of English to emphasise design elements over content. It\'s also called placeholder (or filler) text. It\'s a convenient tool for mock-ups. It helps to outline the visual elements of a document or presentation, eg typography, font, or layout. Lorem ipsum is mostly a part of a Latin text by the classical author and philosopher Cicero. Its words and letters have been changed by addition or removal, so to deliberately render its content nonsensical; it\'s not genuine, correct, or comprehensible Latin anymore. While lorem ipsum\'s still resembles classical Latin, it actually has no meaning whatsoever. As Cicero\'s text doesn\'t contain the letters K, W, or Z, alien to latin, these, and others are often inserted randomly to mimic the typographic appearence of European languages, as are digraphs not to be found in the original.', 'bbosko', '2017-01-10 10:48:37', 'Hronika', NULL, 0, '2017-02-08 11:03:47', NULL),
(8, 'Naslov iz HTMLA iz politike', 'SAdrzaj isto\nLorem ipsum is a pseudo-Latin text used in web design, typography, layout, and printing in place of English to emphasise design elements over content. It\'s also called placeholder (or filler) text. It\'s a convenient tool for mock-ups. It helps to outline the visual elements of a document or presentation, eg typography, font, or layout. Lorem ipsum is mostly a part of a Latin text by the classical author and philosopher Cicero. Its words and letters have been changed by addition or removal, so to deliberately render its content nonsensical; it\'s not genuine, correct, or comprehensible Latin anymore. While lorem ipsum\'s still resembles classical Latin, it actually has no meaning whatsoever. As Cicero\'s text doesn\'t contain the letters K, W, or Z, alien to latin, these, and others are often inserted randomly to mimic the typographic appearence of European languages, as are digraphs not to be found in the original.', 'vmiljkovic', '2017-01-10 11:44:55', 'Politika', 'komentar', 0, '2017-02-08 11:03:52', 'slika1.jpg'),
(9, 'Naslov 6 iz zabave', 'afsfasfasf\nLorem ipsum is a pseudo-Latin text used in web design, typography, layout, and printing in place of English to emphasise design elements over content. It\'s also called placeholder (or filler) text. It\'s a convenient tool for mock-ups. It helps to outline the visual elements of a document or presentation, eg typography, font, or layout. Lorem ipsum is mostly a part of a Latin text by the classical author and philosopher Cicero. Its words and letters have been changed by addition or removal, so to deliberately render its content nonsensical; it\'s not genuine, correct, or comprehensible Latin anymore. While lorem ipsum\'s still resembles classical Latin, it actually has no meaning whatsoever. As Cicero\'s text doesn\'t contain the letters K, W, or Z, alien to latin, these, and others are often inserted randomly to mimic the typographic appearence of European languages, as are digraphs not to be found in the original.', 'vmiljkovic', '2017-01-24 11:53:08', 'Zabava', '', 0, '2017-02-08 11:03:57', ''),
(10, 'Naslov 7 iz politike', 'asdasdLorem ipsum is a pseudo-Latin text used in web design, typography, layout, and printing in place of English to emphasise design elements over content. It\'s also called placeholder (or filler) text. It\'s a convenient tool for mock-ups. It helps to outline the visual elements of a document or presentation, eg typography, font, or layout. Lorem ipsum is mostly a part of a Latin text by the classical author and philosopher Cicero. Its words and letters have been changed by addition or removal, so to deliberately render its content nonsensical; it\'s not genuine, correct, or comprehensible Latin anymore. While lorem ipsum\'s still resembles classical Latin, it actually has no meaning whatsoever. As Cicero\'s text doesn\'t contain the letters K, W, or Z, alien to latin, these, and others are often inserted randomly to mimic the typographic appearence of European languages, as are digraphs not to be found in the original.', 'bbosko', '2017-01-31 10:44:28', 'Politika', 'adasdas', 0, '2017-02-08 11:04:01', ''),
(11, 'Naslov 8 iz sporta', 'dsadasdsaasLorem ipsum is a pseudo-Latin text used in web design, typography, layout, and printing in place of English to emphasise design elements over content. It\'s also called placeholder (or filler) text. It\'s a convenient tool for mock-ups. It helps to outline the visual elements of a document or presentation, eg typography, font, or layout. Lorem ipsum is mostly a part of a Latin text by the classical author and philosopher Cicero. Its words and letters have been changed by addition or removal, so to deliberately render its content nonsensical; it\'s not genuine, correct, or comprehensible Latin anymore. While lorem ipsum\'s still resembles classical Latin, it actually has no meaning whatsoever. As Cicero\'s text doesn\'t contain the letters K, W, or Z, alien to latin, these, and others are often inserted randomly to mimic the typographic appearence of European languages, as are digraphs not to be found in the original.', 'bbosko', '2017-01-31 11:32:00', 'Sport', 'komentar', 0, '2017-02-08 11:04:07', ''),
(12, 'Naslov 9 iz sporta', 'aaaLorem ipsum is a pseudo-Latin text used in web design, typography, layout, and printing in place of English to emphasise design elements over content. It\'s also called placeholder (or filler) text. It\'s a convenient tool for mock-ups. It helps to outline the visual elements of a document or presentation, eg typography, font, or layout. Lorem ipsum is mostly a part of a Latin text by the classical author and philosopher Cicero. Its words and letters have been changed by addition or removal, so to deliberately render its content nonsensical; it\'s not genuine, correct, or comprehensible Latin anymore. While lorem ipsum\'s still resembles classical Latin, it actually has no meaning whatsoever. As Cicero\'s text doesn\'t contain the letters K, W, or Z, alien to latin, these, and others are often inserted randomly to mimic the typographic appearence of European languages, as are digraphs not to be found in the original.', 'bbosko', '2017-02-07 11:02:28', 'Sport', 'aaa', 0, '2017-02-08 11:04:15', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `galerije`
--
ALTER TABLE `galerije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galerijeslike`
--
ALTER TABLE `galerijeslike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ime`
--
ALTER TABLE `ime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vesti`
--
ALTER TABLE `vesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `galerije`
--
ALTER TABLE `galerije`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `galerijeslike`
--
ALTER TABLE `galerijeslike`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ime`
--
ALTER TABLE `ime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vesti`
--
ALTER TABLE `vesti`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
