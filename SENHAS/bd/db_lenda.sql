create database db_lenda;
use db_lenda;

create table tb_usuario (
username varchar(20) primary key not null,
senha varchar(128) not null,
nome varchar(100) not null,
tipo char(1) not null,
status char(1)
);

ALTER TABLE tb_usuario ADD COLUMN qt_acessos BIGINT;

insert into tb_usuario
(username, senha, nome, tipo) values 
("admin", "1234", "admin", "A");
update tb_usuario
set status = "A"
where username = "admin"
;

select * from tb_usuario;

