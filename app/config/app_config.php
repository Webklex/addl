<?php

/*Rootpfad zum app Ordner*/
define('APP_ROOT', '/var/www/dev/addl/app');

/*Datenbankeinstellungen*/
define('DATABASE_HOST', '127.0.0.1');
define('DATABASE_USER', 'root');
define('DATABASE_PASS', '');
define('DATABASE_NAME', 'addl');


/*####################################################################
#####################-DONT CHANGE ANYTHING BELOW-#####################
####################################################################*/
try{
    require_once APP_ROOT.'/libs/Mite/Mite.php';
    require_once APP_ROOT.'/libs/activeRecord/ActiveRecord.php';

    $connections = array(
        'development' => 'mysql://'.DATABASE_USER.'@'.DATABASE_HOST.'/'.DATABASE_NAME.'?charset=utf8',
        'production' => 'mysql://'.DATABASE_USER.'@'.DATABASE_HOST.'/'.DATABASE_NAME.'?charset=utf8'
    );

// initialize ActiveRecord
    ActiveRecord\Config::initialize(function($cfg) use ($connections)
    {
        $cfg->set_model_directory(APP_ROOT.'/models');
        $cfg->set_connections($connections);
    });

    try{
        $configs = Config::all();

        foreach($configs as $config){

            if($config->value == 'false'){
                $config->value = false;
            }elseif($config->value == 'true'){
                $config->value = true;
            }

            define($config->name, $config->value);
        }
    }catch(Exception $e){}
}catch(Exception $e){}
