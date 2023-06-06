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

/* this stuff as well can be done with the html required keyword, just that some websites
too prefer stating the fields that wasn't filled which made the submit button not to go through. */