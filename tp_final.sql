/*
 TRABAJO PRACTICO FINAL
 CURSO PHP Y MYSQL
 ALUMNO :  SPECTERMAN LUIS OMAR
*/

DROP DATABASE IF EXISTS phpcrud3f;

CREATE DATABASE  phpcrud3f ;

USE phpcrud3f;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario VARCHAR(50) UNIQUE,
  clave VARCHAR(255)
);

INSERT INTO usuarios (id, usuario, clave) VALUES
(2, 'admin', '$2y$10$JZ563bJy2jApeI98yskAFe6k16ew5BU4RwopJsJfPLn08XPKSxIru');


CREATE TABLE productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  codigo VARCHAR(50) UNIQUE,
  nombre VARCHAR(100),
  categoria VARCHAR(50),
  unidad_medida VARCHAR(20),
  cantidad INT,
  imagen VARCHAR(255)
);


                              
