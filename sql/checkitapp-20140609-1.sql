-- phpMyAdmin SQL Dump
-- version 3.3.10.4
-- http://www.phpmyadmin.net
--
-- Host: mysql.christianoviedo.com
-- Generation Time: Jun 09, 2014 at 01:56 PM
-- Server version: 5.1.39
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `checkitapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `kpi`
--

CREATE TABLE IF NOT EXISTS `kpi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `subproject_id` int(11) NOT NULL,
  `frequency` varchar(255) NOT NULL,
  `base_date` date NOT NULL,
  `goal_date` date NOT NULL,
  `base_value` float NOT NULL,
  `goal_value` float NOT NULL,
  `unit` varchar(100) NOT NULL,
  `real_value` float NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `limit_red` float NOT NULL,
  `limit_yellow` float NOT NULL,
  `limit_green` float NOT NULL,
  `position_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subproject_id` (`subproject_id`),
  KEY `position_id` (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `kpi`
--

INSERT INTO `kpi` (`id`, `name`, `description`, `subproject_id`, `frequency`, `base_date`, `goal_date`, `base_value`, `goal_value`, `unit`, `real_value`, `modified_date`, `limit_red`, `limit_yellow`, `limit_green`, `position_id`) VALUES
(9, 'Porcentaje de Satisfacción del cliente', 'Porcentaje de Satisfacción del cliente', 4, '1 año', '2014-06-02', '2015-04-15', 60, 80, '%', 60, NULL, 60, 70, 80, 3),
(10, 'Tasa de referidos', 'Tasa de referidos', 4, '1 vez al año', '2014-06-02', '2015-06-02', 1300, 2500, 'personas', 1300, NULL, 1300, 2000, 2500, 3),
(11, 'Errores por millon', 'Errores por millon', 5, 'cada 6 meses', '2014-06-02', '2015-06-02', 12, 4, 'unidades por millon', 12, NULL, 12, 8, 4, 8),
(12, 'Porcentaje de entrega a tiempo', 'Porcentaje de entrega a tiempo', 5, '1 vez al año', '2014-06-02', '2015-06-02', 92, 98, '%', 92, NULL, 92, 95, 98, 8),
(13, 'Rentabilidad por cliente', 'Rentabilidad por cliente', 1, 'cada 6 meses', '2014-06-02', '2015-06-02', 1500, 2500, 'USD', 3500, '2014-06-03 19:42:45', 1500, 2000, 2500, 2),
(14, 'Crecimiento en ventas', 'Crecimiento en ventas', 3, '1 vez al año', '2014-06-02', '2015-06-02', 10, 25, '% anual', 20, '2014-06-03 07:33:13', 10, 18, 25, 2),
(15, 'Cantidad de accidentes', 'Cantidad de accidentes', 7, 'cada 3 meses', '2014-06-02', '2015-06-02', 8, 2, 'accidentes por año', 8, NULL, 8, 4, 2, 9),
(16, 'Obsolescencia de equipos informáticos ', 'Obsolescencia de equipos informáticos ', 7, '1 vez por año', '2014-06-02', '2015-06-02', 25, 5, '%', 6, '2014-06-03 15:05:24', 25, 10, 5, 9);

-- --------------------------------------------------------

--
-- Table structure for table `option`
--

CREATE TABLE IF NOT EXISTS `option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `option`
--

INSERT INTO `option` (`id`, `name`, `value`) VALUES
(1, 'project_name', 'Perspectiva'),
(2, 'projects_name', 'Perspectivas'),
(3, 'subproject_name', 'Objetivo Estratégico'),
(4, 'subprojects_name', 'Objetivos Estratégicos'),
(5, 'task_name', 'Hito'),
(6, 'tasks_name', 'Hitos');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `name`, `parent_id`) VALUES
(1, 'Gerente General', 4),
(2, 'Gerente Finanzas', 1),
(3, 'Gerente Marketing', 1),
(4, 'Director', NULL),
(7, 'Asesor Finanzas', 2),
(8, 'Gerente de Operaciones', 1),
(9, 'Gerente RR.HH.', 1),
(10, 'Asesor RR.HH.', 9),
(11, 'Asesor de Marketing', 3),
(12, 'Asesor de Operaciones', 8);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `position_id` (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `position_id`) VALUES
(1, 'Financiera', 4),
(2, 'Clientes', 4),
(3, 'Procesos Internos', 4),
(4, 'Aprendizaje y Desarrollo', 4);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'dashboard'),
(3, 'process'),
(4, 'strategy');

-- --------------------------------------------------------

--
-- Table structure for table `subproject`
--

CREATE TABLE IF NOT EXISTS `subproject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `position_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `position_id` (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `subproject`
--

INSERT INTO `subproject` (`id`, `name`, `project_id`, `position_id`) VALUES
(1, 'Maximizar la rentabilidad', 1, 2),
(2, 'Crecer a través de nuevos productos', 1, 2),
(3, 'Crecer en el mercado internacional', 1, 2),
(4, 'Ofrecer productos innovadores con alto valor nutritivo', 2, 3),
(5, 'Implementar procesos de innovación de productos', 3, 8),
(6, 'Contar con información sobre inteligencia de mercado', 3, 8),
(7, 'Incrementar la capacitación del personal', 4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `subproject_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `end_date` date DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subproject_id` (`subproject_id`),
  KEY `position_id` (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `name`, `subproject_id`, `start_date`, `due_date`, `status`, `end_date`, `position_id`) VALUES
(1, 'Análisis de necesidades de clientes', 2, '2014-05-08', '2014-06-20', 0, NULL, 7),
(2, 'Definición de lugar planta distribución', 3, '2014-05-14', '2014-07-30', 1, '2014-05-17', 7),
(3, 'Análisis mercado peruano', 3, '2014-03-04', '2014-05-13', 0, NULL, 7),
(4, 'Determinación de mercado objetivo', 2, '2014-05-16', '2014-08-19', 0, NULL, 7),
(5, 'Ver factibilidad técnica', 4, '2014-05-17', '2014-06-04', 0, NULL, 11),
(6, 'Comienzo de operación mercado peruano', 3, '2014-05-17', '2014-10-27', 0, NULL, 7),
(7, 'Estudio de mercado', 6, '2014-06-02', '2014-08-28', 0, NULL, 12),
(8, 'Curso de capacitación ISO-9001', 7, '2014-06-02', '2014-07-31', 0, NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `firstname`, `lastname`, `status`, `position_id`, `created`, `lastvisit`, `token`, `token_created`) VALUES
(5, 'christian.oviedo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Christian', 'Oviedo', 1, 2, '2014-05-08 13:34:24', '2014-06-05 16:37:50', NULL, NULL),
(6, 'fjmoran@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Francisco José', 'Morán', 1, 2, '2014-05-08 13:34:24', '2014-06-03 14:36:16', NULL, NULL),
(9, 'director1@check-it.cl', '21a70a20a394dc2a038843a51a64322b', 'Director 1', 'Empresa', 1, 4, '2014-05-12 10:12:35', '2014-06-05 16:41:19', NULL, NULL),
(10, 'director2@check-it.cl', 'c9c25d0280cad37aa512f2394f5baa34', 'Director 2', 'Empresa', 1, 4, '2014-05-12 10:12:45', NULL, NULL, NULL),
(18, 'gerente@check-it.cl', '740d9c49b11f3ada7b9112614a54be41', 'Gerente', 'General', 1, 1, '2014-05-30 15:43:02', '2014-06-02 11:01:22', NULL, NULL),
(19, 'finanzas@check-it.cl', 'd63d1f46dc616ff29efc6576bc19bc3d', 'Gerente', 'Finanzas', 1, 2, '2014-05-30 15:43:31', '2014-06-02 09:08:18', NULL, NULL),
(20, 'marketing@check-it.cl', 'c769c2bd15500dd906102d9be97fdceb', 'Gerente', 'Marketing', 1, 3, '2014-05-30 15:43:56', '2014-06-02 19:13:29', NULL, NULL),
(21, 'operaciones@check-it.cl', '527c128fd90c90859a5ca1617a2cd23d', 'Gerente', 'Operaciones', 1, 8, '2014-06-02 20:58:31', NULL, NULL, NULL),
(22, 'rrhh@check-it.cl', '89f71c4e9055ee73c3bc372528a54b9c', 'Gerente', 'RRHH', 1, 9, '2014-06-02 21:00:08', NULL, NULL, NULL),
(23, 'asesormarketing@check-it.cl', '6a20e01a1604491def7c3b3b9ae5454d', 'Asesor', 'Marketing', 1, 11, '2014-06-02 21:01:47', NULL, NULL, NULL),
(24, 'asesoroperaciones@check-it.cl', '482ef9d2cf35e966dfcaa8f4eaa76786', 'Asesor', 'Operaciones', 1, 12, '2014-06-02 21:08:51', NULL, NULL, NULL),
(25, 'asesorrrhh@check-it.cl', 'c4ac719461d9cacd6e75507afdd9c621', 'Asesor', 'RRHH', 1, 10, '2014-06-02 21:09:52', NULL, NULL, NULL),
(26, 'asesorfinanzas@check-it.cl', '4cd2440705e2ddbf9e9c044851c4f93c', 'Asesor', 'Finanzas', 1, 7, '2014-06-02 21:10:53', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(5, 1),
(5, 2),
(5, 4),
(6, 1),
(6, 4),
(9, 2),
(9, 4),
(10, 2),
(18, 2),
(18, 4),
(19, 2),
(19, 4),
(20, 2),
(20, 4),
(21, 2),
(21, 4),
(22, 2),
(22, 4),
(23, 2),
(23, 4),
(24, 2),
(24, 4),
(25, 2),
(25, 4),
(26, 2),
(26, 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kpi`
--
ALTER TABLE `kpi`
  ADD CONSTRAINT `kpi_ibfk_1` FOREIGN KEY (`subproject_id`) REFERENCES `subproject` (`id`),
  ADD CONSTRAINT `kpi_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`);

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`);

--
-- Constraints for table `subproject`
--
ALTER TABLE `subproject`
  ADD CONSTRAINT `subproject_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`),
  ADD CONSTRAINT `subproject_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`),
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
