<?php
function censor_input($input){
    $badwords = explode(PHP_EOL, file_get_contents("library/badwords.txt"));

    return str_ireplace($badwords, "***", $input);
    // return $input;
}