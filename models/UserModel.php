<?php
require_once __DIR__ . '/../config/database.php';

class UserModel{
    private $db;
    public function __construct(){
        $connection = new Database();
        $this->db = $connection->getConnection();
    }
    public function add_user($user_name, $user_email, $hashed_pass, $user_role='agent'){
        $sql = "insert into users(name, email, password_hash, role) values(?, ?, ?, ?)";
        $add = $this->db->prepare($sql);
        return $add->execute([$user_name, $user_email, $hashed_pass, $user_role]);
    }
    public function check_email($user_email){
        $sql = "select id from users where email = ?";
        $check = $this->db->prepare($sql);
        $check->execute([$user_email]);
        $result = $check->fetch();
        if($result){
            return true;
        } 
        else{
            return false;
        }
    }
    public function get_user_by_email($email){
        $sql = "select * from users where email = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);
        return $user; 
    }
    public function get_user_by_id($user_id){
        $sql = "select * from department where id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$user_id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    
}
