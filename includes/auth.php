<?php

/**
 * Return the user authentication status
 * 
 * @return boolean True if the user is authenticated, false otherwise
 */

function isLoggedIn(){
    return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
}
