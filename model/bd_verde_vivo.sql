DROP DATABASE IF EXISTS verdevivo;
CREATE DATABASE  IF NOT EXISTS  verdevivo;

use verdevivo;

create table cadastro(
    id_usuario int not null primary key auto_increment,
    usuario varchar(100) not null,
    senha varchar(100) not null,
    email varchar(150) not null unique key
);,

create table cadastro_planta(
	id_planta int not null primary key auto_increment,
	id_usuario int not null,
    nome_planta varchar(100) not null,
    tipo_planta varchar(100) not null,
    descricao varchar(5000) not null,
    FOREIGN KEY (id_usuario) REFERENCES cadastro(id_usuario)
);




