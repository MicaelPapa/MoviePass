use moviepassdb;


create table movieXcinema (
	idmovieXcinema int not null auto_increment,
	idCinema int,
	idMovie int,
	
	constraint pkmovieXcinema primary key (idmovieXcinema),
	constraint fk_idCinema foreign key (idCinema) references cinemas(idCinema),
	constraint fk_idMovie foreign key  (idMovie) references movies(idMovie)
);

select * from moviexcinema;
select * from movies ;
select * from cinemas;

delete from movies