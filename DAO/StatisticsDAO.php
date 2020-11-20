<?php

namespace DAO;

use DAO\Connection as Connection;
use Interfaces\IStatisticsDAO as IStatisticsDAO;

class StatisticsDAO implements IStatisticsDAO
{
    private $connection;

    public function LoadTheMostPopularMovies()
    {
        try{
            $query = "select movies.MovieName, count(tickets.IdTicket) as topMovies
            from tickets inner join orders ON orders.IdOrder = tickets.IdOrder
            inner join screenings ON screenings.IdScreening = tickets.IdScreening
            inner join movies ON movies.IdMovie = screenings.IdMovie
            group by movies.MovieName
            order by (topMovies) desc;";
            $this->connection = Connection::GetInstance();
            $resultList = $this->connection->Execute($query); 

            return $resultList;

     }catch (Exception $ex) {
        return null;
        }
    }

    public function LoadTheLessPopularMovies(){
        try{
            $query = "select movies.MovieName, count(tickets.IdTicket) as lowMovies
            from tickets inner join orders ON orders.IdOrder = tickets.IdOrder
            inner join screenings ON screenings.IdScreening = tickets.IdScreening
            inner join movies ON movies.IdMovie = screenings.IdMovie
            group by movies.MovieName
            order by (lowMovies) asc;";
            $this->connection = Connection::GetInstance();
            $resultList = $this->connection->Execute($query); 

            return $resultList;

     }catch (Exception $ex) {
        return null;
        }
    }
     public function LoadMostBoughtMovies(){
         try{
                $query = "select movies.MovieName, count(tickets.IdTicket)  * screenings.Price as boxOffice from tickets
                    inner join orders ON orders.IdOrder = tickets.IdOrder
                    inner join screenings ON screenings.IdScreening = tickets.IdScreening
                    inner join movies ON movies.IdMovie = screenings.IdMovie
                    group by movies.MovieName
                    order by (boxOffice) desc;";
                $this->connection = Connection::GetInstance();
                $resultList = $this->connection->Execute($query); 

                return $resultList;

         }catch (Exception $ex) {
            return null;
        }
     }
     public function LoadTheMostPopularMoviesByDate($date1, $date2){
         try{
                $query="select movies.MovieName, count(tickets.IdTicket) as topMovies
                    from tickets inner join orders ON orders.IdOrder = tickets.IdOrder 
                    inner join screenings ON screenings.IdScreening = tickets.IdScreening AND (screenings.StartDate BETWEEN CAST('" . $date1 . "' as DATETIME) AND CAST('" . $date2 . "' as DATETIME))
                    inner join movies ON movies.IdMovie = screenings.IdMovie
                    group by movies.MovieName order by (topMovies) asc;";
                 $this->connection = Connection::GetInstance();
                 $resultList = $this->connection->Execute($query); 
 
                 return $resultList;

         }catch (Exception $ex){
             return null;
         }
     }
}
