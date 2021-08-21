<?php


class Product extends Model
{
    public function getAllProducts()
    {
        //edited the end
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $this->db
                ->query("SELECT products.*,users.fullname as seller_fullname,users.email as seller_email,users.phone as seller_phone,users.image as seller_image,users.last_login as last_seen,
                        category.title as productCategory,
                        sub_category.title as productSubCategory
                        FROM products
                        LEFT JOIN sub_category ON sub_category.sub_id = products.sub_category
                        LEFT JOIN category ON category.id = products.category
                        LEFT JOIN users ON users.seller_id = products.seller_id WHERE products.status='1'  ORDER BY products.id DESC");

            if ($this->db->resultSet()) {
                $result['rowCounts'] = $this->db->rowCount();
                $result['data'] = $this->db->resultSet();
                $result['status'] = '1';
            } else {
                $result['data'] = [];
                $result['status'] = '0';
            }
            return $result;
        }
    }


    public function getAllUserSavedProducts($user_id)
    {
        //echo $user_id;exit;
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            // $this->db
            //     ->query("SELECT saved_products.*,products.*,users.fullname as seller_fullname,users.email as seller_email,users.phone as seller_phone,users.image as seller_image,users.last_login as last_seen,
            //             category.title as productCategory,
            //             sub_category.title as productSubCategory
            //             FROM saved_products
            //             LEFT JOIN sub_category ON sub_category.sub_id = products.sub_category
            //             LEFT JOIN category ON category.id = products.category
            //             LEFT JOIN users ON users.seller_id = products.seller_id 
            //             LEFT JOIN products ON products.id = saved_products.product_id 
            //             WHERE saved_products.user_id=:user_id AND saved_products.status='1'  ORDER BY products.id DESC");

        $this->db
        ->query("SELECT saved_products.*, products.*,users.fullname as seller_fullname,users.email as seller_email,users.phone as seller_phone,users.image as seller_image,users.last_login as last_seen FROM saved_products INNER JOIN products ON saved_products.product_id= products.id LEFT JOIN users ON users.seller_id = products.seller_id  WHERE saved_products.user_id=:user_id");
            $this->db->bind(':user_id', $user_id);
            if ($this->db->resultSet()) {
                $result['data'] = $this->db->resultSet();
                $result['status'] = '1';
            } else {
                $result['data'] = [];
                $result['status'] = '0';
            }
            return $result;
        }
    }

    public function getSingleProduct($id)
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            // the value is sanitize to an interger
            $product_code = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            //  print_r($product_code);
            //  exit('got here');

            $this->db->query("SELECT products.*,users.fullname as seller_fullname,users.email as seller_email,users.phone as seller_phone,users.image as seller_image,users.last_login as last_seen,users.signup_date as signup_date,
                        category.title as productCategory,
                        sub_category.title as productSubCategory
                        FROM products
                        LEFT JOIN sub_category ON sub_category.sub_id = products.sub_category
                        LEFT JOIN category ON category.id = products.category
                        LEFT JOIN users ON users.seller_id = products.seller_id
                            WHERE products.product_code = :product_code
                            AND products.status = 1
                        ");
            $this->db->bind(':product_code', $product_code);



            if ($this->db->singleResult()) {
                $result['rowCount'] = $this->db->rowCount();
                $result['data'] = $this->db->singleResult();
                $result['status'] = '1';
            } else {
                $result['data'] = [];
                $result['status'] = '0';
            }
            return $result;
        }
    }

    public function addProduct()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $uploader = uploadMultiple('pro', 'products', 2);
            //Filter sanitize all input as string to remove all unwanted scripts and tags
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //get renamed pictures from helper functions
            $image = $uploader['imageUrl'];
            // $product_code = rand(1000000, 100000000);
            $_POST['image'] = $image;
            $_POST['product_code'] = rand(1000000, 100000000);
            $data = filter_var_array($_POST);
            $data = array_map('trim', array_filter($data));
            $excluded = ['files'];
            // print_r($data);
            // exit();
            foreach (array_keys($data) as $key) {
                if (!in_array($key, $excluded)) {
                    $fields[] = $key;
                    $key_fields[] = ':' . $key;
                    $fields_imploded = implode(',', $fields);
                    $keys_imploded = implode(',', $key_fields);
                }
            }
            $this->db->query(
                'INSERT INTO products (' .
                    $fields_imploded .
                    ') VALUES (' .
                    $keys_imploded .
                    ')'
            );
            foreach (array_keys($data) as $key) {
                if (!in_array($key, $excluded)) {
                    $this->db->bind(':' . $key, $data[$key]);
                }
            }
            // $row = $this->db->singleResult();
            if ($this->db->execute()) {
                $result['message'] = 'product added successfully';
                $result['status'] = '1';
                $result['errors'] = $uploader['image_error'];
            } else {
                $result['message'] = 'create product failed';
                $result['status'] = '0';
                $result['errors'] = $uploader['image_error'];
                //return false;
            }
            return $result;
        }
    }


    public function pinProduct($user_id)
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $data = filter_var_array($_POST);
            
            $this->db->query(" SELECT * FROM saved_products WHERE product_id = :product_id AND user_id=:user_id AND status = 1");
            $this->db->bind(':product_id', $data['product_id']);
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->execute();
        if ($this->db->rowCount() == 0) {
            $this->db->query(
                'INSERT INTO saved_products (product_id, user_id, date_saved) VALUES (:product_id, :user_id, now())');
            $this->db->bind(':product_id', $data['product_id']);
            $this->db->bind(':user_id', $data['user_id']);
            if ($this->db->execute()) {
                $result['message'] = 'product saved successfully';
                $result['status'] = '1';
            } else {
                $result['message'] = 'something went wrong';
                $result['status'] = '0';
            }
            
        }else{
        $result['message'] = 'Item already saved by user';
        $result['status'] = '0';
        }
    }else{
        $result['message'] = 'Invalid request';
        $result['status'] = '0';
    }
    return $result;
}
    

    public function mostViewedProduct()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $this->db
                ->query("SELECT name, brand, price, seller_id, product_code, image,
                        sub_category.title as productSubCategory,
                        category.title as productCategory,
                        most_view.view_count as viewCount
                            FROM products
                            INNER JOIN sub_category ON sub_category.sub_id = products.sub_category
                            INNER JOIN category ON category.id = products.category
                            INNER JOIN most_view ON most_view.product_code = products.product_code
                            WHERE products.status = 1
                            ");

            if ($this->db->resultSet()) {
                $rows['data'] = $this->db->resultSet();
                $rows['status'] = '1';
            } else {
                $rows['data'] = [];
                $rows['status'] = '0';
            }
            return $rows;
        }
    }

    public function getProductRating()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $this->db->query("SELECT name, price,
                        sub_category.title as productSubCategory,
                        category.title as productCategory,
                        product_ratings.rating_score as rating
                            FROM products
                            INNER JOIN sub_category ON sub_category.id = products.sub_category
                            INNER JOIN category ON category.id = products.category
                           INNER JOIN product_ratings ON product_ratings.product_code = products.product_code
                            ");

            if ($this->db->resultSet()) {
                $result['rowCount'] = $this->db->rowCount();
                $rows['data'] = $this->db->resultSet();
                $rows['status'] = '1';
            } else {
                $rows['data'] = [];
                $rows['status'] = '0';
            }
            return $rows;
        }
    }

    /////////////GET ALL RELATED PRODUCTS
    public function getAllRelatedProducts()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $sub_category_id = filter_var($_GET['sub_cat_id']);
            $brand = filter_var($_GET['brand']);
            $product_code = filter_var($_GET['product_code']);
            $this->db
                ->query("SELECT products.*,users.fullname as seller_fullname,users.email as seller_email,users.phone as seller_phone,users.image as seller_image,users.last_login as last_seen,
                        category.title as productCategory,
                        sub_category.title as productSubCategory
                        FROM products
                        LEFT JOIN sub_category ON sub_category.sub_id = products.sub_category
                        LEFT JOIN category ON category.id = products.category
                        LEFT JOIN users ON users.seller_id = products.seller_id
                        WHERE products.product_code!=:product_code AND products.sub_category = :sub_category_id OR products.brand=:brand");

            $this->db->bind(':sub_category_id', $sub_category_id);
            $this->db->bind(':brand', $brand);
            $this->db->bind(':product_code', $product_code);
            if ($this->db->resultSet()) {
                $result['rowCount'] = $this->db->rowCount();
                $result['data'] = $this->db->resultSet();
                $result['status'] = '1';
            } else {
                $result['data'] = [];
                $result['status'] = '0';
            }
            return $result;
        }
    }

    


    /////////////GET ALL RELATED PRODUCTS 


    public function wishLists()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $this->db->query("SELECT name, price,brand,
                        sub_category.title as productSubCategory,
                        category.title as productCategory,
                        wishlist.wish_date as dateAdded
                            FROM products
                            INNER JOIN sub_category ON sub_category.sub_id = products.sub_category
                            INNER JOIN category ON category.id = products.category
                           INNER JOIN wishlist ON wishlist.product_code = products.product_code
                            ");

            if ($this->db->resultSet()) {
                $result['rowCount'] = $this->db->rowCount();
                $result['data'] = $this->db->resultSet();
                $result['status'] = '1';
            } else {
                $result['data'] = [];
                $result['status'] = '0';
            }
            return $result;
        }
    }

    public function addProductToCart()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $product_code = trim($_POST['product_code']);
            $customer_id = trim($_POST['customer_id']);

            $this->db->query(
                'INSERT INTO product_cart (product_code, customer_id, date_added) VALUES (:product_code, :customer_id, now()'
            );
            $this->db->bind(':product_code', $product_code);
            $this->db->bind(':customer_id', $customer_id);
            $result['rowCount'] = $this->db->rowCount();
            if ($this->db->execute()) {
                $result['message'] = 'product added to cart';
                $result['status'] = '1';
            } else {
                $result['message'] = 'product failed';
                $result['status'] = '0';
                return false;
            }
            return $result;
        }
    }

    /*
    public function getAllProductOfaCategory($category_id)
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $this->db->query("SELECT products.*,
                        category.title as productCategory,
                        sub_category.title as productSubCategory
                        FROM products
                        INNER JOIN sub_category ON sub_category.sub_id = products.sub_category
                        INNER JOIN category ON category.id = products.category
                        WHERE products.category = :category_id AND products.status = 1
                            ");
            $this->db->bind(':category_id', $category_id);

            if ($this->db->resultSet()) {
                $result['rowCount'] = $this->db->rowCount();
                $result['data'] = $this->db->resultSet();
                $result['status'] = '1';
            } else {
                $result['data'] = [];
                $result['status'] = '0';
            }
            return $result;
        }
    }
    */
    /*
    public function getAllProductOfaSubCategory($sub_category_id)
    {
        /////// THIS IS A REFERENCE TO GETTING A PRODUCT FROM A DIFFERENT SUB CATEGORY
        /////// WHEN A SUB CATEGORY RETURNS 0
        // $this->db->query("SELECT products.*,
        //                 category.title as productCategory,
        //                 sub_category.title as productSubCategory
        //                 FROM products
        //                 INNER JOIN sub_category ON sub_category.sub_id = products.sub_category
        //                 INNER JOIN category ON category.id = products.category
        //                 WHERE products.sub_category = :sub_category_id
        //                     ");
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $this->db
                ->query("SELECT products.*,
                        sub_category.title as productSubCategory
                        FROM products
                        INNER JOIN sub_category ON sub_category.sub_id = products.sub_category
                        WHERE products.sub_category = :sub_category_id
                        ");

            $this->db->bind(':sub_category_id', $sub_category_id);

            if ($this->db->resultSet()) {
                $result['rowCount'] = $this->db->rowCount();
                $result['data'] = $this->db->resultSet();
                $result['status'] = '1';
            } else {
                $result['data'] = [];
                $result['status'] = '0';
            }
            return $result;
        }
    }
    */

    //     $productCart = array(
    //         1234, 123, 12
    //     );

    //     if (in_array($product_code, $productCart)) {
    //         $result['status'] = '0';
    //         $result['message'] = 'item already in cart';
    //         $result['array'] = $productCart;
    //     } else {
    //         $productCart = array(
    //             $product_code
    //         );


    //         $result['data'] = $product_code;
    //         $result['status'] = '1';
    //         $result['message'] = 'item added to cart';
    //     }

    //     $result['count'] = count($productCart);

    //     return $result;
    // }



    public function searchForProduct()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $searchTerm = trim($_POST['search']);

            $this->db->query("SELECT *
                        /* category.title AS productCategory, */
                        /* sub_category.title AS productSubCategory */
                        FROM products
                        /* LEFT JOIN sub_category ON sub_category.sub_id = products.sub_category */
                        /* LEFT JOIN category ON category.id = products.category */
                        WHERE name LIKE :search OR brand LIKE :search");
            $this->db->bind(':search', '%' . $searchTerm . '%');

            if ($this->db->resultSet()) {
                $result['rowCount'] = $this->db->rowCount();
                $result['data'] = $this->db->resultSet();
                $result['status'] = '1';
            } else {
                $result['data'] = [];
                $result['status'] = '0';
            }
            return $result;
        }
    }

    public function getAllProductOfASeller($seller_id)
    {
        $header = apache_request_headers();
        $seller_id = trim(filter_var($seller_id, FILTER_SANITIZE_STRING));
            $this->db->query("SELECT * FROM products WHERE seller_id = :seller_id AND status=1");
            $this->db->bind(':seller_id', $seller_id);
            if ($this->db->resultSet()) {
                $result['rowCounts'] = $this->db->rowCount();
                $result['data'] = $this->db->resultSet();
                $result['status'] = '1';
            } else {
                $result['data'] = [];
                $result['status'] = '0';
            }
            return $result;
        
    }

    public function messageProductSeller()
    {
        $header = apache_request_headers();
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $sender_name = trim($_POST['sender_name']);
        $sender_tel = trim($_POST['sender_phone']);
        $sender_email = trim($_POST['sender_email']);
        $message = trim($_POST['message']);
        $date = date("Y-m-d H:i:s");
        $_POST['date'] = $date;
        $product_code = $_POST['product_code'];
        $seller_id = $_POST['seller_id'];
        if (isset($header['gnice-authenticate'])) {

            if (!(empty($sender_tel) || empty($sender_name) || empty($sender_name) || empty($message) || empty($product_code) || empty($seller_id))) {
                $is_email_valid = filter_var($sender_email, FILTER_VALIDATE_EMAIL);
                $data = array_map('trim', array_filter($_POST));
                if ($is_email_valid == true) {
                    foreach (array_keys($data) as $key) {
                        $fields[] = $key;
                        $key_fields[] = ':' . $key;
                        $fields_imploded = implode(',', $fields);
                        $keys_imploded = implode(',', $key_fields);
                    }
                    $this->db->query(
                        'INSERT INTO messages (' . $fields_imploded . ') VALUES (' . $keys_imploded . ')'
                    );
                    foreach (array_keys($data) as $key) {
                        $this->db->bind(':' . $key, $data[$key]);
                    }
                    if ($this->db->execute()) {
                        $result['message'] = 'Message sent successfully!';
                        $result['status'] = '1';
                    } else {
                        $result['message'] = 'Something went wrong. Please try agian';
                        $result['status'] = '0';
                    }
                } else {
                    $result['error_email'] = 'Please enter a  valid email';
                    $result['status'] = '0';
                }
            } else {
                $result['error'] = 'All fields are required';
                $result['status'] = '0';
            }
            return $result;
        }
    }

    public function getAllMessagesToSeller($seller_id)
    {
        $header = apache_request_headers();
        $seller_id = trim(filter_var($seller_id, FILTER_SANITIZE_STRING));
        if (isset($header['gnice-authenticate'])) {

            $this->db->query("SELECT M.*,P.name,P.image,P.price,P.brand FROM messages M INNER JOIN products P ON M.product_code=P.product_code  WHERE M.seller_id = :seller_id ORDER BY M.date DESC");
            $this->db->bind(':seller_id', $seller_id);

            if ($this->db->resultSet()) {
                $result['rowCounts'] = $this->db->rowCount();
                $result['data'] = $this->db->resultSet();
                $result['status'] = '1';
            } else {
                $result['data'] = [];
                $result['status'] = '0';
            }
            return $result;
        }
    }
    public function getAllMessages()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $this->db->query("SELECT * FROM messages ORDER BY date DESC");

            if ($this->db->resultSet()) {
                $result['rowCounts'] = $this->db->rowCount();
                $result['data'] = $this->db->resultSet();
                $result['status'] = '1';
            } else {
                $result['data'] = [];
                $result['status'] = '0';
            }
            return $result;
        }
    }
    // TODO: update a product
    public function updateProduct()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $seller_id = $_POST['seller_id'];
            $product_code = $_POST['product_code'];
            //Filter sanitize all input as string to remove all unwanted scripts and tags

            if (!(empty($seller_id) || empty($product_code))) {

                //get renamed pictures from helper functions
                $uploader = uploadMultiple('pro', 'products', 2);
                $image = $uploader['imageUrl'];

                // $product_code = rand(1000000, 100000000);
                $_POST['image'] = $image;
                // $_POST['product_code'] = rand(1000000, 100000000);
                $data = filter_var_array($_POST);
                $data = array_map('trim', array_filter($data));
                $excluded = ['files'];
                $excluded = ['id'];
                // print_r($data);
                // exit();
                $updateString = "";
                $params = [];
                foreach (array_keys($data) as $key) {
                    if (!in_array($key, $excluded)) {

                        $updateString .= "`$key` = :$key,";
                        $params[$key] = "$data[$key]";
                    }
                }
                $updateString = rtrim($updateString, ",");

                $this->db->query(
                    "UPDATE users SET $updateString WHERE seller_id = :seller_id AND product_code = :product_code"
                );
                foreach (array_keys($data) as $key) {
                    if (!in_array($key, $excluded)) {
                        $this->db->bind(':' . $key, $data[$key]);
                    }
                }
                $this->db->bind(':seller_id', $seller_id);
                $this->db->bind(':product_code', $product_code);
                if ($this->db->execute()) {
                    $result['message'] = 'product update successfully';
                    $result['status'] = '1';
                    $result['errors'] = $uploader['image_error'];
                } else {
                    $result['message'] = 'product update failed';
                    $result['status'] = '0';
                    $result['errors'] = $uploader['image_error'];
                    return false;
                }
            } else {
                $result['error'] = ' all * fields are required';
                $result['status'] = '0';
            }
        }
        return $result;
    }
    // TODO: delete image
    public function deleteImage()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $deleteImage = [];
        }
    }

}
