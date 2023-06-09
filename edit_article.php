<?php

require "classes/DbConnect.php";
require "classes/GetArticleId.php";
require "includes/validate_article_form.php";

// Connect to the Database Server
// create new database object and get the connection by calling the method in the class
$db = new DbConnect();
$conn = $db->getConn();

// READING or RETRIEVING from the database to get specific article post by their ids
if (isset($_GET['id'])){

    // checks if the article's id exits in the database, then returns an associative array, which stores in $article variable
    $article = GetArticleId::getArticleById($conn, $_GET['id']); 

    if ($article){
        // Get object values from its keys, which then is stored as values in the HTML form below
        $title = $article->title;
        $content = $article->content;
        $date_published = $article->date_published;
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

    // Check if the save/submit button has been clicked, and check if the fields ain't empty also
    if (isset($_POST['save'])){
        if (!empty($_POST['title']) && !empty($_POST['content'])){

            // getting fields contents, then checking for possible empty fields
            $id = $article['id']; // get id for which we wish to edit from
            $title = $_POST['title'];
            $content = $_POST['content'];
            $date_published = $_POST['date_published'];

            // checking for empty fields, and throwing error if empty 
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

                // Prepares an SQL statement for execution
                $stmt = mysqli_prepare($conn, $sql);

                if ($stmt === false){
                    echo mysqli_error($conn);
                } else {
                    
                    // Bind variables for the parameter markers in the SQL statement prepared
                    mysqli_stmt_bind_param($stmt, "sssi", $title, $content, $date_published, $id);

                    // Executes a prepared statement
                    $results = mysqli_stmt_execute($stmt);

                    // checking for errors, if none, then redirect the user to the new article page
                    if ($results === false){
                        echo mysqli_stmt_error($stmt);
                    } else {
                        // it is more advisable to use absolute paths below than relative path
                        header("Location: http://localhost/lexispress_cms-app/article.php?id=$id"); 
                        exit;
                    }
                }
            }
        }
    }
}

?>


<!--HTML header-->
<?php require "includes/header.php"; ?>

<h1 align="center"><a href="http://localhost/lexispress_cms-app/index.php" style="text-decoration: none">-- LexisPress --</a></h1>
<h2>Edit Article</h2>

<!-- HTML form which is specially for holding old data values by getting them from the database -->
<?php require "includes/article_form.php"; ?>
<!--HTML Footer-->
<?php require "includes/footer.php"; ?>
