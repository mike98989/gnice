<?php

class Banner extends Model
{
    public function getAllBanner()
    {
        $this->db->query("SELECT title, status
                            FROM banners
                            ORDER BY banners.title DESC
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

    public function AddBanner()
    {
        $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->db->query('INSERT INTO banners (title) VALUES (:title)');
        $this->db->bind(':title', $data['title']);
        if ($this->db->execute()) {
            $result['rowCount'] = $this->db->rowCount();
            $result['message'] = 'banner added';
            $result['status'] = 1;
        } else {
            $result['message'] = 'banner failed';
            $result['status'] = 0;
            // return false;
        }
        return $result;
    }
}