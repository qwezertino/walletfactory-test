<?php

define('ROOTPATH', __DIR__);

require_once 'vendor/autoload.php';
require __DIR__ . '/app/App.php';


App::init();
App::$kernel->launch();