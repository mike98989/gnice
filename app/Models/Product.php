<?php

class Product extends Model{

    public function getAllProducts(){     
         $this->db->query("SELECT *, 
                        category.title as productCategory,
                        sub_category.title as productSubCategory                    
                            FROM products
                            INNER JOIN sub_category ON sub_category.id = products.sub_category
                           INNER JOIN category ON category.id = products.category
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
         $this->db->bind(':id', $data);
        
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
            $uploader = uploadProductImage('pro_','products');
            // print_r($uploader);
            // exit;
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $name = trim($_POST['name']);
            $brand = trim($_POST['brand']);
            $product_code = rand(1000000,100000000);
            $color = trim($_POST['color']);
            $short_description =trim($_POST['short_description']);
            $long_description =trim($_POST['long_description']);
            $category =trim($_POST['category']);
            $sub_category =trim($_POST['sub_category']);
            $image = $uploader['route'];
            $price = trim($_POST['price']); 
            //seller will be gotten from session()
            $seller_id = 'AG-'. rand(1000000,100000000);

            $this->db->query('INSERT INTO products (brand, product_code, color, name, short_description, long_description, category, sub_category,image,price,date_added, seller_id) VALUES (:brand, :product_code,:color, :name, :short_description, :long_description, :category, :sub_category,:image,:price, now(), :seller_id)');
            $this->db->bind(':brand', $brand);
            $this->db->bind(':product_code', $product_code);
            $this->db->bind(':color', $color);
            $this->db->bind(':name', $name);
            $this->db->bind(':short_description', $short_description);
            $this->db->bind(':long_description', $long_description);
            $this->db->bind(':category', $category);
            $this->db->bind(':sub_category', $sub_category);
            $this->db->bind(':image', $image);
            $this->db->bind(':price', $price);
            $this->db->bind(':seller_id', $seller_id);
            if($this->db->execute()){
            $result['message'] = 'product added successfully';
            $result['status'] = 1;
            
            }else{

            $result['message'] = 'product failed';
            $result['status'] = 0;
            return false;
           
        }
           return $result;
            

            // $keys = implode(',', array_keys($data));
            //$bind_params = implode(',', array_map(function($value){return ':'. $value;}, array_keys($data)));
            // print_r($data);
            // die;
           //$this->db->query("INSERT INTO products ($keys) VALUES ($bind_params)");
           //$this->db->bind($bind_params, $keys);
            // print_r($bind_params);
            // die();
        //     if($this->db->executeArray()){
        //     $result['message'] = 'product added successfully';
        //     $result['status'] = 1;
            
        //     }else{

        //     $result['message'] = 'product failed';
        //     $result['status'] = 0;
        //    return false;
           
        // }
        //    return $result;


        }
    public function mostViewedProduct(){
        $this->db->query("SELECT name, brand, price, seller_id,
                        sub_category.title as productSubCategory,
                        category.title as productCategory,
                        most_view.view_count as viewCount                   
                            FROM products
                            INNER JOIN sub_category ON sub_category.id = products.sub_category
                            INNER JOIN category ON category.id = products.category
                           INNER JOIN most_view ON most_view.product_code = products.product_code
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

    public function productRating(){
        $this->db->query("SELECT name, price,
                        sub_category.title as productSubCategory,
                        category.title as productCategory,
                        product_ratings.rating_score as rating                  
                            FROM products
                            INNER JOIN sub_category ON sub_category.id = products.sub_category
                            INNER JOIN category ON category.id = products.category
                           INNER JOIN product_ratings ON product_ratings.product_code = products.product_code
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
    public function wishLists(){
        $this->db->query("SELECT name, price,brand,
                        sub_category.title as productSubCategory,
                        category.title as productCategory, 
                        wishlist.wish_date as dateAdded                
                            FROM products
                            INNER JOIN sub_category ON sub_category.id = products.sub_category
                            INNER JOIN category ON category.id = products.category
                           INNER JOIN wishlist ON wishlist.product_code = products.product_code
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

    //  public function uploadProductImage(){
    //       $files = $_FILES['file'];
    //       $fileName = $files['name'];
    //       $fileSize = $files['size'];
    //       $fileTmpLocation = $files['tmp_name'];
    //       $fileError = $files['error'];

    //       //allowed only jpeg,jpg, png
    //       $fileNameExploded =explode('.', $fileName);
         
    //       $fileExtention = strtolower($fileNameExploded[1]);
    //       $allowedExtention = array('jpeg', 'jpg','png', 'webp');

    //       if(in_array($fileExtention, $allowedExtention)){
    //         if($fileSize < 200000){
    //             $folder = 'upload/products/';

    //             if(!file_exists($folder))
	// 		 	{
	// 		 		mkdir($folder,0777,true);
    //              }
    //              //generation new name
    //             $fileNewName = uniqid('pro_',false);
    //             $destination = $folder.$fileNewName.random(100000,10000000).$fileNameExploded[0].'.'.$fileExtention;
                
    //             move_uploaded_file($fileTmpLocation,$destination);
    //             return array($destination);
                
    //         }else {
    //              print_r($result['error']='file size exceed limit');
    //         }
    //       }else {
    //             print_r($result['error']='file type not supported');
    //       }
    // }
}