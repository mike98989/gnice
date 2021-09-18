<?php

class Misc extends Model
{
    public function getAccountPackages()
    {
        $this->db->query("SELECT package_id,title,duration_in_days,value,status FROM seller_account_packages S1 WHERE S1.status=1");
        $packages = $this->db->resultSet();
        $count = $this->db->rowCount();
        for ($a = 0; $a < $count; $a++) {
            $this->db->query("SELECT * FROM seller_account_packages_content WHERE package_id = :package_id AND status!='0'");
            $this->db->bind(':package_id', $packages[$a]->package_id);
            $package_content =  $this->db->resultSet();
            $packages[$a]->package_contents = $this->db->resultSet();
        }
            $rows['data'] = $packages;
            $rows['status'] = '1';
        
        return $rows;
    }

    public function getAllReportReasons()
    {
            $this->db->query("SELECT report_reason.reason FROM report_reason WHERE status!='0'");
            $data = $this->db->resultSet();
            $rows['data'] = $data;
            $rows['status'] = '1';
        
        return $rows;
    }


    public function saveNewsletter()
    {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
        $this->db->query("SELECT email FROM newsletter WHERE email=:email");
        $this->db->bind(':email', $email);
        $row = $this->db->singleResult();
        $count = $this->db->rowCount();
        if ($count != 0) {
            $rows['msg'] = 'Email already exist.';
            $rows['status'] = '0';   
        }else{
        $this->db->query('INSERT INTO newsletter (email, date) VALUES (:email, :date)');
            $this->db->bind(':email', $email);
            $this->db->bind(':date', $date);
            if ($this->db->execute()) {
            $rows['msg'] = 'Your email have been saved! We will keep you updated.';
            $rows['status'] = '1';   
            }   
            
        }

        return $rows;
    }
}