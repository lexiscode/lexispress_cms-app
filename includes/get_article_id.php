<?php

/**
 * Get the article record based on the ID
 * 
 * @param object $conn connection to the database
 * @param integer $id the article ID
 * 
 * @return mixed An associative array containing the article with that ID, or null if not found
 */

function getArticle($conn, $id){

    // gets an article row from the database by id
    $sql = "SELECT * FROM article WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt === false){
        echo mysqli_error($conn);
    } else {
        // i - integer
        mysqli_stmt_bind_param($stmt, "i", $id);

        $result = mysqli_stmt_execute($stmt);

        if ($result === false) {
            echo mysqli_stmt_error($stmt);
        } else {
            
            $get_result = mysqli_stmt_get_result($stmt);
            
            return mysqli_fetch_array($get_result, MYSQLI_ASSOC);
        }
    }

}


