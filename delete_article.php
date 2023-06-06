<?php

require "includes/db_connect.php";
require "includes/get_article_id.php";
require "includes/validate_article_form.php";

// connect to the database server
$conn = connectDB();

// READING or RETRIEVING from the database to get specific article post by their ids
if (isset($_GET['id'])){

    // checks if the article's id exits in the database, then returns an associative array, which stores in $article variable
    $article = getArticle($conn, $_GET['id']); 

    if ($article){
        // Get array values from its keys, which is used in the HTML form below
        $id = $article['id'];
    } else {
        echo "No article found from such ID to be deleted.";
    }

} else{
    echo "Invalid delete action. Page not found.";
}


/*
The reason I chose to work with (mandate) POST below to GET here is so that if the user types in a delete url, it shouldn't 
delete. The delete button is the only condition that can make that article to be deleted.
*/

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // Delete the data into the database server
    $sql = "DELETE FROM article 
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false){
        echo mysqli_error($conn);
    } else {
        // i - integer, d - double, s - string
        mysqli_stmt_bind_param($stmt, "i", $id);

        $results = mysqli_stmt_execute($stmt);

        // checking for errors, if none, then redirect the user to the new article page
        if ($results === false){
            echo mysqli_stmt_error($stmt);
        } else {
            // it is more advisable to use absolute paths below than relative path
            header("Location: http://localhost/lexispress_cms-app/index.php"); 
            exit;
        }
    }
}

?>

