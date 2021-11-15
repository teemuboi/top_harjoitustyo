<?php
function input_cleaner($input){
    $input = trim(filter_var($input, FILTER_SANITIZE_STRING));

    return $input;
}