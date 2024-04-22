DROP DATABASE IF EXISTS verdevivo;
CREATE DATABASE  IF NOT EXISTS  verdevivo;

use verdevivo;

create table cadastro(
    id_usuario int not null primary key auto_increment,
    usuario varchar(100) not null,
    senha varchar(100) not null,
    email varchar(150) not null unique key
);




