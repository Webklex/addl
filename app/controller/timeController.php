<?php

class timeController {

    public function api_edit(){
        $time = Time::find_by_id($_POST['id']);

        if($time != null){
            $time->project_name = $_POST['project_name'];
            $time->service_name = $_POST['service_name'];
            $time->minutes = $_POST['minutes'];
            $time->save();

            return true;
        }

        return false;
    }

    public function api_delete(){
        $time = Time::find_by_id($_POST['id']);

        if($time != null){
            $time->delete();

            return true;
        }

        return false;
    }

    public function api_add(){
        $save = Time::create(array('project_name' => 'Projektbezeichnung', 'service_name' => 'Geleisteter Service', 'minutes' => 0, 'created' => strtotime($_POST['date'])));

        return Time::last()->id;
    }
}