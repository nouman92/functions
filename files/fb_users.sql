-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2015 at 09:13 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fb_users`
--
CREATE DATABASE IF NOT EXISTS `fb_users` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fb_users`;

-- --------------------------------------------------------

--
-- Table structure for table `functions`
--

CREATE TABLE IF NOT EXISTS `functions` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `UID` bigint(20) unsigned NOT NULL,
  `function` text NOT NULL,
  `private` tinyint(4) NOT NULL,
  `name` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`fid`),
  KEY `UID` (`UID`),
  KEY `UID_2` (`UID`),
  KEY `UID_3` (`UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `functions`
--

INSERT INTO `functions` (`fid`, `UID`, `function`, `private`, `name`) VALUES
(8, 1, 'add(a,b,c,d[66])\n{\nreturn a+b+c;\n}', 0, 'add(a,b,s,d[66])'),
(9, 4, 'add(a,b,c,d[])\n{\nreturn a+b+c;\n}', 0, 'add(a,b,c,d[])'),
(10, 4, 'sum (a,b)\n{\n  return a+b;\n}\n', 0, 'sum(a,b)'),
(11, 4, 'randome(e)\n{\nreturn e;\n}', 0, ''),
(12, 4, 'dlete(a,b)\n{\nreturn a-b;\n}', 0, ''),
(13, 11, 'sum(w)\n{\nreturn w;\n}', 0, ''),
(14, 11, 'sum(e)\n{\nreturn e;\n}', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `inputs`
--

CREATE TABLE IF NOT EXISTS `inputs` (
  `fid` int(11) NOT NULL,
  `input` text NOT NULL,
  KEY `fid` (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inputs`
--

INSERT INTO `inputs` (`fid`, `input`) VALUES
(8, '1 ;7 ;2 ;array:{8,2,8,2,5,6,1,5,7,5,2,3,5,1,6,5,10,7,8,3,9,6,3,7,3,9,8,9,5,7,1,10,5,6,4,8,9,9,10,6,6,7,5,6,10,9,1,1,4,2,4,6,5,9,2,7,4,2,4,3,8,9,2,8,9,5} ;'),
(9, '1 ;4 ;2 ;array:{9,2,10,1,8,7,5,2} ;'),
(10, '3 ;4 ;'),
(11, '4 ;'),
(12, '8;9;'),
(13, '1;'),
(14, '8;');

-- --------------------------------------------------------

--
-- Table structure for table `outputs`
--

CREATE TABLE IF NOT EXISTS `outputs` (
  `fid` int(11) NOT NULL,
  `output` text NOT NULL,
  KEY `fid` (`fid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outputs`
--

INSERT INTO `outputs` (`fid`, `output`) VALUES
(8, '10'),
(9, '7'),
(10, '7'),
(11, '4'),
(12, '-1'),
(13, '1'),
(14, '8');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `fid` int(11) NOT NULL,
  `tag` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`fid`, `tag`) VALUES
(11, 'java'),
(11, 'java,sort'),
(11, 'randome');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Fuid` varchar(100) NOT NULL,
  `Ffname` varchar(60) NOT NULL,
  `Femail` varchar(60) DEFAULT NULL,
  `password` varchar(15) NOT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `Fuid`, `Ffname`, `Femail`, `password`) VALUES
(1, '720644484718967', 'Nouman Anjum', '', ''),
(2, '1830222230536414', 'Muhammad Nouman Anjum', '', ''),
(3, '39340118713193', 'umer Farooq', 'uf_rajhistan@ymail.com', 'nouman92'),
(4, '50184980633911', 'usman', 'nouman92', 'nouman92'),
(5, '09607153146434', 'NOUMn', 'nouman92', 'nouman92'),
(6, '75631605390374', 'NOUMn', 'nouman92', 'nouman92'),
(7, '96479268999294', 'NOUMn', 'nouman92', 'nouman92'),
(8, '93490847722252', 'nouman92', 'nouman92', 'nouman92'),
(9, '98939723341441', 'nouman92', 'nouman92', 'nouman92'),
(10, '13275910838487', 'muhammad nouman anjum', 'nouman_anjum@ymail.com', 'noumananjum'),
(11, '16190910437223', 'nouman anjum', 'nouman92@live.com', 'nouman92'),
(12, '89240360576880', 'nouman', 'nouman92@live.com', '1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `functions`
--
ALTER TABLE `functions`
  ADD CONSTRAINT `user_functios` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `inputs`
--
ALTER TABLE `inputs`
  ADD CONSTRAINT `function_input` FOREIGN KEY (`fid`) REFERENCES `functions` (`fid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outputs`
--
ALTER TABLE `outputs`
  ADD CONSTRAINT `function_output` FOREIGN KEY (`fid`) REFERENCES `functions` (`fid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;