<?php
 namespace App\core;
  class App {
    protected $currentController='HomeController';
    protected $currentMethod = 'index';
    protected $currentParameter = [];
    public function __construct(){
   
     $url=$this->getUrl();
  
     if (file_exists('../app/controllers/' . ucwords( $url[0]). 'Controller.php')) {
        //  if exist and set at current controller
        $this->currentController = ucwords( $url[0]).'Controller';
        // unset 0 index
        unset($url[0]);
      
     }
       // require the controller
       require_once '../app/controllers/'. $this->currentController . '.php';
       // intantiate this current controller
       $this->currentController = new $this->currentController;
       //    check for second part of the url
       if (method_exists($this->currentController,$url[1])) {
           $this->currentMethod=$url[1];
             // unset 1 index
             unset($url[1]);
       }
      
       //    get the parameters
       $this->currentParameter= $url ? array_values($url): [];
        // Call a callback with array of parameters;
        call_user_func_array([$this->currentController,$this->currentMethod], $this->currentParameter);
    }
  
    // get URL
    public function getUrl(){
        if (isset($_GET['url'])) {
            $url=rtrim($_GET['url'],'/');
            $url= filter_var($url,FILTER_SANITIZE_URL);
            $url=explode('/',$url);
            return  $url;
        }
        
    }

  } 
  
  