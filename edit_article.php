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
        $title = $article['title'];
        $content = $article['content'];
        $date_published = $article['date_published'];
    } else {
        // if a non-existing id number is in the link
        die("Invalid ID. No article found");
    }

} else {
    // if no id is in the link
    die("ID not supplied. No articles found");
}



// REPEAT VALIDATION, no need declaring $title, $content, or $date_published variables again here
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // getting fields contents, then checking for possible empty fields
    $id = $article['id']; // get id for which we wish to edit from
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date_published = $_POST['date_published'];

    $errors = validateArticle($title, $content);

    // makes the date field "null" by default if not filled
    if ($date_published == ''){
        $date_published = null;
    }

    // the ADD functionality should go through if no errors (non-empty fields) are encountered
    if (empty($errors)){

        // update the data into the database server
        $sql = "UPDATE article 
                SET title = ?, 
                    content = ?, 
                    date_published = ?
                WHERE id = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false){
            echo mysqli_error($conn);
        } else {
            // i - integer, d - double, s - string
            mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $date_published, $id);

            $results = mysqli_stmt_execute($stmt);

            // checking for errors, if none, then redirect the user to the new article page
            if ($results === false){
                echo mysqli_stmt_error($stmt);
            } else {
                // it is more advisable to use absolute paths below than relative path
                header("Location: http://localhost/practice/article.php?id=$id"); 
                exit;
            }
        }
    }
}

?>


<!--HTML header-->
<?php require "includes/header.php"; ?>

<h1>My Blog</h1>
<h2>Edit Article</h2>

<!-- HTML form -->
<?php require "includes/article_form.php"; ?>
<!--HTML Footer-->
<?php require "includes/footer.php"; ?>
