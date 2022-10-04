drop database soge_db; 
create database  soge_db;
use soge_db;
create table persona(
	id int(9) primary key auto_increment,
	nombre varchar (20),
	apellido varchar (20),
	email varchar (48) not null,
	clave varchar (24) not null
);

 create table cliente(
	idc int (9) primary key auto_increment,
	inactivo boolean,
	telefono int(9),
	foreign key (idc) references persona(id)
);

create table vendedor(
	idv int(9) primary key auto_increment,
	inactivo boolean,
	foreign key (idv) references persona(id)
);

create table evento(
	id_evento int (9) primary key auto_increment,
    nom_e varchar (48),
    descripcion_e varchar (400),
    fecha date,
    calle varchar(24),
    nro_p int (5)
);

create table pedido(
	id_ped int (9) primary key auto_increment,
    id_evento int (9),
	precio_ped float (6) not null check (precio_ped>0),
	comentario varchar (200),
    foreign key (id_evento) references evento(id_evento)
);

create table pide(
	id int(9) auto_increment,
	id_ped int(9),
    primary key (id, id_ped),
	foreign key (id) references cliente(idc),
	foreign key (id_ped) references pedido(id_ped)
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
    unidad_med varchar(10),
    cant_in_xreceta float(10) not null,
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
('0','Santiago','Mera','elsanty79@gmail.com','santy1'),
('0','Cristian','Veloz','cveloz@estudiante.ceibal.edu.uy','cveloz'),
('0','Micaela','Lain','lainmicaela@gmail.com','micalain'),
('0','EPOCH','Web','epochweb@gmail.com','12345');

insert into producto values 
('0','Fideos con tuco','El tuco es una salsa tradicional de países como Uruguay, Argentina, y Chile, preparada a base de tomate y carne. Se suele usar para acompañar fideos o ñoquis del domingo, además de las polentas de invierno.','Comestible',false,'100','150','10','Fideos.jpg'),
('0','Milanesa de Pollo con Puré','MILANESAS CON PURÉ podríamos decir que es uno de los mejores platos del mundo, no? y encima con la receta de la abuela y todos sus tips!','Comestible',false,'300','500','23','Milaconpure.jpg'),
('0','Bizcochuelo','Sí, el clasiquísimo bizcochuelo. Absolutamente indiscutido y muy difícil de bajar del podio de las mejores recetas dulces.','Comestible',true,'50','150','10','bizcochuelo.jpg');

insert into evento values
('0','Mesias','Venta de organos','2022-10-05','perdomo','35'),
('0','Venta de hamburuguesas','Hay promociones','2023-02-10','pou','105'),
('0','Programacion al aire libre','No se olviden de traer la compu','2022-11-25','gigante','123');

insert into pedido values
('0','1','550','X2 Muzzarella'),
('0','1','320','Doble cheddar'),
('0','2','710','Sin lechuga'),
('0','2','400','Extra Mayonesa');

insert into cliente values
('0',true,'09999999'),
('0',false,'09823241'),
('0',true,'096231321');

insert into vendedor values
('0',true),
('0',false),
('0',true);

insert into insumo values
('0','Harina',200,40,'harina.png'),
('0','Lechon',3000,1200,'lechon.png'),
('0','Levadura',20,56,'levadura.png'),
('0','Aceite Neutro',500,190,'aceite.png'),
('0','Azucar',1000,40,'azucar.png'),
('0','Huevos',6,140,'huevo.png'),
('0','Vainilla',100,154,'vainilla.png');

insert into receta values
('0','Bizcochuelo casero','Para toda la familia','bizco.png');

insert into contiene values
('1','1','g','400'),
('1','3','g','40'),
('1','4','ml','236.588'),
('1','5','g','200'),
('1','6','unit','3'),
('1','7','ml','65');

insert into elaborado_con values
('1','1','3'),
('1','3','3'),
('1','4','3'),
('1','5','3'),
('1','6','3'),
('1','7','3');

insert into elaborado_en values
('3','1');

insert into pide values
('0','1');

insert into vende values
('1','1'),
('2','1');

-- 1.	Listado de los productos existentes, mostrando su nombre, precio y a la categoría que pertenece.--
select nom_pro,precio_elav,precio_venta,cantidad from producto;
-- 2.	Mostrar los eventos que se encuentran entre dos fechas.--
select * from evento where fecha between '2022-10-05' and '2022-11-25';
-- 3.	Lista de los pedidos solicitados en un evento específico. --
select * from pedido inner join evento on evento.id_evento;
-- 4.	Mostrar los datos del cliente y el pedido solicitado para una determinada fecha.--
select idc,telefono,id_ped,fecha from cliente inner join pide,evento;
-- 5.	Para un vendedor específico, mostrar los eventos y los pedidos que controló en un mes.--
select vendedor.idv,nom_e,descripcion_e,fecha,calle,nro_p,id_prod from vendedor inner join evento,vende where vendedor.idv=1;
-- 6.	Mostrar los ingredientes necesarios para un determinado producto.--
select nom_pro from producto where nom_pro='Bizcochuelo';
-- 7.	Mostrar la receta para un producto específico.--
-- 8.	Calcular cantidad de gramos necesarios de un ingrediente, para una determinada cantidad de un producto específico.  Por ejemplo: ¿cuántos gramos de azúcar necesitaría para realizar 10 postres de chocolate?--
-- 9.	Teniendo en cuenta la cantidad, los ingredientes necesarios para cada receta y su precio, determinar y mostrar el precio de costo de un determinado producto.--
-- 10.	Teniendo en cuenta el precio de costo y el precio de venta de cada producto: listar los productos, precio de costo, precio de venta y la ganancia de cada uno de ellos.--
-- 11.	Mostrar, para un evento específico, producto solicitado, tiempo que demoró en entregarse (tiempo entre que se solicitó y se entregó).--
-- 12.	Listar productos que se encuentran en oferta, su precio y la fecha final de dicha oferta.--