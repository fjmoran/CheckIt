-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 14, 2014 at 05:58 PM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `checkit`
--

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `position`
--

INSERT INTO `position` VALUES(1, 'Gerente General', NULL);
INSERT INTO `position` VALUES(2, 'Gerente Finanzas', 1);
INSERT INTO `position` VALUES(3, 'Gerente Marketing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` VALUES(1, 'admin');
INSERT INTO `role` VALUES(2, 'dashboard');
INSERT INTO `role` VALUES(3, 'process');
INSERT INTO `role` VALUES(4, 'strategy');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `position_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `lastvisit` datetime DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `position_id` (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` VALUES(5, 'christian.oviedo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Christian', 'Oviedo', 1, NULL, '2014-05-08 13:34:24', '2014-05-13 23:13:45', NULL, NULL);
INSERT INTO `user` VALUES(6, 'fjmoran@gmail.com', '202cb962ac59075b964b07152d234b70', 'Francisco', 'Morán', 1, 2, '2014-05-08 13:34:24', NULL, NULL, NULL);
INSERT INTO `user` VALUES(9, 'a@a.cl', '0cc175b9c0f1b6a831c399e269772661', 'a', 'a', 0, 1, '2014-05-12 10:12:35', NULL, NULL, NULL);
INSERT INTO `user` VALUES(10, 'b@b.cl', '92eb5ffee6ae2fec3ad71c777531578f', 'b', 'b', 0, 2, '2014-05-12 10:12:45', NULL, NULL, NULL);
INSERT INTO `user` VALUES(11, 'c@c.cl', '4a8a08f09d37b73795649038408b5f33', 'c', 'c', 0, NULL, '2014-05-12 10:13:11', NULL, NULL, NULL);
INSERT INTO `user` VALUES(12, 'e@e.cl', 'e1671797c52e15f763380b45e841ec32', 'e', 'e', 0, NULL, '2014-05-12 10:14:44', NULL, NULL, NULL);
INSERT INTO `user` VALUES(13, 'd@d.cl', '8277e0910d750195b448797616e091ad', 'd', 'd', 0, NULL, '2014-05-12 10:14:53', NULL, NULL, NULL);
INSERT INTO `user` VALUES(14, 'f@f.cl', '8fa14cdd754f91cc6554c9e71929cce7', 'f', 'f', 0, NULL, '2014-05-12 10:15:21', NULL, NULL, NULL);
INSERT INTO `user` VALUES(15, 'g@g.cl', 'b2f5ff47436671b6e533d8dc3614845d', 'g', 'g', 0, NULL, '2014-05-12 10:18:46', NULL, NULL, NULL);
INSERT INTO `user` VALUES(16, 'h@h.cl', '2510c39011c5be704182423e3a695e91', 'h', 'h', 0, NULL, '2014-05-12 10:18:54', NULL, NULL, NULL);
INSERT INTO `user` VALUES(17, 'i@i.cl', '865c0c0b4ab0e063e5caa3387c1a8741', 'i', 'i', 0, NULL, '2014-05-12 10:19:03', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` VALUES(5, 1);
INSERT INTO `user_role` VALUES(6, 1);
INSERT INTO `user_role` VALUES(6, 2);
INSERT INTO `user_role` VALUES(6, 3);
INSERT INTO `user_role` VALUES(6, 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`);

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
