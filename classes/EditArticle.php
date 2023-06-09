<?php

/**
 * EditArticle
 * 
 * A piece of writing for editing publication
 */
class EditArticle 
{

    public $id;
    public $title;
    public $description;
    public $date_published;

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
        WHERE id = ?";

        // Prepares the statement for execution
        $stmt = $conn->prepare($sql);

        // Binds a value to a corresponding named/question-mark placeholder in the SQL statement that was used to prepare the statement. 
        // NB: PARAM_INT for int type of parameter, PARAM_STR for string type of parameter, PARAM_BOOL for boolean type of parameter
        $stmt->bindValue(':id', $this->$id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $this->$title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $this->$content, PDO::PARAM_STR);

        // if date_pulished is empty, then lets insert null into it
        if ($this->date_published == '') {
            $stmt->bindValue(':date_published', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':date_published', $this->$date_published, PDO::PARAM_STR);
        }

        // Executes a PDO prepared statement
        $results = stmt->execute();

        return $result;
    }
}