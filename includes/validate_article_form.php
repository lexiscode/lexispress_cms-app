<?php

/**
 * Validate the article properties
 * 
 * @param string $title Title, required
 * @param string $content Content, required
 * 
 * @return array An array of validation error messages
 */

function validateArticle($title, $content){
    
    $errors = [];

    if ($title == ''){
        $errors[] = 'Title must not be empty';
    }
    if ($content == ''){
        $errors[] = 'Content must not be empty';
    }

    return $errors;
}
