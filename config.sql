drop database if exists n0juro00;
create database n0juro00;
use n0juro00;

create table user (
        username varchar(50) NOT NULL,
        password varchar(150) NOT NULL,
        CONSTRAINT username_pk PRIMARY KEY (username)
);

create table info (
        username varchar(50) NOT NULL,
        fname varchar(50) NOT NULL,
        lname varchar(50) NOT NULL,
        address varchar(150) NOT NULL,
        age int NOT NULL,
        CONSTRAINT info_FK FOREIGN KEY (username) 
        REFERENCES info (username)
        
);

