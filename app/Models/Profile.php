<?php
include_once('Authenticate.php');

class Profile extends Model
{
    public function updateUserProfile()
    {

        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $seller_id = $_POST['seller_id'];
            $email = trim($_POST['email']);
            $mobile = trim($_POST['mobile']);
            $fullname = trim($_POST['fullname']);
            $phone = trim($_POST['phone']);
            $state = trim($_POST['state']);
            $uploader = uploadMultiple('pro', 'products', 2);
            //Filter sanitize all input as string to remove all unwanted scripts and tags

            if (!(empty($email) || empty($seller_id) || empty($fullname) || empty($phone) || empty($state))) {
                $is_email_valid = filter_var($email, FILTER_VALIDATE_EMAIL);
                if ($is_email_valid == true) {

                    //get renamed pictures from helper functions
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
                        "UPDATE users SET $updateString WHERE seller_id = :seller_id"
                    );
                    foreach (array_keys($data) as $key) {
                        if (!in_array($key, $excluded)) {
                            $this->db->bind(':' . $key, $data[$key]);
                        }
                    }
                    $this->db->bind(':seller_id', $seller_id);
                    if ($this->db->execute()) {
                        $result['message'] = 'profile update successfully';
                        $result['status'] = '1';
                        $result['errors'] = $uploader['image_error'];
                    } else {
                        $result['message'] = 'profile update failed';
                        $result['status'] = '0';
                        $result['errors'] = $uploader['image_error'];
                        return false;
                    }
                } else {
                    $result['error_email'] = 'please enter valid email';
                    $result['status'] = '0';
                }
            } else {
                $result['error'] = ' all * fields are required';
                $result['status'] = '0';
            }
        }
        return $result;
    }

    public function uploadImage($prefix, $location, $email){
        $header = apache_request_headers();

        if(isset($header['gnice-authenticate'])){
            $uploader = uploadMultiple($prefix, $location, 2);
            $image = $uploader['imageUrl'];

            if(isset($image) && strlen($image) > 0){
                $this->db->query("UPDATE $location SET image = :image WHERE email = :email AND status = 1");
                $this->db->bind(':image', $image);
                $this->db->bind(':email', $email);
                if($this->db->execute()){
                    $result['message'] = 'profile picture update successfully';
                    $result['status'] = '1';
                    $result['errors'] = $uploader['image_error'];
                } else{
                    $result['message'] = 'profile picture update failed';
                    $result['status'] = '0';
                    $result['errors'] = $uploader['image_error'];

                }
            }else {
                $result['message'] = 'select a picture';
                $result['status'] = '0';
            }

        }

       return $result;
    } 

    /*
    public function updateUserProfile()
    {
        $header = apache_request_headers();
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $email = trim($_POST['email']);
        $seller_id = trim($_POST['seller_id']);
        $mobile = trim($_POST['mobile']); 
        $fullname = trim($_POST['fullname']);
        $phone = trim($_POST['phone']);
        $state = trim($_POST['state']);
        $country = trim($_POST['country']);
        if (isset($header['gnice-authenticate'])) {
            if (!(empty($email) || empty($seller_id) || empty($fullname) || empty($phone) || empty($state))) {
                $is_email_valid = filter_var($email, FILTER_VALIDATE_EMAIL);

                if ($is_email_valid == true) {
                    //upload new profile picture
                    $uploader = uploadMultiple('user', 'users', 2);
                    $image = $uploader['imageUrl'];
                    $_POST['image'] = $image;
                    //data to frontend
                    $data = array_map('trim', array_filter($_POST));
                    
                    $this->db->query("UPDATE users SET fullname = :fullname, phone = :phone, state = :state, image = :image, country = :country, mobile = :mobile WHERE email = :email AND seller_id = :seller_id AND activated = 1");

                    //bind the values
                    $this->db->bind(':fullname', $fullname);
                    $this->db->bind(':phone', $phone);
                    $this->db->bind(':state', $state);
                    $this->db->bind(':image', $image);
                    $this->db->bind(':country', $country);
                    $this->db->bind(':mobile', $mobile);
                    $this->db->bind(':seller_id', $seller_id);
                    $this->db->bind(':email', $email);

                    $row = $this->db->singleResult();
                    if ($this->db->rowCount() > 0) {
                        $result['data'] = $data;
                        $result['message'] = 'profile updated successfully';
                        $result['errors'] = $uploader['image_error'];
                        $result['status'] = '1';
                    } else {
                        $result['message'] = 'profile updated failed';
                        $result['errors'] = $uploader['image_error'];
                        $result['status'] = '0';
                    }
                } else {
                    $result['error_email'] = 'please enter valid email';
                    $result['status'] = '0';
                }
            } else {
                $result['error'] = ' all * fields are required';
                $result['status'] = '0';
            }
        }
        return $result;
    }
*/
    public function deleteImage()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
        }
    }
}
