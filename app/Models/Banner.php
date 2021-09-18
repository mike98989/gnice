<?php

class Banner extends Model
{
    public function getAllBanner()
    {
        $this->db->query("SELECT * FROM banners WHERE status='1' AND type='1'");
        $msg['top_banner'] = $this->db->resultSet();
        $this->db->query("SELECT * FROM banners WHERE status='1' AND type='2'");
        $msg['main_banner'] = $this->db->resultSet();
        $this->db->query("SELECT * FROM banners WHERE status='1' AND type='3'");
        $msg['side_banner'] = $this->db->resultSet();
        //$this->db->query("SELECT B1.*, B2.*, B3.* FROM banners B1 INNER JOIN banners B2  WHERE B1.type='1' AND ");
        //$this->db->query("SELECT * FROM (SELECT * FROM banners B1 WHERE B1.status='1' AND B1.type='1') UNION (SELECT * FROM banners B2 WHERE B2.status='1' AND B2.type='2') AS main_banner");  

        $rows['data'] = $msg;
        $rows['status'] = '1';
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