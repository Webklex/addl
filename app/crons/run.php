<?php
require_once '../config/app_config.php';


/* Defines all executed cronjobs and its execution order
########################################################
########################################################
*/
$cronjobs = array(
    0 => 'install',
    1 => 'get_times',
    2 => 'buildSets',
    3 => 'buildReports'
);
/*
 * Done defining
########################################################
########################################################
*/

ksort($cronjobs);

echo "\n";
foreach($cronjobs as $cronjob){
    echo "-----------------------------------------------\n";
    $start = microtime(true);
    try{
        require_once $cronjob.'.php';
        echo "Cronjob ".$cronjob.":\tOK+".(microtime(true) - $start)."sec\n";
    }catch(Exception $e){
        echo 'ERROR: '.$e->getMessage()."\n";
        echo "Cronjob ".$cronjob.":\tERROR+".(microtime(true) - $start)."sec\n";
    }
}


echo "-----------------------------------------------\n\n";

/*
 -----------------------------------------------
 Cronjob get_times:      OK+1.0418949127197sec
 -----------------------------------------------
 Cronjob buildSets:      OK+0.086597204208374sec
 -----------------------------------------------
 Cronjob buildReports:   OK+4.3593120574951sec
 -----------------------------------------------
 Cronjob install:        OK+0.082576990127563sec
 -----------------------------------------------
 */