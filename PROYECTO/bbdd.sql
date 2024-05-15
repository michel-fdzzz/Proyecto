
/*
create table producto (
    id int auto_increment primary key,
    nombre varchar(50) not null,
    marca varchar(50) not null,
    modelo varchar(50) not null,
    precio decimal(10, 2) not null,
    imagen varchar(500) not null
);*/


drop database if exists tiendaRelojes;
create database if not exists tiendaRelojes;
use tiendaRelojes;

create table producto (
    id int auto_increment primary key,
    nombre varchar(50) unique not null,
    marca varchar(50) not null,
    modelo varchar(50) not null,
    precio decimal(10, 2) not null,
    imagen varchar(500) not null, 
    stock int not null,
    descripcion varchar(200) not null
);

create table usuario (
    id int auto_increment primary key,
    nombre varchar(30) not null,
    apellidos varchar(50) not null,
    correoElectronico varchar(50) not null,
    contrasenia varchar(30) not null,
    domicilio varchar (100) not null,
    -- false / 0 será un usuario normal y el admin true / 1
    tipo boolean not null
);


create table carrito (
    idProducto int not null,
    idCliente int not null,
    nombreProducto varchar(50) not null,
    modelo varchar (50) not null,
    cantidad int not null,
    precio decimal(10, 2) not null,
    foreign key (idProducto) references producto(id),
    foreign key (idCliente) references usuario(id)
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
    foreign key (idCliente) references usuario(id)
);


-- Insertar productos
INSERT INTO producto (id, nombre, marca, modelo, precio, imagen, stock, descripcion)
VALUES 
  (null, 'Oyster Perpetual 41', 'Rolex', 'Oyster', 6600, 'oyster_perpetual_41.avif', 5, '41 mm, acero Oystersteel'),
  (null, 'Dajejust 36', 'Rolex', 'Dajejust', 13350, 'dajejust_36.avif', 3, '36 mm, acero Oystersteel y oro amarillo'),
  (null, 'T-touch connect sport', 'Tissot', 'T-touch connect sport', 13350, 'tissot_t-touch connect sport.avif', 7, '36 mm, cuarzo'),
  (null, 'Stand Alone', 'Tissot', 'Stand Alone', 445, 'tissot_stand_alone.avif', 7, '49.6 mm, cuarzo suizo'),
  (null, 'Le Locle Powermatic 80 20th anniversary', 'Tissot', 'Powermatic 80 20th anniversary', 775, 'T006.407.11.033.03_R_1.avif', 7, '39.3 mm, brazalete intercambiable, cristral de zafiro');

-- Insertar usuarios
INSERT INTO usuario (nombre, apellidos, domicilio, correoElectronico, contrasenia, tipo)
VALUES 
  ('Alex', 'Perez', '', 'a@gmail.com', 'abcdefG1#', 0),
  ('Michel', 'Fernandez', '', 'admin@gmail.com', 'abcdefG1#', 1),
  ('Juan', 'González', '', 'juan.gonzalez@example.com', 'abcdefG1#', 0),
  ('María', 'López', '', 'maria.lopez@example.com', 'abcdefG1#', 0),
  ('Carlos', 'Martínez', '', 'carlos.martinez@example.com', 'abcdefG1#', 0),
  ('Laura', 'Rodríguez', '', 'laura.rodriguez@example.com', 'abcdefG1#', 0),
  ('Pedro', 'Sánchez', '', 'pedro.sanchez@example.com', 'abcdefG1#', 0),
  ('Sofía', 'García', '', 'sofia.garcia@example.com', 'abcdefG1#', 0),
  ('Ana', 'Pérez', '', 'ana.perez@example.com', 'abcdefG1#', 0),
  ('Diego', 'Ramírez', '', 'diego.ramirez@example.com', 'abcdefG1#', 0);
