<?php

require "../includes/init.php";
/*require "../classes/DbConnect.php";
require "../classes/GetArticleId.php";*/

// in this case of the admin page, you must be login to access this page
Auth::requireLogin();

// Connect to the Database Server
$conn = require "../includes/db.php";

// READING or RETRIEVING from the database to get specific article post by their ids
if (isset($_GET['id'])){

    // checks if the article's id exits in the database, then returns an object, which stores in $article variable
    $article = GetArticleId::getArticleById($conn, $_GET['id']); 

    if (!$article){
        // if a non-existing id number is in the link
        die("Invalid ID. No article found");
    }

} else {
    // if no id is in the link
    die("ID not supplied. No articles found");
}



// REPEAT VALIDATION, no need declaring $title, $content, or $date_published variables again here
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if the save/submit button has been clicked, and check if the fields ain't empty also
    if (isset($_POST['save'])){
        if (!empty($_POST['title']) && !empty($_POST['content'])){

            // getting fields contents, then checking for possible empty fields
            $article->title = $_POST['title'];
            $article->content = $_POST['content'];
            $article->date_published = $_POST['date_published'];

            // makes the date field "null" by default if not filled
            if ($article->date_published == ''){
                $article->date_published = null;
            }

            // UPDATE PDO query
            $result = $article->updateArticle($conn);

            if ($result){
                // it is more advisable to use absolute paths below than relative path
                header("Location: http://localhost/lexispress_cms-app/admin/article.php?id={$article->id}"); // get id for which we wish to edit from
                exit;
            }
            
        }
    }
}

?>


<!--HTML header-->
<?php require "../includes/header.php"; ?>

<h2>Edit Article</h2>

<!-- HTML form which is specially for holding old data values by getting them from the database -->
<?php require "../includes/update_article_form.php"; ?>
<!--HTML Footer-->
<?php require "../includes/footer.php"; ?>
