<?php

/**
 * Article
 * 
 * A piece of writing for publication
 */
class GetArticleId
{
    public $id;
    public $title;
    public $description;
    public $date_published;
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


    /**
     * Get the article record based on the ID
     * 
     * @param object $conn connection to the database
     * @param integer $id the article ID
     * 
     * @return mixed An associative array containing the article with that ID, or null if not found
     */

    public static function getArticleById($conn, $id){
        // This GETS an article row from the database by id
        // in PDO we can use "?" or ":id" but the latter is best, any name can be used other than "id" jsyk 
        $sql = "SELECT * FROM article WHERE id = :id"; 

        // Prepares a statement for execution and returns a PDOstatement object
        $stmt = $conn->prepare($sql);

        // Binds a value to a corresponding named/question-mark placeholder in the SQL statement that was used to prepare the statement. 
        // NB: PARAM_INT for int type of parameter, PARAM_STR for string type of parameter, PARAM_BOOL for boolean type of parameter
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        // Executes a PDO prepared statement
        $result = $stmt->execute();

        if ($result === true) {
            
            // Fetches the next row from a result set in associative array format
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
}

