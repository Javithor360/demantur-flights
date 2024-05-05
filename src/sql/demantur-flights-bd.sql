CREATE SCHEMA IF NOT EXISTS demantur_flights DEFAULT CHARACTER SET utf8;

DROP DATABASE demantur_flights;
CREATE DATABASE demantur_flights;

CREATE TABLE demantur_flights . usuario (
  id_usuario INT NOT NULL AUTO_INCREMENT,
  nombres VARCHAR(300),
  apellidos VARCHAR(300),
  documento_identidad CHAR(10), -- DUI
  password VARCHAR(255),
  email VARCHAR(255),
  PRIMARY KEY(id_usuario)
);

CREATE TABLE demantur_flights . aerolinea (
  id_aerolinea INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(300) NOT NULL, -- TEXT (avianca)
  PRIMARY KEY(id_aerolinea)
);

CREATE TABLE demantur_flights . destino (
  id_destino INT NOT NULL AUTO_INCREMENT,
  lugar TEXT NOT NULL,-- TEXTO (miami)
  aeropuerto TEXT NOT NULL, -- TEXTO (national miami airport)
  PRIMARY KEY (id_destino)
);

CREATE TABLE demantur_flights . avion (
  id_avion INT NOT NULL AUTO_INCREMENT,
  codigo_avion CHAR(4) NOT NULL, -- CHAR: AV01
  id_aerolinea INT NOT NULL, -- FK_AEROLINEA
  id_ultima_ubicacion INT, -- FK_DESTINO
  PRIMARY KEY(id_avion),
  FOREIGN KEY(id_ultima_ubicacion) REFERENCES demantur_flights . destino(id_destino),
  FOREIGN KEY(id_aerolinea) REFERENCES demantur_flights . aerolinea(id_aerolinea)
);

CREATE TABLE demantur_flights . horario (
  id_horario INT NOT NULL AUTO_INCREMENT,
  id_destino INT NOT NULL, -- FK_DESTINO
  id_origen INT NOT NULL, -- FK_DESTINO
  hora_salida DATETIME NOT NULL, -- DATETIME
  hora_llegada DATETIME NOT NULL, -- DATETIME
  PRIMARY KEY(id_horario),
  FOREIGN KEY(id_destino) REFERENCES demantur_flights . destino(id_destino),
  FOREIGN KEY(id_origen) REFERENCES demantur_flights . destino(id_destino)
);

CREATE TABLE demantur_flights . vuelo (
  id_vuelo INT NOT NULL AUTO_INCREMENT,
  codigo CHAR(7) NOT NULL,-- CHAR: AV01V01
  id_horario INT NOT NULL, -- FK_HORARIO
  tarifa DECIMAL(10, 2) NOT NULL,
  id_avion INT NOT NULL, -- FK_AVION
  finalizado BOOLEAN, -- BOOLEAN
  PRIMARY KEY(id_vuelo),
  FOREIGN KEY(id_horario) REFERENCES demantur_flights . horario(id_horario),
  FOREIGN KEY(id_avion) REFERENCES demantur_flights . avion(id_avion)
);

CREATE TABLE demantur_flights . asiento (
  id_asiento INT NOT NULL AUTO_INCREMENT,
  numero_asiento CHAR(3) NOT NULL, -- CHAR: A1
  id_vuelo INT NOT NULL,-- FK_VUELO
  PRIMARY KEY (id_asiento),
  FOREIGN KEY(id_vuelo) REFERENCES demantur_flights . vuelo(id_vuelo)
);

CREATE TABLE demantur_flights . boleto (
  id_boleto INT NOT NULL AUTO_INCREMENT,
  id_comprador INT NOT NULL, -- FK_USUARIO
  codigo_boleto CHAR(16) NOT NULL, -- CHAR: VL20240321V01N01
  fecha_compra DATETIME NOT NULL,
  id_asiento INT NOT NULL, -- FK_ASIENTO
  nombre_pasajero VARCHAR(250) NOT NULL, -- VARCHAR
  documento_identidad CHAR(10), -- DUI
  PRIMARY KEY (id_boleto),
  FOREIGN KEY(id_comprador) REFERENCES demantur_flights . usuario(id_usuario),
  FOREIGN KEY(id_asiento) REFERENCES demantur_flights . asiento(id_asiento)
);

SELECT * FROM demantur_flights.usuario;