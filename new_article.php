<?php

require "includes/init.php";
/*
require "classes/DbConnect.php";
require "classes/GetArticleId.php";
require "classes/Auth.php";
*/

// Initialize the session.
session_start();

// NB: This below will no longer be necessary if you won't be displaying the new article link page for non-login users
if (!Auth::isLoggedIn()){
    
    die("Unauthorized. You must be logged in first." . PHP_EOL . "<a href='index.php'>Back To Homepage</a>");
}


// why didn't we also declare $errors = []; above here?
/* The empty() below determines whether a variable is considered to be empty. A variable is considered 
empty if it does not exist or if its value equals FALSE. empty() does not generate a warning if the 
variable does not exist.
*/


$article = new GetArticleId();

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if the save/submit button has been clicked, and check if the fields ain't empty also
    if (isset($_POST['save'])){
        if (!empty($_POST['title']) && !empty($_POST['content'])){

            // Connect to the Database Server
            // create new database object and get the connection by calling the method in the class
            $conn = require "includes/db.php";

            // getting fields contents, then checking for possible empty fields
            $article->title = $_POST['title'];
            $article->content = $_POST['content'];
            $article->date_published = $_POST['date_published'];

            // makes the date field "null" by default if not filled
            if ($article->date_published == ''){
                $article->date_published = null;
            }
            
            // Insert into the database
            $results = $article->newArticle($conn);

            // checking for errors, if none, then redirect the user to the new article page
            if ($results){
                
                // it is more advisable to use absolute paths below than relative path
                header("Location: http://localhost/lexispress_cms-app/article.php?id={$article->id}"); 
                exit;
            }
            
        }
    }
 
}

?>


<!--HTML header-->
<?php require "includes/header.php"; ?>

<h1 align="center"><a href="http://localhost/lexispress_cms-app/index.php" style="text-decoration: none">-- LexisPress --</a></h1>
<h2>New Article</h2>

<!-- HTML form -->
<?php require "includes/new_article_form.php"; ?>

<!--HTML Footer-->
<?php require "includes/footer.php"; ?>


