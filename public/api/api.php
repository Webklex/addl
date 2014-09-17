<?php
require_once '../../app/config/app_config.php';

$_GET['c'] = (isset($_GET['c'])?$_GET['c']:'home');
$_GET['m'] = (isset($_GET['m'])?$_GET['m']:'ping');

$controllerName = $_GET['c'].'Controller';
$methodName = 'api_'.$_GET['m'];

require_once APP_ROOT.'/controller/'.$controllerName.'.php';

$controller = new $controllerName();
$data = $controller->$methodName();

if(!empty($data)){
    echo json_encode($data);
}
