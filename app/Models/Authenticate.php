<?php

class Authenticate extends Model{

// login user
    public function login($username,$password){
            $email = filter_var($username, FILTER_VALIDATE_EMAIL);
            $password = filter_var($password);
            $this->db->query('SELECT * FROM users WHERE email= :email');
            $this->db->bind(':email', $email);
            $row=$this->db->singleResult();
            if($row==true){
            $hashedPassword = $row->password;
            if(password_verify($password, $hashedPassword)){
                if($row->status=='0'){
                    $msg['status']="0";
                    $msg['msg'] = "Your account is disabled. Please contact administrator!"; 
                }elseif($row->activated=='0'){
                    $msg['status']="0";
                    $msg['msg'] = "Your account is not yet active. Please click on the validation link sent to your email or contact administrator!"; 
                }else{
                  
                $updated_token = $this->updateUserToken($row->id);
                if((isset($_POST['source']))&&($_POST['source']=='browser')){
                        @session_start();		
                        Session::init();
                        Session::set('loggedIn', true);
                        Session::set('loggedType', 'user');
                        Session::set('token', $updated_token);
                        Session::set('data', $row); 
                }
                $msg['status']='1';
                $msg['token']=$updated_token;
                $msg['data']=$row;
                }
            }else{
                $msg['status']='0';
                $msg['msg']='Wrong Username or Password! Please try again';
            }
            }else{
                $msg['status']='0';
                $msg['msg']='Email Address not found!';
            }
            return($msg);
            $return = json_encode($message);
            print_r($return);
            exit;
        
        
    }

    /////UPDATE TOKEN AND LAST LOGIN
    public function updateUserToken($id){
    $token = bin2hex(openssl_random_pseudo_bytes(64));
    $date = new DateTime();
    $date->setTimezone(new DateTimeZone('GMT+1'));
    $date->format('Y-m-d H:i:s');
    $date=json_encode($date,true);
    $date = json_decode($date,true);
    $this->db->query('UPDATE users SET token = :token,last_login = :last_login WHERE id = :id');
        $this->db->bind(':token', $token);
        $this->db->bind(':last_login', date($date['date']));
        $this->db->bind(':id', $id);
        if($this->db->execute()){
            return $token;
        }else{
            return false;
        }
    
    }


    public function updateUserAccountType(){
        $header = apache_request_headers(); 
        if(isset($header['gnice-Authenticate'])){
			$token = filter_var($header['gnice-Authenticate']);
            $verifyToken = $this->verifyToken($token);
            if($verifyToken){
                $this->db->query('UPDATE users SET account_type = :account_type WHERE id = :id ');
                $this->db->bind(':account_type', filter_var($_POST['selectedOption']));
                $this->db->bind(':id', $verifyToken->id);
                if($this->db->execute()){
                    $msg['msg'] = "Successfully updated user account type!";
                    $msg['status']='1';
                }else{
                    return false;
                }
            }else{
                $msg['msg'] =  "invalid token";
                $msg['status']='0';
            }
            
        }else{
            $msg['msg'] =  "invalid request";
            $msg['status']='0';
        }
       
        return $msg;
    }
    // register user
    public function signup($data){
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
            // bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        //execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    //find user by email
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->singleResult();

            // check row
        if($this->db->rowCount()> 0){
            return true;
        }else{
            return false;
        }
    }

 //get user by ID
    public function getUserById($id){
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->singleResult();
        return $row;
    }

  //verify user token
    public function verifyToken($token){
        $this->db->query('SELECT id,token FROM users WHERE token = :token');
        $this->db->bind(':token', $token);
        $row = $this->db->singleResult();
            // check row
        if($this->db->rowCount()> 0){
            return $row;
        }else{
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