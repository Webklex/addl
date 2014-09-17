<?php
error_reporting(0);

$errors = false;
$success = array();

try{
    require_once '../app/config/app_config.php';
    $success[] = 'Konfigurationsdatei erfolgreich geladen';

    if(APP_ROOT != '' && DATABASE_NAME != ''){
        $success[] = 'Konfiguration gesetzt';
    }else{
        $errors[] = array('Konfiguration fehlerhaft','Missing definitions found in app_config.php');
    }
}catch(Exception $e){
    $errors[] = array('Konfigurationsdatei konnte nicht gefunden werden',$e->getMessage());
}

if(!$errors){
    $db = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

    $templine = '';

    $lines = file(APP_ROOT.'/sql/database.sql');

    try{
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
                $templine = str_replace('[%DATABASE%]', DATABASE_NAME, $templine);

                $db->query($templine) or /*print('Error performing query \'<strong>' . $templine . '\': ' . $db->connect_error . '<br /><br />')*/$errors[] = array('Fehler während der Installation', $templine);
                // Reset temp variable to empty
                $templine = '';
            }
        }
        $success[] = 'Die Datenbank wurde erfolgreich installiert';
    }catch(Exception $e){
        $errors[] = array('Die Datenbank konnte nicht installiert werden',$e->getMessage());
    }

}

echo '<h1>Installation</h1>';

if($errors){
    echo '<h3>Fehler</h3>';
    foreach($errors as $error){
        echo '-'.$error[0].' ('.$error[1].')<br />';
    }
}
if($success){
    echo '<h3>Erfolg</h3>';
    foreach($success as $error){
        echo '-'.$error.'<br />';
    }
}
?>