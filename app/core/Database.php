<?php
namespace App\core;
use PDO;
use App\config\Config;
class Database
{
    private $host = Config::DB_HOST;
    private $user = Config::DB_USER;
    private $pass =Config::DB_PASSWORD;
    private $dbname = Config::DB_NAME;
    private $dbh;
    private $error;
    public function __construct(){
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
          PDO::ATTR_PERSISTENT => true,
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
  
       
        try{
          $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e){
          $this->error = $e->getMessage();
          echo $this->error;
        }
      }
  
      
      public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
      }
  
    
      public function bind($param, $value, $type = null){
        if(is_null($type)){
          switch(true){
            case is_int($value):
              $type = PDO::PARAM_INT;
              break;
            case is_bool($value):
              $type = PDO::PARAM_BOOL;
              break;
            case is_null($value):
              $type = PDO::PARAM_NULL;
              break;
            default:
              $type = PDO::PARAM_STR;
          }
        }
  
        $this->stmt->bindValue($param, $value, $type);
      }
  
    
      public function execute(){
        return $this->stmt->execute();
      }
  
  
      public function result(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
      }

      public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
      }
  
    
      public function rowCount(){
        return $this->stmt->rowCount();
      }

}
