<?php

namespace database;

use database\Connection;
class DB{
    private $connection;

    public static function connect($db)
    {
        $connection = new Connection($db);
        $connection->connect($db);
    }
    
    public static function table($tbl_name)
    {
        $builder = new QueryBuilder($tbl_name);
        return $builder;
    }

   

    public static function select($tbl_name)
    {
        $select = new SelectFacade($tbl_name);
        return $select;
    }
}