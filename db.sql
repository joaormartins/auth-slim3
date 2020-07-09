-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 09-Jul-2020 às 19:33
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `authslim3`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(60) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_confirmed`, `password`, `admin`, `created_at`, `updated_at`) VALUES
(1, 'JoaorMartins', 'joaormartins.dev@gmail.com', 0, '$2y$10$7l1R2qBWNb0qCEbrBEdr0uINquhVCIt6Jjmrum7SYd5spV6q6jawy', 1, '2020-07-07 20:18:14', '2020-07-07 20:18:14'),
(3, 'ZicoFerreira', 'ezequielferreira@gmail.com', 0, '$2y$10$fpa4MSoWdcP9CBotl8gMm.CdH1jiOpA2lCogZygXkbyR9TPLh8Rn2', 0, '2020-07-07 22:09:39', '2020-07-07 22:09:39'),
(5, 'LindauraReis', 'lindauradosreism@gmail.com', 0, '$2y$10$beVdOxj62toLjcjKSQLbUOa3bkodskL43mzkAtBtCub9iixN47SKK', 0, '2020-07-09 22:18:03', '2020-07-09 22:18:03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_sessions`
--

DROP TABLE IF EXISTS `user_sessions`;
CREATE TABLE IF NOT EXISTS `user_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `session` char(40) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `expiry` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
