<?php

/**
 * Article
 * 
 * A piece of writing for publication
 */
class GetAll
{
    
    /**
     * Get all the articles
     * @param object $conn Connection to the database
     * @return array An associative array of all the article records
     */

    public static function getAll($conn)
    {
        // READING FROM THE DATABASE AND CHECKING FOR ERRORS
        $sql = "SELECT * 
                FROM article
                ORDER BY date_published DESC;";

        // Execute the sql statement, returning a result set as a PDOStatement object
        $results = $conn->query($sql); 

        $articles = $results->fetchAll(PDO::FETCH_ASSOC);
        //print_r($articles);  prints an associative array

        return $articles;
    }


    
}

