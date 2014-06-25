drop table if exists archivos;

create table archivos(
	id serial primary key,
	origen varchar not null,
	destino varchar not null,
	direccion varchar 
);