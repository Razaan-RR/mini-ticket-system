<?php
require_once __DIR__ . '/../config/database.php';

class DepartmentModel{
    private $db;
    public function __construct(){
        $conn = new Database();
        $this->db = $conn->getConnection();
    }
    public function create_department($name){
        $sql_query = "insert into department (name) values (?)";
        $result = $this->db->prepare($sql_query);
        return $result->execute([$name]);
    }
    public function update_department($id,$name){
        $update_query = "update department set name = ? where id = ?";
        $result = $this->db->prepare($update_query);
        return $result->execute([$name,$id]);
    }
    public function delete_department($id){
        $delete_query = "delete from department where id = ?";
        $result = $this->db->prepare($delete_query);
        return $result->execute([$id]);
    }
    public function get_all_departments() {
        $stmt = $this->db->query("select id, name from department order by name asc");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}