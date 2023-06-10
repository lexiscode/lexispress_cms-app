<?php

// Initialize the session.
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    // Check if the submit button has been clicked, and check if the fields ain't empty also
    if (isset($_POST['sign-in'])){
        if (!empty($_POST['username']) && !empty($_POST['password'])){
            if ($_POST['username'] == 'lexiscode' && $_POST['password'] == 'secret123'){

                // this helps prevent session fixation attacks
                session_regenerate_id(true);

                $_SESSION['is_logged_in'] = true;
                
                // redirect to the index page
                header('Location: index.php');
                exit;

            } else {

                $error = "login details incorrect";
            }
        }
    }
}

?>

<?php require "includes/header.php"; ?>

<h1 align="center"><a href="http://localhost/lexispress_cms-app/index.php" style="text-decoration: none">-- LexisPress --</a></h1>

<h2>Login</h2>

<?php if (!empty($error)): ?>
    <p>* <i><?= $error ?></i></p>
<?php endif; ?>

<form method="POST" action="">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">
    <br> <br>
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <br> <br>

    <button type="submit" name="sign-in">Sign in</button>
</form>


<?php require "includes/footer.php"; ?>