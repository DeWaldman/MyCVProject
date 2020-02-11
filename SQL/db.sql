create database sitedb;
use sitedb;

create table user (
  username varchar(30) not null,
  userpasswd varchar(30) not null,
  primary key (username)
);
insert into user values (
  "admin", "senha_admin" );

create table feedback (
  id_fb int not null auto_increment,
  mensagens text not null,
  primary key (id_fb)
);

