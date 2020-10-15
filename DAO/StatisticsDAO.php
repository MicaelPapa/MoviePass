<?php

namespace DAO;

use DAO\Connection as Connection;

class StatisticsDAO
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
