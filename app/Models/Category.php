<?php
//Category crud
/**
 * add, delete, create, update categories and sub categories
 *
 */
TODO: // work on category
class Category extends Model
{
    public function save_json(){

        $CSVfp = fopen(__DIR__."/apple_phones.csv", "r");
        if($CSVfp !== FALSE) {    
        while(! feof($CSVfp)) {
        $data = fgetcsv($CSVfp, 1000, ",");
        if(isset($data[0])){
        $model=$data[0];    
        $this->db->query('SELECT model FROM phone_models WHERE model = :model');
        $this->db->bind(':model', $model);
        if (!$this->db->singleResult()) {
            $this->db->query("INSERT INTO phone_models (make_id,model,status) VALUES ('6',:model,'1')");
            $this->db->bind(':model', $model);
            $this->db->execute();     
        print_r($data[0]);
        }
        }
        }
        }
        fclose($CSVfp);

        //$json = file_get_contents(__DIR__.'/car_model_list.json');

        //Decode JSON
        // $json_data = json_decode($json,true);
    
        // foreach ($json_data as $key => $value) {
        //     for($a=1;$a<count($json_data[$key]);$a++){
        //     $type = $json_data[$key][$a]['Category'];    
        //     $this->db->query('SELECT type FROM car_types WHERE type = :type');
        //     $this->db->bind(':type', $type);
        //     if (!$this->db->singleResult()) {
        //         $row = $this->db->singleResult();
        //         $this->db->query("INSERT INTO car_types (type,status) VALUES (:type,'1')");
        //         $this->db->bind(':type', $type);
        //         $this->db->execute();    
        //         echo $type.'<br/>';
        //         // $this->db->query("INSERT INTO car_models (make,status) VALUES (:make,'1')");
        //         // $this->db->bind(':make', $make);
        //         // $this->db->execute();
        //         // echo $json_data[$key][$a]['Make'].'<br/>';
    
        //     } else {
               
        //     }
            
        //         }
            
        //     }


        // foreach ($json_data as $key => $value) {
        // for($a=1;$a<count($json_data[$key]);$a++){
        // $make = $json_data[$key][$a]['Make']; 
        // $model = $json_data[$key][$a]['Model'];  
        // $type = $json_data[$key][$a]['Category'];    
        // $this->db->query('SELECT make,make_id FROM car_makes WHERE make = :make');
        // $this->db->bind(':make', $make);
        // if ($this->db->singleResult()==true) {
        //     $row = $this->db->singleResult();
        //     $this->db->query('SELECT model FROM car_models WHERE model = :model AND make_id= :make_id');
        //     $this->db->bind(':model', $model);
        //     $this->db->bind(':make_id', $row->make_id);
        //     if (!$this->db->resultSet()) {
        //     $this->db->query("INSERT INTO car_models (make_id,model,type,status) VALUES (:make_id,:model,:type,'1')");
        //     $this->db->bind(':make_id', $row->make_id);
        //     $this->db->bind(':model', $model);
        //     $this->db->bind(':type', $type);
        //     $this->db->execute();    
        //     echo $model.'@'.$make.'<br/>';
        //     }

        //     // $this->db->query("INSERT INTO car_models (make,status) VALUES (:make,'1')");
        //     // $this->db->bind(':make', $make);
        //     // $this->db->execute();
        //     // echo $json_data[$key][$a]['Make'].'<br/>';

        // } else {
           
        // }
        
        //     }
        
        // }


    // $model = [
    //     "Spark Plus",
    //     "Camon CX Air",
    //     "Spark Pro",
    //     "Camon CX Manchester City LE",
    //     "Phantom 6",
    //     "Camon CX",
    //     "Pop 1 Lite",
    //     "Pouvoir 2",
    //     "Pouvoir 2 Pro",
    //     "Pop 1 Pro",
    //     "Phantom 6 Plus",
    //     "Pop 1s",
    //     "Pouvoir 1",
    //     "Camon X",
    //     "Pop 1",
    //     "Spark 2",
    //     "Spark CM",
    //     "Camon X Pro",
    //     "Spark",
    //     "Phantom 8",
    //     "Camon CM",
    //     "Camon 11",
    //     "F2 LTE",
    //     "F2",
    //     "Camon 11 Pro"
    // ];

    //   for($a=0;$a<count($model);$a++){
    //     $this->db->query("INSERT INTO phone_models (make_id,model,status) VALUES ('95',:model,'1')");
    //     $this->db->bind(':model', $model[$a]);
    //     if ($this->db->execute()) {
    //     echo $model[$a].'<br/>';    
    //     }
    //   }
    }
    
    public function getAllCategoriesAndSubCategories()
    {
        $this->db->query("SELECT * FROM category WHERE status!='0' ORDER BY id ASC");
        $category = $this->db->resultSet();
        $count = $this->db->rowCount();
        //print_r($this->db->rowCount());exit;
        //$row['category'] = $category;
        for($a=0;$a<$count;$a++){
            $this->db->query("SELECT * FROM sub_category WHERE parent_id = :category_id AND status!='0'");
            $this->db->bind(':category_id', $category[$a]->id);
            $subcategory =  $this->db->resultSet();
            $category[$a]->subcategory = $this->db->resultSet();
        }
       
            $rows['data'] = $category;
            $rows['status'] = '1';
        
        return $rows;
    }

    
     public function getAllRequiredTables()
    {
        $query =$this->db;
        $car_makes = $query->query("SELECT * FROM car_makes WHERE status!='0' ORDER BY make DESC");
        $row['car_makes'] = $query->resultSet();
        $count = $this->db->rowCount();
        for($a=0;$a<$count;$a++){
            $this->db->query("SELECT * FROM car_models WHERE make_id = :make_id AND status!='0'");
            $this->db->bind(':make_id', $row['car_makes'][$a]->make_id);
            $car_model =  $this->db->resultSet();
            $row['car_makes'][$a]->car_models = $this->db->resultSet();
        }
        $property_type = $query->query("SELECT * FROM property_types WHERE status!='0' ORDER BY type DESC");
        $row['property_types'] = $query->resultSet();
        $phone_makes = $query->query("SELECT * FROM phone_makes WHERE status!='0' ORDER BY make DESC");
        $row['phone_makes'] = $query->resultSet();
        $count2 = $this->db->rowCount();
        for($a=0;$a<$count2;$a++){
            $this->db->query("SELECT * FROM phone_models WHERE make_id = :make_id AND status!='0'");
            $this->db->bind(':make_id', $row['phone_makes'][$a]->phone_make_id);
            $phone_model =  $this->db->resultSet();
            $row['phone_makes'][$a]->phone_models = $this->db->resultSet();
        }

        $states = $query->query("SELECT * FROM states ORDER BY state DESC");
        $row['states'] = $query->resultSet();
        $count3 = $this->db->rowCount();
        for($a=0;$a<$count3;$a++){
            $this->db->query("SELECT * FROM lga WHERE State = :state");
            $this->db->bind(':state', strtoupper($row['states'][$a]->state));
            $lgas =  $this->db->resultSet();
            $row['states'][$a]->lgas = $this->db->resultSet();
        }

        $rows['data'] = $row;
        $rows['status'] = '1';
        
        return $rows;
    }

    public function addCategory($data)
    {
        $this->db->query('INSERT INTO category (title, address) VALUES (:title,:address)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':address', $data['address']);
        if ($this->db->execute()) {
            return true;
            return $status = [1];
        } else {
            return false;
            return $status = [0];
        }
    }
    public function updateCategory($data)
    {
        $this->db->query('UPDATE category SET title = :title,address = :address WHERE id = :id');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':address', $data['address']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteCategory($id)
    {
        $this->db->query('DELETE * FROM category WHERE id = :id ');
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllSubCategory()
    {
        $this->db->query('SELECT DISTINCT sub_category.title,
                            category.title as parentCategory
                          FROM sub_category
                           JOIN category
                          WHERE sub_category.parent_id = category.id
                        ');
        if ($this->db->resultSet()) {
            $rows['data'] = $this->db->resultSet();
            $rows['status'] = '1';
        } else {
            $rows['data'] = [];
            $rows['status'] = '0';
        }

        return $rows;
    }

    public function addSubCategory($data)
    {
        $this->db->query('INSERT INTO sub_category (title, parent-id, address) VALUES (:title, :parent-id, :address)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':parent-id', $data['category']);
        $this->db->bind(':address', $data['address']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteSubCategory($id)
    {
        $this->db->query('DELETE * FROM sub-category WHERE id = :id ');
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function testCategory()
    {
        $this->db->query("SELECT t1.id, t1.name
                            CASE WHEN parent_id = 0 THEN
                                1
                            ELSE
                            (SELECT count(id)+1 FROM category t2  WHERE t2.parent_id = t1.id AND t2.id < t1.id)
                            END AS seq_no
                FROM category t1
                            ");

        if ($this->db->resultSet()) {
            $result['data'] = $this->db->resultSet();
            $result['status'] = '1';
        } else {
            $result['data'] = [];
            $result['status'] = '0';
        }

        return $result;
    }

    public function createCategory()
    {
        $_POST = filter_var(INPUT_POST, FILTER_SANITIZE_STRING);
        $category_name = $_POST['category_name'];
        $this->db->query("INSERT INTO category (name, parent_id) VALUES (:category_name, 0)");
        $this->db->bind(':category_name', $category_name);

        if ($this->db->execute()) {
            $result['message'] = 'category added';
            $result['status'] = '1';
        } else {
            $result['message'] = 'category failed';
            $result['status'] = '0';
        }

        return $result;
    }

    public function createSubCategory()
    {
        $_POST = filter_var(INPUT_POST, FILTER_SANITIZE_STRING);
        $parent_id = filter_var($_POST['category_id'], FILTER_SANITIZE_NUMBER_INT);
        $subcategory_name = $_POST['subcategory_name'];
        $this->db->query("INSERT INTO sub_category (name, parent_id) VALUES (:subcategory_name, :parent_id)");
        $this->db->bind(':subcategory_name', $subcategory_name);
        $this->db->bind(':parent_id', $parent_id);

        if ($this->db->execute()) {
            $result['message'] = ' subcategory added';
            $result['status'] = '1';
        } else {
            $result['message'] = 'category failed';
            $result['status'] = '0';
        }
        return $result;
    }

    public function getAllCategory2()
    {
        $parent_id = 0;
        $this->db->query("SELECT * FROM category WHERE parent_id = :parent_id");
        $this->db->bind(':parent_id', $parent_id);


        // $this->db->query("SELECT * FROM category");

        $catData = [];
        if ($this->db->resultSet()) {
            $row = $this->db->resultSet();
            $data = json_encode($row);

            // print_r($data);
            // exit('got here');
            while ($row = $this->db->resultSet()) {
                $catData[] = [
                    'id' => $row['id'],
                    'parent_id' => $row['parent_id'],
                    'category_name' => $row['name'],
                    'subcategory' => $this->getAllSubCategory2($row['id'])
                ];
            }



            return $catData;
        } else {
            return $catData = [];
        }

        print_r($catData);
    }

    public function getAllSubCategory2($parent_id)
    {
        $this->db->query("SELECT * FROM sub_category WHERE parent_id = :parent_id");
        $this->db->bind(':parent_id', $parent_id);
        $row = $this->db->execute();

        $subCatData = [];
        if ($this->db->resultSet()) {
            if ($this->db->rowCount() > 0) {
                while ($row) {

                    $subCatData[] = [
                        'id' => $row['id'],
                        'parent_id' => $row['parent_id'],
                        'subcategory' => $row['subcategory'],
                    ];
                    # code...
                }
                return $subCatData;
            } else {
                return $subCatData = [];
            }
        }
    }
}
