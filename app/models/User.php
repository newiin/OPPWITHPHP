<?php
use App\core\Database;
class User 
{
    public function __construct() {
        $this->db = new Database;
    }
    
    public function getUsers(){
        $this->db->query("SELECT * FROM users");
         return $this->db->result();
        
    }
}
