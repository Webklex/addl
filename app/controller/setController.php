<?php
class setController {

    public function create(){

    }

    public function api_bundle(){
        $data = false;
        switch($_POST['type']){
            case 'normal':
                /*Get all times*/
                $start = microtime(true);
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

                $data['count'] = count($sets);
                $data['time'] = microtime(true) - $start;
                break;
            case 'advanced':
                /*Get all times*/
                $start = microtime(true);
                $times = Time::all();
                $sets = array();

                $extensions = Extension::all();
                $parents = array();
                $section = array();

                foreach($extensions as $extension){
                    if($extension->parent == null){
                        $parents[$extension->id] = $extension->value;
                    }
                }

                foreach($extensions as $extension){
                    if($extension->parent !== null){
                        $section[$parents[$extension->parent]][] = $extension->value;
                    }
                }

                /*Bundle Times Days*/
                foreach($times as $time){
                    //echo $section[$time->project_name][array_rand($section[$time->project_name])]."\n";
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

                $data['count'] = count($sets);
                $data['time'] = microtime(true) - $start;
                break;
        }

        return $data;
    }

    public function api_bundleMagic(){

    }
}