drop database if exists tiendaRelojes;
create database if not exists tiendaRelojes;
use tiendaRelojes;

create table producto (
    id int auto_increment primary key,
    nombre varchar(50) not null,
    modelo varchar(50) not null,
    precio decimal(10, 2) not null
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



