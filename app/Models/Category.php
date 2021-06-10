<?php
//Category crud
/**
 * add, delete, create, update categories and sub categories
 * 
 */
class Category extends Model{
    public function getAllCategory(){
         $this->db->query("SELECT * 
                            FROM category WHERE status='1'
                            ORDER BY title DESC
                            ");
        
        if($this->db->resultSet()){
            $return['data'] = $this->db->resultSet();
            $return['status']='1';
        }else{
            $return['data'] = [];
            $return['status']='0';
        }
        
        return $return;
    }

    public function addCategory($data){
        $this->db->query('INSERT INTO category (title, address) VALUES (:title,:address)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':address', $data['address']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function updateCategory($data){
        $this->db->query('UPDATE category SET title = :title,address = :address WHERE id = :id');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':address', $data['address']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function deleteCategory($id){
         $this->db->query('DELETE * FROM category WHERE id = :id ');
        $this->db->bind(':id', $id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function addSubCategory($data){
        $this->db->query('INSERT INTO sub-category (title, parent-id, address) VALUES (:title, :parent-id, :address)');
         $this->db->bind(':title', $data['title']);
         $this->db->bind(':parent-id', $data['category']);
         $this->db->bind(':address', $data['address']);
          if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function deleteSubCategory($id){
        $this->db->query('DELETE * FROM sub-category WHERE id = :id ');
        $this->db->bind(':id', $id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
        
    }
}
