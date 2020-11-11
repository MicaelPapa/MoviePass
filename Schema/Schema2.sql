DROP DATABASE MOVIEPASSDB;

CREATE DATABASE MOVIEPASSDB;

USE MOVIEPASSDB;


create table Addresses (
    IdAddress int AUTO_INCREMENT,
    Street varchar(100) not null,
    NumberStreet int not null,
    constraint Pk_Addresses primary key (IdAddress)
);

create table Cinemas (
    IdCinema int AUTO_INCREMENT,
    CinemaName varchar(50) not null,
    IdAddress int not null,
    constraint Pk_Cinema primary key (IdCinema),
    constraint Fk_Address foreign key (IdAddress)
        references Addresses (IdAddress)
);

create table NonWorkDays (
    IdNonWorkDay int AUTO_INCREMENT,
    DateNonWorkDay date not null,
    Reason varchar(300) not null,
    constraint Pk_NonWorkDays primary key (IdNonWorkDay)
);

create table NonWorkDaysXCinemas (
    IdNonWorkDay int not null,
    IdCinema int not null,
    constraint Pk_NonWorkDaysXCinemas primary key (IdNonWorkDay , IdCinema),
    constraint Fk_NonWorkDays foreign key (IdNonWorkDay)
        references NonWorkDays (IdNonWorkDay),
    constraint Fk_Cinema foreign key (IdCinema)
        references Cinemas (IdCinema)
);

create table Clasifications (
    IdClasification int AUTO_INCREMENT,
    ClasificationCode varchar(20),
    Description varchar(200),
    constraint Pk_Clasifications primary key (IdClasification)
);


create table Genders (
    IdGender int AUTO_INCREMENT,
    GenderName varchar(50) not null,
    constraint Pk_Genders primary key (IdGender)
);

create table MovieGenres (
    IdMovieGenre int AUTO_INCREMENT,
    IdIMDB int not null,
    Name varchar(100) not null,
    constraint Pk_Genders primary key (IdMovieGenre)
);
create table Movies (
    IdMovie int AUTO_INCREMENT,
    IdMovieIMDB int,
    MovieName varchar(250) not null,
    Duration int,
    Synopsis varchar(800),
    ReleaseDate date,
    Photo varchar(200) DEFAULT null,
    Earnings decimal(15 , 2 ),
    Budget decimal(15 , 2 ),
    OriginalLanguage varchar(30),
    IsPlaying boolean,
    constraint Pk_Movies primary key (IdMovie)

);

create table moviesXmoviesgenres (
    IdMovieIMDB int,
    IdGenreIMDB int,
    constraint Pk_moviesXmoviesgenres primary key (IdMovieIMDB , IdGenreIMDB),
    constraint Fk_Movies foreign key (IdMovieIMDB)
        references Movies (IdMovieIMDB),
    constraint Fk_IdGenreIMDB foreign key (IdGenreIMDB)
        references MovieGenres (IdGenreIMDB)
);


create table Rooms (
    IdRoom int AUTO_INCREMENT,
    RoomNumber varchar(50) not null,
    CinemaId int NOT NULL,
    Capacity int NOT NULL,
    constraint PK_Rooms primary key (IdRoom),
    constraint Fk_Cinema foreign key (CinemaId)
        references Cinemas (IdCinema)
);

create table Users (
    IdUser int AUTO_INCREMENT,
    UserName varchar(50) not null,
    Email varchar(50) not null UNIQUE,
    UserPassword varchar(50) not null,
    IdGender int not null,
	Photo varchar(250),
    Birthdate date,
	IsAdmin bit,
	ChangedPassword bit,
    constraint Pk_Users primary key (IdUser),
    constraint Fk_Gender foreign key (IdGender)
        references Genders (IdGender)
);



create table Screenings (
    IdScreening int AUTO_INCREMENT,
    IdMovieIMDB int not null,
	IdMovie int,
    StartDate datetime not null,
    LastDate datetime not null,
    StartHour DATETIME NOT NULL,
    FinishHour datetime not null,
    Price decimal,
    IdRoom int not null,
    IdCinema int not null,
    Subtitles varchar(20),
    Audio varchar(20) not null,
    Dimension varchar(20) not null,
    constraint Pk_Screenings primary key (IdScreening),
    constraint Fk_Movie foreign key (IdMovieIMDB)
        references Movies (IdMovieIMDB),
    constraint Fk_Room foreign key (IdRoom)
        references Rooms (IdRoom),
    constraint Fk_Cinema foreign key (IdCinema)
        references Cinemas (IdCinema)
);
create table movieXcinema (
	idmovieXcinema int not null auto_increment,
	idCinema int,
	idMovie int,
	
	constraint pkmovieXcinema primary key (idmovieXcinema),
	constraint fk_idCinema foreign key (idCinema) references cinemas(idCinema),
	constraint fk_idMovie foreign key  (idMovie) references movies(idMovie)
);


create table Orders (
    IdOrder int AUTO_INCREMENT,
    SubTotal decimal(10 , 2 ),
    Total decimal(10 , 2 ),
    DatePurchase datetime not null,
    Discount decimal(6 , 2 ),
    IdUser int not null,
    IdScreening int not null,
    cantTickets int,
    constraint Pk_Orders primary key (IdOrder),
    constraint Fk_User foreign key (IdUser)
        references Users (IdUser),
    constraint Fk_Screening foreign key (IdScreening)
        references Screenings (IdScreening)
);


DELIMITER $$


CREATE PROCEDURE GetOrdersByUser(UserId int, TodayDate Date)
BEGIN

select  
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

END $$ 
DELIMITER ;

DELIMITER $$


CREATE PROCEDURE GetScreeningsByMovieAndCinema(MovieId int, CinemaId int)
BEGIN

select screenings.StartDate,screenings.price, movies.MovieName from screenings
inner join movies on screenings.IdMovie = movies.IdMovie 
inner join rooms on screenings.idroom = rooms.IdRoom
inner join cinemas on rooms.cinemaid = cinemas.IdCinema
inner join addresses on addresses.IdAddress = cinemas.IdAddress
inner join cities on cities.IdCity = addresses.IdCity 
where cities.idcity = CityId;

END $$
 
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE GetMostPopularMovies()
BEGIN

select 
    count(tickets.idticket) / (select count(tickets.idticket) from tickets) * 100 as Popularity,
    movies.idmovie,
    movies.moviename,
    sum(tickets.price) as moneyCollection
from
    tickets
        inner join
    orders ON orders.idorder = tickets.idorder
        inner join
    screenings ON screenings.idscreening = orders.idscreening
        inner join
    movies ON movies.idmovie = screenings.idmovie
group by 2 , 3
order by (Popularity) desc
limit 3;

END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE GetLessPopularMovies()
BEGIN
select 
    count(tickets.idticket) / (select 
            count(tickets.idticket)
        from
            tickets) * 100 as Popularity,
    movies.idmovie,
    movies.moviename,
    sum(tickets.price) as moneyCollection
from
    tickets
        inner join
    orders ON orders.idorder = tickets.idorder
        inner join
    screenings ON screenings.idscreening = orders.idscreening
        inner join
    movies ON movies.idmovie = screenings.idmovie
group by 2 , 3
order by (Popularity) asc
limit 3;

END $$
DELIMITER ;

DELIMITER $$
 CREATE PROCEDURE `BuyTickets`(IN `IdUser` INT, IN `IdFuncion` INT, IN `CantTickets` INT, IN `Price` INT) 

BEGIN 
	declare MoviePrice decimal default 0.0; declare Discount decimal default 0.0; 
	declare LastInsertIdOrders int default 0; 
	declare AsignedRoom int default 0;
	insert into orders
	(SubTotal,Total,DatePurchase,Discount,IdUser,IdScreening,cantTickets) 
	values(Price * CantTickets, Price * CantTickets * (CASE WHEN DAYOFWEEK(now()) = 3 or DAYOFWEEK(now()) = 4 THEN 0.75 ELSE 1 END), now(), (CASE WHEN DAYOFWEEK(now()) = 3 or DAYOFWEEK(now()) = 4 THEN 25 ELSE 0 END), IdUser, IdFuncion, CantTickets); 
	update screenings set RemainTickets = RemainTickets - CantTickets where idScreening = IdFuncion; 
 END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE GetCapacityPerScreening(IdFuncion int)
BEGIN

select Capacity from screenings where IdScreening = IdFuncion;

END $$
DELIMITER ;


/*Inserts*/
insert into genders(GenderName) values('Female'),('Male'),('Other');
insert into addresses(street,numberstreet) values('Cordoba',1543),('Sarmiento',3123),('Diagonal',1440);
insert into cinemas(CinemaName,idAddress) values('Ambassador',1),('Aldrey',2),('Del Paseo',3);
insert into rooms(RoomNumber,CinemaId,Capacity) values ('Sala Ambassador 1',1,40),('Sala Ambassador 2',1,40),('Sala Aldrey 1',2,50), ('Sala Aldrey 2',2,50), ('Sala Diagonal 1',3,35), ('Sala Diagonal 2',3,40);

/*INSERT ADMIN */
/* user: admin@gmail.com, password: admin */
insert into Users(UserName,Email,UserPassword,IdGender,Photo,BirthDate,IsAdmin,ChangedPassword) 
values('admin','admin@gmail.com','d033e22ae348aeb5660fc2140aec35850c4da997',2,'/MoviePass/Views/img/boy-1.png',now(),1,0);

/* EJEMPLOS TARJETAS DE CREDITO
VISA:
4024007196573033
4532533282476786

MasterCard:
5171918834349602
5396108968991879

Maestro:
6761293125899325
5018731929583051

*/



/*insert into tickets(price,idroom,idseatrow,idseatcol,idorder) values(1,1,1,1,1),(1,1,1,1,2),(1,1,1,1,3);
insert into orders(subtotal,total,datepurchase,discount,iduser,idscreening) values(1,1,now(),1,1,1),(1,1,now(),1,1,2),(1,1,now(),1,1,3);
insert into screenings(idmovie,startdate,lastdate,starthour,finishhour,price,idroom,capacity,idcinema,subtitles,audio,dimension)
values(1,now(),now(),hour(now()),hour(now()),1,1,1,1,1,1,1),(2,now(),1,1,1,1,1),(3,now(),1,1,1,1,1);
insert into movies(idmovieimdb,moviename,duration,synopsis,releasedate,photo,earnings,budget,originallanguage,isplaying) 
values(1,'Rambo',1,"Una peli",now(),'asd',1,1,"spanish",1),(1,'Malefica',1,"Una peli",now(),'asd',1,1,"spanish",1),
(1,'Duro de Matar',1,"Una peli",now(),'asd',1,1,"spanish",1);*/




