<?php
//Category crud
/**
 * add, delete, create, update categories and sub categories
 * 
 */
class Category extends Model{
    public function getAllCategory(){     
         $this->db->query("SELECT * FROM category
                            ");
        
        if($this->db->resultSet()){
            $rows['data'] = $this->db->resultSet();
            $rows['status']='1';
        }else{
            $rows['data'] = [];
            $rows['status']='0';
        }
        
        return $rows;
    }

    public function addCategory($data){
        $this->db->query('INSERT INTO category (title, address) VALUES (:title,:address)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':address', $data['address']);
        if($this->db->execute()){
            return true;
            return $status =[1];
        }else{
            return false;
            return $status = [0];
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

    public function getAllSubCategory(){
        $this->db->query('SELECT DISTINCT sub_category.title,
                            category.title as parentCategory
                          FROM sub_category 
                           JOIN category
                          WHERE sub_category.parent_id = category.id    
                        ');
         if($this->db->resultSet()){
            $rows['data'] = $this->db->resultSet();
            $rows['status']='1';
        }else{
            $rows['data'] = [];
            $rows['status']='0';
        }
        
        return $rows;
    }

    public function addSubCategory($data){
        $this->db->query('INSERT INTO sub_category (title, parent-id, address) VALUES (:title, :parent-id, :address)');
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
