<?php
class homeController{
    public function index(){

    }

    public function api_ping(){
        return 'OK+'.microtime(true);
    }
}