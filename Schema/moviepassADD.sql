use moviepassdb;


create table movieXcinema (
	idmovieXcinema int not null auto_increment,
	idCinema int,
	idMovie int,
	
	constraint pkmovieXcinema primary key (idmovieXcinema),
	constraint fk_idCinema foreign key (idCinema) references cinemas(idCinema),
	constraint fk_idMovie foreign key  (idMovie) references movies(idMovie)
);

select * from moviexcinema WHERE IdMovieIMDB = 635302 AND idCinema = 13;
select * from movies ;
select * from cinemas;
DELETE FROM moviexcinema WHERE IdMovieIMDB = 635302 AND idCinema = 13;

/*
                        $screening = new Screening();
                        $screening->setIdScreening($row["IdScreening"]);
			          //  $screening->setIdMovie($row["IdMovie"]);
                        $screening->setIdMovieIMDB($row["IdMovieIMDB"]);
                        $screening->setStartDate($row["StartDate"]);
                        $screening->setLastDate($row["LastDate"]);
                        $screening->setIdRoom($row["IdRoom"]);
                        $screening->setIdCinema($row["IdCinema"]);
                        $screening->setDimension($row["Dimension"]);
                        $screening->setAudio($row["Audio"]);
                        $screening->setPrice($row["Price"]);
                        $screening->setSubtitles($row["Subtitles"]);
                        $screening->setStartHour($row["StartHour"]);
                        $screening->setFinishHour($row["FinishHour"]);
                        $screening->setMovie($movie); }
                        
                        
                        */
                        
 select * from screenings  where  IdMovieIMDB =724989  and  StartDate = "21" and IdCinema != 1;   /*cine unico                  */
 select * from screenings where  IdMovieIMDB =724989 and IdRoom != 123; /*sala unica */
 select * from screenings where  IdMovieIMDB =724989 and StartDate = "" and StartHour between "hora de inicio" and "hora de fin"; /*horario unico*/
select * from screenings; 
select hour(finishhour) from screenings; 
select * from moviexcinema ;
select *  from screenings s inner join moviexcinema mc on s.idmovie = mc.idMovie and s.idcinema = mc.idCinema where s.IdCinema =12;

select * from Screenings  where  IdMovieIMDB = 724989 and  StartDate = 2020-11-07 and IdCinema != 13 ;
select * from Screenings where IdMovieIMDB = 724989 and IdRoom != 25 and IdCinema = 13 ;
select * from Screenings where  IdMovieIMDB = 724989 and StartDate = '2020-11-04' and (( CAST('2020-11-04 01:32:00' AS  DATETIME) between StartHour AND finishhour) or (CAST('2020-11-04 03:17:00' AS  DATETIME) between StartHour AND finishhour)); /*nueva*/
select * from Screenings where  IdMovieIMDB = 724989 and StartDate = '2020-11-05'  and ( (CAST('2020-11-04 01:30:00' AS  DATETIME) between StartHour and finishHour) or (CAST('2020-11-04 03:25:00' AS  DATETIME) between StartHour and finishHour) ) ;

/*BEGIN

select    // ID ORDER, SUBTOTAL, TOTAL, HORA DE LA PELICULA, NOMBRE SALA, NOMBRE PELICULA,  SUBTITULOS, NOMBRE DE CINE, DIRECCION DEL CINE, NOMBRE DEL USUARIO//
orders.idorder,
concat('$',orders.Discount) as Discount,
concat('$',orders.SubTotal) as SubTotal,
concat('$',orders.Total) as Total,
screenings.startdate,
rooms.roomnumber,
movies.moviename,
if(screenings.Subtitles is null, screenings.audio, concat('Sub ',screenings.subtitles)) as MovieLanguage,
screenings.Dimension,
cinemas.cinemaname,
concat(addresses.street,' ',addresses.numberstreet) as CinemaAddress,
users.UserName
FROM orders
inner join screenings on screenings.IdScreening = orders.IdScreening
inner join rooms on screenings.IdRoom = rooms.IdRoom
inner join movies on screenings.IdMovie = movies.IdMovie
inner join cinemas on rooms.CinemaId = cinemas.IdCinema
inner join addresses on cinemas.IdAddress = addresses.IdAddress
inner join users on users.IdUser = orders.IdUser
WHERE (users.IdUser = UserId AND screenings.StartDate > if(TodayDate is null,'0001-01-01',TodayDate))
GROUP BY(orders.IdOrder) ORDER BY screenings.StartDate ASC;

END*/



select * from screenings;

CALL BuyTickets(3,69,1,150);
 select * from orders;
select * from Screenings where  IdMovieIMDB = 724989 and StartHour between CAST('23:02' AS  DATE) and CAST('00:47' AS  DATE);
describe screenings;

select * from Screenings where  IdMovieIMDB = 724989 and StartDate = 2020-11-07;
select * from Screenings where  IdMovieIMDB = 724989 and StartDate = 2020-11-07 and StartHour between CAST('23:02' AS DATE) AND CAST('2003-01-31' AS DATE);

delete from moviexcinema where idmovieXcinema = 39;

select * from movies;


SELECT * FROM rooms WHERE RoomNumber = 'Sala Aldrey 2';
ALTER TABLE `screenings` CHANGE `StartHour` `StartHour` DATETIME NOT NULL;
