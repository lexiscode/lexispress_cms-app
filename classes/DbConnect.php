<?php

class DbConnect
{
    public function getConn()
    {
        $db_host = "localhost";
        $db_name = "lexis_cms";
        $db_user = "lexis";
        $db_passwd = "fs86RDF8*FebyM@4";

        $dsn = 'mysql:host='.$db_host. ';dbname='.$db_name.';charset=utf8';
        
        $conn = new PDO($dsn, $db_user, $db_passwd);
    }
}


