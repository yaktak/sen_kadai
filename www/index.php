<?php

require_once dirname(__FILE__) . '/../app/Testapp_Controller.php';

/**
 * If you want to enable the UrlHandler, comment in following line,
 * and then you have to modify $action_map on app/Testapp_UrlHandler.php .
 *
 */
// $_SERVER['URL_HANDLER'] = 'index';

/**
 * Run application.
 */
Testapp_Controller::main('Testapp_Controller', 'index');

