/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.28-MariaDB : Database - academia
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`academia` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `academia`;

/*Table structure for table `alumnos` */

DROP TABLE IF EXISTS `alumnos`;

CREATE TABLE `alumnos` (
  `idalumno` int(11) NOT NULL AUTO_INCREMENT,
  `apellidos` varchar(40) NOT NULL,
  `nombres` varchar(40) NOT NULL,
  `fechanac` date NOT NULL,
  `numerodoc` char(8) NOT NULL,
  `telefono` char(9) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idalumno`),
  UNIQUE KEY `uk_numerodoc_alu` (`numerodoc`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `alumnos` */

insert  into `alumnos`(`idalumno`,`apellidos`,`nombres`,`fechanac`,`numerodoc`,`telefono`,`create_at`,`update_at`,`inactive_at`) values 
(1,'Hernandez Yeren','Yorghet','2003-07-28','72159736','946989937','2023-09-09 13:17:03',NULL,NULL),
(2,'Muñoz Quispe','Alonso','1996-12-26','72159735','920490818','2023-09-09 13:17:17',NULL,'2023-09-10 00:15:32'),
(3,'Yeren','Margarita','1972-08-05','21819126','987456321','2023-09-09 23:51:26',NULL,NULL),
(4,'dskdsldskdslkl','klklksldk','2003-02-20','13123232','946464646','2023-09-09 23:51:38',NULL,'2023-09-10 00:15:27'),
(5,'dsdssdsd','dssd','2015-12-15','89899999','211211556','2023-09-09 23:52:20',NULL,'2023-09-11 21:50:49');

/*Table structure for table `cursos` */

DROP TABLE IF EXISTS `cursos`;

CREATE TABLE `cursos` (
  `idcurso` int(11) NOT NULL AUTO_INCREMENT,
  `nombrecurso` varchar(200) NOT NULL,
  `costo` decimal(7,2) NOT NULL,
  `nivel` char(1) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idcurso`),
  UNIQUE KEY `uk_nombrecurso_cur` (`nombrecurso`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `cursos` */

insert  into `cursos`(`idcurso`,`nombrecurso`,`costo`,`nivel`,`create_at`,`update_at`,`inactive_at`) values 
(1,'Microsoft Office',150.00,'B','2023-09-08 14:25:31',NULL,'2023-09-13 12:07:26'),
(2,'Laravel',250.00,'A','2023-09-08 14:25:35',NULL,NULL),
(3,'Fundamentos de Javascript',180.00,'I','2023-09-08 14:25:41',NULL,NULL),
(5,'SQL Server',250.00,'I','2023-09-13 12:07:00','2023-09-13 12:07:12',NULL);

/*Table structure for table `matriculas` */

DROP TABLE IF EXISTS `matriculas`;

CREATE TABLE `matriculas` (
  `idmatricula` int(11) NOT NULL AUTO_INCREMENT,
  `idcurso` int(11) NOT NULL,
  `idalumno` int(11) NOT NULL,
  `turno` char(1) NOT NULL,
  `observaciones` varchar(100) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idmatricula`),
  KEY `fk_idcurso_mat` (`idcurso`),
  KEY `fk_idalumno_mat` (`idalumno`),
  CONSTRAINT `fk_idalumno_mat` FOREIGN KEY (`idalumno`) REFERENCES `alumnos` (`idalumno`),
  CONSTRAINT `fk_idcurso_mat` FOREIGN KEY (`idcurso`) REFERENCES `cursos` (`idcurso`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `matriculas` */

insert  into `matriculas`(`idmatricula`,`idcurso`,`idalumno`,`turno`,`observaciones`,`create_at`,`update_at`,`inactive_at`) values 
(1,1,1,'M','Todo claro y conciso','2023-09-13 11:33:20',NULL,NULL),
(2,2,1,'T',NULL,'2023-09-13 11:33:20',NULL,'2023-09-13 11:57:54'),
(3,3,1,'N','Todo OK','2023-09-13 11:55:18',NULL,NULL),
(4,2,3,'M',NULL,'2023-09-13 11:55:50',NULL,'2023-09-13 11:57:57');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `apellidos` varchar(30) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `nombreusuario` varchar(15) NOT NULL,
  `claveacceso` varchar(80) NOT NULL,
  `nivelacceso` char(1) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL,
  `inactive_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `uk_nombreusuario_usu` (`nombreusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idusuario`,`apellidos`,`nombres`,`nombreusuario`,`claveacceso`,`nivelacceso`,`create_at`,`update_at`,`inactive_at`) values 
(1,'Hernandez Yerén','Yorghet','YorghetF','$2y$10$ha4wJunp1YzXLZrnEN//uOhfTH115AYyo5OMiEd8V2VAMRKvnf6zm','A','2023-09-13 16:36:06',NULL,NULL),
(2,'Francia Minaya','Jhon','JhonF','$2y$10$Iamy/NETEEUEYL/r0LMtdOkcEeC.Z.z1J3GytarRUMBd8UNc7rSYO','A','2023-09-13 16:36:19',NULL,NULL);

/* Procedure structure for procedure `spu_alumnos_buscar_dni` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_alumnos_buscar_dni` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_alumnos_buscar_dni`(IN _numerodoc CHAR(8))
BEGIN
	SELECT
		ALU.idalumno,
		ALU.numerodoc,	
		CONCAT(apellidos, ' ', nombres) AS datos_alumno
		FROM alumnos ALU
		WHERE ALU.numerodoc = _numerodoc
		AND ALU.inactive_at IS NULL;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_alumnos_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_alumnos_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_alumnos_eliminar`(in idalumno_ int)
begin
	update alumnos
		set inactive_at = now()
		where idalumno = idalumno_;
end */$$
DELIMITER ;

/* Procedure structure for procedure `spu_alumnos_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_alumnos_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_alumnos_listar`()
BEGIN
	select 
		idalumno, apellidos, nombres, fechanac, numerodoc, telefono
		from alumnos
		where inactive_at is null
		order by idalumno;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_alumnos_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_alumnos_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_alumnos_registrar`(
	in apellidos_			varchar(40),
	in nombres_				varchar(40),
	in fechanac_			date,
	IN numerodoc_			CHAR(8),
	in telefono_			char(9)
)
BEGIN
	insert into alumnos (apellidos, nombres, fechanac, numerodoc, telefono)
	VALUES (apellidos_, nombres_, fechanac_, numerodoc_, telefono_);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_cursos_actualizar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cursos_actualizar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cursos_actualizar`(
	_idcurso			INT,
	_nombrecurso 	VARCHAR(200),
	_costo 			DECIMAL(7,2),
	_nivel 			CHAR(1)
)
BEGIN
	UPDATE cursos SET
		nombrecurso = _nombrecurso,
		costo = _costo,
		nivel = _nivel,
		update_at = NOW()
	WHERE idcurso = _idcurso;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_cursos_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cursos_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cursos_eliminar`(IN _idcurso INT)
BEGIN
	UPDATE cursos 
		SET inactive_at = NOW()
		WHERE idcurso = _idcurso;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_cursos_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cursos_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cursos_listar`()
BEGIN
	SELECT 
		idcurso, nombrecurso, costo, nivel 
		FROM cursos
		WHERE inactive_at IS NULL
		ORDER BY idcurso;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_cursos_nombres` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cursos_nombres` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cursos_nombres`()
begin
	select 
		idcurso, nombrecurso
		from cursos
		where inactive_at is null
		order by idcurso;
end */$$
DELIMITER ;

/* Procedure structure for procedure `spu_cursos_obtener` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cursos_obtener` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cursos_obtener`(IN _idcurso INT)
BEGIN
	SELECT 
		idcurso, nombrecurso, costo, nivel 
		FROM cursos 
		WHERE idcurso = _idcurso;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_cursos_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cursos_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cursos_registrar`(
	_nombrecurso 	VARCHAR(200),
	_costo 			DECIMAL(7,2),
	_nivel 			CHAR(1)
)
BEGIN
	INSERT INTO cursos (nombrecurso, costo, nivel) VALUES
		(_nombrecurso, _costo, _nivel);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_matriculas_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_matriculas_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_matriculas_eliminar`(IN _idmatricula INT)
BEGIN
	UPDATE matriculas
		SET inactive_at = NOW()
		WHERE idmatricula = _idmatricula;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_matriculas_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_matriculas_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_matriculas_listar`()
BEGIN
	SELECT
	MAT.idmatricula,
	CUR.nombrecurso,
	ALU.apellidos,
	ALU.nombres,
	MAT.turno,
	CUR.costo
	FROM matriculas MAT
	INNER JOIN cursos 	CUR ON CUR.idcurso	= MAT.idcurso
	INNER JOIN alumnos 	ALU ON ALU.idalumno  = MAT.idalumno
	WHERE MAT.inactive_at IS NULL
	ORDER BY idmatricula; 
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_matriculas_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_matriculas_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_matriculas_registrar`(
	IN _idcurso				INT,
	IN _idalumno			INT,
	IN _turno				CHAR(1),
	IN _observaciones		VARCHAR(100)
)
BEGIN
	-- OBSERVACIONES puede quedar vacío
	IF _observaciones = '' THEN SET _observaciones = NULL; END IF;
	
	INSERT INTO matriculas (idcurso, idalumno, turno, observaciones) 
	VALUES(_idcurso, _idalumno, _turno, _observaciones);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuario_login` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuario_login` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuario_login`(in _nombreusuario varchar(15))
begin
	select
		idusuario, apellidos, nombres, nombreusuario, claveacceso, nivelacceso
		from usuarios
		where nombreusuario = _nombreusuario;
end */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
