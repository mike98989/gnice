<?php

class Profile extends Model
{
    public function addProfileData()
    {
        $header = apache_request_headers();
        if (isset($header['gnice-authenticate'])) {
            // $email_valid = filter_var($email, FILTER_VALIDATE_EMAIL);

            // if ($email_valid == true) {
            //     $check_email = $this->findUserByEmail($email);
            //     if ($check_email != false) {
            //         $uploader = uploadMultiple('user', 'profiles');
            //         $_POST = filter_input_array(
            //             INPUT_POST,
            //             FILTER_SANITIZE_STRING
            //         );
            //         $image = $uploader['imageUrl'];
            //         $_POST['image'] = $image;

            //         if (
            //             $_POST['image'] != '' &&
            //             $user_email != '' &&
            //             $user_id != ''
            //         ) {
            //             $this->db->query(
            //                 'INSERT INTO users (image) VALUES (:image) WHERE users.id = :user_id AND users.email = :user_email AND users.activaded = 1 AND users.status = 1 LIMIT 1'
            //             );
            //         }
            //     }
            // }
        }
    }
}