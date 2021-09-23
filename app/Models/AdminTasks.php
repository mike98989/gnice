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
    public function verifyPrivilege($token)
    {

        $this->db->query("SELECT fullname, email, last_login,privilege, token FROM admin WHERE token = :token  AND privilege = 3");
        $this->db->bind(':token', $token);

        if ($this->db->execute()) {
            // return $row;
            return true;
        } else {
            return false;
        }
    }
    public function findUserByEmail($email)
    {
        $this->db->query("SELECT * FROM admin WHERE email = :email");
        $this->db->bind(':email', $email);
        $row = $this->db->singleResult();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function getAllCategoriesAndSubCategories()
    {
        $this->db->query(
            "SELECT * FROM category ORDER BY title DESC"
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


    public function homeStatistics()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];

            if ($this->verifyToken($token) == true) {
                // $this->db->query("SELECT SUM(transactions.amount) AS total_amount, COUNT(transactions.amount) AS total_records FROM transactions WHERE transactions.trans_status = 'success'");
                // if ($this->db->execute()) {
                //     $row['transactions'] = $this->db->resultSet();
                // }
                $this->db->query("SELECT SUM(transactions.amount) AS total_amount, COUNT(transactions.amount) AS total_records FROM transactions");
                if ($this->db->execute()) {
                    $row['transactions'] = $this->db->resultSet();
                }
                $this->db->query("SELECT SUM(transactions.amount) AS total_success_amount, COUNT(transactions.amount) AS total_success_records FROM transactions WHERE transactions.trans_status = 'success'");
                if ($this->db->execute()) {
                    $row['success_transactions'] = $this->db->resultSet();
                }
                $this->db->query("SELECT SUM(transactions.amount) AS total_failed_amount, COUNT(transactions.amount) AS total_failed_records FROM transactions WHERE NOT transactions.trans_status = 'success'");
                if ($this->db->execute()) {
                    $row['failed_transactions'] = $this->db->resultSet();
                }


                $this->db->query("SELECT S.title, COUNT(U.seller_id) AS number_of_sellers FROM users AS U LEFT JOIN seller_account_packages AS S ON U.account_type = S.package_id GROUP BY title  HAVING COUNT(U.seller_id) > 0");
                if ($this->db->resultSet()) {
                    $row['packages_and_sellers'] = $this->db->resultSet();
                }
                // $this->db->query("SELECT R*, P.image,P.brand,U.fullname FROM abuse_report AS R LEFT JOIN products AS P LEFT JOIN users AS U WHERE R.product_code = P.product_code ");
                // if ($this->db->resultSet()) {
                //     $row['abuse'] = $this->db->resultSet();
                // }

                $this->db->query("SELECT COUNT(P.product_code) AS total_ads, COUNT(DISTINCT U.seller_id) AS total_sellers_with_ads FROM products AS P LEFT JOIN users AS U ON P.seller_id = U.seller_id");
                if ($this->db->resultSet()) {
                    $row['ads'] = $this->db->resultSet();
                }

                $this->db->query("SELECT COUNT(DISTINCT users.seller_id) AS total_sellers, COUNT(DISTINCT users.email) AS total_users FROM users WHERE users.account_type > 0");
                if ($this->db->resultSet()) {
                    $row['sellers'] = $this->db->resultSet();
                }
                
                $this->db->query("SELECT COUNT(DISTINCT users.email) AS total_sellers FROM users WHERE users.account_type > 0");
                if ($this->db->resultSet()) {
                    $row['users'] = $this->db->resultSet();
                }
                
                if ($this->db->resultSet()) {
                    $result['message'] = 'fetch successful';
                    $result['data'] = $row;
                    $result['status'] = '1';
                } else {
                    $result['message'] = 'fetch failed';
                    $result['data'] = [];
                    $result['status'] = '0';
                }
            } else {
                $result['message'] = 'invalid session';
                $result['status'] = '0';
            }
        } else {
            $result['message'] = 'invalid header';
            $result['status'] = '0';
        }
        return $result;
    }
    public function getAllProducts()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
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
                        LEFT JOIN users ON users.seller_id = products.seller_id ORDER BY products.date_added DESC");

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
                $this->db->query("SELECT  U.id,U.fullname,U.email,U.phone,U.whatsapp,U.state,U.country,U.seller,U.account_type,U.image,U.token,U.seller_id,U.last_login,U.signup_date,U.activated,U.status, S.title as account_type_title, S.package_id as seller_account_packages_id FROM users U LEFT JOIN seller_account_packages S ON U.account_type = S.package_id ORDER BY U.last_login DESC ");
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

    public function disableEnableUser()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];
            $status = $_POST['status'];
            $seller_id = $_POST['seller_id'];
            if ($this->verifyToken($token) == true) {
                $this->db->query("UPDATE users SET status = :status WHERE seller_id = :seller_id");
                $this->db->bind(':seller_id', $seller_id);
                $this->db->bind(':status', $status);
                if ($this->db->execute()) {
                    $result['message'] = 'account operation successfully';
                    $result['status'] = '1';
                } else {
                    $result['data'] = [];
                    $result['message'] = 'account operation failed';
                    $result['status'] = '0';
                }
            } else {
                $result['data'] = [];
                $result['message'] = 'invalid token, login to continue task';
                $result['status'] = '0';
            }
        } else {
            $result['data'] = [];
            $result['message'] = 'invalid';
            $result['status'] = '0';
        }

        return $result;
    }
    public function disableEnableCategory()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];
            $status = $_POST['status'];
            $category_id = $_POST['category_id'];
            if ($this->verifyToken($token) == true) {
                $this->db->query("UPDATE category SET status = :status WHERE id = :id");
                $this->db->bind(':id', $category_id);
                $this->db->bind(':status', $status);
                if ($this->db->execute()) {
                    $result['message'] = 'Category operation successfully';
                    $result['status'] = '1';
                } else {
                    $result['data'] = [];
                    $result['message'] = 'Category operation failed';
                    $result['status'] = '0';
                }
            } else {
                $result['data'] = [];
                $result['message'] = 'Invalid token, login to continue task';
                $result['status'] = '0';
            }
        } else {
            $result['data'] = [];
            $result['message'] = 'Invalid request';
            $result['status'] = '0';
        }

        return $result;
    }

    public function disableEnableBanner()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];
            $status = $_POST['status'];
            $id = $_POST['banner_id'];
            $type = $_POST['banner_type'];
            if ($this->verifyToken($token) == true) {
                $this->db->query("UPDATE banners SET status = :status WHERE id = :id");
                $this->db->bind(':id', $id);
                $this->db->bind(':status', $status);
                if ($this->db->execute()) {
                    $result['message'] = 'Task operation successfully';
                    $result['status'] = '1';
                } else {
                    $result['data'] = [];
                    $result['message'] = 'Task operation failed';
                    $result['status'] = '0';
                }
            } else {
                $result['data'] = [];
                $result['message'] = 'invalid token, login to continue task';
                $result['status'] = '0';
            }
        } else {
            $result['data'] = [];
            $result['message'] = 'invalid';
            $result['status'] = '0';
        }

        return $result;
    }


    public function disableEnableAdmin()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $status = $_POST['status'];
            $id = $_POST['account_id'];
            if ($this->verifyToken($token) == true && $this->verifyPrivilege($token) == true) {
                $this->db->query("UPDATE admin SET status = :status WHERE id = :id");
                $this->db->bind(':id', $id);
                $this->db->bind(':status', $status);
                if ($this->db->execute()) {
                    $result['message'] = 'account operation successfully';
                    $result['status'] = '1';
                } else {
                    $result['data'] = [];
                    $result['message'] = 'account operation failed';
                    $result['status'] = '0';
                }
            } else {
                $result['data'] = [];
                $result['message'] = 'invalid token or privilege';
                $result['status'] = '0';
            }
        } else {
            $result['data'] = [];
            $result['message'] = 'invalid';
            $result['status'] = '0';
        }

        return $result;
    }
    public function updateAdminPrivilege()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $privilege = $_POST['privilege'];
            $admin_id = $_POST['admin_id'];
            if ($this->verifyToken($token) == true && $this->verifyPrivilege($token) == true) {
                $this->db->query("UPDATE admin SET privilege = :privilege WHERE id = :id");
                $this->db->bind(':id', $admin_id);
                $this->db->bind(':privilege', $privilege);
                if ($this->db->execute()) {
                    $result['message'] = 'account operation successfully';
                    $result['status'] = '1';
                } else {
                    $result['data'] = [];
                    $result['message'] = 'account operation failed';
                    $result['status'] = '0';
                }
            } else {
                $result['data'] = [];
                $result['message'] = 'invalid token or privilege';
                $result['status'] = '0';
            }
        } else {
            $result['data'] = [];
            $result['message'] = 'invalid';
            $result['status'] = '0';
        }

        return $result;
    }

    public function togglePackageStatus()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $status = trim($_POST['status']);
            $id = trim($_POST['id']);


            if ($this->verifyToken($token) == true) {

                $this->db->query("UPDATE seller_account_packages SET status = :status WHERE package_id = :id");
                $this->db->bind(':id', $id);
                $this->db->bind(':status', $status);
                if ($this->db->execute()) {
                    $result['message'] = 'package status operation successful';
                    $result['status'] = '1';
                } else {
                    $result['data'] = [];
                    $result['message'] = 'package status operation failed';
                    $result['status'] = '0';
                }
            } else {
                $result['data'] = [];
                $result['message'] = 'invalid token, login to continue task';
                $result['status'] = '0';
            }
        } else {
            $result['data'] = [];
            $result['message'] = 'invalid';
            $result['status'] = '0';
        }

        return $result;
    }
    public function togglePackageContentStatus()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $status = trim($_POST['status']);
            $id = trim($_POST['id']);

            if ($this->verifyToken($token) == true) {
                $this->db->query("UPDATE seller_account_packages_content SET status = :status WHERE content_id = :id");
                $this->db->bind(':id', $id);
                $this->db->bind(':status', $status);
                if ($this->db->execute()) {
                    $result['message'] = 'package content status operation successful';
                    $result['status'] = '1';
                } else {
                    $result['data'] = [];
                    $result['message'] = 'package content  status operation failed';
                    $result['status'] = '0';
                }
            } else {
                $result['data'] = [];
                $result['message'] = 'invalid token, login to continue task';
                $result['status'] = '0';
            }
        } else {
            $result['data'] = [];
            $result['message'] = 'invalid';
            $result['status'] = '0';
        }

        return $result;
    }

    public function disableEnableAds()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];
            $status = $_POST['status'];
            $product_code = $_POST['product_code'];
            if ($this->verifyToken($token) == true) {
                $this->db->query("UPDATE products SET status = :status WHERE product_code = :product_code");
                $this->db->bind(':product_code', $product_code);
                $this->db->bind(':status', $status);
                if ($this->db->execute()) {
                    $this->db
                        ->query("SELECT products.*,users.fullname as seller_fullname,users.email as seller_email,users.phone as seller_phone,users.image as seller_image,users.last_login as last_seen,
                        category.title as productCategory,
                        sub_category.title as productSubCategory
                        FROM products
                        LEFT JOIN sub_category ON sub_category.sub_id = products.sub_category
                        LEFT JOIN category ON category.id = products.category
                        LEFT JOIN users ON users.seller_id = products.seller_id ORDER BY products.status DESC");
                    $row = $this->db->resultSet();
                    $result['data'] = $row;
                    $result['message'] = 'ads operation successfully';
                    $result['status'] = '1';
                } else {
                    $result['data'] = [];
                    $result['message'] = 'account operation failed';
                    $result['status'] = '0';
                }
            } else {
                $result['data'] = [];
                $result['message'] = 'invalid token, login to continue task';
                $result['status'] = '0';
            }
        } else {
            $result['data'] = [];
            $result['message'] = 'invalid';
            $result['status'] = '0';
        }

        return $result;
    }
    public function disableEnableSubCategory()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];
            $status = $_POST['status'];
            $sub_id = $_POST['sub_id'];
            if ($this->verifyToken($token) == true) {
                $this->db->query("UPDATE sub_category SET status = :status WHERE sub_id = :sub_id");
                $this->db->bind(':sub_id', $sub_id);
                $this->db->bind(':status', $status);
                if ($this->db->execute()) {
                    $result['message'] = 'sub category operation successfully';
                    $result['status'] = '1';
                } else {
                    $result['data'] = [];
                    $result['message'] = 'account operation failed';
                    $result['status'] = '0';
                }
            } else {
                $result['data'] = [];
                $result['message'] = 'invalid token, login to continue task';
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
                $this->db->query("SELECT id, fullname, phone, email, image,privilege,last_login, status FROM admin ORDER BY privilege DESC ");
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

                $uploader = uploadMultiple('cat', 'category', 1);
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $image = $uploader['imageUrl'];
                $title = $_POST['title'];
                $status = 1;
                $this->db->query(
                    'INSERT INTO category (title, image, status) VALUES (:title,:image, :status)'
                );
                $this->db->bind(':title', $title);
                $this->db->bind(':status', $status);
                $this->db->bind(':image', $image);
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
    public function updateCategory()
    {

        // FIXME: add deleting previous image

        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];
            if ($this->verifyToken($token) == true) {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $title = trim($_POST['title']);
                $id = $_POST['id'];
                $image = $_FILES['file']['name'];
                // echo ($image);
                // die;
                $deleteimage = $_POST['previous_image'];
                if ($image != "") {
                    $path = 'assets/images/uploads/category/' . $_FILES['file']['name'];
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {

                        //delete previous_image
                        $pathDelete = "public/assets/images/uploads/category/" . $deleteimage;
                        if (is_file($pathDelete)) {
                            unlink($pathDelete);
                        }
                        $this->db->query('UPDATE category SET title = :title,image = :image WHERE id = :id');
                        $this->db->bind(':id', $id);
                        $this->db->bind(':title', $title);
                        $this->db->bind(':image', $image);
                        if ($this->db->execute()) {
                            $result['rowCount'] = $this->db->rowCount();
                            $result['message'] = 'Category Updated';
                            $result['status'] = 1;
                        } else {
                            $result['message'] = 'Category failed';
                            $result['status'] = 0;
                            // return false;
                        }
                    } else {
                        $result['message'] = 'upload failed';
                        $result['status'] = 0;
                    }
                } else {
                    $this->db->query('UPDATE category SET title = :title WHERE id = :id');
                    $this->db->bind(':title', $title);
                    $this->db->bind(':id', $id);
                    if ($this->db->execute()) {
                        $result['rowCount'] = $this->db->rowCount();
                        $result['message'] = 'Category updated';
                        $result['status'] = 1;
                    } else {
                        $result['message'] = 'Category failed';
                        $result['status'] = 0;
                        // return false;
                    }
                }
            } else {
                $result['message'] = 'Category failed';
                $result['status'] = 0;
            }
        } else {
            $result['message'] = 'invalid request';
            $result['status'] = '0';
        }

        return $result;
    }



    public function updateBanner()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];
            if ($this->verifyToken($token) == true) {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $title = trim($_POST['title']);
                $description = trim($_POST['description']);
                $id = trim($_POST['id']);

                $this->db->query('UPDATE banners SET title = :title, description = :description WHERE id = :id');
                $this->db->bind(':id', $id);
                $this->db->bind(':title', $title);
                $this->db->bind(':description', $description);
                if ($this->db->execute()) {
                    $result['message'] = 'update sucessful';
                    $result['status'] = 1;
                } else {
                    $result['message'] = 'update failed';
                    $result['status'] = 0;
                    // return false;
                }
            } else {
                $result['message'] = 'token failed';
                $result['status'] = 0;
            }
        } else {
            $result['message'] = 'invalid request';
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

    public function addSubCategory()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];
            if ($this->verifyToken($token) == true) {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = array_map('trim', array_filter($_POST));
                $status = 1;
                $this->db->query(
                    'INSERT INTO sub_category (title, parent_id, status) VALUES (:title, :parent_id, :status)'
                );
                $this->db->bind(':title', $data['title']);
                $this->db->bind(':parent_id', $data['parent_id']);
                $this->db->bind(':status', $status);
                if ($this->db->execute()) {
                    $result['message'] = 'sub category creation successfully';
                    $result['status'] = '1';
                } else {
                    $result['message'] = 'sub category creation failed';
                    $result['status'] = '0';
                }
            } else {
                $result['message'] = 'invalid token';
                $result['status'] = '0';
            }
        } else {
            $result['message'] = 'invalid request';
            $result['status'] = '0';
        }
        return $result;
    }
    public function updateSubCategory()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];
            if ($this->verifyToken($token) == true) {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $_POST = array_map('trim', array_filter($_POST));
                $id = $_POST['id'];
                $title = $_POST['title'];
                $this->db->query("UPDATE sub_category SET title = :title WHERE sub_id = :id");
                $this->db->bind(':title', $title);
                $this->db->bind(':id', $id);
                if ($this->db->execute()) {
                    $result['data'] =  $title;
                    $result['message'] = 'sub category updated successfully';
                    $result['status'] = '1';
                } else {
                    $result['message'] = 'sub category update failed';
                    $result['status'] = '0';
                }
            } else {
                $result['message'] = 'invalid token';
                $result['status'] = '0';
            }
        } else {
            $result['message'] = 'invalid request';
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

    public function getAllProductOfASeller($seller_id)
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];

            if ($this->verifyToken($token) == true) {
                $header = apache_request_headers();
                $seller_id = trim(filter_var($seller_id, FILTER_SANITIZE_STRING));
                $this->db->query("SELECT * FROM products WHERE seller_id = :seller_id ORDER BY date_added DESC");
                $this->db->bind(':seller_id', $seller_id);
                $row = $this->db->resultSet();
                if ($this->db->execute()) {
                    $result['rowCounts'] = $this->db->rowCount();
                    $result['data'] = $row;
                    $result['message'] = 'all ads fetched successfully';
                    // echo ($result);
                    // die();
                    $result['status'] = '1';
                } else {
                    $result['data'] = [];
                    $result['status'] = '0';
                }
            } else {
                $result['message'] = 'invalid token';
                $result['status'] = '0';
            }
        } else {
            $result['message'] = 'invalid header';
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
    public function getAllTransactions()
    {

        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];

            if ($this->verifyToken($token) == true) {
                $this->db->query("SELECT transactions.*, users.fullname as seller_fullname, users.seller_id as seller_id  FROM transactions LEFT JOIN users ON users.email = transactions.user_email ORDER BY transactions.trans_date DESC ");
                $row = $this->db->resultSet();
                if ($this->db->execute()) {
                    $result['rowCounts'] = $this->db->rowCount();
                    $result['data'] = $row;
                    $result['message'] = 'category created successfully';
                    $result['status'] = '1';
                } else {
                    $result['message'] = 'error, try again';
                    $result['status'] = '0';
                }
            } else {
                $result['message'] = 'invalid token';
                $result['status'] = '0';
            }
        } else {
            $result['message'] = 'invalid request';
            $result['status'] = '0';
        }
        return $result;
    }

    public function getAccountPackages()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];

            if ($this->verifyToken($token) == true) {

                $this->db->query("SELECT package_id,title,duration_in_days,product_count,value,status FROM seller_account_packages");
                $packages = $this->db->resultSet();
                $count = $this->db->rowCount();
                for ($a = 0; $a < $count; $a++) {
                    $this->db->query("SELECT * FROM seller_account_packages_content WHERE package_id = :package_id");
                    $this->db->bind(':package_id', $packages[$a]->package_id);
                    $package_content =  $this->db->resultSet();
                    $packages[$a]->package_contents = $this->db->resultSet();
                }
                $result['data'] = $packages;
                $result['status'] = '1';
            } else {
                $result['message'] = 'invalid token';
                $result['status'] = '0';
            }
        } else {
            $result['message'] = 'invalid request';
            $result['status'] = '0';
        }
        return $result;
    }
    public function deleteUserAccount()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];
            $seller_id = $_GET['seller_id'];
            $seller_id = trim(filter_var($seller_id, FILTER_SANITIZE_STRING));
            if ($this->verifyToken($token) == true) {
                $this->db->query("DELETE * FROM users  WHERE seller_id = :seller_id");
                $this->db->bind(':seller_id', $seller_id);
                if ($this->db->execute()) {
                    $this->db->query("DELETE * FROM products  WHERE seller_id = :seller_id");
                    $this->db->bind(':seller_id', $seller_id);
                    if ($this->db->execute()) {
                        $result['message'] = "all user data successfully deleted";
                        $result['status'] = '1';
                    } else {
                        $result['message'] = 'invalid operation on deleting ads';
                        $result['status'] = '0';
                    }
                } else {
                    $result['message'] = 'invalid token';
                    $result['status'] = '0';
                }
            } else {
                $result['message'] = 'invalid token';
                $result['status'] = '0';
            }
        } else {
            $result['message'] = 'invalid request header model';
            $result['status'] = '0';
        }
        return $result;
    }
    public function updatePackageContents()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];
            if ($this->verifyToken($token) == true) {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $id = trim($_POST['server_content_id']);
                $content_title = trim($_POST['content_title']);
                $content_body = trim($_POST['content_body']);
                // print_r(json_encode("got"));
                // die();
                $this->db->query("UPDATE seller_account_packages_content SET content_title = :content_title, content_body = :content_body WHERE content_id = :id");
                $this->db->bind(':content_title', $content_title);
                $this->db->bind(':content_body', $content_body);
                $this->db->bind(':id', $id);
                $row = $this->db->singleResult();
                if ($this->db->execute()) {
                    $result['data'] = $row;
                    $result['message'] = 'Package content updated successfully';
                    $result['status'] = 1;
                } else {
                    $result['message'] = 'Package content updated failed';
                    $result['status'] = 0;
                }
            } else {
                $result['message'] = 'invalid token';
                $result['status'] = '0';
            }
        } else {
            $result['message'] = 'invalid request';
            $result['status'] = '0';
        }

        return $result;
    }
    public function updatePackage()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];
            if ($this->verifyToken($token) == true) {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $id = trim($_POST['package_id']);
                $title = trim($_POST['title']);
                $value = trim($_POST['value']);
                $duration = trim($_POST['duration_in_days']);
                $product_count = trim($_POST['product_count']);
                // print_r(json_encode("got"));
                // die();
                $this->db->query("UPDATE seller_account_packages SET title = :title,  value = :value, duration_in_days = :duration, product_count = :count WHERE package_id = :id");
                $this->db->bind(':title', $title);
                $this->db->bind(':value', $value);
                $this->db->bind(':duration', $duration);
                $this->db->bind(':count', $product_count);
                $this->db->bind(':id', $id);
                $row = $this->db->singleResult();
                if ($this->db->execute()) {
                    $result['data'] = $row;
                    $result['message'] = 'Package updated successfully';
                    $result['status'] = 1;
                } else {
                    $result['message'] = 'Package updated failed';
                    $result['status'] = 0;
                }
            } else {
                $result['message'] = 'invalid token';
                $result['status'] = '0';
            }
        } else {
            $result['message'] = 'invalid request';
            $result['status'] = '0';
        }

        return $result;
    }

    public function changeAdminPassword()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];

            if ($this->verifyToken($token) == true) {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $email = trim($_POST['verify_email']);
                // print_r($_POST);
                // die();
                // $currentPassword = trim($_POST['current_password']);
                $newPassword = trim($_POST['new_password']);
                $confirmNewPassword = trim($_POST['confirm_new_password']);
                if ($newPassword === $confirmNewPassword) {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $this->db->query("UPDATE admin SET password = :password WHERE email = :email");
                    $this->db->bind(":password", $hashedPassword);
                    $this->db->bind(":email", $email);
                    $row = $this->db->singleResult();
                    if ($this->db->execute()) {
                        $result['data'] = $row;
                        $result['message'] = 'password update successful';
                        $result['status'] = '1';
                    }
                } else {
                    $result['message'] = 'new password and confirm new password do not match';
                    $result['status'] = '0';
                }
            } else {
                $result['message'] = 'invalid token';
                $result['status'] = '0';
            }
        } else {
            $result['message'] = 'invalid request';
            $result['status'] = '0';
        }

        return $result;
    }
    public function createAdminAccount()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];
            if ($this->verifyToken($token) == true && $this->verifyPrivilege($token) == true) {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $checkEmailValididy = filter_var(strtolower(trim($_POST['email'])), FILTER_VALIDATE_EMAIL);

                if ($checkEmailValididy == true) {
                    $email =  trim($_POST['email']);
                    $name = trim($_POST['name']);
                    $image = trim($_POST['image']);
                    $activated = trim($_POST['activated']);
                    $phone = trim($_POST['phone']);
                    $password = trim($_POST['password']);
                    $cpassword = trim($_POST['cpassword']);
                    $status = 1;

                    if ($this->findUserByEmail($email) == false) {

                        if ($password === $cpassword) {
                            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                            $this->db->query("INSERT INTO admin (fullname, email, password, activated, status,image, phone) VALUES (:fullname, :email, :password, :activated, :status, :image, :phone)");
                            $this->db->bind(":fullname", $name);
                            $this->db->bind(":email", $email);
                            $this->db->bind(":password", $hashedPassword);
                            $this->db->bind(":activated", $activated);
                            $this->db->bind(":status", $status);
                            $this->db->bind(":image", $image);
                            $this->db->bind(":phone", $phone);
                            $row = $this->db->resultSet();
                            if ($this->db->rowCount() > 0) {
                                $result['data'] = $row;
                                $result['message'] = 'new Admin created successfully';
                                $result['status'] = '1';
                            } else {

                                $result['message'] = 'new admin creation failed';
                                $result['status'] = '0';
                            }
                        } else {
                            $result['message'] = 'password and confirm password do not match';
                            $result['status'] = '0';
                        }
                    } else {
                        $result['message'] = 'new Admin email already exist';
                        $result['status'] = '0';
                    }
                } else {
                    $result['message'] = 'invalid email account';
                    $result['status'] = '0';
                }
            } else {
                $result['message'] = 'invalid token, login';
                $result['status'] = '0';
            }
        } else {
            $result['message'] = 'invalid request';
            $result['status'] = '0';
        }
        return $result;
    }

    public function fetchAllBanner()
    {

        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];

            if ($this->verifyToken($token) == true) {
                $this->db->query("SELECT * FROM banners");
                $row = $this->db->resultSet();
                if ($this->db->rowCount() > 0) {
                    $result['rowCount'] = $this->db->rowCount();
                    $result['data'] = $row;
                    $result['message'] = 'all banners fetched successfully';
                    $result['status'] = '1';
                } else {
                    $result['data'] = [];
                    $result['message'] = 'all banners fetching failed';
                    $result['status'] = '0';
                }
            } else {
                $result['message'] = 'invalid token';
                $result['status'] = '0';
            }
        } else {
            $result['message'] = 'invalid header';
            $result['status'] = '0';
        }

        return $result;
    }

    public function createNewBanner()
    {

        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $splitHeader = explode(":", $header['gnice-authenticate']);
            $token = $splitHeader[0];



            if ($this->verifyToken($token) == true) {


                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $banner_type = $_POST['banner_type'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $status = 1;
                $max_resolution = null;


                if (isset($_FILES['image'])) {
                    if ($banner_type == '1') {
                        $max_resolution = 200;
                    } elseif ($banner_type == '2') {
                        $max_resolution = 700;
                    } elseif ($banner_type == '3') {
                        $max_resolution = 400;
                    }
                }
                $image_resizer = resizer(1, $max_resolution, 'banners');
                $image = $image_resizer['success'];


                $this->db->query("INSERT INTO banners (title, description, image, type, status) VALUES (:title, :description, :image, :sub_title, :status)");
                $this->db->bind(':title', $title);
                $this->db->bind(':description', $description);
                $this->db->bind(':image', $image);
                $this->db->bind(':type', $banner_type);
                $this->db->bind(':status', $status);

                if ($this->db->execute()) {
                    $result['message'] = 'new banner created  successfully';
                    $result['status'] = '1';
                } else {
                    $result['data'] = [];
                    $result['message'] = 'new banner creation failed';
                    $result['errors'] = $image_resizer['image_error'];
                    $result['status'] = '0';
                }
            } else {
                $result['message'] = 'invalid token';
                $result['status'] = '0';
            }
        } else {
            $result['message'] = 'invalid header';
            $result['status'] = '0';
        }

        return $result;
    }
}