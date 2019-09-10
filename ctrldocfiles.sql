-- --------------------------------------------------------
-- Host:                         192.168.1.33
-- Versión del servidor:         10.1.38-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para ctrldocsdb
CREATE DATABASE IF NOT EXISTS `ctrldocsdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `ctrldocsdb`;

-- Volcando estructura para tabla ctrldocsdb.tb_account_state
CREATE TABLE IF NOT EXISTS `tb_account_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(15) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ctrldocsdb.tb_casefiles
CREATE TABLE IF NOT EXISTS `tb_casefiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) NOT NULL,
  `id_type` int(11) DEFAULT NULL,
  `description` int(11) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `finish_date` timestamp NULL DEFAULT NULL,
  `start_user_id` int(11) NOT NULL,
  `finish_user_id` int(11) DEFAULT NULL,
  `casefile_state` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tb_casefiles_tb_clients` (`id_client`),
  KEY `FK_tb_casefiles_tb_users` (`start_user_id`),
  CONSTRAINT `FK_tb_casefiles_tb_clients` FOREIGN KEY (`id_client`) REFERENCES `tb_clients` (`id`),
  CONSTRAINT `FK_tb_casefiles_tb_users` FOREIGN KEY (`start_user_id`) REFERENCES `tb_users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ctrldocsdb.tb_casefiles_document
CREATE TABLE IF NOT EXISTS `tb_casefiles_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_casefile` int(11) NOT NULL,
  `id_document` int(11) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tb_casefiles_document_tb_casefiles` (`id_casefile`),
  KEY `FK_tb_casefiles_document_tb_main_document` (`id_document`),
  CONSTRAINT `FK_tb_casefiles_document_tb_casefiles` FOREIGN KEY (`id_casefile`) REFERENCES `tb_casefiles` (`id`),
  CONSTRAINT `FK_tb_casefiles_document_tb_main_document` FOREIGN KEY (`id_document`) REFERENCES `tb_main_document` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ctrldocsdb.tb_casefiles_state
CREATE TABLE IF NOT EXISTS `tb_casefiles_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(15) NOT NULL DEFAULT '0',
  `value` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ctrldocsdb.tb_casefiles_type
CREATE TABLE IF NOT EXISTS `tb_casefiles_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;


-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ctrldocsdb.tb_clients
CREATE TABLE IF NOT EXISTS `tb_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cif` varchar(15) NOT NULL,
  `code` varchar(15) DEFAULT NULL,
  `description` varchar(15) NOT NULL,
  `address` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT '',
  `phone` varchar(50) DEFAULT '',
  `notes` varchar(50) DEFAULT '',
  `type_client` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tb_clients_tb_client_type` (`type_client`),
  CONSTRAINT `FK_tb_clients_tb_client_type` FOREIGN KEY (`type_client`) REFERENCES `tb_client_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ctrldocsdb.tb_client_type
CREATE TABLE IF NOT EXISTS `tb_client_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(250) NOT NULL,
  `notes` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ctrldocsdb.tb_document_state
CREATE TABLE IF NOT EXISTS `tb_document_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(250) NOT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ctrldocsdb.tb_document_type
CREATE TABLE IF NOT EXISTS `tb_document_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ctrldocsdb.tb_main_document
CREATE TABLE IF NOT EXISTS `tb_main_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_type` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `document_code` varchar(50) DEFAULT NULL,
  `description` varchar(250) NOT NULL,
  `filename` varchar(250) NOT NULL,
  `document_date` date DEFAULT NULL,
  `period_start_date` date DEFAULT NULL,
  `period_finish_date` date DEFAULT NULL,
  `value` decimal(10,0) DEFAULT NULL,
  `main_doc_id` int(11) DEFAULT NULL,
  `place_details_id` int(11) NOT NULL, -- ID lugar fisico donde se guardara la documentacion
  `place_details_obs` varchar(250) NOT NULL,
  `user_upload_id` int(11) NOT NULL,
  `document_state` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ctrldocsdb.tb_users
CREATE TABLE IF NOT EXISTS `tb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(50) NOT  NULL,
  `email` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `login` varchar(15) NOT NULL,
  `password` varchar(250) NOT NULL,
  `keyaccess` varchar(15) DEFAULT NULL,
  `type_level` int(11) NOT NULL,
  `account_state` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_tb_users_tb_account_state` (`account_state`),
  KEY `FK_tb_users_tb_user_level` (`type_level`),
  CONSTRAINT `FK_tb_users_tb_account_state` FOREIGN KEY (`account_state`) REFERENCES `tb_account_state` (`id`),
  CONSTRAINT `FK_tb_users_tb_user_level` FOREIGN KEY (`type_level`) REFERENCES `tb_user_level` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.
-- Volcando estructura para tabla ctrldocsdb.tb_user_level
CREATE TABLE IF NOT EXISTS `tb_user_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

INSERT IGNORE INTO `tb_account_state` (`id`, `description`, `value`) VALUES
	(1, 'Activo', NULL),
	(2, 'Inactivo', NULL),
	(3, 'Suspendida', NULL);

  INSERT IGNORE INTO `tb_casefiles_state` (`id`, `description`, `value`) VALUES
	(1, 'Abierto', 0),
	(2, 'Cerrado', 0),
	(3, 'Revision', 0),
	(4, 'Auditoria', 0);

  INSERT IGNORE INTO `tb_casefiles_type` (`id`, `description`) VALUES
	(1, 'CONTRATO'),
	(2, 'ADENDA'),
	(3, 'EXTENSION'),
	(4, 'ORDEN DE SERVICIO'),
	(5, 'FACTURA'),
	(6, 'COMPROBANTE'),
	(7, 'CONFORMIDAD'),
	(8, 'COFORMIDAD PARCIAL');

  INSERT IGNORE INTO `tb_client_type` (`id`, `description`, `notes`) VALUES
	(1, 'Empresa Unipersonal', NULL),
	(2, 'Empresa Individual de Responsabilidad Limitada (E.I.R.L.)', NULL),
	(3, 'Sociedad Anónima (S.A.)', NULL),
	(4, 'Sociedad Anónima Abierta (S.A.A.)', NULL),
	(5, 'Sociedad Anónima Cerrada (S.A.C.)', NULL),
	(6, 'Sociedad Comercial de Responsabilidad Limitada (S.R.L.)', NULL);

  INSERT IGNORE INTO `tb_document_state` (`id`, `description`, `value`) VALUES
	(1, 'IDENTICO AL ORIGINAL', NULL),
	(2, 'DEBE SER REVISADO EN FISICO', NULL),
	(3, 'NO SE ENCUENTRA FISICO', NULL);

  INSERT IGNORE INTO `tb_document_type` (`id`, `description`) VALUES
	(1, 'CONTRATO'),
	(2, 'ADENDA'),
	(3, 'EXTENSION'),
	(4, 'ORDEN DE SERVICIO'),
	(5, 'FACTURA'),
	(6, 'COMPROBANTE'),
	(7, 'CONFORMIDAD'),
	(8, 'COFORMIDAD PARCIAL');