<?php

/**
 * DbConnect
 * 
 * A connection to the database
 */
class DbConnect
{   
    /**
     * Get the database connection
     * 
     * @return PDO object Connection to the database server
     */
    public function getConn()
    {
        $db_host = "localhost";
        $db_name = "lexis_cms";
        $db_user = "lexis";
        $db_passwd = "fs86RDF8*FebyM@4";

        $dsn = 'mysql:host='.$db_host. ';dbname='.$db_name.';charset=utf8';
        
        $conn = new PDO($dsn, $db_user, $db_passwd);

        // Error handling for the database connection
        try {

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;

        } catch (PDOException $e) {
            
            echo $e->getMessage();
            exit;
        }

    
    }
}


