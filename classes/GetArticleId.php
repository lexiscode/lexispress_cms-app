<?php

/**
 * GetArticleId
 * 
 * A piece of writing for publication by identifying the id
 */
class GetArticleId
{
    public $id;
    public $title;
    public $description;
    public $date_published;
    public $image_file;


    /**
     * Get the article record based on the ID
     * 
     * @param object $conn connection to the database
     * @param integer $id the article ID
     * 
     * @return mixed An object of this class, or null if not found
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

        // Set the default fetch mode for this statement
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'GetArticleId');

        // Executes a PDO prepared statement
        $result = $stmt->execute();

        if ($result === true) {
            
            // Fetches the next row from a result set in an object format
            return $stmt->fetch();
        }
    }

    


     /**
     * Update the article with its current property values
     * 
     * @param object $conn Connection to the database
     * 
     * @return boolean True if the update was successful, false otherwise
     */
     
    public function updateArticle($conn)
    {
            
        // update the data into the database server
        $sql = "UPDATE article 
                SET title = :title, 
                    content = :content, 
                    date_published = :date_published
                WHERE id = :id";

        // Prepares the statement for execution
        $stmt = $conn->prepare($sql);

        // Binds a value to a corresponding named/question-mark placeholder in the SQL statement that was used to prepare the statement. 
        // NB: PARAM_INT for int type of parameter, PARAM_STR for string type of parameter, PARAM_BOOL for boolean type of parameter
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);

        // if date_pulished is empty, then lets insert null into it
        if ($this->date_published == '') {
            $stmt->bindValue(':date_published', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':date_published', $this->date_published, PDO::PARAM_STR);
        }

        // Executes a PDO prepared statement
        $result = $stmt->execute();

        return $result;
       
    }


    
    /**
     * Delete the current article
     * 
     * @param object $conn Connection to the database
     * 
     * @return boolean True if the delete was successful, false otherwise
     */

    public function deleteArticle($conn)
    {
        // update the data into the database server
        $sql = "DELETE FROM article 
                WHERE id = :id";

        // Prepares the statement for execution
        $stmt = $conn->prepare($sql);

        // Binds a value to a corresponding named/question-mark placeholder in the SQL statement that 
        // was used to prepare the statement
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        // Executes a PDO prepared statement
        $result = $stmt->execute();

        return $result;
    }



     /**
     * Insert a new the article with its current property values
     * 
     * @param object $conn Connection to the database
     * 
     * @return boolean True if the insert was successful, false otherwise
     */
     
    public function newArticle($conn)
    {
             
        // Update the data into the database server
        $sql = "INSERT INTO article (title, content, date_published)
                VALUES (:title, :content, :date_published)";
 
        // Prepares the statement for execution
        $stmt = $conn->prepare($sql);
 
        // Binds a value to a corresponding named/question-mark placeholder in the SQL statement that was used to prepare the statement. 
        $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);
 
        // if date_pulished is empty, then lets insert null into it
        if ($this->date_published == '') {
            $stmt->bindValue(':date_published', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':date_published', $this->date_published, PDO::PARAM_STR);
        }
 
        // Executes a PDO prepared statement
        $result = $stmt->execute();
 
        if ($result){
            // gets the last id
            $this->id = $conn->lastInsertId();
            return true;

        }
 
    }


    /**
     * Update the image file property
     * 
     * @param object $conn Connection to the database
     * @param string $filename The filename of the image file
     * 
     * @return boolean True if it was successful, false otherwise
     */
    public function setImageFile($conn, $filename)
    {
        $sql = "UPDATE article
                SET image_file = :image_file
                WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->bindValue(':image_file', $filename, PDO::PARAM_STR);

        return $stmt->execute();

    }
}

