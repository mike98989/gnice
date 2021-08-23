<?php

class Misc extends Model
{
    public function getAccountPackages()
    {
        $this->db->query("SELECT package_id,title,value,status FROM seller_account_packages S1 WHERE S1.status=1");
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
}