drop database if exists n0juro00;
create database n0juro00;
use n0juro00;

create table user (
        username varchar(50) NOT NULL,
        password varchar(150) NOT NULL,
        PRIMARY KEY (username)
);

insert into user(username, password) value ('admin', 'admin');
insert into user(username, password) value ('user', 'user');

create table info (
        username varchar(50) NOT NULL,
        fname varchar(50) NOT NULL,
        lname varchar(50) NOT NULL,
        address varchar(150) NOT NULL,
        age int NOT NULL,
        PRIMARY KEY (username)
);

insert into info(username ,fname, lname, address, age) value ('user', 'Etunimi','Sukunimi', 'osoite1', 12);
insert into info(username, fname, lname, address, age) value ('admin', 'Roni','Junttila', 'ouluntie1', 21);




tääääääääääääääää uus on vielä ahjamattta sisää eli usernam primaryksi