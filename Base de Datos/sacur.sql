
CREATE SCHEMA IF NOT EXISTS `sacur` DEFAULT CHARACTER SET latin1 ;
USE `sacur` ;


CREATE TABLE IF NOT EXISTS `sacur`.`asignatura` (
  `id_Asignatura` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(30) NOT NULL,
  `credito` INT NOT NULL,
  PRIMARY KEY (`id_Asignatura`));


CREATE TABLE IF NOT EXISTS `sacur`.`estudiante` (
  `carnet` VARCHAR(10) NOT NULL,
  `nombres` VARCHAR(100) NOT NULL,
  `apellidos` VARCHAR(100) NOT NULL,
  `sexo` VARCHAR(2) NOT NULL,
  `telefono` INT NULL DEFAULT NULL,
  `departamento` VARCHAR(50) NULL DEFAULT NULL,
  `ciudad` VARCHAR(50) NULL DEFAULT NULL,
  `email` VARCHAR(50) NULL DEFAULT NULL,
  `carrera` VARCHAR(50) NOT NULL,
  `pass` VARCHAR(25) NOT NULL,
  `FechaNac` DATE NOT NULL,
  `Estado` INT NOT NULL,
  PRIMARY KEY (`carnet`));



CREATE TABLE IF NOT EXISTS `sacur`.`asistencia` (
  `idAsistencia` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  `estado` VARCHAR(15) NULL,
  `estudiante_carnet` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`idAsistencia`),
  INDEX `fk_asistencia_estudiante1_idx` (`estudiante_carnet` ASC));



CREATE TABLE IF NOT EXISTS `sacur`.`aula` (
  `idAula` INT NOT NULL AUTO_INCREMENT,
  `codigoAula` VARCHAR(25) NOT NULL,
  `turno` VARCHAR(25) NOT NULL,
  `anio` INT NOT NULL,
  PRIMARY KEY (`idAula`));


CREATE TABLE IF NOT EXISTS `sacur`.`clase` (
  `idclase` INT NOT NULL AUTO_INCREMENT,
  `asignatura_clase` INT NOT NULL,
  `tema` VARCHAR(50) NOT NULL,
  `contenido` LONGTEXT NOT NULL,
  `imagenes` BLOB NULL DEFAULT NULL,
  `video` BLOB NULL DEFAULT NULL,
  `fecha` DATE NULL DEFAULT NULL,
  `fk_asignatura` INT NOT NULL,
  PRIMARY KEY (`idclase`),
  INDEX `fk_clase_asignatura1_idx` (`fk_asignatura` ASC));



CREATE TABLE IF NOT EXISTS `sacur`.`est_aula` (
  `aula_idAula` INT NOT NULL,
  `estudiante_aula` VARCHAR(10) NOT NULL,
  INDEX `fk_est_aula_aula_idx` (`aula_idAula` ASC),
  INDEX `fk_est_aula_estudiante1_idx` (`estudiante_aula` ASC));



CREATE TABLE IF NOT EXISTS `sacur`.`notificaciones` (
  `idNotificacion` INT NOT NULL AUTO_INCREMENT,
  `Est_carnet_Not` VARCHAR(10) NOT NULL,
  `Mensaje` VARCHAR(50) NOT NULL,
  `recibido` INT NOT NULL,
  `estudiante_carnet` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`idNotificacion`),
  INDEX `fk_notificaciones_estudiante1_idx` (`estudiante_carnet` ASC));


CREATE TABLE IF NOT EXISTS `sacur`.`preguntas` (
  `idPreguntas` INT NOT NULL AUTO_INCREMENT,
  `repuesta_correcta` INT NOT NULL,
  `puntos` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `pregunta` VARCHAR(200) NOT NULL,
  `activada` INT NULL DEFAULT NULL,
  PRIMARY KEY (`idPreguntas`));

CREATE TABLE IF NOT EXISTS `sacur`.`opcionesrepuestas` (
  `idRepuesta` INT NOT NULL AUTO_INCREMENT,
  `pregunta_idPregunta` INT NOT NULL,
  `op1` VARCHAR(50) NOT NULL,
  `op2` VARCHAR(50) NOT NULL,
  `op3` VARCHAR(50) NOT NULL,
  `op4` VARCHAR(50) NOT NULL,
  `preguntas_idPreguntas` INT NOT NULL,
  PRIMARY KEY (`idRepuesta`),
  INDEX `fk_opcionesrepuestas_preguntas1_idx` (`preguntas_idPreguntas` ASC));



CREATE TABLE IF NOT EXISTS `sacur`.`profesor` (
  `idprofesor` INT NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(100) NOT NULL,
  `apellidos` VARCHAR(100) NOT NULL,
  `usuario` VARCHAR(50) NOT NULL,
  `pass_prof` VARCHAR(30) NOT NULL,
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 8c6e9157c8ca43b04a17bc107f518f29fe3d5e6f
   `sexo` VARCHAR(2) NOT NULL,
  `emailProf` VARCHAR(50) NOT NULL,
  `carrera` VARCHAR(50) NULL,
   `Estado` INT NOT NULL,
<<<<<<< HEAD
=======
=======
  `emailProf` VARCHAR(50) NOT NULL,
  `carrera` VARCHAR(50) NULL,
>>>>>>> 1f1356aebe58dd2af9110cccd2dbd722c7601c42
>>>>>>> 8c6e9157c8ca43b04a17bc107f518f29fe3d5e6f
  PRIMARY KEY (`idprofesor`));



CREATE TABLE IF NOT EXISTS `sacur`.`recibe` (
  `asignatura_id_Asignatura` INT NOT NULL,
  `estudiante_carnet` VARCHAR(10) NOT NULL,
  INDEX `fk_recibe_estudiante1_idx` (`estudiante_carnet` ASC),
  INDEX `fk_recibe_asignatura1_idx` (`asignatura_id_Asignatura` ASC));


CREATE TABLE IF NOT EXISTS `sacur`.`subtema` (
  `id_subtema` INT NOT NULL AUTO_INCREMENT,
  `clase_id` INT NOT NULL,
  `nombreTema` TEXT NOT NULL,
  `contenido_tema` LONGTEXT NOT NULL,
  `imagen` BLOB NULL DEFAULT NULL,
  `clase_idclase` INT NOT NULL,
  PRIMARY KEY (`id_subtema`),
  INDEX `fk_subtema_clase1_idx` (`clase_idclase` ASC));



CREATE TABLE IF NOT EXISTS `sacur`.`tarea` (
  `id_tare` INT NOT NULL AUTO_INCREMENT,
  `class_id` INT NOT NULL,
  `nombre` VARCHAR(50) NOT NULL,
  `fecha_inicio` DATE NULL DEFAULT NULL,
  `fecha_entrega` DATE NULL DEFAULT NULL,
  `tarea_imagen` BLOB NULL DEFAULT NULL,
  `documento` BLOB NULL DEFAULT NULL,
  `clase_idclase` INT NOT NULL,
  PRIMARY KEY (`id_tare`),
  INDEX `fk_tarea_clase1_idx` (`clase_idclase` ASC));


CREATE TABLE IF NOT EXISTS `sacur`.`profesor_estudiante` (
  `prof_idprofesor` INT NOT NULL,
  `est_prof_carnet` VARCHAR(10) NOT NULL,
  INDEX `fk_profesor_has_estudiante_estudiante1_idx` (`est_prof_carnet` ASC),
  INDEX `fk_profesor_has_estudiante_profesor1_idx` (`prof_idprofesor` ASC));



CREATE TABLE IF NOT EXISTS `sacur`.`estudiante_preguntas` (
  `estudiante_carnet` VARCHAR(10) NOT NULL,
  `preguntas_idPreguntas` INT NOT NULL,
  `puntaje` INT NULL,
  INDEX `fk_estudiante_has_preguntas_preguntas1_idx` (`preguntas_idPreguntas` ASC),
  INDEX `fk_estudiante_has_preguntas_estudiante1_idx` (`estudiante_carnet` ASC));


CREATE TABLE IF NOT EXISTS `sacur`.`imparte` (
  `asignatura_id_Asignatura` INT(11) NOT NULL,
  `profesor_idprofesor` INT(11) NOT NULL,
  INDEX `fk_asignatura_has_profesor_profesor1_idx` (`profesor_idprofesor` ASC) ,
  INDEX `fk_asignatura_has_profesor_asignatura1_idx` (`asignatura_id_Asignatura` ASC));


CREATE TABLE IF NOT EXISTS `sacur`.`Redacta` (
  `id_redacta` INT NOT NULL,
  `profesor_idprofesor` INT NOT NULL,
  `preguntas_idPreguntas` INT NOT NULL,
  INDEX `fk_profesor_has_preguntas_preguntas1_idx` (`preguntas_idPreguntas` ASC),
  INDEX `fk_profesor_has_preguntas_profesor1_idx` (`profesor_idprofesor` ASC),
  PRIMARY KEY (`id_redacta`));
