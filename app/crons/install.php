<?php

$db = new mysqli('localhost', 'root', '', 'addl');

$templine = '';
// Read in entire file
$lines = file(APP_ROOT.'/sql/database.sql');
// Loop through each line

foreach ($lines as $line){
    // Skip it if it's a comment
    if (substr($line, 0, 2) == '--' || $line == ''){
        continue;
    }

    // Add this line to the current segment
    $templine .= $line;
    // If it has a semicolon at the end, it's the end of the query
    if (substr(trim($line), -1, 1) == ';'){
        // Perform the query
        $templine = str_replace('[%DATABASE%]', DATABASE, $templine);

        $db->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . $db->connect_error . '<br /><br />');
        // Reset temp variable to empty
        $templine = '';
        //var_dump($this->__DB);
    }
}