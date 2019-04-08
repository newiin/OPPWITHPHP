<?php
use App\core\BaseController;

class HomeController extends BaseController
{
   
    public function index()
    {
    //     $user=$this->model('User');

    //    var_dump($user->getUsers());
    //    var_dump(dirname(dirname(__FILE__)));
        $this->view('front.home');
    }
    public static function contact()
    {
        echo 'contact';
    }
}
