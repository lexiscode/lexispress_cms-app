<?php

require "classes/DbConnect.php";
require "classes/GetArticleId.php";


// Connect to the Database Server
// create new database object and get the connection by calling the method in the class
$db = new DbConnect();
$conn = $db->getConn();

// READING or RETRIEVING from the database to get specific article post by their ids
if (isset($_GET['id'])){

    // checks if the article's id exits in the database, then returns an associative array, which stores in $article variable
    $article = GetArticleId::getArticleById($conn, $_GET['id']); 

    if (!$article){
        // if a non-existing id number is in the link
        die("Invalid ID. No article found");
    }

} else {
    // if no id is in the link
    die("ID not supplied. No articles found");
}


/*
The reason I chose to work with (mandate) POST below to GET here is so that if the user types in a delete url, it shouldn't 
delete. The delete button is the only condition that can make that article to be deleted.
*/

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["delete"])){
        
        // DELETE PDO query
        $results = $article->deleteArticle($conn);

        // checking for errors, if none, then redirect the user to the new article page
        if ($results){
            // it is more advisable to use absolute paths below than relative path
            header("Location: http://localhost/lexispress_cms-app/index.php"); 
            exit;
        }
    }
    
}

?>

