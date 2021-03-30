<?php


class App

{

    public static $router;

    //public static $db;

    public static $kernel;

    public static function init()
    {
        spl_autoload_register(['static', 'loadClass']);
        static::bootstrap();
        set_exception_handler(['App', 'handleException']);

    }

    public static function bootstrap()
    {
        static::$router = new App\Router();
        static::$kernel = new App\Kernel();
        //static::$db = new App\Database();

    }

    public static function loadClass($className)
    {

        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        require_once ROOTPATH . DIRECTORY_SEPARATOR . $className . '.php';

    }

    public function handleException(Throwable $e)
    {

        if ($e instanceof \app\exceptions\InvalidRouteException) {
            echo static::$kernel->launchAction('Error', 'error404', ['error' => 'Страница не найдена!']);
        } else {
            echo static::$kernel->launchAction('Error', 'error500', ['error' => $e->__toString()]);
        }

    }

}