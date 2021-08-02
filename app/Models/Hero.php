<?php

class Hero extends Model
{
    public function getAllHero()
    {
        $this->db->query("SELECT title, sub_title, image
                            FROM hero
                            ORDER BY hero.title DESC
                            ");

        if ($this->db->resultSet()) {
            $rows['rowCount'] = $this->db->rowCount();
             $rows['data'] = $this->db->singleResult();
            $rows['status'] = '1';
        } else {
            $rows['data'] = [];
            $rows['status'] = '0';
        }

        return $rows;
    }

    public function AddHero()
    {
        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $title = trim($_POST['title']);
        $sub_title = trim($_POST['sub_title']);
        /*
        $image = $uploader['uploaded'];
        */
        $image = $_FILES['file']['name'];
          $path = 'assets/images/uploads/hero/'.$_FILES['file']['name'];
     if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
        $this->db->query('INSERT INTO hero (title,sub_title,image) VALUES (:title,:sub_title,:image)');
        $this->db->bind(':title', $title);
        $this->db->bind(':sub_title', $sub_title);
        $this->db->bind(':image', $image);
        if ($this->db->execute()) {
            $result['rowCount'] = $this->db->rowCount();
            $result['message'] = 'banner added';
            $result['status'] = 1;
        } else {
            $result['message'] = 'banner failed';
            $result['status'] = 0;
            // return false;
        }
    } else {
              $result['message'] = 'upload failed';
            $result['status'] = 0;
            }
        return $result;
    
    }
}