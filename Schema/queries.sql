USE moviepassdb;

insert into users (UserName, Email, UserPassword, IdGender, Photo, Birthdate, IsAdmin, ChangedPassword) values ('RomanAdmin', 'admin@gmail.com', '123', 2, '/MoviePass/Views/man-1.png', '1995-01-29', 1, 0);

/* INSERT INTO genders (GenderName) VALUES ('Female');

insert into Genders (GenderName) values ('Male');

insert into Genders (GenderName)values ('Not binary');

select * from genders; */

DELIMITER $$

use Moviepassdb;

CREATE PROCEDURE GetOrdersByUser(UserId int) 
BEGIN

select  orders.Discount,
		orders.SubTotal,
		orders.Total,
		(SELECT concat(tickets.idseatcol,tickets.IdSeatRow,', ') FROM tickets WHERE tickets.idorder = orders.idorder) as MovieSeats,
		screenings.startdate,
		rooms.roomnumber,
		movies.moviename,
		if(screenings.IdSubsLanguage is null, languages.description, concat('sub ',languages.description)) as MovieLanguage,
		dimensions.dimensiondescrip,
		cinemas.cinemaname,
		concat(addresses.street,' ',addresses.numberstreet) as CinemaAddress,
		users.UserName
FROM orders
		inner join tickets on tickets.idorder = orders.IdOrder
		inner join screenings on screenings.IdScreening = orders.IdScreening
		inner join rooms on screenings.IdRoom = rooms.IdRoom
		inner join movies on screenings.IdMovie = movies.IdMovie
		inner join languages on languages.IdLanguage = screenings.IdSubsLanguage or languages.IdLanguage = screenings.IdAudioLanguage 
		inner join dimensions on dimensions.IdDimension = screenings.iddimension
		inner join cinemas on rooms.CinemaId = cinemas.IdCinema
		inner join addresses on cinemas.IdAddress = addresses.IdAddress
		inner join users on users.IdUser = orders.IdUser
WHERE (users.IdUser = UserId AND screenings.StartDate < NOW())
GROUP BY(orders.IdOrder) ORDER BY screenings.StartDate ASC;		

END $$ 

DELIMITER ;
