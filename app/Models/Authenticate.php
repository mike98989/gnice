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

                        $updated_token = $this->updateUserToken($row->id);
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

    /////UPDATE TOKEN AND LAST LOGIN
    public function updateUserToken($id)
    {
        $token = bin2hex(openssl_random_pseudo_bytes(64));
        $date = new DateTime();
        $date->setTimezone(new DateTimeZone('GMT+1'));
        $date->format('Y-m-d H:i:s');
        $date = json_encode($date, true);
        $date = json_decode($date, true);
        $this->db->query('UPDATE users SET token = :token,last_login = :last_login WHERE id = :id');
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
            $verifyToken = $this->verifyToken($token);
            if ($verifyToken) {
                $this->db->query('UPDATE users SET account_type = :account_type WHERE id = :id ');
                $this->db->bind(':account_type', filter_var($_POST['selectedOption']));
                $this->db->bind(':id', $verifyToken->id);
                if ($this->db->execute()) {
                    $msg['msg'] = "Successfully updated user account type!";
                    $msg['status'] = '1';
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
    // register user
    public function signup()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $data = filter_var_array($_POST);
            $email = filter_var(strtolower($data['email']), FILTER_VALIDATE_EMAIL);
            if ($email == true) {
                $data['email']  = $email;
                $check_email = $this->findUserByEmail($email);
                if ($check_email == false) {
                    if ($data['password'] === $data['confirm_password']) {
                        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                        $data['signup_date'] = date('Y-m-d');
                        $data['status'] = '1';
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
                            $msg['msg'] =  "New user account created";
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

        $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

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
                $check_email = $this->findUserByEmail($email);
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
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->singleResult();
        if ($this->db->rowCount() > 0) {
            return $row;;
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
            $verifyToken = $this->verifyToken($token);
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

    public function confirm_user_signup($email, $confirm_code)
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            $email = filter_var(strtolower($email), FILTER_VALIDATE_EMAIL);
            if ($email == true) {
                $confirm_code = filter_var($confirm_code);
                $check_email = $this->findUserByEmail($email);
                if ($check_email != false) {
                    /////////MATCH THE CONFIRMATION CODE
                    if ($check_email->activated == '0') {
                        if ($check_email->user_confirm_id == $confirm_code) {
                            $this->db->query('UPDATE users SET activated = :activated WHERE email = :email');
                            $this->db->bind(':email', $email);
                            $this->db->bind(':activated', '1');
                            $this->db->execute();
                            $msg['msg'] =  "Successfully confirmed your account.";
                            $msg['status'] = '1';
                        } else {
                            $msg['msg'] =  "Invalid CONFIRMATION CODE";
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
                $msg['msg'] =  "Invalid email address";
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
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->singleResult();
        return $row;
    }

    //verify user token
    public function verifyToken($token)
    {
        $this->db->query('SELECT id,token,activated,user_recover_id FROM users WHERE token = :token');
        $this->db->bind(':token', $token);
        $row = $this->db->singleResult();
        // check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }

    // public function updateToken($email){
    //     $token = generateToken(50);
    //     $this->db->query('UPDATE users SET token = :token WHERE email = :email ');
    //     $this->db->bind(':email', $email);
    //     $this->db->bind(':token', $token);
    //     $this->db->execute();

    //     //set session token
    //     $_SESSION['token'] = $token;

    // }



}
