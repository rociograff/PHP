/*Estructura para la tabla 'teatro'*/
create table teatro (
	id_teatro int not null auto_increment,
	nombre varchar(50),
	direccion varchar(50),
	primary key(id_teatro)
)engine=innodb default character set=utf8 auto_increment=1;

/*Estructura para la tabla 'funcion'*/
create table funcion (
	id_funcion int not null auto_increment,
	nombre varchar(50),
	precio float(5),
	hora_inicio float(5),
	duracion integer(3),
	id_teatro int,
	primary key(id_funcion),
	foreign key(id_teatro) references teatro(id_teatro)
)engine=innodb default character set=utf8 auto_increment=1;

/*Estructura para la tabla 'musical'*/
create table musical (
	id_funcion int,
	director varchar(50),
	cant_personas integer(3),
	primary key(id_funcion),
	foreign key(id_funcion) references funcion(id_funcion)
)engine=innodb default character set=utf8;

/*Estructura para la tabla 'obra'*/
create table obra (
	id_funcion int,
	autor varchar(50),
	primary key(id_funcion),
	foreign key(id_funcion)references funcion(id_funcion)
)engine=innodb default character set=utf8;

/*Estructura para la tabla 'pelicula'*/
create table pelicula (
	id_funcion int,
	genero varchar(30),
	pais_origen varchar(30),
	primary key(id_funcion),
	foreign key (id_funcion) references funcion(id_funcion)
)engine=innodb default character set=utf8;