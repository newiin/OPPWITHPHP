<?php
namespace App\core;
class BaseController
{
    public function model($model)
    {
        if (file_exists('../app/models/' . $model . '.php')) {
            require_once '../app/models/' . $model . '.php';
            return new $model();
        }
        
    }

    public function view($view, $data = [])
    {

        if (stripos($view, '.')) {
            $view = str_replace('.', "/", $view);
            if (file_exists('../views/' . $view . '.php')) {
                require_once '../views/' . $view . '.php';
            } else {
                die('no views');
            }

        } else {
            require_once '../views/' . $view . '.php';
        }

    }
   

}
