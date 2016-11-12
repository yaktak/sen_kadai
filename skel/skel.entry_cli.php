<?php
/**
 *  {$action_name}.php
 *
 *  @author     {$author}
 *  @package    Testapp
 */
chdir(dirname(__FILE__));
require_once '{$dir_app}/Testapp_Controller.php';

ini_set('max_execution_time', 0);

Testapp_Controller::main_CLI('Testapp_Controller', '{$action_name}');
