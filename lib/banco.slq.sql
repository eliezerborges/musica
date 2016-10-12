

CREATE TABLE musicas
(
  id SERIAL,
  id_album INTEGER,
  id_banda INTEGER,
  nome VARCHAR(255),
  data_lancamento VARCHAR(255),
  genero VARCHAR(255),
  PRIMARY KEY (id),
  FOREIGN KEY (id_album)
    REFERENCES albuns (id_album),
  FOREIGN KEY (id_banda)
    REFERENCES musicas (id_banda)
);

CREATE TABLE bandas
(
  id_banda SERIAL,
  nome VARCHAR(255),
  vocalista VARCHAR(255),
  guitarrista VARCHAR(255),
  baterista VARCHAR(255),
  genero VARCHAR(255),
  PRIMARY KEY (id_banda)
);

CREATE TABLE albuns
(
  id_album SERIAL,
  id_banda INTEGER,
  nome VARCHAR(255),
  data_lancamento VARCHAR(255),
  PRIMARY KEY (id_album),
  FOREIGN KEY (id_banda)
    REFERENCES bandas (id_banda)
);
