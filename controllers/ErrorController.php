<?php


namespace Controllers;


use App\Controller;

class Error extends Controller
{
    public function error404($error)
    {
        return $this->render('Error', $error);
    }
    public function error500($error)
    {
        return $this->render('Error', $error);
    }
}