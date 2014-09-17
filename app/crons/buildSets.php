<?php
/*This cronjob handles all times and bundels them for better handling*/

/*Get all times*/
$times = Time::all();
$sets = array();

/*Bundle Times Days*/
foreach($times as $time){
    $sets[date('Ymd', $time->created)][] = array('project_name' => $time->project_name, 'service_name' => $time->service_name, 'created' => $time->created, 'minutes' => $time->minutes);
}

/*Storing the prev generated bundles as Sets*/
foreach($sets as $set_date => $set){
    $tmp_set = Set::find_by_set_date($set_date);
    if($tmp_set){
        //UPDATE
        $tmp_set->object_data = json_encode($set);
        $tmp_set->save();
    }else{
        //INSERT
        Set::create(array('object_data' => json_encode($set), 'set_date' => $set_date));
    }
}

echo "\t\t\t".count($sets)." sets ".(count($sets)>1?'have':'has')." been crafted...\n";


