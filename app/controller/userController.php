<?php

class userController {
    public function settings(){
        if(isset($_POST['letsgo'])){
            foreach($_POST as $name => $value){

                $config = Config::find_by_name($name);

                if($config){
                    $config->value = $value;
                    $config->save();
                }

            }
            //SUCCESSS REPORTER
            echo '<div class="row">
                    <div class="col-lg-9 col-lg-offset-2">
                        <br />
                        <div class="alert alert-success">
                            Die Einstellungen wurden erfolgreich gespeichert.
                        </div>
                    </div>
                 </div>';
        }

        $data = array();

        $configs = Config::all();

        foreach($configs as $config){
            $data[$config->name] = $config;
        }

        return $data;
    }

    public function editTimes(){
        $times = Time::all();
        $data = array();

        foreach($times as $time){
            $data[date('Y-m', $time->created)][date('d', $time->created)][] = $time;
        }

        return $data;
    }

    public function api_load_times(){
        /*Initialize the Mite API connector class*/
        $mite = new Mite\Mite(MITE_SUB, MITE_KEY);

        /*Get your own userID*/
        $userID = $mite->getMyself()->id;
        $stepper = array('a' => 0, 'u' => 0);

        /*Get all times which belong to me*/
        $e = $mite->getTimes(array(), array(), array(), array($userID), null, false, false, false, false, null, MITE_TIMES, false);

        for ($e->rewind(); $e->valid(); $e->next()){
            $entry = $e->current();

            /*MAP ALL TIMES WITH WORKTIME*/
            if($entry->minutes > 0){
                $time = Time::find(array('conditions' => array('project_name = ? AND service_name = ? AND minutes = ? AND created = ?', $entry->project_name, $entry->service_name, $entry->minutes, strtotime($entry->date_at))));
                if(!$time){
                    $save = Time::create(array('project_name' => $entry->project_name , 'service_name' => $entry->service_name, 'minutes' => $entry->minutes, 'created' => strtotime($entry->date_at) ));
                    $stepper['a']++;
                }else{
                    $time->project_name = $entry->project_name;
                    $time->service_name = $entry->service_name;
                    $time->minutes = $entry->minutes;
                    $time->created = strtotime($entry->date_at);
                    $time->save();
                    $stepper['u']++;
                }
            }
            unset($entry);
        }

        /*Status*/
        echo "\t\t\t".$stepper['a']." entries ".($stepper['a']>1?'have':'has')." been added...\n";
        echo "\t\t\t".$stepper['u']." entries ".($stepper['u']>1?'have':'has')." been updated...\n";
    }
}