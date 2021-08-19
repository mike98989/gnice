<?php

class Authenticate extends Model
{

    // login user
    public function login($username, $password)
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $email = filter_var($username, FILTER_VALIDATE_EMAIL);
            $password = filter_var($password);
            $this->db->query('SELECT * FROM users WHERE email= :email');
            $this->db->bind(':email', $email);
            $row = $this->db->singleResult();
            if ($row == true) {
                $hashedPassword = $row->password;
                if (password_verify($password, $hashedPassword)) {
                    if ($row->status == '0') {
                        $msg['status'] = "0";
                        $msg['msg'] = "Your account is disabled. Please contact administrator!";
                    } elseif ($row->activated == '0') {
                        $msg['status'] = "0";
                        $msg['msg'] = "Your account is not yet active. Please click on the validation link sent to your email or contact administrator!";
                    } else {
                        $row->password = null;
                        if (($row->seller == '1') && ($row->account_type != '0')) {
                            $row->seller_account_details = $this->getUserAccountType($row->account_type);
                        }
                        $updated_token = $this->updateUserToken($row->id, 'users');
                        if ((isset($_POST['source'])) && ($_POST['source'] == 'browser')) {
                            @session_start();
                            Session::init();
                            Session::set('loggedIn', true);
                            Session::set('loggedType', 'user');
                            Session::set('token', $updated_token);
                            Session::set('data', $row);
                        }
                        $msg['status'] = '1';
                        $msg['token'] = $updated_token;
                        $msg['data'] = $row;
                    }
                } else {
                    $msg['status'] = '0';
                    $msg['msg'] = 'Wrong Username or Password! Please try again';
                }
            } else {
                $msg['status'] = '0';
                $msg['msg'] = 'Email Address not found!';
            }
        } else {
            $msg['msg'] =  "invalid request";
            $msg['status'] = '0';
        }
        return $msg;
    }

    public function getUserAccountType($account_type)
    {
        $this->db->query('SELECT title FROM seller_account_packages WHERE package_id= :id');
        $this->db->bind(':id', $account_type);
        $row = $this->db->singleResult();
        return $row;
    }

    /////UPDATE TOKEN AND LAST LOGIN
    public function updateUserToken($id, $location)
    {
        $token = bin2hex(openssl_random_pseudo_bytes(64));
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('GMT+1'));
        $date->format('Y-m-d H:i:s');
        $date = json_encode($date, true);
        $date = json_decode($date, true);
        $this->db->query("UPDATE $location SET token = :token,last_login = :last_login WHERE id = :id");
        $this->db->bind(':token', $token);
        $this->db->bind(':last_login', date($date['date']));
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return $token;
        } else {
            return false;
        }
    }




    public function updateUserAccountType()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $token = filter_var($header['gnice-authenticate']);
            $verifyToken = $this->verifyToken($token, 'users');
            if ($verifyToken) {
                $email = filter_var(strtolower($_POST['email_to_be_activated']), FILTER_VALIDATE_EMAIL);
                $selectedOption = filter_var($_POST['selectedOption']);
                $check_email = $this->findUserByEmail($email, 'users');
                if ($check_email !== false) {
                    if ($check_email->seller_id == null) {
                        $seller_id = 'AG-' . rand(1000000, 10000000);
                        $this->db->query('UPDATE users SET account_type = :account_type, seller_id=:seller_id WHERE id = :id ');
                        $this->db->bind(':seller_id', $seller_id);
                    } else {
                        $this->db->query('UPDATE users SET account_type = :account_type WHERE id = :id ');
                    }
                    $this->db->bind(':account_type', $selectedOption);

                    $this->db->bind(':id', $check_email->id);
                    if ($this->db->execute()) {
                        $check_email_again = $this->findUserByEmail($email, 'users');
                        $check_email_again->seller_account_details = $this->getUserAccountType($check_email_again->account_type);
                        $msg['data'] = $check_email_again;
                        $msg['msg'] = "Successfully updated user account type!";
                        $msg['status'] = '1';
                    } else {
                        return false;
                    }
                } else {
                    $msg['msg'] =  "invalid email address";
                    $msg['status'] = '0';
                }
            } else {
                $msg['msg'] =  "invalid token";
                $msg['status'] = '0';
            }
        } else {
            $msg['msg'] =  "invalid request";
            $msg['status'] = '0';
        }

        return $msg;
    }


    public function updateUserData()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $token = filter_var($header['gnice-authenticate']);
            $data = filter_var_array($_POST);
            $verifyToken = $this->verifyToken($token, 'users');
            if ($verifyToken) {
                $this->db->query('UPDATE users SET fullname = :fullname, phone=:phone, whatsapp=:whatsapp WHERE id = :id ');
                $this->db->bind(':fullname', $data['fullname']);
                $this->db->bind(':phone', $data['phone']);
                $this->db->bind(':whatsapp', $data['whatsapp']);
                $this->db->bind(':id', $verifyToken->id);
                if ($this->db->execute()) {
                    $check_data = $this->findUserByEmail($verifyToken->email, 'users');
                    $msg['data'] = $check_data;
                    $msg['msg'] = "Successfully updated user details!";
                    $msg['status'] = '1';
                    $_SESSION['data'] = $check_data;
                } else {
                    return false;
                }
            } else {
                $msg['msg'] =  "invalid token";
                $msg['status'] = '0';
            }
        } else {
            $msg['msg'] =  "invalid request";
            $msg['status'] = '0';
        }

        return $msg;
    }


    /////////GENERATE PAYSTACK CHECKOUT
    public function generate_paystack_checkout()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $token = filter_var($header['gnice-authenticate']);
            $verifyToken = $this->verifyToken($token, 'users');
            if ($verifyToken) {
                $email = filter_var(strtolower($_POST['email']), FILTER_VALIDATE_EMAIL);
                $amount = filter_var($_POST['amount']);
                $url = "https://api.paystack.co/transaction/initialize";
                $fields = [
                    'email' => $email,
                    'amount' => $amount,
                ];
                $fields_string = http_build_query($fields);
                //open connection
                $ch = curl_init();

                //set the url, number of POST vars, POST data
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    "Authorization: Bearer " . PAYSTACK_SECRETE_KEY,
                    "Cache-Control: no-cache",
                ));

                //So that curl_exec returns the contents of the cURL; rather than echoing it
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                //execute post
                $result = curl_exec($ch);
                //echo $result;

                $msg['data'] = json_decode($result);
                $msg['status'] = '1';
            } else {
                $msg['msg'] =  "invalid token";
                $msg['status'] = '0';
            }
        } else {
            $msg['msg'] =  "invalid request";
            $msg['status'] = '0';
        }

        return $msg;
    }

    public function verify_transaction()
    {

        $curl = curl_init();
        $reference = $_GET['reference'];
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . $reference,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . PAYSTACK_SECRETE_KEY,
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            //echo "cURL Error #:" . $err;
        } else {
            $result = json_decode($response, true);
            $email = $result['data']['customer']['email'];

            if ($result['data']['status'] == 'success') {
                $check_email = $this->findUserByEmail($email, 'users');
                if ($check_email != false) {
                    $this->db->query("INSERT INTO transactions (trans_reference,amount,currency,user_email,trans_date,trans_status) VALUES (:reference,:amount,:currency,:email,:trans_date,:status)");
                    $this->db->bind(':reference', $result['data']['reference']);
                    $this->db->bind(':amount', $result['data']['amount']);
                    $this->db->bind(':currency', $result['data']['currency']);
                    $this->db->bind(':email', $email);
                    $this->db->bind(':trans_date', $result['data']['transaction_date']);
                    $this->db->bind(':status', $result['data']['status']);
                    if ($this->db->execute()) {
                        //$update = $this->updateUserAccountType($email,'2');
                    }
                    header('location:http://localhost/gnice/transactionstatus?ref=' . $result['data']['reference']);
                }
            }
            //header('Location:http://localhost/gnice/transactionstatus');
        }
    }


    // register user
    public function signup()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $data = filter_var_array($_POST);
            $email = filter_var(strtolower($data['email']), FILTER_VALIDATE_EMAIL);
            if ($email == true) {
                $data['email']  = $email;
                $check_email = $this->findUserByEmail($email, 'users');
                if ($check_email == false) {
                    if ($data['password'] === $data['confirm_password']) {
                        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                        $data['signup_date'] = date('Y-m-d');
                        $data['status'] = '1';
                        $data['image'] = 'default.png';
                        $exclude = array('confirm_password');

                        ////////////GENERATE CONFIRMATION CODE AND SEND EMAIL
                        $data['user_confirm_id'] = rand(1000, 10000);
                        $subject = "Welcome to Gnice";
                        $html_message = "<div style='background:#C1E4FF;width:100%;padding:0;margin:0;padding:30px'>
                     <div style='margin:0 auto;width:40%;min-width:300px;float:none;'>
                     <div style='height:45px;background:#DEDEDE;padding:5px 25px; text-align:left'>
                     <img src='" . APP_URL . "public/assets/images/gnice_logo.png' style='height:70%'>

                     </div>
                     <div style='background:#fff;padding:10px'>
                     <div style='text-align:left;font-size:14px;padding:0 20px'>
                     <h3 style='color:#666666'>Hello  " . $data['email'] . " </h3>
                     <p style='line-height:20px'>
                     Welcome to <strong>Gnice Market Place</strong>. We bring you a world of possibilities. Get ready to explore.To validate your account, please complete your profile by entering this code on the app; <br/>
                     <h1>" . $data['user_confirm_id'] . "</h1><br/>
                     <hr style='border:none; border-bottom:1px solid #E7E7E7' />
                     </p>
                     <p style='line-height:15px;text-align:left;font-size:12px;margin-top:15px'>
                     If you did not associate your address with a Gnice account, please ignore this message.
                     </p>
                     </div>
                     </div>
                     </div>
                     </div>";
                        $send_mail = $this->send_mail($email, $data['fullname'], $subject, $html_message);

                        foreach (array_keys($data) as $key) {
                            if (!in_array($key, $exclude)) {
                                $fields[] = $key;
                                $key_fields[] = ":" . $key;
                                $fields_imploded = implode(",", $fields);
                                $keys_imploded = implode(",", $key_fields);
                            }
                        }

                        $this->db->query('INSERT INTO users (' . $fields_imploded . ') VALUES (' . $keys_imploded . ')');
                        foreach (array_keys($data) as $key) {
                            if (!in_array($key, $exclude)) {
                                $this->db->bind(":" . $key, $data[$key]);
                            }
                        }
                        if ($this->db->execute()) {
                            $msg['msg'] =  "New user account created. Please check your mail for confirmation code.";
                            $msg['status'] = '1';
                        } else {
                            return false;
                        }
                    } else {
                        $msg['msg'] =  "Passwords DO NOT MATCH!";
                        $msg['status'] = '0';
                    }
                } else {
                    $msg['msg'] =  "Email address already exist";
                    $msg['status'] = '0';
                }
            } else {
                $msg['msg'] =  "Invalid email address";
                $msg['status'] = '0';
            }
        } else {
            $msg['msg'] =  "invalid request";
            $msg['status'] = '0';
        }
        return $msg;
    }

    public function send_mail($receiver_email, $receiver_name, $subject, $html_message)
    {
        require_once(APP_ROOT . '/Libraries/sendinblue-php-library/vendor/autoload.php');

        $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', SENDINBLUE_API_KEY);

        $apiInstance = new SendinBlue\Client\Api\TransactionalEmailsApi(
            new GuzzleHttp\Client(),
            $config
        );
        $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
        $sendSmtpEmail['subject'] = $subject;
        $sendSmtpEmail['htmlContent'] = $html_message;
        $sendSmtpEmail['sender'] = array('name' => 'Gnice Market Place', 'email' => 'users@gnice.com.ng');
        $sendSmtpEmail['to'] = array(
            array('email' => $receiver_email, 'name' => $receiver_name)
        );
        // $sendSmtpEmail['cc'] = array(
        //     array('email' => 'example2@example2.com', 'name' => 'Janice Doe')
        // );
        // $sendSmtpEmail['bcc'] = array(
        //     array('email' => 'example@example.com', 'name' => 'John Doe')
        // );
        $sendSmtpEmail['replyTo'] = array('email' => 'replyto@gnice.com.ng', 'name' => 'GNICE MARKET');
        $sendSmtpEmail['headers'] = array('gnice-email-header' => 'unique-id-1234');
        $sendSmtpEmail['params'] = array('parameter' => 'My param value', 'subject' => 'Welcome to Gnice');

        try {
            $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
            return $result;
            //print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function password_recovery()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $email = strtolower($_POST['email']);
            $email_valid = filter_var($email, FILTER_VALIDATE_EMAIL);

            if ($email_valid == true) {
                $check_email = $this->findUserByEmail($email, 'users');
                if ($check_email != false) {
                    $rand = rand(1000, 10000);
                    $this->db->query('UPDATE users SET user_recover_id = :recovery_code WHERE email = :email');
                    $this->db->bind(':email', $email);
                    $this->db->bind(':recovery_code', $rand);
                    $this->db->execute();
                    $subject = "Password Reset";
                    $html_message = "<div style='background:#C1E4FF;width:100%;padding:0;margin:0;padding:30px'>
                    <div style='margin:0 auto;width:40%;min-width:300px;float:none;'>
                    <div style='height:45px;background:#DEDEDE;padding:5px 25px; text-align:left'>
                    <img src='" . APP_URL . "public/assets/images/gnice_logo.png' style='height:70%'>

                    </div>
                    <div style='background:#fff;padding:10px'>
                    <div style='text-align:left;font-size:14px;padding:0 20px'>
                    <h3 style='color:#666666'>Hello  " . $check_email->email . " </h3>
                    <p style='line-height:20px'>
                    You recently made a request to reset your Gnice Account (" . $check_email->email . "). Here is your activation code to complete the process.<br/>
                    <h1>" . $rand . "</h1><br/>
                    If you did not make this change or you believe an unauthorised person have accessed your account, please contact admin@gnice.com.ng.<br/>Regards.
                    <hr style='border:none; border-bottom:1px solid #E7E7E7' />
                    </p>
                    <p style='line-height:15px;text-align:left;font-size:12px;margin-top:15px'>
                     If you did not associate your address with a Gnice account, please ignore this message.
                    </p>
                    </div>
                    </div>
                    </div>
                    </div>";
                    $send_mail = $this->send_mail($email, $check_email->fullname, $subject, $html_message);
                    if ($send_mail['messageId'] != '') {
                        $msg['msg'] =  "A message was sent to your email address";
                        $msg['token'] = $check_email->token;
                        $msg['status'] = '1';
                    } else {
                        $msg['msg'] =  "There was a problem with the internet connection. Please try again";
                        $msg['status'] = '0';
                    }
                } else {
                    $msg['msg'] =  "No account with this record found!";
                    $msg['status'] = '0';
                }
            } else {
                $msg['msg'] =  "Invalid email address";
                $msg['status'] = '0';
            }
        } else {
            $msg['msg'] =  "invalid request";
            $msg['status'] = '0';
        }
        return $msg;
    }
    //find user by email
    public function findUserByEmail($email, $table)
    {
        $this->db->query("SELECT * FROM $table WHERE email = :email");
        $this->db->bind(':email', $email);
        $row = $this->db->singleResult();
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function confirm_password_recovery_code()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $data = filter_var_array($_POST);
            $token = filter_var($header['gnice-authenticate']);
            $verifyToken = $this->verifyToken($token, 'users');
            if ($verifyToken) {
                $confirm_code = filter_var($data['confirm_code']);
                /////////MATCH THE CONFIRMATION CODE
                if ($verifyToken->activated != '0') {
                    if ($verifyToken->user_recover_id == $confirm_code) {
                        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
                        $this->db->query('UPDATE users SET password = :password WHERE token = :token');
                        $this->db->bind(':token', $token);
                        $this->db->bind(':password', $hashedPassword);
                        $this->db->execute();
                        $msg['msg'] =  "Successfully changed your account password. Please proceed to login";
                        $msg['status'] = '1';
                    } else {
                        $msg['msg'] =  "Invalid CONFIRMATION CODE";
                        $msg['status'] = '0';
                    }
                } else {
                    $msg['msg'] =  "Your account is not activated yet. Please use the 'I have a confirmation code' or 'Resend confirmation code' link.";
                    $msg['status'] = '0';
                }
            } else {
                $msg['msg'] =  "Invalid token. Please click on forgot password link and follow the process.";
                $msg['status'] = '0';
            }
        } else {
            $msg['msg'] =  "invalid request";
            $msg['status'] = '0';
        }
        return $msg;
    }

    public function change_password()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $data = filter_var_array($_POST);
            $token = filter_var($header['gnice-authenticate']);
            $verifyToken = $this->verifyToken($token, 'users');
            if ($verifyToken) {
                if ($verifyToken->activated != '0') {
                    if ($data['password'] == $data['confirm_password']) {
                        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
                        $this->db->query('UPDATE users SET password = :password WHERE token = :token');
                        $this->db->bind(':token', $token);
                        $this->db->bind(':password', $hashedPassword);
                        $this->db->execute();
                        $msg['msg'] =  "Successfully changed your account password.";
                        $msg['status'] = '1';
                    } else {
                        $msg['msg'] =  "Passwords do not match! Please try again.";
                        $msg['status'] = '0';
                    }
                } else {
                    $msg['msg'] =  "Your account is not activated yet. Please use the 'I have a confirmation code' or 'Resend confirmation code' link.";
                    $msg['status'] = '0';
                }
            } else {
                $msg['msg'] =  "Invalid token";
                $msg['status'] = '-1';
            }
        } else {
            $msg['msg'] =  "invalid request";
            $msg['status'] = '0';
        }
        return $msg;
    }

    public function confirm_user_signup($email, $confirm_code)
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $email = filter_var(strtolower($email), FILTER_VALIDATE_EMAIL);
            if ($email == true) {
                $confirm_code = filter_var($confirm_code);
                $check_email = $this->findUserByEmail($email, 'users');
                if ($check_email != false) {
                    /////////MATCH THE CONFIRMATION CODE
                    if ($check_email->activated == '0') {
                        if ($check_email->user_confirm_id == $confirm_code) {
                            $this->db->query('UPDATE users SET activated = :activated WHERE email = :email');
                            $this->db->bind(':email', $email);
                            $this->db->bind(':activated', '1');
                            $this->db->execute();
                            $msg['msg'] = "Successfully confirmed your account.";
                            $msg['status'] = '1';
                        } else {
                            $msg['msg'] = "Invalid CONFIRMATION CODE";
                            $msg['status'] = '0';
                        }
                    } else {
                        $msg['msg'] =  "Account already activated. Please login.";
                        $msg['status'] = '0';
                    }
                } else {
                    $msg['msg'] =  "Email address not found!";
                    $msg['status'] = '0';
                }
            } else {
                $msg['msg'] =  "Invalid email address!";
                $msg['status'] = '0';
            }
        } else {
            $msg['msg'] =  "invalid request";
            $msg['status'] = '0';
        }
        return $msg;
    }

    //get user by ID
    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE seller_id = :seller_id LIMIT 1');
        $this->db->bind(':seller_id', $id);
        $row = $this->db->singleResult();
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    //verify user token
    public function verifyToken($token, $location)
    {
        $this->db->query("SELECT id,token,email,activated,user_recover_id FROM $location WHERE token = :token");
        $this->db->bind(':token', $token);
        $row = $this->db->singleResult();
        // check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    // public function createUserSession($user){
    //     session_start();
    //     $_SESSION['user_id'] = $user->id;
    //     $_SESSION['user_email'] = $user->email;
    //     $_SESSION['user_name'] = $user->name;
    //     $_SESSION['token'] = $user->token;
    // }

    public function updateUserProfile()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $token = filter_var($header['gnice-authenticate']);
            $verifyToken = $this->verifyToken($token, 'users');
            if ($verifyToken) {
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
            } else {
                $result['status'] = '0';
                $result['msg'] = 'Invalid token';
            }
        } else {
            echo 'invalid request';
            exit();
        }
        return $result;
    }

    public function uploadProfileImage()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $token = filter_var($header['gnice-authenticate']);
            $verifyToken = $this->verifyToken($token, 'users');
            if ($verifyToken) {
                $uploader = uploadMultiple('profile', 'profile', 2);
                $image = $uploader['imageUrl'];
                if (isset($image) && strlen($image) > 0) {
                    $this->db->query("UPDATE users SET image = :image WHERE email = :email AND status = 1");
                    $this->db->bind(':image', $image);
                    $this->db->bind(':email', $verifyToken->email);
                    if ($this->db->execute()) {
                        $this->db->query('SELECT * FROM users WHERE email= :email AND status=1');
                        $this->db->bind(':email', $verifyToken->email);
                        $row = $this->db->singleResult();
                        $row->seller_account_details = $this->getUserAccountType($row->account_type);
                        $result['data'] = $row;
                        $result['message'] = 'profile picture update successfully';
                        $result['status'] = '1';
                        $result['errors'] = $uploader['image_error'];
                    } else {
                        $result['message'] = 'profile picture update failed';
                        $result['status'] = '0';
                        $result['errors'] = $uploader['image_error'];
                    }
                } else {
                    $result['message'] = 'select a picture';
                    $result['status'] = '0';
                }
            } else {
                $result['status'] = '0';
                $result['msg'] = 'Invalid token';
            }
        } else {
            echo 'invalid request';
            exit();
        }
        return $result;
    }

    public function loginAdmin()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $email = strtolower(trim($_POST['email']));
            $password = trim($_POST['password']);
            if (!(empty($email) || empty($password))) {
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                if ($email == true) {

                    $this->db->query('SELECT id, fullname, email ,phone, last_login,privilege, password FROM admin WHERE email= :email AND status = 1');
                    $this->db->bind(':email', $email);
                    $row = $this->db->singleResult();
                    if ($row == true) {
                        $hashedPassword = $row->password;
                        if (password_verify($password, $hashedPassword)) {
                            // if ($password === $hashedPassword) {
                            $updated_token = $this->updateUserToken($row->id, 'admin');
                            $excluded = $row->password;
                            unset($row->password, $row->id);
                            @session_start();
                            Session::init();
                            Session::set('loggedIn', true);
                            Session::set('loggedType', 'admin');
                            Session::set('token', $updated_token);
                            Session::set('data', $row);
                            $result['status'] = '1';
                            $result['data'] = $row;
                            $result['token'] = $updated_token;
                            // session_start();
                            // $_SESSION['token'] = $updated_token;
                            // $_SESSION['isLoggedIn'] = true;
                            // $_SESSION['type'] = 'admin';
                            // $_SESSION['privilege'] = $row->privilege;
                            // $_SESSION['data'] = $row;
                            // $result['status'] = '1';
                            //$result['data'] = $row;

                        } else {
                            $result['message'] = 'Enter valid password or email';
                            $result['status'] = '0';
                        }
                    } else {

                        $result['message'] = 'Please contact admin';
                        $result['status'] = '0';
                    }
                } else {
                    $result['message'] = 'Please a provide email ';
                    $result['status'] = '0';
                }
            } else {
                $result['message'] = 'Please provide email and password';
                $result['status'] = '0';
            }
            return $result;
        }
    }

    public function registerAdmin()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            if ($_SESSION['privilege'] == 3) {
                $data = filter_var_array($_POST);
                $email = filter_var(strtolower(trim($data['email'])), FILTER_VALIDATE_EMAIL);
                if ($email == true) {
                    $data['email']  = $email;
                    $check_email = $this->findUserByEmail($email, 'admins');
                    if ($check_email == false) {
                        $data['status'] = 1;
                        $data['reset_password'] = rand(1000, 10000);
                        $subject = "Welcome to Gnice";
                        $html_message = "<div style='background:#C1E4FF;width:100%;padding:0;margin:0;padding:30px'>
                     <div style='margin:0 auto;width:40%;min-width:300px;float:none;'>
                     <div style='height:45px;background:#DEDEDE;padding:5px 25px; text-align:left'>
                     <img src='" . APP_URL . "public/assets/images/gnice_logo.png' style='height:70%'>

                     </div>
                     <div style='background:#fff;padding:10px'>
                     <div style='text-align:left;font-size:14px;padding:0 20px'>
                     <h3 style='color:#666666'>Hello  " . $data['name'] . " </h3>
                     <p style='line-height:20px'>
                     Welcome to <strong>Gnice Market Place</strong>. We bring you a world of possibilities. Get ready to explore.To validate your account, please complete your profile by entering this; <br/>
                     <h1>" . $data['reset_password'] . "</h1><br/>
                     <hr style='border:none; border-bottom:1px solid #E7E7E7' />
                     </p>
                     <p style='line-height:15px;text-align:left;font-size:12px;margin-top:15px'>
                     If you did not associate your address with a Gnice account, please ignore this message.
                     </p>
                     </div>
                     </div>
                     </div>
                     </div>";
                        $send_mail = $this->send_mail($email, $data['name'], $subject, $html_message);
                        foreach (array_keys($data) as $key) {
                            $fields[] = $key;
                            $key_fields[] = ":" . $key;
                            $fields_imploded = implode(",", $fields);
                            $keys_imploded = implode(",", $key_fields);
                        }

                        $this->db->query('INSERT INTO admins (' . $fields_imploded . ') VALUES (' . $keys_imploded . ')');
                        foreach (array_keys($data) as $key) {
                            $this->db->bind(":" . $key, $data[$key]);
                        }
                        if ($this->db->execute()) {
                            $result['message'] =  "New Admin account created. Please check your mail for confirmation code.";
                            $result['status'] = '1';
                            $result['code'] = $data['reset_password'];
                        } else {
                            $result['message'] = 'try again something went wrong!';
                            $result['status'] = '0';
                        }
                    } else {
                        $result['message'] = 'Please a email is already in use';
                        $result['status'] = '0';
                    }
                } else {
                    $result['message'] = 'Please a provide email ';
                    $result['status'] = '0';
                }
            } else {
                $result['message'] = 'not allowed, upgrade account';
                $result['status'] = '0';
            }
        } else {
            $result['message'] = 'invalid request ';
        }

        return $result;
    }

    public function changeAdminPassword()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $data = filter_var_array($_POST);

            $verifyCode = $this->verifyResetCode($data['reset_code'], 'admins');
            if ($verifyCode) {
                if ($verifyCode->status != '0') {
                    if ($data['password'] == $data['confirm_password']) {
                        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
                        $this->db->query("UPDATE admin SET password = :password, reset_code = null  WHERE email = :email");
                        $this->db->bind(':email', $data['email']);
                        $this->db->bind(':password', $hashedPassword);
                        $row = $this->db->singleResult();
                        if ($row == true) {
                            $updated_token = $this->updateUserToken($row->id, 'admin');
                            unset($row->password, $row->id);
                            session_start();
                            $_SESSION['token'] = $updated_token;
                            $_SESSION['isLoggedIn'] = true;
                            $_SESSION['type'] = 'admin';

                            $_SESSION['data'] = $row;
                            $result['status'] = '1';
                        } else {
                            $result['msg'] = 'something went wrong, try again';
                            $result['status'] = '0';
                        }
                    } else {
                        $result['msg'] =  "Passwords do not match! Please try again.";
                        $result['status'] = '0';
                    }
                } else {
                    $result['msg'] =  "Your account is deactivated, contact admin";
                    $result['status'] = '0';
                }
            } else {
                $result['msg'] =  "Invalid token";
                $result['status'] = '-1';
            }
        } else {
            $result['msg'] =  "invalid request";
            $result['status'] = '0';
        }
        return $result;
    }
    public function verifyResetCode($reset_code, $location)
    {
        $this->db->query("SELECT id,privilege,phone,last_login,status FROM $location WHERE reset_password = :reset_password");
        $this->db->bind(':reset_password', $reset_code);
        $row = $this->db->singleResult();
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    public function generatePasswordResetCode()
    {
        $data = filter_var_array($_POST);
        $email = filter_var(strtolower(trim($data['email'])), FILTER_VALIDATE_EMAIL);
        if ($email == true) {
            $data['email']  = $email;
            $check_email = $this->findUserByEmail($email, 'admins');
            if ($check_email == true) {
                $data['status'] = 1;
                $data['reset_password'] = rand(1000, 10000);
                $subject = "Welcome to Gnice";
                $html_message = "<div style='background:#C1E4FF;width:100%;padding:0;margin:0;padding:30px'>
                     <div style='margin:0 auto;width:40%;min-width:300px;float:none;'>
                     <div style='height:45px;background:#DEDEDE;padding:5px 25px; text-align:left'>
                     <img src='" . APP_URL . "public/assets/images/gnice_logo.png' style='height:70%'>

                     </div>
                     <div style='background:#fff;padding:10px'>
                     <div style='text-align:left;font-size:14px;padding:0 20px'>
                     <h3 style='color:#666666'>Hello  " . $data['name'] . " </h3>
                     <p style='line-height:20px'>
                     Welcome to <strong>Gnice Market Place</strong>. We bring you a world of possibilities. Get ready to explore.To validate your account, please complete your profile by entering this; <br/>
                     <h1>" . $data['reset_password'] . "</h1><br/>
                     <hr style='border:none; border-bottom:1px solid #E7E7E7' />
                     </p>
                     <p style='line-height:15px;text-align:left;font-size:12px;margin-top:15px'>
                     If you did not associate your address with a Gnice account, please ignore this message.
                     </p>
                     </div>
                     </div>
                     </div>
                     </div>";
                $send_mail = $this->send_mail($email, $data['name'], $subject, $html_message);
                $this->db->query('UPDATE admins SET resest_password = :resest_password WHERE email = :email');
                $this->db->bind(':email', $email);
                $this->db->bind(':reset_password', $data['reset_password']);
                if ($this->db->execute()) {
                    $result['message'] = 'reset code sent successfully';
                    $result['status'] = '1';
                } else {
                    $result['message'] = 'try again';
                    $result['status'] = '0';
                }
            } else {
                $result['message'] = 'Please register first';
                $result['status'] = '0';
            }
        } else {
            $result['msg'] =  "Please enter a valid email.";
            $result['status'] = '0';
        }

        return $result;
    }

    // TODO: admin logout
    public function adminLogout()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {

            session_destroy();
            // redirect('users/login');
        }
    }
}
