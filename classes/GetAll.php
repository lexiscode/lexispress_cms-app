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


    /**
     * Get a page of article
     * 
     * @param object $conn Connection to the database
     * @param integer $limit Number of records to return
     * @param integer $offset Number of records to skip starting
     */
    public static function getPage($conn, $limit, $offset)
    {
        // this reads out all articles information from the database, including the categories
        $sql = "SELECT a.*, category.name AS category_name
                FROM (SELECT * 
                FROM article 
                ORDER BY date_published DESC
                LIMIT :limit
                OFFSET :offset) AS a
                LEFT JOIN article_category
                ON a.id = article_category.article_id
                LEFT JOIN category
                ON article_category.category_id = category.id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // this helps preventing returning multiple duplicate categories data
        $articles = [];
        $previous_id = null;

        foreach ($results as $row) {

            $article_id = $row['id'];
            if ($article_id != $previous_id){
                $row['category_names'] = [];
                $articles[$article_id] = $row;
            }
            $articles[$article_id]['category_names'][] = $row['category_name'];
            $previous_id = $article_id;

        }
        // returns array of unrepeated articles
        return $articles;
    }


    /**
     * Get a count of the total number of records
     * 
     * @param object $conn Connection to the database
     * 
     * @param integer The total number of records 
     */
    public static function getTotalRecords($conn)
    {
        return $conn->query('SELECT COUNT(*) FROM article')->fetchColumn();
    }
    
}

