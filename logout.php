<?php

require "includes/init.php";

// Initialize the session.
session_start();

Auth::logout();

// Redirects the user to the homepage
header('Location: index.php');
exit;
