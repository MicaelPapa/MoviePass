<?php

namespace DAO;

use DAO\Connection as Connection;
use Interfaces\IStatisticsDAO as IStatisticsDAO;

class StatisticsDAO implements IStatisticsDAO
{
    private $connection;

    public function LoadTheMostPopularMovies()
    {
        $invokeStoredProcedure = 'CALL GetMostPopularMovies()';
        $this->connection = Connection::GetInstance();
        return $this->connection->Execute($invokeStoredProcedure,array(), QueryType::StoredProcedure);
    }

    public function LoadTheLessPopularMovies(){
        $invokeStoredProcedure = 'CALL GetLessPopularMovies()';
        $this->connection = Connection::GetInstance();
        return $this->connection->Execute($invokeStoredProcedure,array(), QueryType::StoredProcedure);
    }
}
