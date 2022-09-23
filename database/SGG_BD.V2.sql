-- drop database sgg_db; 
create database  sgg_db;
use sgg_db;
create table persona(
	id int(9) primary key auto_increment,
	nombre varchar (20),
	apellido varchar (20),
	email varchar (48) not null,
	clave varchar (24) not null
);

 create table cliente(
	idc int (9) primary key,
	inactivo boolean,
	telefono int(9),
	foreign key (idc) references persona(id)
);

create table vendedor(
	idv int(9) primary key,
	inactivo boolean,
	foreign key (idv) references persona(id)
);

create table pedido(
	id_ped int (9) primary key auto_increment,
	precio_ped float (6) not null check (precio_ped>0),
	comentario varchar (200)
);

create table pide(
	id int(9),
	id_ped int(9),
    primary key (id, id_ped),
	foreign key (id) references cliente(idc),
	foreign key (id_ped) references pedido(id_ped)
);

create table evento(
	id_evento int (9) primary key auto_increment,
    nom_e varchar (48),
    descripcion_e varchar (400),
    fecha date,
    calle varchar(24),
    nro_p int (5)
);

create table elaborado_en (
	id_ped int (9) primary key,
	id_evento int (9),
	foreign key (id_ped) references pedido(id_ped)
);

create table controla (
	id_ped int(9),
	idv int (9),
    primary key (id_ped, idv),
	foreign key (id_ped) references pedido(id_ped),
	foreign key (idv) references vendedor(idv)
);

create table producto(
	id_prod int (9) primary key auto_increment,
    nom_pro varchar (48) not null,
    descri_pro varchar (400),
    tipo varchar (24),
    inactivo boolean,
    precio_elav float(6) not null check (precio_elav>0),
    precio_venta float (6) not null check (precio_venta>0),
    cantidad int (6) not null,
    img_id varchar(128)
);

create table vende(
	id_prod int (9) primary key,
    idv int(9),
    foreign key (id_prod) references producto(id_prod)
);

create table receta(
	id_rec int (9) primary key auto_increment,
    nom_r varchar(48),
    descri_r varchar(600),
    img_id varchar(48)
);

create table insumo(
	id_insu int (9) primary key auto_increment,
    nom_insu varchar (24),
    cant_disp int (9) not null,
    precio_insu float (10) not null check (precio_insu>0),
    img_insu varchar(128)
);

create table contiene (
	id_rec int (9),
    id_insu int (9),
    unidad_med float(10),
    cant_in_xreceta int(10) not null,
	primary key (id_rec, id_insu),
    foreign key (id_rec) references receta(id_rec),
    foreign key (id_insu) references insumo(id_insu)
);

create table elaborado_con (
	id_rec int (9) ,
    id_insu int (9),
    primary key (id_rec, id_insu),
    id_prod int (9),
    foreign key (id_rec) references receta(id_rec),
    foreign key (id_insu) references insumo(id_insu)
);

create table tiene (
	id_prod int (9),
    id_ped int (9),
    cant_pro_xped int (10) not null,
    nombre_prod varchar (20),
    subtotal float(10) not null check (subtotal>0),
    primary key (id_prod, id_ped),
    foreign key (id_prod) references producto(id_prod),
    foreign key (id_ped) references pedido(id_ped)
);

-- Datos de prueba para testear el ingreso y carga de datos --
insert into persona values 
('','Santiago','Mera','elsanty79@gmail.com','santy1'),
('','Cristian','Veloz','cveloz@estudiante.ceibal.edu.uy','cveloz'),
('','Micaela','Lain','lainmicaela@gmail.com','micalain');

insert into producto values 
('','Fideos con tuco','Son Moñitas con tuco','Comestible',false,'500','700','10','Fideos.jpg'),
('','Milanesa de Pollo con Puré','CLASICO PA','Comestible',false,'300','500','23','Milaconpure.jpg');
