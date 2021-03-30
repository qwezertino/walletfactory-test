<?php

namespace App;

class Router

{

    public function resolve()
    {
        if (($pos = strpos($_SERVER['REQUEST_URI'], '?')) !== false) {
            $route = ltrim(substr($_SERVER['REQUEST_URI'], 0, $pos), '/');
        } else {
            $route = ltrim($_SERVER['REQUEST_URI'], '/');
        }
        $result = explode('/', $route, 3);

        if(!empty($_REQUEST)) {
            $result[2] = $_REQUEST;
        }
        return $result;
    }
    /*public function resolve_test()
    {
        if (($pos = strpos($_SERVER['REQUEST_URI'], '?')) !== false) {
            $route = substr($_SERVER['REQUEST_URI'], 0, $pos);
        }
        $route = is_null($route) ? $_SERVER['REQUEST_URI'] : $route;
        $route = explode('/', $route);
        array_shift($route);
        $result[0] = array_shift($route);
        $result[1] = array_shift($route);
        $result[2] = $route;

        return $result;
    }*/

}