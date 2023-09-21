CREATE DATABASE academia;
USE academia;

CREATE TABLE cursos
(
	idcurso			INT AUTO_INCREMENT PRIMARY KEY,
	nombrecurso		VARCHAR(200)	NOT NULL,
	costo 			DECIMAL(7,2)	NOT NULL,
	nivel 			CHAR(1)			NOT NULL,	-- B/I/A
	create_at		DATETIME 		NOT NULL DEFAULT NOW(),
	update_at	 	DATETIME 		NULL,
	inactive_at 	DATETIME			NULL,
	CONSTRAINT uk_nombrecurso_cur UNIQUE (nombrecurso)
)ENGINE = INNODB;


-- // Procedimientos almacenados // --

DELIMITER $$
CREATE PROCEDURE spu_cursos_registrar
(
	_nombrecurso 	VARCHAR(200),
	_costo 			DECIMAL(7,2),
	_nivel 			CHAR(1)
)
BEGIN
	INSERT INTO cursos (nombrecurso, costo, nivel) VALUES
		(_nombrecurso, _costo, _nivel);
END $$

CALL spu_cursos_registrar('Microsoft Office', 150, 'B');
CALL spu_cursos_registrar('Fundamentos de Javascript', 180, 'I');
CALL spu_cursos_registrar('Laravel', 250, 'A');


-- Nota: Los procedimientos para listar, no utilizan todos los campos
-- debes indicar solo los que son de utilidad, además de condicionar que
-- estos se encuentren activos.
DELIMITER $$
CREATE PROCEDURE spu_cursos_listar()
BEGIN
	SELECT 
		idcurso, nombrecurso, costo, nivel 
		FROM cursos
		WHERE inactive_at IS NULL
		ORDER BY idcurso;
END $$

CALL spu_cursos_listar();

-- LISTADO SOLO DEL NOMRE DE CURSO
-- Por ahora que queda así
-- debió llamarse: spu_cursos_lista_basica, aunque pudiste utilizar el spu_cursos, y solo tomar los campos que necesites
DELIMITER $$
CREATE PROCEDURE spu_cursos_nombres()
BEGIN
	SELECT 
		idcurso, nombrecurso
		FROM cursos
		WHERE inactive_at IS NULL
		ORDER BY idcurso;
END $$
CALL spu_cursos_nombres();


-- Haremos uso de la ELIMINACIÓN LÓGICA, el campo "inactive_at" guarda la información del momento exacto
-- cuando un registro es dado de baja (eliminado), mientras este campo este NULL, significa que está
-- activo, así que lo que hace el procedimiento es asignarle la fecha y hora actual.
DELIMITER $$
CREATE PROCEDURE spu_cursos_eliminar(IN _idcurso INT)
BEGIN
	UPDATE cursos 
		SET inactive_at = NOW()
		WHERE idcurso = _idcurso;
END $$


-- NUEVOS SPU PARA ACTUALIZAR LOS CURSOS
-- Cuando se selecciona un curso de la lista utilizando el botón EDITAR
-- se recupera todo los datos asociados al registro y se vuelve a mostrar
-- en el formulario
DELIMITER $$
CREATE PROCEDURE spu_cursos_obtener(IN _idcurso INT)
BEGIN
	SELECT 
		idcurso, nombrecurso, costo, nivel 
		FROM cursos 
		WHERE idcurso = _idcurso;
END $$


-- Actualiza toda la información
DELIMITER $$
CREATE PROCEDURE spu_cursos_actualizar
(
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
END $$



-- // Prueba estas instrucciones: // --

-- Primero: Eliminando de forma lógica 1
CALL spu_cursos_eliminar(1);
-- Segundo: Verificando la eliminación
SELECT * FROM cursos;
-- Tercero: dejamos el registro como al principio
UPDATE cursos SET inactive_at = NULL WHERE idcurso = 1;

UPDATE matriculas SET inactive_at = NULL WHERE idmatricula = 2;




-- NUEVA TABLA: Alumnos
CREATE TABLE alumnos
(
	idalumno			INT AUTO_INCREMENT PRIMARY KEY,
	apellidos		VARCHAR(40)		NOT NULL,
	nombres 			VARCHAR(40)		NOT NULL,
	fechanac 		DATE 				NOT NULL,
	numerodoc		CHAR(8)			NOT NULL,
	telefono 		CHAR(9)			NULL,
	create_at		DATETIME 		NOT NULL DEFAULT NOW(),
	update_at	 	DATETIME 		NULL,
	inactive_at 	DATETIME			NULL,
	CONSTRAINT uk_numerodoc_alu UNIQUE (numerodoc)	
)
ENGINE = INNODB;

-- PORCEDIMIENTO PARA REGISTRAR ALUMNOS
DELIMITER $$
CREATE PROCEDURE spu_alumnos_registrar(
	IN apellidos_			VARCHAR(40),
	IN nombres_				VARCHAR(40),
	IN fechanac_			DATE,
	IN numerodoc_			CHAR(8),
	IN telefono_			CHAR(9)
)
BEGIN
	INSERT INTO alumnos (apellidos, nombres, fechanac, numerodoc, telefono)
	VALUES (apellidos_, nombres_, fechanac_, numerodoc_, telefono_);
END $$

CALL spu_alumnos_registrar('Hernandez Yeren','Yorghet','2003-07-28','72159736','946989937');
CALL spu_alumnos_registrar('Muñoz Quispe','Alonso','1996-12-26','72159735','920490818');

-- PROCEDIMIENTO PARA LISTAR ALUMNOS
DELIMITER $$
CREATE PROCEDURE spu_alumnos_listar()
BEGIN
	SELECT 
		idalumno, apellidos, nombres, fechanac, numerodoc, telefono
		FROM alumnos
		WHERE inactive_at IS NULL
		ORDER BY idalumno;
END $$

CALL spu_alumnos_listar();


-- PROCEDIMIENTO PARA ELIMINAR ALUMNOS
-- Siempre para eliminar algún se hace a través del ID de la tabla, en este caso tenemos un campo inactive_at
-- lo que haremos es que al momento de eliminar el id seleccionado salga la actualización del inactive.
DELIMITER $$
CREATE PROCEDURE spu_alumnos_eliminar(IN idalumno_ INT)
BEGIN
	UPDATE alumnos
		SET inactive_at = NOW()
		WHERE idalumno = idalumno_;
END $$

CALL spu_alumnos_eliminar(1);

SELECT * FROM alumnos;
-- REGRESANDO AL ESTADO ANTERIOR
UPDATE alumnos SET inactive_at = NULL WHERE idalumno = 1;


-- Tabla que integra alumnos y cursos
CREATE TABLE matriculas
(
	idmatricula			INT AUTO_INCREMENT PRIMARY KEY,
	idcurso				INT 				NOT NULL,
	idalumno				INT 				NOT NULL,
	turno					CHAR(1)			NOT NULL, -- M/T/N
	observaciones		VARCHAR(100)	NULL,
	create_at			DATETIME 		NOT NULL DEFAULT NOW(),
	update_at	 		DATETIME 		NULL,
	inactive_at 		DATETIME			NULL,
	CONSTRAINT fk_idcurso_mat FOREIGN KEY (idcurso) REFERENCES cursos (idcurso),
	CONSTRAINT fk_idalumno_mat FOREIGN KEY (idalumno) REFERENCES alumnos (idalumno)
)ENGINE = INNODB;


-- PROCEDIMIENTO ALMACENADO PARA LISTAR MATRICULA
DELIMITER $$
CREATE PROCEDURE spu_matriculas_listar()
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
END $$

UPDATE matriculas SET inactive_at = NULL;
CALL spu_matriculas_listar();

-- PROCEDIMIENTO PARA REGISTRAR MATRICULAS
-- El guion va antes _idcurso, _idalumno, _idturno
DELIMITER $$
CREATE PROCEDURE spu_matriculas_registrar(
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
END $$

DELETE FROM matriculas;
ALTER TABLE matriculas AUTO_INCREMENT 0;

CALL spu_matriculas_registrar(1,1,'M','Todo claro y conciso');
CALL spu_matriculas_registrar(2,1,'T','');

SELECT * FROM matriculas;
CALL spu_matriculas_listar();


-- PROCEDIMIENTO PARA ELIMINAR MATRICULA
DELIMITER $$
CREATE PROCEDURE spu_matriculas_eliminar(IN _idmatricula INT)
BEGIN
	UPDATE matriculas
		SET inactive_at = NOW()
		WHERE idmatricula = _idmatricula;
END $$

-- PROCEDIMIENTO PARA OBTENER AL ALUMNO CON SU DNI
-- SPU + TABLA + FUNCIONALIDAD
DELIMITER $$
CREATE PROCEDURE spu_alumnos_buscar_dni(IN _numerodoc CHAR(8))
BEGIN
	SELECT
		ALU.idalumno,
		ALU.numerodoc,	
		CONCAT(apellidos, ' ', nombres) AS datos_alumno
		FROM alumnos ALU
		WHERE ALU.numerodoc = _numerodoc
		AND ALU.inactive_at IS NULL;
END $$

-- ¡CUIDADO!
-- No existe SPU de búsqueda que NO RETORNE EL ID (PK), el ID siempre se tiene que retornar
-- ya que la información obtenida es solo para mostrar en pantalla, recuerda que para una matrícula
-- no importa el apellido, nombre, teléfono o DNI del alumno, lo único que importa es su clave primaria
-- y tu buscador debe devolver siempre ello. No importa que busque tu algoritmo (marcas, personas, empresas, etc)
-- siempre devolver PK
CALL spu_alumnos_buscar_dni('72159736');
SELECT * FROM matriculas;
SELECT * FROM alumnos;

-- USUARIOS
CREATE TABLE usuarios
(
	idusuario			INT AUTO_INCREMENT PRIMARY KEY,
	apellidos 			VARCHAR(30)	NOT NULL,
	nombres 				VARCHAR(30) NOT NULL,
	nombreusuario		VARCHAR(15)	NOT NULL,
	claveacceso			VARCHAR(80)	NOT NULL,
	nivelacceso			CHAR(1)		NOT NULL,
	create_at			DATETIME 	NOT NULL DEFAULT NOW(),
	update_at	 		DATETIME 	NULL,
	inactive_at 		DATETIME		NULL,
	CONSTRAINT uk_nombreusuario_usu UNIQUE (nombreusuario)
)ENGINE = INNODB;

INSERT INTO usuarios(apellidos, nombres, nombreusuario, claveacceso, nivelacceso) 
				VALUES('Hernandez Yerén','Yorghet','YorghetF','Senati123','A');

INSERT INTO usuarios(apellidos, nombres, nombreusuario, claveacceso, nivelacceso) 
				VALUES('Francia Minaya','Jhon','JhonF','Senati123','A');
				
INSERT INTO usuarios(apellidos, nombres, nombreusuario, claveacceso, nivelacceso) 
				VALUES('Muñoz Quispe','Alonso','AlonsoM','Senati123','C');


SELECT * FROM usuarios

-- 1. Agregar 3 registros USUARIOS (encriptado)
-- 2. Clase Usuario.php, Controlador usuario.controller.php
-- 3. Método login
-- 4. Consumir el método POST en el controlador
-- 5. Conectar todo con el index.php (formulario de login)

-- PROCEDIMIENTO LOGIN - USUARIO
DELIMITER $$
CREATE PROCEDURE spu_usuario_login(IN _nombreusuario VARCHAR(15))
BEGIN
	SELECT
		idusuario, apellidos, nombres, nombreusuario, claveacceso, nivelacceso
		FROM usuarios
		WHERE nombreusuario = _nombreusuario;
END $$

CALL spu_usuario_login('YorghetF');

UPDATE usuarios SET
	claveacceso = '$2y$10$ha4wJunp1YzXLZrnEN//uOhfTH115AYyo5OMiEd8V2VAMRKvnf6zm'
	WHERE idusuario = 1;
	
UPDATE usuarios SET
	claveacceso = '$2y$10$Iamy/NETEEUEYL/r0LMtdOkcEeC.Z.z1J3GytarRUMBd8UNc7rSYO'
	WHERE idusuario = 2;
	
SELECT * FROM usuarios