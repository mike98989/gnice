<?php



class Product extends Model{

    public function getAllProducts(){     
         $this->db->query("SELECT brand,name,color, short_description,long_description,seller_id,image,product_code,price,date_added, 
                        category.title as productCategory,
                        sub_category.title as productSubCategory                    
                        FROM products
                        INNER JOIN sub_category ON sub_category.id = products.sub_category
                        INNER JOIN category ON category.id = products.category
                            ");
        
        if($this->db->resultSet()){
            $result['data'] = $this->db->resultSet();
            $result['status']='1';
        }else{
            $result['data'] = [];
            $result['status']='0';
        }
        return $result;
     }

     public function getSingleProduct($id){ 
        
        // the value is sanitize to an interger
         $product_code = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        //  print_r($product_code);
        //  exit('got here');
         $this->db->query("
                            SELECT *,
                            category.title as productCategory,
                            sub_category.title as productSubCategory
                            FROM products
                            INNER JOIN sub_category ON sub_category.id = products.sub_category
                            INNER JOIN category ON category.id = products.category
                            WHERE product_code = :product_code
                        ");
         $this->db->bind(':product_code', $product_code);
        
        if($this->db->singleResult()){
            $result['data'] = $this->db->singleResult();
            $result['status']='1';
        }else{
            $result['data'] = [];
            $result['status']='0';
        }
        return $result;
     }
    
        public function addProduct(){
            $uploader = uploadMultiple('pro','products');
            // print_r(json_encode($uploader[1]));
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
            $image = $uploader['uploaded'];
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
            $result['status'] = '1';
            $result['errors'] = $uploader['image_error'];
            
            }else{

            $result['message'] = 'product failed';
            $result['status'] = '0';
            return false;
           
        }
           return $result;
            

        }
        public function mostViewedProduct(){
             $this->db->query("SELECT name, brand, price, seller_id, product_code, image,
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

        public function getProductRating(){
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
            $result['data'] = $this->db->resultSet();
            $result['status']='1';
         }else{
            $result['data'] = [];
            $result['status']='0';
         }
            return $result;
        }

        public function addProductToCart(){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $product_code = trim($_POST['product_code']);
            $customer_id = trim($_POST['customer_id']);

            $this->db->query('INSERT INTO product_cart (product_code, customer_id, date_added) VALUES (:product_code, :customer_id, now()');
            $this->db->bind(':product_code', $product_code);
            $this->db->bind(':customer_id', $customer_id);
            if($this->db->execute()){
            $result['message'] = 'product added to cart';
            $result['status'] = '1';
            
            }else{
            $result['message'] = 'product failed';
            $result['status'] = '0';
            return false;
           
            }
           return $result;
        }
        public function getAllProductCart(){
            $this->db->query("SELECT name, price, brand,
                        products.product_code as productCode,
                        product_cart.customer_id as customerID,
                        product_cart.date_added as dateAdded                
                         FROM products
                         INNER JOIN product_cart ON product_cart.product_code = products.product_code
                            ");
        
            if($this->db->resultSet()){
            $result['data'] = $this->db->resultSet();
            $result['status']='1';
         }else{
            $result['data'] = [];
            $result['status']='0';
         }
            return $result;
        }
        public function ProductToCart(){
        // if(isset($_SESSION['product_code'])){

        // } else{
        //     $item_array = array(
        //         'product_code' => $_POST['product_code']
        //     );
        //}
        $product_code = $_POST['product_code'];

        $productCart = array(
            1234,123, 12
        );
         
        if(in_array($product_code, $productCart)){ 
            $result['status']='0';
            $result['message'] = 'item already in cart';
            $result['array'] = $productCart;
            
        }else{   
            $productCart = array(
                $product_code
            );
           

            $result['data'] = $product_code;
            $result['status']='1';
            $result['message'] = 'item added to cart';
            
        }
        
        $result['count'] = count($productCart);

        return $result;
    }
}