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
    public $errors = [];


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
        if($this->validate()){
            
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

        } else {
            return $error;
        }
         
     }



     /**
     * Validate the article properties, putting any validation error messages in the $error property
     * 
     * @return boolean True if the current properties are valid, false otherwise
     */

    protected function validate()
    {
        if ($this->title == ''){
            $this->errors[] = 'Title must not be empty';
        }
        if ($this->content == ''){
            $this->errors[] = 'Content must not be empty';
        }

        return empty($this->errors);
    }

    /* this stuff as well can be done with the html required keyword, just that some websites
    too prefer stating the fields that wasn't filled which made the submit button not to go through. */
     
}

