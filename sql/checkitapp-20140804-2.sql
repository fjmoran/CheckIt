-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 04, 2014 at 06:59 PM
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
  `root` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` VALUES(1, 4, 2, 19, 2, 'Gerencia General');
INSERT INTO `department` VALUES(2, 4, 3, 6, 3, 'Gerencia Finanzas');
INSERT INTO `department` VALUES(3, 4, 7, 10, 3, 'Gerencia Marketing');
INSERT INTO `department` VALUES(4, NULL, 1, 23, 1, 'Dirección');
INSERT INTO `department` VALUES(7, 4, 4, 5, 4, 'Contabilidad');
INSERT INTO `department` VALUES(8, 4, 11, 14, 3, 'Gerencia Operaciones');
INSERT INTO `department` VALUES(9, 4, 15, 18, 3, 'Gerencia RR.HH.');
INSERT INTO `department` VALUES(10, 4, 16, 17, 4, 'Remuneraciones');
INSERT INTO `department` VALUES(11, 4, 8, 9, 4, 'Marketing Digital');
INSERT INTO `department` VALUES(12, 4, 12, 13, 4, 'Producción');
INSERT INTO `department` VALUES(13, 4, 20, 21, 2, 'Prueba');

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
  `root` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `calculation` varchar(1000) NOT NULL,
  `subproject_id` int(11) NOT NULL,
  `base_date` date NOT NULL,
  `goal_date` date NOT NULL,
  `base_value` float NOT NULL,
  `goal_value` float NOT NULL,
  `unit` varchar(100) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `update_frequency` int(11) NOT NULL,
  `review_frequency` int(11) NOT NULL,
  `weight` float NOT NULL,
  `measuring` int(11) NOT NULL,
  `function` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subproject_id` (`subproject_id`),
  KEY `department_id` (`department_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `kpi`
--

INSERT INTO `kpi` VALUES(9, 9, 1, 2, 1, 'Porcentaje de Satisfacción del cliente', 'Porcentaje de Satisfacción del cliente', 4, '2014-06-02', '2015-04-15', 60, 80, '%', NULL, 3, NULL, 0, 0, 0, 0, 0);
INSERT INTO `kpi` VALUES(10, 10, 1, 2, 1, 'Tasa de referidos', 'Tasa de referidos', 4, '2014-06-02', '2015-06-02', 1300, 2500, 'personas', NULL, 3, NULL, 0, 0, 0, 0, 0);
INSERT INTO `kpi` VALUES(11, 11, 1, 4, 1, 'Errores por millon', 'Errores por millon', 5, '2014-06-02', '2015-06-02', 12, 4, 'unidades por millon', NULL, 8, NULL, 0, 0, 0, 0, 0);
INSERT INTO `kpi` VALUES(12, 12, 1, 2, 1, 'Porcentaje de entrega a tiempo', 'Porcentaje de entrega a tiempo', 5, '2014-06-02', '2015-06-02', 92, 98, '%', NULL, 8, NULL, 0, 0, 0, 0, 0);
INSERT INTO `kpi` VALUES(13, 13, 1, 2, 1, 'Rentabilidad por cliente', 'Rentabilidad por cliente', 1, '2014-06-02', '2015-06-02', 1500, 2500, 'USD', '2014-07-29 10:55:50', 2, NULL, 0, 0, 0, 0, 0);
INSERT INTO `kpi` VALUES(14, 14, 1, 2, 1, 'Crecimiento en ventas', 'Crecimiento en ventas', 3, '2014-06-02', '2015-06-02', 10, 25, '% anual', '2014-06-03 07:33:13', 2, NULL, 0, 0, 0, 0, 0);
INSERT INTO `kpi` VALUES(15, 15, 1, 2, 1, 'Cantidad de accidentes', 'Cantidad de accidentes/Tiempo', 5, '2014-06-02', '2015-06-02', 8, 2, 'accidentes por año', NULL, 9, NULL, 0, 0, 1, 0, 0);
INSERT INTO `kpi` VALUES(16, 16, 1, 2, 1, 'Obsolescencia de equipos informáticos ', 'Obsolescencia de equipos informáticos ', 7, '2014-06-02', '2015-06-02', 25, 5, '%', '2014-06-03 15:05:24', 9, NULL, 0, 0, 0, 0, 0);
INSERT INTO `kpi` VALUES(17, 11, 2, 3, 2, 'Sub errores por millón 2', 'errores/tiempo', 5, '2014-04-08', '2015-05-13', 10, 3, 'porcentaje', NULL, 12, NULL, 0, 0, 1.5, 1, 0);
INSERT INTO `kpi` VALUES(18, 18, 1, 6, 1, 'kpi de prueba', 'kpi', 7, '2014-08-01', '2014-08-29', 100, 200, 'kpi', NULL, 4, NULL, 0, 0, 1, 0, 0);
INSERT INTO `kpi` VALUES(19, 18, 3, 4, 3, 'kpi de prueba 2-', 'kljsdfkljsdf', 7, '2014-08-08', '2014-08-22', 1, 2, 'ssdf', NULL, NULL, 10, 0, 0, 1, 0, 0);
INSERT INTO `kpi` VALUES(20, 18, 2, 5, 2, 'kpi de prueba 3', 'sdlkfjsdlfkjsdf', 7, '2014-08-06', '2014-08-22', 2, 5, 'dfdksjhf', NULL, NULL, 22, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `option`
--

CREATE TABLE `option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(1000) NOT NULL,
  `filter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `option`
--

INSERT INTO `option` VALUES(1, 'project_name', 'Perspectiva', 0);
INSERT INTO `option` VALUES(2, 'projects_name', 'Perspectivas', 0);
INSERT INTO `option` VALUES(3, 'subproject_name', 'Objetivo Estratégico', 0);
INSERT INTO `option` VALUES(4, 'subprojects_name', 'Objetivos Estratégicos', 0);
INSERT INTO `option` VALUES(5, 'task_name', 'Hito', 0);
INSERT INTO `option` VALUES(6, 'tasks_name', 'Hitos', 0);
INSERT INTO `option` VALUES(7, 'department_name', 'Área', 0);
INSERT INTO `option` VALUES(8, 'departments_name', 'Áreas', 0);
INSERT INTO `option` VALUES(9, 'manager_name', 'Encargado', 0);
INSERT INTO `option` VALUES(10, 'managers_name', 'Encargados', 0);
INSERT INTO `option` VALUES(11, 'kpi_yellow', '100', 0);
INSERT INTO `option` VALUES(12, 'kpi_red', '0', 0);
INSERT INTO `option` VALUES(13, 'table_rows', '10', 0);
INSERT INTO `option` VALUES(14, 'mision', 'Generar, desarrollar, asimilar y aplicar el conocimiento científico y tecnológico, promover la formación de recursos humanos especializados para apoyar a la industria petrolera nacional y contribuir al desarrollo sostenido y sustentable del país.', 1);
INSERT INTO `option` VALUES(15, 'vision', 'Ser una institución dedicada en lo fundamental a la investigación y al desarrollo tecnológico, centrada en la generación de conocimientos y habilidades críticas para la industria petrolera, que transforme el conocimiento en realidades industriales, que ofrezca y comercialice servicios y productos de calidad y con alto contenido tecnológico, organizada para responder con agilidad al cambio y capaz de mantener su autosuficiencia financiera.', 1);

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
  `friendly_name` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `pos` int(11) NOT NULL,
  `start_page` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` VALUES(1, 'admin', 'Administrador de sistema', 'Tiene acceso a todas las funcionalidades del sistema incluidas las de front y backend', 13, 'user/admin', 0);
INSERT INTO `role` VALUES(2, 'strategy_admin', 'Administrador de gestión estratégica', 'Tiene acceso al backend para configurar perspectivas, objetivos estratégicos, hitos y KPI.', 8, 'project/admin', 1);
INSERT INTO `role` VALUES(3, 'workflow_admin', 'Administrador de flujos de proceso', 'Tiene acceso al backend para configurar flujos de proceso y administrar grupos.', 9, 'process/admin', 1);
INSERT INTO `role` VALUES(4, 'dashboard_admin', 'Administrador de cuadros de mando', 'Tiene acceso al backend para definir los grupos que pueden visualizar cada reporte o cuadro de mando, y configurar los reportes de sistema.', 10, '', 1);
INSERT INTO `role` VALUES(5, 'strategy_manager', 'Encargado gestión estratégica', 'Tiene acceso al frontend de gestión estratégica, puede ver todas las perspectivas, Objetivos estratégicos, Hitos, Sub hitos, KPI y sub KPI y editar su contenido para todo su nivel jerárquico.', 5, 'project/myprojects', 1);
INSERT INTO `role` VALUES(6, 'strategy_user', 'Usuario gestión estratégica', 'Tiene acceso al frontend de gestión estratégica, puede ver las Perspectivas y Objetivos donde posea Hitos, Sub hitos, KPI y sub KPI y puede modificarlos (solo puede modificar los que tiene asignados).', 1, 'project/myprojects', 0);
INSERT INTO `role` VALUES(7, 'workflow_manager', 'Encargado flujos de proceso', 'Tiene acceso al frontend de flujos de proceso puede ver y reasignar todas las instancias de los flujos en ejecución, puede iniciar los flujos a los cuales pertenece y puede gestionar su inbox.', 6, '', 1);
INSERT INTO `role` VALUES(8, 'workflow_user', 'Usuario flujos de proceso', 'Tiene acceso al frontend de flujos de proceso, puede iniciar los flujos a los cuales pertenece y puede gestionar su inbox.', 2, '', 0);
INSERT INTO `role` VALUES(9, 'dashboard_manager', 'Encargado cuadros de mando', 'Tiene acceso al frontend de cuadros de mando puede visualizar todos los cuadros definidos con toda su información independiente de su nivel jerárquico.', 7, 'site/report', 1);
INSERT INTO `role` VALUES(10, 'dashboard_user', 'Usuario cuadros de mando', 'Tiene acceso al frontend de cuadros de mando y puede visualizar los cuadros que le han sido asignados, la información a visualizar depende de su nivel jerárquico.', 3, 'site/report', 0);
INSERT INTO `role` VALUES(11, 'viewer', 'Visualizador global', 'Tiene acceso al frontend de gestión estratégica, flujos de trabajo y cuadros de mando puede visualizar toda la información pero no puede modificarla. Puede gestionar su inbox e iniciar los flujos a los cuales pertenece', 11, 'site/report', 1);
INSERT INTO `role` VALUES(12, 'system_admin', 'Administrador de usuarios', 'Puede administrar usuarios, departamentos y grupos.', 12, 'user/admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subproject`
--

CREATE TABLE `subproject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `weight` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `subproject`
--

INSERT INTO `subproject` VALUES(1, 'Maximizar la rentabilidad', 1, 2, 1);
INSERT INTO `subproject` VALUES(2, 'Crecer a través de nuevos productos', 1, 2, 1);
INSERT INTO `subproject` VALUES(3, 'Crecer en el mercado internacional', 1, 2, 1);
INSERT INTO `subproject` VALUES(4, 'Ofrecer productos innovadores con alto valor nutritivo', 2, 3, 1);
INSERT INTO `subproject` VALUES(5, 'Implementar procesos de innovación de productos', 3, 8, 1);
INSERT INTO `subproject` VALUES(6, 'Contar con información sobre inteligencia de mercado', 3, 8, 1);
INSERT INTO `subproject` VALUES(7, 'Incrementar la capacitación del personal', 4, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `root` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subproject_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` int(11) NOT NULL,
  `end_date` date DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subproject_id` (`subproject_id`),
  KEY `department_id` (`department_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` VALUES(1, 1, 1, 4, 1, 'Análisis de necesidades de clientes', 2, '2014-05-08', '2014-06-20', 0, NULL, 7, NULL);
INSERT INTO `task` VALUES(2, 2, 1, 2, 1, 'Definición de lugar planta distribución', 3, '2014-05-14', '2014-07-30', 1, '2014-05-17', 7, NULL);
INSERT INTO `task` VALUES(3, 3, 1, 2, 1, 'Análisis mercado peruano', 3, '2014-03-04', '2014-05-13', 0, NULL, 7, NULL);
INSERT INTO `task` VALUES(4, 4, 1, 2, 1, 'Determinación de mercado objetivo', 2, '2014-05-16', '2014-08-19', 0, NULL, 7, NULL);
INSERT INTO `task` VALUES(5, 5, 1, 2, 1, 'Ver factibilidad técnica', 4, '2014-05-17', '2014-06-04', 0, NULL, 11, NULL);
INSERT INTO `task` VALUES(6, 6, 1, 2, 1, 'Comienzo de operación mercado peruano', 3, '2014-05-17', '2014-10-27', 0, NULL, 7, NULL);
INSERT INTO `task` VALUES(7, 7, 1, 2, 1, 'Estudio de mercado', 6, '2014-06-02', '2014-08-28', 0, NULL, 12, NULL);
INSERT INTO `task` VALUES(8, 8, 1, 2, 1, 'Curso de capacitación ISO-9001', 7, '2014-06-02', '2014-07-31', 0, NULL, NULL, 5);
INSERT INTO `task` VALUES(9, 1, 2, 3, 2, 'Sub análisis de necesidades de clientes', 2, '2014-06-03', '2014-06-20', 0, NULL, 1, NULL);

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

INSERT INTO `user` VALUES(5, 'christian.oviedo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Christian', 'Oviedo', 1, 'Gerente de Finanzas', '2014-05-08 13:34:24', '2014-07-29 15:10:24', NULL, NULL, 2, 1);
INSERT INTO `user` VALUES(6, 'fjmoran@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Francisco José', 'Morán', 1, 'Gerente de Operaciones', '2014-05-08 13:34:24', '2014-08-01 18:00:58', NULL, NULL, 8, 1);
INSERT INTO `user` VALUES(9, 'director1@check-it.cl', '81dc9bdb52d04dc20036dbd8313ed055', 'José', 'Andrade', 1, 'Presidente del directorio', '2014-05-12 10:12:35', '2014-06-17 03:28:29', NULL, NULL, 4, 1);
INSERT INTO `user` VALUES(10, 'director2@check-it.cl', '81dc9bdb52d04dc20036dbd8313ed055', 'Gastón', 'Jimenez', 1, 'Director', '2014-05-12 10:12:45', NULL, NULL, NULL, 4, 0);
INSERT INTO `user` VALUES(18, 'gerente@check-it.cl', '81dc9bdb52d04dc20036dbd8313ed055', 'Roberto', 'Gomez', 1, 'Gerente General', '2014-05-30 15:43:02', '2014-06-17 03:28:08', NULL, NULL, 1, 1);
INSERT INTO `user` VALUES(20, 'marketing@check-it.cl', '81dc9bdb52d04dc20036dbd8313ed055', 'Alejandro', 'Pizarro', 1, 'Gerente de Marketing', '2014-05-30 15:43:56', '2014-06-02 19:13:29', NULL, NULL, 3, 1);
INSERT INTO `user` VALUES(22, 'rrhh@check-it.cl', '81dc9bdb52d04dc20036dbd8313ed055', 'Felipe', 'Díaz', 1, 'Gerente de RRHH', '2014-06-02 21:00:08', NULL, NULL, NULL, 9, 1);
INSERT INTO `user` VALUES(23, 'asesormarketing@check-it.cl', '81dc9bdb52d04dc20036dbd8313ed055', 'Pablo', 'Sanhueza', 1, 'Asesor de marketing', '2014-06-02 21:01:47', NULL, NULL, NULL, 3, 0);
INSERT INTO `user` VALUES(24, 'asesoroperaciones@check-it.cl', '81dc9bdb52d04dc20036dbd8313ed055', 'Nelson', 'Figueroa', 1, 'Asesor operaciones', '2014-06-02 21:08:51', NULL, NULL, NULL, 8, 0);
INSERT INTO `user` VALUES(25, 'asesorrrhh@check-it.cl', '81dc9bdb52d04dc20036dbd8313ed055', 'Carlos', 'Olivos', 1, 'Asesor RR.HH.', '2014-06-02 21:09:52', NULL, NULL, NULL, 9, 0);
INSERT INTO `user` VALUES(26, 'asesorfinanzas@check-it.cl', '81dc9bdb52d04dc20036dbd8313ed055', 'Andrea', 'Ramírez', 1, 'Asesor finanzas', '2014-06-02 21:10:53', NULL, NULL, NULL, 2, 0);

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

INSERT INTO `user_role` VALUES(5, 2);
INSERT INTO `user_role` VALUES(5, 6);
INSERT INTO `user_role` VALUES(5, 10);
INSERT INTO `user_role` VALUES(6, 1);
INSERT INTO `user_role` VALUES(9, 2);
INSERT INTO `user_role` VALUES(9, 4);
INSERT INTO `user_role` VALUES(10, 2);
INSERT INTO `user_role` VALUES(18, 2);
INSERT INTO `user_role` VALUES(18, 4);
INSERT INTO `user_role` VALUES(20, 2);
INSERT INTO `user_role` VALUES(20, 4);
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
  ADD CONSTRAINT `kpi_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `kpi_ibfk_1` FOREIGN KEY (`subproject_id`) REFERENCES `subproject` (`id`),
  ADD CONSTRAINT `kpi_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);

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
  ADD CONSTRAINT `subproject_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `subproject_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`subproject_id`) REFERENCES `subproject` (`id`),
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);
