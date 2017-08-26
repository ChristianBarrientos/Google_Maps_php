CREATE TABLE  mp_zona (
     id_zona INTEGER AUTO_INCREMENT NOT NULL,
     pais VARCHAR(100),
     provincia VARCHAR(100),
     localidad VARCHAR(100),
     direccion VARCHAR(100),
     KEY (id_zona)
     ) ENGINE=InnoDB;

CREATE TABLE  mp_punto (
     id_punto INTEGER AUTO_INCREMENT NOT NULL,
     latitud VARCHAR(100) NOT NULL,
     longitud VARCHAR(100) NOT NULL,
     id_zona INTEGER NOT NULL,
     FOREIGN KEY (id_zona) REFERENCES mp_zona(id_zona) ON DELETE NO ACTION ON UPDATE CASCADE,
     KEY (id_punto)
     ) ENGINE=InnoDB;

CREATE TABLE  mp_ruta (
     id_ruta INTEGER AUTO_INCREMENT NOT NULL,
     punto_origen INTEGER NOT NULL,
     punto_destino INTEGER NOT NULL,
     
     FOREIGN KEY (punto_origen) REFERENCES mp_punto(id_punto) ON DELETE NO ACTION ON UPDATE CASCADE,
     FOREIGN KEY (punto_destino) REFERENCES mp_punto(id_punto) ON DELETE NO ACTION ON UPDATE CASCADE,
     KEY (id_ruta)
     ) ENGINE=InnoDB;


CREATE TABLE  mp_market (
     id_market INTEGER AUTO_INCREMENT NOT NULL,
     id_ruta INTEGER,
     id_punto INTEGER,
     titulo VARCHAR(50),
     FOREIGN KEY (id_ruta) REFERENCES mp_ruta(id_ruta) ON DELETE NO ACTION ON UPDATE CASCADE,
     FOREIGN KEY (id_punto) REFERENCES mp_punto(id_punto) ON DELETE NO ACTION ON UPDATE CASCADE,
     KEY (id_market)
     ) ENGINE=InnoDB;

CREATE TABLE usuarios (
     id_usuario INTEGER AUTO_INCREMENT NOT NULL,
     usuario VARCHAR(50),
     KEY (id_usuario)
     ) ENGINE=InnoDB;

CREATE TABLE  us_mark (
     id_market INTEGER NOT NULL,
     id_usuario INTEGER NOT NULL,
     FOREIGN KEY (id_market) REFERENCES mp_market(id_market) ON DELETE NO ACTION ON UPDATE CASCADE,
     FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE NO ACTION ON UPDATE CASCADE
     ) ENGINE=InnoDB;

CREATE TABLE us_eventos (
     id_evento INTEGER AUTO_INCREMENT NOT NULL,
     id_usuario INTEGER NOT NULL,
     evento ENUM('BORRAR','AGREGAR','MODIFICAR'), 
     id_market INTEGER,
     KEY (id_evento),
     FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE NO ACTION ON UPDATE CASCADE,
     FOREIGN KEY (id_market) REFERENCES mp_market(id_market) ON DELETE NO ACTION ON UPDATE CASCADE
     
     ) ENGINE=InnoDB;