DROP DATABASE IF EXISTS actividadLizeth;
CREATE DATABASE actividadLizeth;
USE actividadLizeth;

CREATE TABLE usuario (
  idUsuario INT PRIMARY KEY AUTO_INCREMENT,
  tipousuario VARCHAR(50),
  nombre VARCHAR(50),
  apellido VARCHAR(50),
  correo VARCHAR(50),
  telefono BIGINT,
  contrasenia VARCHAR(50),
  genero VARCHAR(30)
);

CREATE TABLE mascota (
  idMascota INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(50),
  raza VARCHAR(50),
  descripcion VARCHAR(100),
  edad INT,
  genero VARCHAR(30)
);
SELECT * FROM mascota;


CREATE TABLE adopcion (
  idAdopcion INT PRIMARY KEY AUTO_INCREMENT,
  idUsuario INT,
  idMascota INT,
  FOREIGN KEY (idUsuario) REFERENCES usuario (idUsuario),
  FOREIGN KEY (idMascota) REFERENCES mascota (idMascota)
);
CREATE TABLE postulacionM (
  idpostulacionM INT PRIMARY KEY AUTO_INCREMENT,
  idUsuario INT,
  idMascota INT,
  FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario),
  FOREIGN KEY (idMascota) REFERENCES mascota(idMascota)
);
