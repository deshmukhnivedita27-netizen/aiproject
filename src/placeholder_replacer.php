<?php
function replace_placeholders($text) {
    // Handle alphanumeric and other string formats
    $text = preg_replace_callback('/\[an_(\d+)\]/', function ($matches) {
        return generate_random_string($matches[1], '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
    }, $text);
    $text = preg_replace_callback('/\[num\((\d+)\)\]/', function ($matches) {
        return generate_random_string($matches[1], '0123456789');
    }, $text);
    $text = preg_replace_callback('/\[smallchar\((\d+)\)\]/', function ($matches) {
        return generate_random_string($matches[1], 'abcdefghijklmnopqrstuvwxyz');
    }, $text);
    $text = preg_replace_callback('/\[bigchar\((\d+)\)\]/', function ($matches) {
        return generate_random_string($matches[1], 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
    }, $text);
    $text = preg_replace_callback('/\[mixsmallbigchar\((\d+)\)\]/', function ($matches) {
        return generate_random_string($matches[1], 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
    }, $text);
    $text = preg_replace_callback('/\[mixsmallalphanum\((\d+)\)\]/', function ($matches) {
        return generate_random_string($matches[1], '0123456789abcdefghijklmnopqrstuvwxyz');
    }, $text);
    $text = preg_replace_callback('/\[mixbigalphanum\((\d+)\)\]/', function ($matches) {
        return generate_random_string($matches[1], '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
    }, $text);
    $text = preg_replace_callback('/\[mixall\((\d+)\)\]/', function ($matches) {
        return generate_random_string($matches[1], '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
    }, $text);
    $text = preg_replace_callback('/\[hexdigit\((\d+)\)\]/', function ($matches) {
        return generate_random_string($matches[1], '0123456789abcdef');
    }, $text);

    // Handle date formats
    $text = str_replace('[[RFC_Date_EST()]]', gmdate(DATE_RFC822, strtotime('-5 hours')), $text);
    $text = str_replace('[[RFC_Date_UTC()]]', gmdate(DATE_RFC822), $text);
    $text = str_replace('[[RFC_Date_EDT()]]', gmdate(DATE_RFC822, strtotime('-4 hours')), $text);
    $text = str_replace('[[RFC_Date_IST()]]', gmdate(DATE_RFC822, strtotime('+5 hours 30 minutes')), $text);

    // Handle ASCII to Hex conversion
    $text = preg_replace_callback('/\[\[ascii2hex\((.+)\)\]\]/', function ($matches) {
        return bin2hex($matches[1]);
    }, $text);

    return $text;
}

function generate_random_string($length, $characters) {
    $characters_length = strlen($characters);
    $random_string = '';
    for ($i = 0; $i < $length; $i++) {
        $random_string .= $characters[rand(0, $characters_length - 1)];
    }
    return $random_string;
}
?>

