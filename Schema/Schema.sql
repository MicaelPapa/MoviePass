/*DROP DATABASE MOVIEPASSDB;*/

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
    RemainTickets int,
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
    cantTickets int,
    constraint Pk_Orders primary key (IdOrder)
);

create table Tickets (
    IdTicket int AUTO_INCREMENT,
    QrCode varchar(200),
    IdUser int not null,
    IdScreening int not null,
    IdOrder int not null,
    constraint Pk_Ticket primary key (IdTicket),
    constraint Fk_User foreign key (IdUser)
        references Users (IdUser),
    constraint Fk_Screening foreign key (IdScreening)
        references Screenings (IdScreening),
    constraint Fk_Order foreign key (IdOrder)
        references Orders (IdOrder)
);


DELIMITER $$
 CREATE PROCEDURE `BuyTickets`( IN `IdFuncion` INT, IN `CantTickets` INT, IN `Price` INT) 

BEGIN 
	declare MoviePrice decimal default 0.0; declare Discount decimal default 0.0; 
	declare LastInsertIdOrders int default 0; 
	declare AsignedRoom int default 0;
	insert into orders
	(SubTotal,Total,DatePurchase,Discount,cantTickets) 
	values(Price * CantTickets, Price * CantTickets * (CASE WHEN DAYOFWEEK(now()) = 3 or DAYOFWEEK(now()) = 4 THEN 0.75 ELSE 1 END), now(), (CASE WHEN DAYOFWEEK(now()) = 3 or DAYOFWEEK(now()) = 4 THEN 25 ELSE 0 END), CantTickets); 
	update screenings set RemainTickets = RemainTickets - CantTickets where idScreening = IdFuncion; 
 END $$
DELIMITER ;

DELIMITER  $$
create procedure sp_insert_cinema(pNumberStreet int, pStreet varchar(50), pcinemaName  varchar(50), out pid_address varchar(50)) 
begin
	
		INSERT INTO addresses (Street, NumberStreet) VALUES ( pStreet, pNumberStreet);
		
        SET pid_address = last_insert_id();
		
        INSERT INTO cinemas (CinemaName, IdAddress)
			values (pcinemaName,pid_address);
end;
$$
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

/*INSERT USUARIO NORMAL*/
/* user : usuario@gmail.com password: pass*/
insert into Users(UserName,Email,UserPassword,IdGender,Photo,BirthDate,IsAdmin,ChangedPassword) 
values('generico','usuario@gmail.com','9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684',2,'/MoviePass/Views/img/boy-1.png','1996-11-03',0,0);

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







