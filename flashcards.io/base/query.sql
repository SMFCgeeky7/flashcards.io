create database infocal;

show databases;
use infocal;
show tables;

create table estudiante(
    id int primary key auto_increment,
    nombre varchar(25),
    apellido varchar(10),
    edad int,
    telefono varchar(10)
);

create table materia(
    id int primary key auto_increment,
    nombre varchar(25),
    semestre int
);

create table referencias(
    id int primary key auto_increment,
    nombre varchar(25),
    relacion varchar(15),
    telefono varchar(10),
    estudiante_id int,
    foreign key (estudiante_id) references estudiante(id)
);


create table estudiante_referencia(
    id int primary key auto_increment,
    estudiante_id int,
    materia_id int,
    foreign key (estudiante_id) references estudiante(id),
    foreign key (materia_id) references materia(id)
);

create table productos(
    id int primary key auto_increment,
    nombre varchar(25),
    unidad varchar(10),
    precio float(8,2),
    activo boolean
);

create table recibos(
    id int primary key auto_increment,
    nit_id int default 1,
    fecha datetime,
    foreign key (nit_id) references nit(id)
)

create table recibos_productos(
    id int primary key auto_increment,
    precio float(8,2),
    cantidad float(8,2),
    recibo_id int,
    producto_id int
)

insert into referencias values(default,"Fabiana","Hermana","4865464",2);
insert into referencias values(default,"Mario","Papa","456452312",2);
insert into referencias values(default,"Pablo","Vecino","456452312",1);


insert into estudiante values(default,"Pedro","Picapiedra",45,"78456");
insert into estudiante values(default,"Maria","Prado",25,"432432");
insert into estudiante values(default,"Jose","Peres",45,"432321");
insert into estudiante values(default,"Milton","Vargas",45,"32432");
insert into estudiante values(default,"Javier","Vaca",45,"423432");

insert into materia values(default, "Programacion", 1);
insert into materia values(default, "Web", 4);



select * from estudiante;
select * from referencias;
update estudiante set edad = 28 where id = 3;

delete from estudiante where id = 3;

select nombre, apellido, edad from estudiante where edad < 20;



select * from estudiante
join referencias on estudiante.id = referencias.estudiante_id;