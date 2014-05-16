-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 16, 2014 at 07:28 PM
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
-- Table structure for table `option`
--

CREATE TABLE `option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `option`
--

INSERT INTO `option` VALUES(1, 'project_name', 'Acción');
INSERT INTO `option` VALUES(2, 'projects_name', 'Acciones');
INSERT INTO `option` VALUES(3, 'subproject_name', 'Objetivo Estratégico');
INSERT INTO `option` VALUES(4, 'subprojects_name', 'Objetivos Estratégicos');
INSERT INTO `option` VALUES(5, 'task_name', 'Hito');
INSERT INTO `option` VALUES(6, 'tasks_name', 'Hitos');

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
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `position_id` (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` VALUES(1, 'Entorno - Cluster', 2);
INSERT INTO `project` VALUES(2, 'Acción 2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` VALUES(1, 'admin');
INSERT INTO `role` VALUES(2, 'dashboard');
INSERT INTO `role` VALUES(3, 'process');
INSERT INTO `role` VALUES(4, 'strategy');

-- --------------------------------------------------------

--
-- Table structure for table `subproject`
--

CREATE TABLE `subproject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `subproject`
--

INSERT INTO `subproject` VALUES(1, 'Dependencia del Proyecto Cluster: manejo de los Contratos y Principales causas', 1);
INSERT INTO `subproject` VALUES(2, 'Crear dependencia de Codelco hacia la empresa a través de buenos resultados en las pruebas preliminares', 1);
INSERT INTO `subproject` VALUES(3, 'Visibilidad: mantener al usuario enterado de lo que se está haciendo, mostrando resultado y entregando información relevante', 1);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `subproject_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subproject_id` (`subproject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` VALUES(1, 'Hito 1', 2, '2014-05-08', '2014-06-20', 0, NULL);
INSERT INTO `task` VALUES(2, 'Hito 1', 1, '2014-05-14', '2014-07-18', 1, '2014-05-16');
INSERT INTO `task` VALUES(3, 'Hito 1', 3, '2014-03-04', '2014-05-07', 0, NULL);
INSERT INTO `task` VALUES(4, 'Hito 2', 2, '2014-05-16', '2014-05-31', 0, NULL);

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

INSERT INTO `user` VALUES(5, 'christian.oviedo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Christian', 'Oviedo', 1, 2, '2014-05-08 13:34:24', '2014-05-16 19:28:00', NULL, NULL);
INSERT INTO `user` VALUES(6, 'fjmoran@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Francisco', 'Morán', 1, 2, '2014-05-08 13:34:24', '2014-05-16 19:17:43', NULL, NULL);
INSERT INTO `user` VALUES(9, 'juanito@checkit.cl', '0cc175b9c0f1b6a831c399e269772661', 'Juanito', 'Ito', 1, 1, '2014-05-12 10:12:35', NULL, NULL, NULL);
INSERT INTO `user` VALUES(10, 'pedrito@checkit.cl', '92eb5ffee6ae2fec3ad71c777531578f', 'Pedrito', 'Ito Ito', 1, 3, '2014-05-12 10:12:45', NULL, NULL, NULL);
INSERT INTO `user` VALUES(11, 'c@c.cl', '4a8a08f09d37b73795649038408b5f33', 'c', 'c', 1, 2, '2014-05-12 10:13:11', '2014-05-16 19:26:13', NULL, NULL);
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
INSERT INTO `user_role` VALUES(5, 4);
INSERT INTO `user_role` VALUES(6, 1);
INSERT INTO `user_role` VALUES(6, 4);
INSERT INTO `user_role` VALUES(9, 1);
INSERT INTO `user_role` VALUES(9, 2);
INSERT INTO `user_role` VALUES(9, 3);
INSERT INTO `user_role` VALUES(9, 4);
INSERT INTO `user_role` VALUES(10, 1);
INSERT INTO `user_role` VALUES(10, 2);
INSERT INTO `user_role` VALUES(10, 3);
INSERT INTO `user_role` VALUES(10, 4);
INSERT INTO `user_role` VALUES(11, 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`);

--
-- Constraints for table `subproject`
--
ALTER TABLE `subproject`
  ADD CONSTRAINT `subproject_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`subproject_id`) REFERENCES `subproject` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`);

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
