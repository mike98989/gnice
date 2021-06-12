<?php

class Product extends Model{
    public function getAllProducts(){     
         $this->db->query("SELECT *
                            FROM products
                            ORDER BY name DESC
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

     public function getSingleProduct($data){     
         $this->db->query("SELECT * FROM products WHERE id = :id");
         $this->db->bind(':id', $data['id']);
        
        if($this->db->resultSingleSet()){
            $row['data'] = $this->db->resultSingleSet();
            $row['status']='1';
        }else{
            $row['data'] = [];
            $row['status']='0';
        }
        return $row;
     }

    //  public function addProduct(){
    //     $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    //     foreach (array_keys($_POST) as $key) {
    //        $fields[] = "`$key`";
    //       $values[] = $_POST[$key];
    //        $fields_imploded = implode(",",$fields);
    //        $values_imploded = implode(",", $values);
    //     }
    //     $this->db->query("INSERT INTO products ($fields_imploded) VALUES ($values_imploded)");
    //     $this->db->bind(':$values_imploded', $values_imploded);
    //     if($this->db->executeArray()){
    //         $result['message'] = 'product added successfully';
    //         $result['status'] = 1;
            
    //     }else{

    //         $result['message'] = 'product failed';
    //         $result['status'] = 0;
    //        // return false;
           
    //     }
    //         return $result;
    //  }
    
        public function addProduct(){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = $_POST;
            $keys = implode(',', array_keys($data));
            $bind_params = implode(',', array_map(function($value){return ':'. $value;}, array_keys($data)));
            // print_r($data);
            // die;
           $this->db->query("INSERT INTO products ($keys) VALUES ($bind_params)");
           $this->db->bind($keys, $bind_params);
            print_r($bind_params);
            die();
            if($this->db->execute()){
            $result['message'] = 'product added successfully';
            $result['status'] = 1;
            
            }else{

            $result['message'] = 'product failed';
            $result['status'] = 0;
           return false;
           
        }
           return $result;


        }
    
}