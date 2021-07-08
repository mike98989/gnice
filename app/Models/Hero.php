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
            $rows['data'] = $this->db->resultSet();
            $rows['status'] = '1';
        } else {
            $rows['data'] = [];
            $rows['status'] = '0';
        }

        return $rows;
    }

    public function AddHero($data)
    {
        $data = filter_input($data, FILTER_SANITIZE_STRING);
        $this->db->query('INSERT INTO banner title VALUES :title');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':address', $data['address']);
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