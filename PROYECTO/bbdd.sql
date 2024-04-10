






/*Cambiar la base de datos por esta nueva*/


create table producto (
    id int auto_increment primary key,
    nombre varchar(50) not null,
    marca varchar(50) not null,
    modelo varchar(50) not null,
    precio decimal(10, 2) not null,
    imagen varchar(500) not null, 
    stock int not null,
    descripcion varchar(200) not null
);





drop database if exists tiendaRelojes;
create database if not exists tiendaRelojes;
use tiendaRelojes;

create table producto (
    id int auto_increment primary key,
    nombre varchar(50) not null,
    marca varchar(50) not null,
    modelo varchar(50) not null,
    precio decimal(10, 2) not null,
    imagen varchar(500) not null
);

create table usuarioRegistrado (
    id int auto_increment primary key,
    nombre varchar(30) not null,
    apellidos varchar(50) not null,
    correoElectronico varchar(50) not null,
    contrasenia varchar(30) not null,
    domicilio varchar (100) not null
);


create table carrito (
    idProducto int not null,
    idCliente int not null,
    nombreProducto varchar(50) not null,
    modelo varchar (50) not null,
    cantidad int not null,
    precio decimal(10, 2) not null,
    foreign key (idProducto) references producto(id),
    foreign key (idCliente) references usuarioRegistrado(id)
);

create table pedido (
    id int not null,
    idProducto int not null,
    idCliente int not null,
    nombreProducto varchar(50) not null,
    modelo varchar (50) not null,
    cantidad int not null,
    precio decimal(10, 2) not null,
    fecha date not null,
    foreign key (idProducto) references producto(id),
    foreign key (idCliente) references usuarioRegistrado(id)
);

-- Sin stock ni descripcion


INSERT INTO producto VALUES (null, 'Oyster Perpetual 41', 'Oyster', 6600, 'https://media.rolex.com/image/upload/q_auto/f_auto/t_v7-grid/c_limit,w_320/v1/catalogue/2023-06/upright-bba-with-shadow/m124300-0001');
insert into producto values (null, 'Dajejust 36', 'Dajejust', 13350, 'https://media.rolex.com/image/upload/q_auto/f_auto/t_v7-main-configurator/c_limit,w_2440/v1/catalogue/2023-06/upright-c/m126233-0039');

INSERT INTO producto (nombre, marca, modelo, precio, imagen)
VALUES ('Oyster Perpetual 41', 'Oyster', 'Modelo1', 6600.00, 'https://media.rolex.com/image/upload/q_auto/f_auto/t_v7-grid/c_limit,w_320/v1/catalogue/2023-06/upright-bba-with-shadow/m124300-0001'),
       ('Dajejust 36', 'Dajejust', 'Modelo2', 13350.00, 'https://media.rolex.com/image/upload/q_auto/f_auto/t_v7-main-configurator/c_limit,w_2440/v1/catalogue/2023-06/upright-c/m126233-0039');

-- con estock y descripcion

INSERT INTO producto VALUES (null, 'Oyster Perpetual 41', 'Oyster', 6600, 'https://media.rolex.com/image/upload/q_auto/f_auto/t_v7-grid/c_limit,w_320/v1/catalogue/2023-06/upright-bba-with-shadow/m124300-0001',1, '41 mm, acero Oystersteel');
insert into producto values (null, 'Dajejust 36', 'Dajejust', 13350, 'https://media.rolex.com/image/upload/q_auto/f_auto/t_v7-main-configurator/c_limit,w_2440/v1/catalogue/2023-06/upright-c/m126233-0039',3, '36 mm, acero Oystersteel y oro amarillo');





