<?php
    namespace DAO;
    
    abstract class QueryType 
    {
        const Query = 0;
        const StoredProcedure = 1;
        const StoredProcedureOut = 2; 
    }
?>