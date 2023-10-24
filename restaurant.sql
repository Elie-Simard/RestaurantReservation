-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 18, 2021 at 03:55 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `jour` datetime NOT NULL,
  `couverts` int(2) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `annulation` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `jour`, `couverts`, `nom`, `email`, `annulation`) VALUES
(1, '2021-12-01 11:30:00', 5, 'Haythem', 'rhoumahaythem@gmail.com', '1634487587Haythem'),
(2, '2021-12-02 11:30:00', 6, 'Haythem', 'rhoumahaythem@gmail.com', '1634491246Haythem'),
(3, '2021-12-01 11:30:00', 5, 'Haythem', 'rhoumahaythem@gmail.com', '1634491368Haythem'),
(4, '2022-01-02 11:45:00', 2, 'Haythem', 'rhoumahaythem@gmail.com', '1634491963Haythem'),
(5, '2023-01-01 11:35:00', 2, 'stépahanie', 'rhoumahaythem@gmail.com', '1634492072stépahanie'),
(6, '2023-01-01 11:35:00', 2, 'stépahanie', 'rhoumahaythem@gmail.com', '1634492082stépahanie'),
(7, '2022-01-03 11:55:00', 3, 'haythem', 'rhoumahaythem@gmail.com', '1634492213haythem'),
(8, '2022-01-03 11:55:00', 3, 'haythem', 'rhoumahaythem@gmail.com', '1634493176haythem'),
(9, '2022-01-01 11:50:00', 2, 'Haythem', 'rhoumahaythem@gmail.com', '1634493217Haythem'),
(10, '2022-01-01 11:50:00', 2, 'Haythem', 'rhoumahaythem@gmail.com', '1634493328Haythem'),
(11, '2022-01-01 11:50:00', 2, 'Haythem', 'rhoumahaythem@gmail.com', '1634493389Haythem'),
(12, '2022-01-01 11:50:00', 2, 'Haythem', 'rhoumahaythem@gmail.com', '1634494898Haythem'),
(13, '2022-01-01 11:50:00', 2, 'Haythem', 'rhoumahaythem@gmail.com', '1634494948Haythem'),
(14, '2022-01-01 11:50:00', 2, 'Haythem', 'rhoumahaythem@gmail.com', '1634496216Haythem'),
(15, '2022-01-02 11:50:00', 1, 'Haythem', 'rhoumahaythem@gmail.com', '1634496485Haythem'),
(16, '2022-01-02 11:50:00', 1, 'Haythem', 'rhoumahaythem@gmail.com', '1634496524Haythem'),
(17, '2022-01-02 11:50:00', 1, 'Haythem', 'rhoumahaythem@gmail.com', '1634496751Haythem'),
(18, '2022-01-02 11:50:00', 1, 'Haythem', 'rhoumahaythem@gmail.com', '1634497881Haythem'),
(19, '2022-01-01 11:30:00', 5, 'Haythem', 'rhoumahaythem@gmail.com', '1634571930Haythem');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
