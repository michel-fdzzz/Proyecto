
drop database if exists tiendaRelojes;
create database if not exists tiendaRelojes;
use tiendaRelojes;

create table producto (
    id int auto_increment primary key,
    nombre varchar(50) not null,
    marca varchar(50) not null,
    modelo varchar(50) not null,
    precio decimal(10, 2) not null,
    imagen varchar(500) not null, 
    stock int not null,
    descripcion varchar(400) not null
);

create table usuario (
    id int auto_increment primary key,
    nombre varchar(30) not null,
    apellidos varchar(50) not null,
    correoElectronico varchar(50) not null unique,
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
    foreign key (idProducto) references producto(id) on delete cascade,
    foreign key (idCliente) references usuario(id) on delete cascade
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
    foreign key (idProducto) references producto(id) on delete cascade,
    foreign key (idCliente) references usuario(id) on delete cascade
);

create table usuarios_newsletter (
    id int auto_increment primary key,
    correoElectronico varchar(50) not null,
    foreign key (correoElectronico) references usuario(correoElectronico) on delete cascade
);

-- Insertar productos
INSERT INTO producto (id, nombre, marca, modelo, precio, imagen, stock, descripcion)
VALUES 
  (null, 'Oyster Perpetual 41', 'Rolex', 'Oyster', 6600, 'oyster_perpetual_41.avif', 5, '41 mm, acero Oystersteel'),
  (null, 'Dajejust 36', 'Rolex', 'Dajejust', 13350, 'dajejust_36.avif', 3, '36 mm, acero Oystersteel y oro amarillo'),
  (null, 'Oyster Perpetual 36', 'Rolex', 'Oyster', 6300, 'oyster_perpetual_36.avif', 1, '36 mm, acero Oystersteel'),
  (null, 'Nautilus acero', 'Patek Philippe', 'Nautilus', 32170, 'nautilus.png', 1, 'Brazalete de acero. Cierre desplegable Nautilus. Movimineto mecánico de cuerda. Opalina azul  índices y cifras aplicados de oro, con revestimiento luminiscente.'),
  (null, 'Nautilus oro blanco', 'Patek Philippe', 'Nautilus', 415920, 'nautilus_oro_blanco.png', 1, 'Brazalete de oro blanco, engastado en diamantes. Cierre desplegable Nautilus. Movimineto mecánico de cuerda. Engastado en un total de 2364 diamantes.'),
  (null, 'Nautilus oro blanco', 'Patek Philippe', 'Nautilus', 535510, 'nautilus_oro_blanco_diamantes_verdes.png', 1, 'Brazalete de oro blanco, engastado en diamantes y esmeraldas. Cierre desplegable  patentado engastado con diamantes. Movimineto mecánico de carga automática. Engastado en 1500 diamantes y 876 esmeraldas.'),
  (null, 'RM 66', 'Richard Mille', 'RM', 1095000, 'RM66.webp', 5, 'Mano de oro rojo 5N. Barrilete de rotación rápida. Cuerda manual. Edicion limitada de 50 piezas.'),
  (null, 'Day-Date 36', 'Rolex', 'Oyster', 41000, 'oyster_perpetual_day-date36.avif', 5, '36 mm, oro amarillo.'),
  (null, 'GMT-Master II', 'Rolex', 'GMT', 46250, 'gmt_masterII.avif', 5, '40 mm, oro blanco.'),
(null, 'Deepsea', 'Rolex', 'Submariner', 56300, 'submariner_deepsea.avif', 5, '44 mm, oro amarillo.'),
 (null, 'Air-King', 'Rolex', 'Air king', 7700, 'air_king.avif', 5, '40 mm, acero Oystersteel.'),
(null, 'Cosmograph Daytona', 'Rolex', 'Daytona', 121450, 'cosmograph_daytona.avif', 5, '40 mm, oro amarillo y diamantes.'),
(null, 'Seastar 1000 Powermatic 80', 'Tissot', 'Seastar 1000', 875, 'tissot_Seastar_1000_powermatic80_40mm.png', 15, '40 mm, brazalete intercambiable. Hasta 80 de reserva de marcha.'),
(null, 'Supersport chrono', 'Tissot', 'Supersport', 575, 'tissot_supersportChrono.png', 15, '45.5 mm, brazalete intercambiable. Caja de acero inoxidable con revestimiento de oro amarillo.'),
(null, 'Rainbow', 'Patek Philippe', 'Rainbow', 750000, 'patekDiamonds.png', 3, '46 mm, 500 diamantes de colores incrustados. Oro blanco.'),
(null, 'Grandes complicaciones', 'Patek Philippe', 'Complicaciones', 351120, 'patekCueroRojo.png', 3, '43 mm, 80 rubíes buguette.'),
(null, 'Aquanaut Loce', 'Patek Philippe', 'Aquanaut', 49370, 'patek_Aquanaut_luce.png', 3, '42.2 mm, oro blanco.'),
(null, 'Com', 'Patek Philippe', 'Aquanaut', 54140, 'patek_aquanutOro.png', 15, '38.8 mm, oro rosa. Fondo de cristal de zafiro.'),
(null, 'World time', 'Patek Philippe', 'Complicaciones', 109220, 'patek_complicaciones.png', 5, '39.8 mm, platino. Fondo de cristal de zafiro.'),
(null, 'PRX', 'Tissot', 'PRX', 4119, 'tissot_PRX.png', 4, '42 mm, movimiento de cuarzo suizo. Caja de acero inoxidable.'),
(null, 'PRX powermatic', 'Tissot', 'PRX', 3822, 'tissot_prx_powermatic.png', 5, '42 mm, movimiento de cuarzo suizo. Resistente al agua.'),
(null, 'Race chronograph', 'Tissot', 'Race', 3334, 'tissot_raceChronograph.png', 5, '45 mm, brazalete de acero.'),
(null, 'PRX 35mm', 'Tissot', 'PRX', 2615, 't_prx35mm.png', 5, '35 mm, brazalete de acero.'),
(null, 'Classic dream', 'Tissot', 'Dream', 1949, 't_classicDream.png', 5, '42 mm, brazalete de acero.'),
(null, 'PRX automatic', 'Tissot', 'PRX', 6545, 't_prxAutomatic.png', 3, '41 mm, brazalete de acero inoxidable. Cristal de zafiro'),
(null, 'Hamilton ventura', 'Hamilton', 'Ventura', 1863, 'hamiltonVentura.png', 3, 'Ha aparecido en mas de 500 peliculas.'),
(null, 'Black Venom', 'Rolex', 'Dajejust', 14900, 'Datejust-II-Venum.png', 3, 'Edicion limitada.'),
(null, 'T-race cycling vuelta 2023', 'Tissot', 'T-race', 1456, 't-race.png', 5, '45 mm, caja de carbono. Cristal de zafiro.'),
(null, 'Le locle', 'Tissot', 'Le Locle', 2856, 'leLocle.png', 5, '39.3 mm, caja acero inoxidable. Cristal de zafiro.');














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
