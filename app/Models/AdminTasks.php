<?PHP

class AdminTasks extends Model
{

    public function verifyToken($token)
    {
        Session::init();
        $isLoggedIn = Session::get('loggedIn');
        // $privilegeType = Session::get('loggedIn');
        // $token = Session::get('token');
        if ($isLoggedIn == true) {
            $this->db->query("SELECT fullname, email, last_login,privilege, token FROM admin WHERE token = :token  AND status =1");
            $this->db->bind(':token', $token);
            // $this->db->bind(':privilege_type', $privilegeType);
            $row = $this->db->singleResult();
            // check row
            if ($this->db->rowCount() > 0) {
                // return $row;
                return true;
            } else {
                return false;
            }
        }
    }


    public function getAllCategoriesAndSubCategories()
    {
        $this->db->query(
            "SELECT * FROM category WHERE  ORDER BY status ASC"
        );
        $category = $this->db->resultSet();
        $count = $this->db->rowCount();
        //print_r($this->db->rowCount());exit;
        //$row['category'] = $category;
        for ($a = 0; $a < $count; $a++) {
            $this->db->query("SELECT * FROM sub_category WHERE parent_id = :category_id ");
            $this->db->bind(':category_id', $category[$a]->id);
            $subcategory =  $this->db->resultSet();
            $category[$a]->subcategory = $this->db->resultSet();
        }

        $rows['data'] = $category;
        $rows['status'] = '1';

        return $rows;
    }

    public function getAllProducts()
    {
        $header = apache_request_headers();
        if (!isset($header['gnice-authenticate'])) {
            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];

            if ($this->verifyToken($token) == true) {
                $this->db
                    ->query("SELECT products.*,users.fullname as seller_fullname,users.email as seller_email,users.phone as seller_phone,users.image as seller_image,users.last_login as last_seen,
                        category.title as productCategory,
                        sub_category.title as productSubCategory
                        FROM products
                        LEFT JOIN sub_category ON sub_category.sub_id = products.sub_category
                        LEFT JOIN category ON category.id = products.category
                        LEFT JOIN users ON users.seller_id = products.seller_id ORDER BY products.status DESC");

                if ($this->db->resultSet()) {
                    $result['rowCounts'] = $this->db->rowCount();
                    $result['data'] = $this->db->resultSet();
                    $result['status'] = '1';
                } else {
                    $result['data'] = [];
                    $result['status'] = '0';
                }
            } else {
                $result['message'] = 'invalid session';
                $result['status'] = '0';
            }
            return $result;
        }
    }

    public function getAllUsers()
    {

        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];

            if ($this->verifyToken($token) == true) {
                $this->db->query("SELECT  U.*, S.title as account_type_title FROM users U LEFT JOIN seller_account_packages S ON U.account_type = S.package_id ORDER BY U.status ASC ");
                $row = $this->db->resultSet();
                if ($this->db->rowCount() > 0) {
                    $result['rowCounts'] = $this->db->rowCount();
                    $result['data'] = $row;
                    $result['status'] = '1';
                } else {
                    $result['data'] = [];
                    $result['message'] = 'error, try again';
                    $result['status'] = '0';
                }
            } else {
                $result['data'] = $token;
                $result['message'] = 'invalid token';
                $result['status'] = '0';
            }
        } else {
            $result['data'] = [];
            $result['message'] = 'invalid';
            $result['status'] = '0';
        }
        return $result;
    }

    public function disableUser()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];

            $status = $_POST['status'];
            $seller_id = $_POST['seller_id'];
            if ($this->verifyToken($token) == true) {
                $this->db->query("UPDATE users SET status = : status WHERE seller_id = :seller_id");
                $this->db->bind(':seller_id', $seller_id);
                $this->db->bind(':status', $status);
                if ($this->db->execute()) {
                    $this->db->query("SELECT  U.*, S.title as account_type_title FROM users U LEFT JOIN seller_account_packages S ON U.account_type = S.package_id WHERE seller_id = :seller_id");
                    $this->db->bind(':seller_id', $seller_id);
                    $row = $this->db->singleResult();
                    $result['data'] = $row;
                    $result['message'] = 'account operation successfully';
                    $result['status'] = '1';
                } else {
                    $result['data'] = [];
                    $result['message'] = 'account operation failed';
                    $result['status'] = '0';
                }
            } else {
                $result['data'] = [];
                $result['message'] = 'invalid';
                $result['status'] = '0';
            }
        } else {
            $result['data'] = [];
            $result['message'] = 'invalid';
            $result['status'] = '0';
        }

        return $result;
    }


    public function getAllAdminAccounts()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];

            if ($this->verifyToken($token) == true) {
                $this->db->query("SELECT id, name, phone, email, image,privilege,last_login, status FROM admins ORDER BY privilege ASC ");
                $row = $this->db->resultSet();
                unset($row->password, $row->id, $row->token, $row->user_confirm_id, $row->user_recovery_id);
                if ($this->db->rowCount() > 0) {
                    $result['rowCounts'] = $this->db->rowCount();
                    $result['data'] = $row;
                    $result['status'] = '1';
                } else {
                    $result['data'] = [];
                    $result['message'] = 'error, try again';
                    $result['status'] = '0';
                }
            } else {
                $result['data'] = [];
                $result['message'] = 'invalid token';
                $result['status'] = '0';
            }
        } else {
            $result['data'] = [];
            $result['message'] = 'invalid';
            $result['status'] = '0';
        }

        return $result;
    }


    public function addCategory()
    {

        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];

            if ($this->verifyToken($token) == true) {
                $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $title = $data['title'];
                $status = 1;
                $this->db->query(
                    'INSERT INTO category (title, image, status) VALUES (:title,:image, :status)'
                );
                $this->db->bind(':title', $data['title']);
                $this->db->bind(':status', $status);
                // $this->db->bind(':image', $image]);
                if ($this->db->execute()) {
                    $result['message'] = 'category created successfully';
                    $result['status'] = '1';
                } else {
                    $result['message'] = 'error, try again';
                    $result['status'] = '0';
                }
            } else {
                $result['message'] = 'invalid request';
                $result['status'] = '0';
            }
        } else {
            $result['message'] = 'invalid request';
            $result['status'] = '0';
        }
        return $result;
    }
    public function updateCategory($data)
    {
        //! if ($this->verifyToken() == true) {}else{}
        $this->db->query(
            'UPDATE category SET title = :title,image = :image WHERE id = :id'
        );
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':id', $data['id']);
        if ($this->db->execute()) {
            $result['message'] = 'category updated successfully';
            $result['status'] = '1';
        } else {
            $result['message'] = 'category creation failed';
            $result['status'] = '0';
        }

        return $result;
    }
    public function deleteCategory($id)
    {
        $this->db->query('DELETE * FROM category WHERE id = :id ');
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            $result['message'] = 'category deleted';
            $result['status'] = '1';
        } else {
            $result['message'] = 'operation failed';
            $result['status'] = '0';
        }
        return $result;
    }
    public function disableCategory($id)
    {
        $status = 0;
        $this->db->query('UPDATE category SET status = : status  WHERE id = :id ');
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        if ($this->db->execute()) {
            $result['message'] = 'category disabled';
            $result['status'] = '1';
        } else {
            $result['message'] = 'operation failed';
            $result['status'] = '0';
        }
        return $result;
    }

    public function addSubCategory($data)
    {
        $status = 1;
        $this->db->query(
            'INSERT INTO sub_category (title, parent_id, address) VALUES (:title, :parent_id, :address)'
        );
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':parent_id', $data['category']);
        $this->db->bind(':status', $status);
        if ($this->db->execute()) {
            $result['message'] = 'category updated successfully';
            $result['status'] = '1';
        } else {
            $result['message'] = 'category creation failed';
            $result['status'] = '0';
        }
        return $result;
    }

    public function deleteSubCategory($id)
    {
        $this->db->query('DELETE * FROM sub-category WHERE sub_id = :id ');
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function createCategory()
    {
        $_POST = filter_var(INPUT_POST, FILTER_SANITIZE_STRING);
        $category_name = $_POST['category_name'];
        $this->db->query(
            'INSERT INTO category (name, parent_id) VALUES (:category_name, 0)'
        );
        $this->db->bind(':category_name', $category_name);

        if ($this->db->execute()) {
            $result['rowCount'] = $this->db->rowCount();
            $result['message'] = 'category added';
            $result['status'] = '1';
        } else {
            $result['message'] = 'category failed';
            $result['status'] = '0';
        }

        return $result;
    }

    public function createSubCategory()
    {
        $_POST = filter_var(INPUT_POST, FILTER_SANITIZE_STRING);
        $parent_id = filter_var(
            $_POST['category_id'],
            FILTER_SANITIZE_NUMBER_INT
        );
        $subcategory_name = $_POST['subcategory_name'];
        $this->db->query(
            'INSERT INTO sub_category (name, parent_id) VALUES (:subcategory_name, :parent_id)'
        );
        $this->db->bind(':subcategory_name', $subcategory_name);
        $this->db->bind(':parent_id', $parent_id);

        if ($this->db->execute()) {
            $result['rowCount'] = $this->db->rowCount();
            $result['message'] = ' subcategory added';
            $result['status'] = '1';
        } else {
            $result['message'] = 'category failed';
            $result['status'] = '0';
        }
        return $result;
    }
    public function removeElements($elements, $array)
    {
        foreach ($elements as $key) {

            unset($array[array_search($key, $array)]);
            # code...
        }

        return $array;
    }
}