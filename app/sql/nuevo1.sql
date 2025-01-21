CREATE DATABASE IF NOT EXISTS gestionLibros;

USE gestionLibros;

CREATE TABLE IF NOT EXISTS Alumnos (
	idAlumno SMALLINT PRIMARY KEY AUTO_INCREMENT,
	nombre VARCHAR(50) NOT NULL,
	apellidos VARCHAR(100) NOT NULL,
	correo VARCHAR(100) NOT NULL,
	idCurso VARCHAR(5),
	FOREIGN KEY (idCurso) REFERENCES Cursos(idCurso)
);

CREATE TABLE IF NOT EXISTS Cursos (
	idCurso VARCHAR(5) PRIMARY KEY,
	nombre_curso VARCHAR(200) NOT NULL
);

CREATE TABLE IF NOT EXISTS Libros(
	ISBN INT PRIMARY KEY,
	titulo VARCHAR(255) NOT NULL,
	autor VARCHAR(50),
	precio DECIMAL(4,2),
	stock SMALLINT,
	editorial VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS Curso_Libros(
	idCurso VARCHAR(5),
	ISBN INT,
	PRIMARY KEY (idCurso, ISBN),
	FOREIGN KEY (idCurso) REFERENCES Cursos(idCurso),
	FOREIGN KEY (ISBN) REFERENCES Libros(ISBN)
);

CREATE TABLE IF NOT EXISTS Pagos(
	idPago INT PRIMARY KEY,
	idAlumno SMALLINT,
	ISBN INT,
	fecha_pago DATE,
	monto_pagado DECIMAL (6,2),
	estado_pago VARCHAR(50),
	FOREIGN KEY (idAlumno) REFERENCES Alumnos(idAlumno),
	FOREIGN KEY (ISBN) REFERENCES Libros(ISBN)
	
);
