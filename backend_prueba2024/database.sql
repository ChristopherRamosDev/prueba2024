

CREATE TABLE `persona` (
  `id_persona` int NOT NULL AUTO_INCREMENT,
  `dni` varchar(8) DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_persona`),
  UNIQUE KEY `dni_UNIQUE` (`dni`),
  UNIQUE KEY `correo_UNIQUE` (`correo`)
) ENGINE=InnoDB 


CREATE TABLE `type_user` (
  `id_type_user` int NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_type_user`)
) ENGINE=InnoDB

INSERT INTO `type_user` VALUES (1,'businessman'),(2,'common');





CREATE TABLE `users` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `type_user_id` int DEFAULT NULL,
  `persona_id` int DEFAULT NULL,
  `user` varchar(45) DEFAULT NULL,
  `password` text,
  `saldo` decimal(10,2) DEFAULT '500.00',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB 
