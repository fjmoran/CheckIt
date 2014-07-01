-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2014 at 11:17 AM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

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

CREATE TABLE `kpi` (
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

INSERT INTO `kpi` VALUES(9, 'Porcentaje de Satisfacción del cliente', 'Porcentaje de Satisfacción del cliente', 4, '1 año', '2014-06-02', '2015-04-15', 60, 80, '%', 60, NULL, 60, 70, 80, 3);
INSERT INTO `kpi` VALUES(10, 'Tasa de referidos', 'Tasa de referidos', 4, '1 vez al año', '2014-06-02', '2015-06-02', 1300, 2500, 'personas', 1300, NULL, 1300, 2000, 2500, 3);
INSERT INTO `kpi` VALUES(11, 'Errores por millon', 'Errores por millon', 5, 'cada 6 meses', '2014-06-02', '2015-06-02', 12, 4, 'unidades por millon', 12, NULL, 12, 8, 4, 8);
INSERT INTO `kpi` VALUES(12, 'Porcentaje de entrega a tiempo', 'Porcentaje de entrega a tiempo', 5, '1 vez al año', '2014-06-02', '2015-06-02', 92, 98, '%', 92, NULL, 92, 95, 98, 8);
INSERT INTO `kpi` VALUES(13, 'Rentabilidad por cliente', 'Rentabilidad por cliente', 1, 'cada 6 meses', '2014-06-02', '2015-06-02', 1500, 2500, 'USD', 3500, '2014-06-03 19:42:45', 1500, 2000, 2500, 2);
INSERT INTO `kpi` VALUES(14, 'Crecimiento en ventas', 'Crecimiento en ventas', 3, '1 vez al año', '2014-06-02', '2015-06-02', 10, 25, '% anual', 20, '2014-06-03 07:33:13', 10, 18, 25, 2);
INSERT INTO `kpi` VALUES(15, 'Cantidad de accidentes', 'Cantidad de accidentes', 7, 'cada 3 meses', '2014-06-02', '2015-06-02', 8, 2, 'accidentes por año', 8, NULL, 8, 4, 2, 9);
INSERT INTO `kpi` VALUES(16, 'Obsolescencia de equipos informáticos ', 'Obsolescencia de equipos informáticos ', 7, '1 vez por año', '2014-06-02', '2015-06-02', 25, 5, '%', 6, '2014-06-03 15:05:24', 25, 10, 5, 9);

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

INSERT INTO `option` VALUES(1, 'project_name', 'Perspectiva');
INSERT INTO `option` VALUES(2, 'projects_name', 'Perspectivas');
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `position`
--

INSERT INTO `position` VALUES(1, 'Gerente General', 4);
INSERT INTO `position` VALUES(2, 'Gerente Finanzas', 1);
INSERT INTO `position` VALUES(3, 'Gerente Marketing', 1);
INSERT INTO `position` VALUES(4, 'Director', NULL);
INSERT INTO `position` VALUES(7, 'Asesor Finanzas', 2);
INSERT INTO `position` VALUES(8, 'Gerente de Operaciones', 1);
INSERT INTO `position` VALUES(9, 'Gerente RR.HH.', 1);
INSERT INTO `position` VALUES(10, 'Asesor RR.HH.', 9);
INSERT INTO `position` VALUES(11, 'Asesor de Marketing', 3);
INSERT INTO `position` VALUES(12, 'Asesor de Operaciones', 8);

-- --------------------------------------------------------

--
-- Table structure for table `process`
--

CREATE TABLE `process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `process`
--

INSERT INTO `process` VALUES(1, 'Flujo de prueba');
INSERT INTO `process` VALUES(2, 'Proceso número 2');

-- --------------------------------------------------------

--
-- Table structure for table `process_connector`
--

CREATE TABLE `process_connector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_task_id` int(11) NOT NULL,
  `target_task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `target_task_id` (`target_task_id`),
  KEY `source_task_id` (`source_task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `process_connector`
--


-- --------------------------------------------------------

--
-- Table structure for table `process_task`
--

CREATE TABLE `process_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `process_id` int(11) NOT NULL,
  `pos_x` int(11) NOT NULL,
  `pos_y` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `process_id` (`process_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `process_task`
--

INSERT INTO `process_task` VALUES(46, 'Tarea 1', 1, 180, 40);
INSERT INTO `process_task` VALUES(47, 'Tarea 1', 1, 440, 240);
INSERT INTO `process_task` VALUES(48, 'Tarea 1', 1, 180, 240);
INSERT INTO `process_task` VALUES(49, 'Tarea 2', 1, 720, 240);
INSERT INTO `process_task` VALUES(50, 'Tarea 3', 1, 740, 120);
INSERT INTO `process_task` VALUES(51, 'Tarea 4', 1, 460, 160);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` VALUES(1, 'Financiera', 4);
INSERT INTO `project` VALUES(2, 'Clientes', 4);
INSERT INTO `project` VALUES(3, 'Procesos Internos', 4);
INSERT INTO `project` VALUES(4, 'Aprendizaje y Desarrollo', 4);

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
  `position_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `position_id` (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `subproject`
--

INSERT INTO `subproject` VALUES(1, 'Maximizar la rentabilidad', 1, 2);
INSERT INTO `subproject` VALUES(2, 'Crecer a través de nuevos productos', 1, 2);
INSERT INTO `subproject` VALUES(3, 'Crecer en el mercado internacional', 1, 2);
INSERT INTO `subproject` VALUES(4, 'Ofrecer productos innovadores con alto valor nutritivo', 2, 3);
INSERT INTO `subproject` VALUES(5, 'Implementar procesos de innovación de productos', 3, 8);
INSERT INTO `subproject` VALUES(6, 'Contar con información sobre inteligencia de mercado', 3, 8);
INSERT INTO `subproject` VALUES(7, 'Incrementar la capacitación del personal', 4, 9);

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
  `position_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subproject_id` (`subproject_id`),
  KEY `position_id` (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` VALUES(1, 'Análisis de necesidades de clientes', 2, '2014-05-08', '2014-06-20', 0, NULL, 7);
INSERT INTO `task` VALUES(2, 'Definición de lugar planta distribución', 3, '2014-05-14', '2014-07-30', 1, '2014-05-17', 7);
INSERT INTO `task` VALUES(3, 'Análisis mercado peruano', 3, '2014-03-04', '2014-05-13', 0, NULL, 7);
INSERT INTO `task` VALUES(4, 'Determinación de mercado objetivo', 2, '2014-05-16', '2014-08-19', 0, NULL, 7);
INSERT INTO `task` VALUES(5, 'Ver factibilidad técnica', 4, '2014-05-17', '2014-06-04', 0, NULL, 11);
INSERT INTO `task` VALUES(6, 'Comienzo de operación mercado peruano', 3, '2014-05-17', '2014-10-27', 0, NULL, 7);
INSERT INTO `task` VALUES(7, 'Estudio de mercado', 6, '2014-06-02', '2014-08-28', 0, NULL, 12);
INSERT INTO `task` VALUES(8, 'Curso de capacitación ISO-9001', 7, '2014-06-02', '2014-07-31', 0, NULL, 10);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` VALUES(5, 'christian.oviedo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Christian', 'Oviedo', 1, 2, '2014-05-08 13:34:24', '2014-07-01 09:38:16', NULL, NULL);
INSERT INTO `user` VALUES(6, 'fjmoran@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Francisco José', 'Morán', 1, 2, '2014-05-08 13:34:24', '2014-06-27 14:15:46', NULL, NULL);
INSERT INTO `user` VALUES(9, 'director1@check-it.cl', '21a70a20a394dc2a038843a51a64322b', 'Director 1', 'Empresa', 1, 4, '2014-05-12 10:12:35', '2014-06-17 03:28:29', NULL, NULL);
INSERT INTO `user` VALUES(10, 'director2@check-it.cl', 'c9c25d0280cad37aa512f2394f5baa34', 'Director 2', 'Empresa', 1, 4, '2014-05-12 10:12:45', NULL, NULL, NULL);
INSERT INTO `user` VALUES(18, 'gerente@check-it.cl', '740d9c49b11f3ada7b9112614a54be41', 'Gerente', 'General', 1, 1, '2014-05-30 15:43:02', '2014-06-17 03:28:08', NULL, NULL);
INSERT INTO `user` VALUES(19, 'finanzas@check-it.cl', 'd63d1f46dc616ff29efc6576bc19bc3d', 'Gerente', 'Finanzas', 1, 2, '2014-05-30 15:43:31', '2014-06-02 09:08:18', NULL, NULL);
INSERT INTO `user` VALUES(20, 'marketing@check-it.cl', 'c769c2bd15500dd906102d9be97fdceb', 'Gerente', 'Marketing', 1, 3, '2014-05-30 15:43:56', '2014-06-02 19:13:29', NULL, NULL);
INSERT INTO `user` VALUES(21, 'operaciones@check-it.cl', '527c128fd90c90859a5ca1617a2cd23d', 'Gerente', 'Operaciones', 1, 8, '2014-06-02 20:58:31', NULL, NULL, NULL);
INSERT INTO `user` VALUES(22, 'rrhh@check-it.cl', '89f71c4e9055ee73c3bc372528a54b9c', 'Gerente', 'RRHH', 1, 9, '2014-06-02 21:00:08', NULL, NULL, NULL);
INSERT INTO `user` VALUES(23, 'asesormarketing@check-it.cl', '6a20e01a1604491def7c3b3b9ae5454d', 'Asesor', 'Marketing', 1, 11, '2014-06-02 21:01:47', NULL, NULL, NULL);
INSERT INTO `user` VALUES(24, 'asesoroperaciones@check-it.cl', '482ef9d2cf35e966dfcaa8f4eaa76786', 'Asesor', 'Operaciones', 1, 12, '2014-06-02 21:08:51', NULL, NULL, NULL);
INSERT INTO `user` VALUES(25, 'asesorrrhh@check-it.cl', 'c4ac719461d9cacd6e75507afdd9c621', 'Asesor', 'RRHH', 1, 10, '2014-06-02 21:09:52', NULL, NULL, NULL);
INSERT INTO `user` VALUES(26, 'asesorfinanzas@check-it.cl', '4cd2440705e2ddbf9e9c044851c4f93c', 'Asesor', 'Finanzas', 1, 7, '2014-06-02 21:10:53', NULL, NULL, NULL);

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
INSERT INTO `user_role` VALUES(5, 2);
INSERT INTO `user_role` VALUES(5, 3);
INSERT INTO `user_role` VALUES(5, 4);
INSERT INTO `user_role` VALUES(6, 1);
INSERT INTO `user_role` VALUES(6, 4);
INSERT INTO `user_role` VALUES(9, 2);
INSERT INTO `user_role` VALUES(9, 4);
INSERT INTO `user_role` VALUES(10, 2);
INSERT INTO `user_role` VALUES(18, 2);
INSERT INTO `user_role` VALUES(18, 4);
INSERT INTO `user_role` VALUES(19, 2);
INSERT INTO `user_role` VALUES(19, 4);
INSERT INTO `user_role` VALUES(20, 2);
INSERT INTO `user_role` VALUES(20, 4);
INSERT INTO `user_role` VALUES(21, 2);
INSERT INTO `user_role` VALUES(21, 4);
INSERT INTO `user_role` VALUES(22, 2);
INSERT INTO `user_role` VALUES(22, 4);
INSERT INTO `user_role` VALUES(23, 2);
INSERT INTO `user_role` VALUES(23, 4);
INSERT INTO `user_role` VALUES(24, 2);
INSERT INTO `user_role` VALUES(24, 4);
INSERT INTO `user_role` VALUES(25, 2);
INSERT INTO `user_role` VALUES(25, 4);
INSERT INTO `user_role` VALUES(26, 2);
INSERT INTO `user_role` VALUES(26, 4);

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
-- Constraints for table `process_connector`
--
ALTER TABLE `process_connector`
  ADD CONSTRAINT `process_connector_ibfk_2` FOREIGN KEY (`target_task_id`) REFERENCES `process_task` (`id`),
  ADD CONSTRAINT `process_connector_ibfk_1` FOREIGN KEY (`source_task_id`) REFERENCES `process_task` (`id`);

--
-- Constraints for table `process_task`
--
ALTER TABLE `process_task`
  ADD CONSTRAINT `process_task_ibfk_1` FOREIGN KEY (`process_id`) REFERENCES `process` (`id`);

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`);

--
-- Constraints for table `subproject`
--
ALTER TABLE `subproject`
  ADD CONSTRAINT `subproject_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `subproject_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`subproject_id`) REFERENCES `subproject` (`id`),
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`);

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
