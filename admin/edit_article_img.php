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

    try {
        // this runs if the file uploaded is > the post_max__size limit
        if (empty($_FILES)){
            throw new Exception("Invalid upload");
        }
        switch ($_FILES['file']['error']){
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception("No file uploaded!");
                break;
            case UPLOAD_ERR_INI_SIZE:
                // this runs if the file uploaded is > the upload_max_size limit
                throw new Exception("File is too large!");
                break;
            default:
                throw new Exception("An error occurred while uploading!");
        }
        // i choose to want to limit upload size to 2MB below
        if ($_FILES['file']['size'] > 2000000){
            throw new Exception("File is too large!");
        }

        // Specifying the type of MIME type
        $mime_types = ['image/gif', 'image/png', 'image/jpeg'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);
        // below means if the file is not of the type specified, throw an error
        if (!in_array($mime_type, $mime_types)){
            throw new Exception("Invalid file type!");
        }

        // moves the uploaded file from system's /tmp dir to project's root "uploads" dir
        //$destination = "../uploads/" . $_FILES['file']['name']; using this doesn't prevent code injection
        // prevent filename code injections first
        $pathinfo = pathinfo($_FILES['file']['name']);
        $base = $pathinfo['filename'];
        // replace any characters that ain't letters, numbers, underscores, or hypens with an underscore
        $base = preg_replace("/[^a-zA-Z0-9_-]/", "_", $base);
        // limits the filename to be 200 characters max
        $base = mb_substr($base, 0, 200);
        $filename = $base . "." . $pathinfo['extension'];

        $destination = "../uploads/$filename"; // prevents code injection

        // check if the filename already exists first before moving the file to the "uploads" directory
        $i = 1;
        while (file_exists($destination)) {
            $filename = $base . "-$i." . $pathinfo['extension'];
            $destination = "../uploads/$filename";
            $i++;
        }

        // moves the file to the "uploads" directory
        $check_status = move_uploaded_file($_FILES['file']['tmp_name'], $destination);

        if ($check_status){

            // this holds/stores any previously uploaded image
            $previous_image = $article->image_file;

            //echo "File uploaded successfully";
            $confirm = $article->setImageFile($conn, $filename);
            
            if ($confirm){

                if ($previous_image){
                    unlink("../uploads/$previous_image"); // deletes the previous image
                }
                
                header("Location: http://localhost/lexispress_cms-app/admin/edit_article_img.php?id={$article->id}"); 
                exit;
            }

        }else{
            throw new Exception("Unable to move uploaded file");
        }

    } catch (Exception $e){
        $error = $e->getMessage();
    }

}

?>


<!--HTML header-->
<?php require "../includes/header.php"; ?>

<h2>Edit Article Image</h2>

<?php if ($article->image_file): ?>
    <img src="../uploads/<?= $article->image_file; ?>" alt="">
    <a href="http://localhost/lexispress_cms-app/admin/delete_article_img.php?id=<?= $article->id; ?>">Delete</a>
<?php endif; ?>


<!--Prints out the any error messages-->
<?php if (isset($error)): ?>
    <p><?= $error ?></p>
<?php endif; ?>


<form action="" method="POST" enctype="multipart/form-data">
    <div>
        <label for="file">Image File</label>
        <!--if "multiple" attribute is added below, it will allow for multiple uploads-->
        <input type="file" name="file" id="file">
    </div>

    <button>Upload</button>
</form>

<!--HTML Footer-->
<?php require "../includes/footer.php"; ?>
