-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2014 at 08:38 PM
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
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` VALUES(1, 'Gerencia General', 4);
INSERT INTO `department` VALUES(2, 'Gerencia Finanzas', 1);
INSERT INTO `department` VALUES(3, 'Gerencia Marketing', 1);
INSERT INTO `department` VALUES(4, 'Dirección', NULL);
INSERT INTO `department` VALUES(7, 'Contabilidad', 2);
INSERT INTO `department` VALUES(8, 'Gerencia Operaciones', 1);
INSERT INTO `department` VALUES(9, 'Gerencia RR.HH.', 1);
INSERT INTO `department` VALUES(10, 'Remuneraciones', 9);
INSERT INTO `department` VALUES(11, 'Marketing Digital', 3);
INSERT INTO `department` VALUES(12, 'Producción', 8);

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `process_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `process_id` (`process_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `form`
--

INSERT INTO `form` VALUES(2, 'Datos de contacto', 1);
INSERT INTO `form` VALUES(3, 'Aplica', 1);
INSERT INTO `form` VALUES(4, 'Adjunta cotización', 1);
INSERT INTO `form` VALUES(5, 'Actualizar CRM', 1);
INSERT INTO `form` VALUES(6, 'Minuta', 2);

-- --------------------------------------------------------

--
-- Table structure for table `form_field`
--

CREATE TABLE `form_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `process_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_id` (`process_id`),
  KEY `process_id` (`process_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `form_field`
--

INSERT INTO `form_field` VALUES(1, 'Empresa', 2, 'empresa', 0);
INSERT INTO `form_field` VALUES(2, 'Nombre Contacto', 2, 'contacto', 0);
INSERT INTO `form_field` VALUES(4, 'Descripción', 1, 'descripcion', 1);
INSERT INTO `form_field` VALUES(5, 'Fecha entrega', 1, 'fecha_entrega', 2);
INSERT INTO `form_field` VALUES(6, 'Aplica', 1, 'aplica', 3);
INSERT INTO `form_field` VALUES(7, 'Adjuntar cotización', 1, 'adjuntar_cotizacion', 5);
INSERT INTO `form_field` VALUES(8, 'Actualizar CRM', 1, 'actualizar_crm', 3);
INSERT INTO `form_field` VALUES(9, 'Empresa', 1, 'empresa', 0);
INSERT INTO `form_field` VALUES(10, 'Nombre Contacto', 1, 'nombre_contacto', 0);
INSERT INTO `form_field` VALUES(11, 'Minuta', 2, 'minuta', 1);
INSERT INTO `form_field` VALUES(12, 'campo nuevo', 1, 'campo_nuevo', 0);

-- --------------------------------------------------------

--
-- Table structure for table `form_field_option`
--

CREATE TABLE `form_field_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `form_field_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_field_id` (`form_field_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `form_field_option`
--

INSERT INTO `form_field_option` VALUES(1, 'Si', 6, 1);
INSERT INTO `form_field_option` VALUES(2, 'No', 6, 2);
INSERT INTO `form_field_option` VALUES(4, 'Si', 8, 1);
INSERT INTO `form_field_option` VALUES(5, 'No', 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `form_property`
--

CREATE TABLE `form_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `form_field_id` int(11) NOT NULL,
  `visible` int(11) NOT NULL,
  `required` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_field` (`form_id`,`form_field_id`),
  KEY `form_id` (`form_id`),
  KEY `form_field_id` (`form_field_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `form_property`
--

INSERT INTO `form_property` VALUES(5, 2, 4, 0, 0, 3);
INSERT INTO `form_property` VALUES(6, 2, 5, 0, 0, 4);
INSERT INTO `form_property` VALUES(7, 3, 6, 0, 1, 1);
INSERT INTO `form_property` VALUES(8, 4, 7, 0, 1, 1);
INSERT INTO `form_property` VALUES(9, 5, 8, 0, 1, 1);
INSERT INTO `form_property` VALUES(10, 2, 9, 0, 0, 1);
INSERT INTO `form_property` VALUES(11, 2, 10, 0, 0, 2);
INSERT INTO `form_property` VALUES(12, 6, 1, 0, 1, 1);
INSERT INTO `form_property` VALUES(13, 6, 2, 0, 0, 2);
INSERT INTO `form_property` VALUES(14, 6, 11, 0, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` VALUES(1, 'Grupo 1');
INSERT INTO `group` VALUES(3, 'Grupo 2');

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
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subproject_id` (`subproject_id`),
  KEY `department_id` (`department_id`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `option`
--

INSERT INTO `option` VALUES(1, 'project_name', 'Perspectiva');
INSERT INTO `option` VALUES(2, 'projects_name', 'Perspectivas');
INSERT INTO `option` VALUES(3, 'subproject_name', 'Objetivo Estratégico');
INSERT INTO `option` VALUES(4, 'subprojects_name', 'Objetivos Estratégicos');
INSERT INTO `option` VALUES(5, 'task_name', 'Hito');
INSERT INTO `option` VALUES(6, 'tasks_name', 'Hitos');
INSERT INTO `option` VALUES(7, 'department_name', 'Área');
INSERT INTO `option` VALUES(8, 'departments_name', 'Áreas');

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

INSERT INTO `process` VALUES(1, 'Cotización Check!It');
INSERT INTO `process` VALUES(2, 'Proceso número 2');

-- --------------------------------------------------------

--
-- Table structure for table `process_connector`
--

CREATE TABLE `process_connector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_task_id` int(11) NOT NULL,
  `target_task_id` int(11) NOT NULL,
  `process_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `source_task_id_2` (`source_task_id`,`target_task_id`),
  KEY `target_task_id` (`target_task_id`),
  KEY `source_task_id` (`source_task_id`),
  KEY `process_id` (`process_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `process_connector`
--

INSERT INTO `process_connector` VALUES(46, 76, 70, 1, 0);
INSERT INTO `process_connector` VALUES(67, 70, 64, 1, 1);
INSERT INTO `process_connector` VALUES(81, 65, 76, 1, 2);
INSERT INTO `process_connector` VALUES(83, 76, 64, 1, 2);
INSERT INTO `process_connector` VALUES(85, 89, 91, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `process_step`
--

CREATE TABLE `process_step` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process_task_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `process_task_id` (`process_task_id`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `process_step`
--

INSERT INTO `process_step` VALUES(30, 89, 6, 1);
INSERT INTO `process_step` VALUES(31, 70, 2, 1);
INSERT INTO `process_step` VALUES(32, 65, 2, 1);

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
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `process_id` (`process_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `process_task`
--

INSERT INTO `process_task` VALUES(64, 'Actualizar CRM', 1, 540, 420, 2);
INSERT INTO `process_task` VALUES(65, 'Formulario Solicitud', 1, 220, 60, 1);
INSERT INTO `process_task` VALUES(70, 'Enviar Cotización', 1, 220, 260, 0);
INSERT INTO `process_task` VALUES(76, 'Calificación de Prospecto', 1, 400, 160, 3);
INSERT INTO `process_task` VALUES(89, 'Crear minuta', 2, 60, 80, 1);
INSERT INTO `process_task` VALUES(91, 'Enviar al cliente', 2, 60, 280, 2);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` VALUES(1, 'Financiera', 4);
INSERT INTO `project` VALUES(2, 'Clientes', 8);
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
  `department_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `department_id` (`department_id`)
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
  `department_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subproject_id` (`subproject_id`),
  KEY `department_id` (`department_id`)
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
  `position` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `lastvisit` datetime DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_created` datetime DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `manager` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` VALUES(5, 'christian.oviedo@gmail.com', '863d49dc9c2cc6d2c8582d307ede6dec', 'Christian', 'Oviedo', 1, '2', '2014-05-08 13:34:24', '2014-07-28 14:28:57', NULL, NULL, 2, 0);
INSERT INTO `user` VALUES(6, 'fjmoran@gmail.com', 'ec6a6536ca304edf844d1d248a4f08dc', 'Francisco José', 'Morán', 0, 'Gerente de Operaciones', '2014-05-08 13:34:24', '2014-06-27 14:15:46', NULL, NULL, NULL, 0);
INSERT INTO `user` VALUES(9, 'director1@check-it.cl', '39e01d1f1a8f8beeb91cb68a6e7f174f', 'Director 1', 'Empresa', 1, '4', '2014-05-12 10:12:35', '2014-06-17 03:28:29', NULL, NULL, NULL, 0);
INSERT INTO `user` VALUES(10, 'director2@check-it.cl', '90dfec638047d4195aded882f988e346', 'Director 2', 'Empresa', 1, '4', '2014-05-12 10:12:45', NULL, NULL, NULL, NULL, 0);
INSERT INTO `user` VALUES(18, 'gerente@check-it.cl', '45a45319441619325ef8d2a24413f9ea', 'Gerente', 'General', 1, '1', '2014-05-30 15:43:02', '2014-06-17 03:28:08', NULL, NULL, 1, 1);
INSERT INTO `user` VALUES(19, 'finanzas@check-it.cl', '4cc7a491f5d70596b919210a4e3d6df2', 'Gerente', 'Finanzas', 1, '2', '2014-05-30 15:43:31', '2014-06-02 09:08:18', NULL, NULL, 2, 1);
INSERT INTO `user` VALUES(20, 'marketing@check-it.cl', 'c769c2bd15500dd906102d9be97fdceb', 'Gerente', 'Marketing', 1, '3', '2014-05-30 15:43:56', '2014-06-02 19:13:29', NULL, NULL, NULL, 0);
INSERT INTO `user` VALUES(21, 'operaciones@check-it.cl', '527c128fd90c90859a5ca1617a2cd23d', 'Gerente', 'Operaciones', 1, '8', '2014-06-02 20:58:31', NULL, NULL, NULL, NULL, 0);
INSERT INTO `user` VALUES(22, 'rrhh@check-it.cl', '89f71c4e9055ee73c3bc372528a54b9c', 'Gerente', 'RRHH', 1, '9', '2014-06-02 21:00:08', NULL, NULL, NULL, NULL, 0);
INSERT INTO `user` VALUES(23, 'asesormarketing@check-it.cl', '6a20e01a1604491def7c3b3b9ae5454d', 'Asesor', 'Marketing', 1, '11', '2014-06-02 21:01:47', NULL, NULL, NULL, NULL, 0);
INSERT INTO `user` VALUES(24, 'asesoroperaciones@check-it.cl', '482ef9d2cf35e966dfcaa8f4eaa76786', 'Asesor', 'Operaciones', 1, '12', '2014-06-02 21:08:51', NULL, NULL, NULL, NULL, 0);
INSERT INTO `user` VALUES(25, 'asesorrrhh@check-it.cl', 'c4ac719461d9cacd6e75507afdd9c621', 'Asesor', 'RRHH', 1, '10', '2014-06-02 21:09:52', NULL, NULL, NULL, NULL, 0);
INSERT INTO `user` VALUES(26, 'asesorfinanzas@check-it.cl', '4cd2440705e2ddbf9e9c044851c4f93c', 'Asesor', 'Finanzas', 1, '7', '2014-06-02 21:10:53', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`group_id`),
  KEY `user_id_2` (`user_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` VALUES(3, 5, 1);
INSERT INTO `user_group` VALUES(2, 6, 1);
INSERT INTO `user_group` VALUES(4, 20, 1);

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
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `form`
--
ALTER TABLE `form`
  ADD CONSTRAINT `form_ibfk_1` FOREIGN KEY (`process_id`) REFERENCES `process` (`id`);

--
-- Constraints for table `form_field`
--
ALTER TABLE `form_field`
  ADD CONSTRAINT `form_field_ibfk_1` FOREIGN KEY (`process_id`) REFERENCES `process` (`id`);

--
-- Constraints for table `form_field_option`
--
ALTER TABLE `form_field_option`
  ADD CONSTRAINT `form_field_option_ibfk_1` FOREIGN KEY (`form_field_id`) REFERENCES `form_field` (`id`);

--
-- Constraints for table `form_property`
--
ALTER TABLE `form_property`
  ADD CONSTRAINT `form_property_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`),
  ADD CONSTRAINT `form_property_ibfk_2` FOREIGN KEY (`form_field_id`) REFERENCES `form_field` (`id`);

--
-- Constraints for table `kpi`
--
ALTER TABLE `kpi`
  ADD CONSTRAINT `kpi_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `kpi_ibfk_1` FOREIGN KEY (`subproject_id`) REFERENCES `subproject` (`id`);

--
-- Constraints for table `process_connector`
--
ALTER TABLE `process_connector`
  ADD CONSTRAINT `process_connector_ibfk_1` FOREIGN KEY (`source_task_id`) REFERENCES `process_task` (`id`),
  ADD CONSTRAINT `process_connector_ibfk_2` FOREIGN KEY (`target_task_id`) REFERENCES `process_task` (`id`),
  ADD CONSTRAINT `process_connector_ibfk_3` FOREIGN KEY (`process_id`) REFERENCES `process` (`id`);

--
-- Constraints for table `process_step`
--
ALTER TABLE `process_step`
  ADD CONSTRAINT `process_step_ibfk_1` FOREIGN KEY (`process_task_id`) REFERENCES `process_task` (`id`),
  ADD CONSTRAINT `process_step_ibfk_2` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`);

--
-- Constraints for table `process_task`
--
ALTER TABLE `process_task`
  ADD CONSTRAINT `process_task_ibfk_1` FOREIGN KEY (`process_id`) REFERENCES `process` (`id`);

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `subproject`
--
ALTER TABLE `subproject`
  ADD CONSTRAINT `subproject_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `subproject_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`subproject_id`) REFERENCES `subproject` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `user_group`
--
ALTER TABLE `user_group`
  ADD CONSTRAINT `user_group_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_group_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`);

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
