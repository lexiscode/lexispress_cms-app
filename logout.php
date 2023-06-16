<?php

require "includes/init.php";

Auth::logout();

// Redirects the user to the homepage
header('Location: index.php');
exit;
