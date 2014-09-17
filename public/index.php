<?php
/**
 * Created by PhpStorm.
 * User: mgoldenbaum
 * Date: 12.09.14
 * Time: 08:50
 */
require_once '../app/config/app_config.php';


require_once APP_ROOT.'/views/default/header.php';
require_once APP_ROOT.'/views/default/navigation.php';

$_GET['c'] = (isset($_GET['c'])?$_GET['c']:'home');
$_GET['m'] = (isset($_GET['m'])?$_GET['m']:'index');

$controllerName = $_GET['c'].'Controller';

require_once APP_ROOT.'/controller/'.$controllerName.'.php';

$controller = new $controllerName();
$data = $controller->$_GET['m']();

require_once APP_ROOT.'/views/'.$_GET['c'].'/'.$_GET['m'].'.stp';

require_once APP_ROOT.'/views/default/footer.php';


?>
