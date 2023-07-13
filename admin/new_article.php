<?php

require "../includes/init.php";
/*
require "classes/DbConnect.php";
require "classes/GetArticleId.php";
require "classes/Auth.php";
*/

// Initialize the session.

Auth::requireLogin();

$article = new GetArticleId();

// Connect to the Database Server
// create new database object and get the connection by calling the method in the class
$conn = require "../includes/db.php";

// This gets all categories from the database
$categories = Category::getAll($conn);

$category_ids = [];

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if the save/submit button has been clicked, and check if the fields ain't empty also
    if (isset($_POST['save'])){
        if (!empty($_POST['title']) && !empty($_POST['content'])){

            // getting fields contents, then checking for possible empty fields
            $article->title = $_POST['title'];
            $article->content = $_POST['content'];
            $article->date_published = $_POST['date_published'];

            $category_ids = $_POST['category'] ?? [];

            // makes the date field "null" by default if not filled
            if ($article->date_published == ''){
                $article->date_published = null;
            }
            
            // INSERT into the database
            $results = $article->newArticle($conn);

            // checking for errors, if none, then redirect the user to the new article page
            if ($results){
                
                $article->setCategories($conn, $category_ids);
                
                // it is more advisable to use absolute paths below than relative path
                header("Location: http://localhost/lexispress_cms-app/admin/article.php?id={$article->id}"); 
                exit;
            }
            
        }else{

            $error = "No fields must be left empty, except the date-time field.";
            
        }
    }
 
}

?>

<!--HTML header-->
<?php require "../includes/header.php"; ?>

<h2>New Article</h2>

<!-- HTML form -->
<?php require "../includes/new_article_form.php"; ?>

<!--HTML Footer-->
<?php require "../includes/footer.php"; ?>


