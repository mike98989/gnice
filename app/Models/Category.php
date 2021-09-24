<?php
//Category crud
/**
 * add, delete, create, update categories and sub categories
 *
 */

TODO: // work on category


class Category extends Model
{
    public function save_json()
    {
        return;
        // $CSVfp = fopen(__DIR__."/lenovo.csv", "r");

        // $CSVfp = fopen(__DIR__."/apple_phones.csv", "r");
        // if($CSVfp !== FALSE) {    
        // while(! feof($CSVfp)) {
        // $data = fgetcsv($CSVfp, 1000, ",");
        // if(isset($data[0])){
        // $model=$data[0];    
        // $this->db->query('SELECT model FROM phone_models WHERE model = :model');
        // $this->db->bind(':model', $model);
        // if (!$this->db->singleResult()) {
        //     $this->db->query("INSERT INTO phone_models (make_id,model,status) VALUES ('51',:model,'1')");
        //     $this->db->bind(':model', $model);
        //     $this->db->execute();     
        // print_r($data[0]);
        // }
        // }
        // }
        // }
        // fclose($CSVfp);

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
        //     "Redmi Note 10 Pro (China)",
        //     "Redmi Note 8 2021",
        //     "Poco M3 Pro 5G",
        //     "Redmi K40 Gaming",
        //     "Mi 11X Pro",
        //     "Mi 11X",
        //     "Poco M2 Reloaded",
        //     "Mi Mix Fold",
        //     "Mi 11 Ultra",
        //     "Mi 11 Pro",
        //     "Mi 11i",
        //     "Mi 11 Lite 5G",
        //     "Mi 11 Lite",
        //     "Black Shark 4 Pro",
        //     "Black Shark 4",
        //     "Poco X3 Pro",
        //     "Poco F3",
        //     "Mi 10S",
        //     "Redmi Note 10 Pro",
        //     "Redmi Note 10 5G",
        //     "Redmi Note 10S",
        //     "Redmi Note 10",
        //     "Redmi Note 10 Pro Max",
        //     "Redmi Note 10 Pro (India)",
        //     "Redmi K40 Pro+",
        //     "Redmi K40 Pro",
        //     "Redmi K40",
        //     "Redmi Note 9T",
        //     "Redmi 9T",
        //     "Mi 10i 5G",
        //     "Mi 11",
        //     "Redmi 9 Power",
        //     "Mi Watch Lite",
        //     "Redmi Note 9 Pro 5G",
        //     "Redmi Note 9 5G",
        //     "Redmi Note 9 4G",
        //     "Redmi Watch",
        //     "Poco M3",
        //     "Redmi K30S",
        //     "Poco C3",
        //     "Mi 10T Pro 5G",
        //     "Mi 10T 5G",
        //     "Mi 10T Lite 5G",
        //     "Redmi 9AT",
        //     "Redmi 9i",
        //     "Poco M2",
        //     "Poco X3",
        //     "Poco X3 NFC",
        //     "Redmi 9 (India)",
        //     "Mi 10 Ultra",
        //     "Redmi K30 Ultra",
        //     "Redmi 9 Prime",
        //     "Black Shark 3S",
        //     "Poco M2 Pro",
        //     "Redmi 9A",
        //     "Redmi 9C NFC",
        //     "Redmi 9C",
        //     "Redmi 9",
        //     "Redmi 10X Pro 5G",
        //     "Redmi 10X 5G",
        //     "Redmi 10X 4G",
        //     "Redmi K30i 5G",
        //     "Poco F2 Pro",
        //     "Redmi K30 5G Racing",
        //     "Redmi Note 9 Pro",
        //     "Redmi Note 9",
        //     "Mi Note 10 Lite",
        //     "Mi 10 Youth 5G",
        //     "Mi 10 Lite 5G",
        //     "Redmi K30 Pro Zoom",
        //     "Redmi K30 Pro",
        //     "Redmi Note 9S",
        //     "Redmi Note 9 Pro Max",
        //     "Redmi Note 9 Pro (India)",
        //     "Black Shark 3 Pro",
        //     "Black Shark 3",
        //     "Mi 10 Pro 5G",
        //     "Mi 10 5G",
        //     "Redmi 8A Pro",
        //     "Redmi 8A Dual",
        //     "Poco X2",
        //     "Redmi K30",
        //     "Redmi K30 5G",
        //     "Redmi Note 8T",
        //     "Mi Note 10 Pro",
        //     "Mi Note 10",
        //     "Mi CC9 Pro",
        //     "Redmi 8",
        //     "Redmi 8A",
        //     "Mi Mix Alpha",
        //     "Mi 9 Pro 5G",
        //     "Mi 9 Pro",
        //     "Redmi K20 Pro Premium",
        //     "Mi 9 Lite",
        //     "Redmi Note 8 Pro",
        //     "Black Shark 2 Pro",
        //     "Mi A3",
        //     "Redmi 7A",
        //     "Mi CC9",
        //     "Mi CC9e",
        //     "Redmi Note 8",
        //     "Mi 9T Pro",
        //     "Mi 9T",
        //     "Redmi K20",
        //     "Redmi K20 Pro",
        //     "Redmi Note 7S",
        //     "Redmi Y3",
        //     "Black Shark 2",
        //     "Redmi 7",
        //     "Redmi Note 7 Pro",
        //     "Mi Mix 3 5G",
        //     "Mi 9 Explorer",
        //     "Mi 9 SE",
        //     "Mi 9",
        //     "Redmi Go",
        //     "Redmi Note 7",
        //     "Mi Play",
        //     "Black Shark Helo",
        //     "Mi Mix 3",
        //     "Redmi Note 6 Pro",
        //     "Mi 8 Pro",
        //     "Mi 8 Lite",
        //     "Pocophone F1",
        //     "Mi A2 (Mi 6X)",
        //     "Mi A2 Lite (Redmi 6 Pro)",
        //     "Mi Max 3",
        //     "Mi Pad 4 Plus",
        //     "Mi Pad 4",
        //     "Redmi 6",
        //     "Redmi 6A",
        //     "Mi 8 Explorer",
        //     "Mi 8",
        //     "Mi 8 SE",
        //     "Redmi S2 (Redmi Y2)",
        //     "Mi Mix 2S",
        //     "Redmi Note 5 AI Dual Camera",
        //     "Redmi Note 5 Pro",
        //     "Black Shark",
        //     "Redmi 5 Plus (Redmi Note 5)",
        //     "Redmi 5",
        //     "Redmi 5A",
        //     "Redmi Y1 (Note 5A)",
        //     "Redmi Y1 Lite",
        //     "Mi Note 3",
        //     "Mi Mix 2",
        //     "Mi A1 (Mi 5X)",
        //     "Mi Max 2",
        //     "Redmi 4 (4X)",
        //     "Mi 6",
        //     "Mi Pad 3",
        //     "Mi 5c",
        //     "Redmi Note 4X",
        //     "Redmi Note 4",
        //     "Redmi 4 (China)",
        //     "Mi 6 Plus",
        //     "Redmi 4 Prime",
        //     "Mi Mix",
        //     "Mi Note 2",
        //     "Mi 5s Plus",
        //     "Mi 5s",
        //     "Redmi Note 4 (MediaTek)",
        //     "Redmi Pro",
        //     "Redmi 3x",
        //     "Redmi 3s Prime",
        //     "Redmi 3s",
        //     "Redmi 3 Pro",
        //     "Mi Max",
        //     "Mi 5",
        //     "Mi 4s",
        //     "Redmi Note 3",
        //     "Redmi 3",
        //     "Redmi Note Prime",
        //     "Mi Pad 2",
        //     "Redmi Note 3 (MediaTek)",
        //     "Mi 4c",
        //     "Redmi Note 2",
        //     "Redmi 2 Pro",
        //     "Redmi 2 Prime",
        //     "Mi 4i",
        //     "Mi Note Pro",
        //     "Mi Note",
        //     "Redmi 2A",
        //     "Redmi 2",
        //     "Mi 4 LTE",
        //     "Redmi Note 4G",
        //     "Mi 4",
        //     "Mi Pad 7.9",
        //     "Redmi Note",
        //     "Mi 3",
        //     "Redmi 1S",
        //     "Redmi",
        //     "Mi 2A",
        //     "Mi 2S",
        //     "Mi 2",
        //     "Mi 1S",
        //     "Poco M3 Pro",
        //     "Mi 10 Lite Zoom",
        //     "Mi 9X",
        //     "Mi Max 4 Pro",
        //     "Mi Max 4",
        //     "Mi 6c",
        //     "Redmi Pro 2",
        //     "Mi Note Plus"
        // ];

        // for ($a = 0; $a < count($model); $a++) {
        //     $this->db->query("INSERT INTO phone_models (make_id,model,status) VALUES ('111',:model,'1')");
        //     $this->db->bind(':model', $model[$a]);
        //     if ($this->db->execute()) {
        //         echo $model[$a] . '<br/>';
        //     }
        // }
    }

    public function getAllCategoriesAndSubCategories()
    {
        $this->db->query(
            "SELECT * FROM category WHERE status!='0' ORDER BY id ASC"
        );
        $category = $this->db->resultSet();
        $count = $this->db->rowCount();
        //print_r($this->db->rowCount());exit;
        //$row['category'] = $category;
        for ($a = 0; $a < $count; $a++) {
            /////// GET SUBCATEGORY
            $this->db->query("SELECT * FROM sub_category WHERE parent_id = :category_id AND status!='0'");
            $this->db->bind(':category_id', $category[$a]->id);
            $subcategory =  $this->db->resultSet();
            $category[$a]->subcategory = $this->db->resultSet();
            $count2 = $this->db->rowCount();
            /////////COUNT PRODUCTS OF SUB CATEGORY
            for ($i = 0; $i < $count2; $i++) {
            $this->db->query("SELECT COUNT(*) as counted FROM products WHERE sub_category = :sub_category_id AND status!='0'");
            $this->db->bind(':sub_category_id', $category[$a]->subcategory[$i]->sub_id);
            $category[$a]->subcategory[$i]->counted_sub_category_products = $this->db->singleResult();
            }
        }

        $rows['data'] = $category;
        $rows['status'] = '1';

        return $rows;
    }


    public function getAllRequiredTables()
    {
        $query = $this->db;
        $car_makes = $query->query("SELECT * FROM car_makes WHERE status!='0' ORDER BY make ASC");
        $row['car_makes'] = $query->resultSet();
        $count = $this->db->rowCount();
        for ($a = 0; $a < $count; $a++) {
            $this->db->query("SELECT * FROM car_models WHERE make_id = :make_id AND status!='0' ORDER BY model ASC");
            $this->db->bind(':make_id', $row['car_makes'][$a]->make_id);
            $car_model =  $this->db->resultSet();
            $row['car_makes'][$a]->car_models = $this->db->resultSet();
        }
        $property_type = $query->query("SELECT * FROM property_types WHERE status!='0' ORDER BY type ASC");
        $row['property_types'] = $query->resultSet();
        $phone_makes = $query->query("SELECT * FROM phone_makes WHERE status!='0' ORDER BY make ASC");
        $row['phone_makes'] = $query->resultSet();
        $count2 = $this->db->rowCount();
        for ($a = 0; $a < $count2; $a++) {
            $this->db->query("SELECT * FROM phone_models WHERE make_id = :make_id AND status!='0' ORDER BY model ASC");
            $this->db->bind(':make_id', $row['phone_makes'][$a]->phone_make_id);
            $phone_model =  $this->db->resultSet();
            $row['phone_makes'][$a]->phone_models = $this->db->resultSet();
        }

        $states = $query->query("SELECT * FROM states ORDER BY state ASC");
        $row['states'] = $query->resultSet();
        $count3 = $this->db->rowCount();
        for ($a = 0; $a < $count3; $a++) {
            $this->db->query("SELECT * FROM lga WHERE State = :state ORDER BY Lga ASC");
            $this->db->bind(':state', strtoupper($row['states'][$a]->state));
            $lgas =  $this->db->resultSet();
            $row['states'][$a]->lgas = $this->db->resultSet();
        }

        $conditions = $query->query("SELECT * FROM conditions WHERE status!='0' ORDER BY state ASC");
        $row['conditions'] = $query->resultSet();

        $rows['data'] = $row;
        $rows['status'] = '1';

        return $rows;
    }

    // FIXME: move to admin menu

    public function addCategory($data)
    {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $title = trim($_POST['titles']);
        $id = $_POST['id'];
        $image = $_FILES['file']['name'];
        if ($image != "") {
            $path = 'assets/images/uploads/category/' . $_FILES['file']['name'];
            if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
                $this->db->query('UPDATE category SET title = :title,image = :image WHERE id = :id');
                $this->db->bind(':id', $id);
                $this->db->bind(':title', $title);
                $this->db->bind(':image', $image);
                if ($this->db->execute()) {
                    $result['rowCount'] = $this->db->rowCount();
                    $result['message'] = 'Category Updated';
                    $result['status'] = 1;
                } else {
                    $result['message'] = 'Category failed';
                    $result['status'] = 0;
                    // return false;
                }
            } else {
                $result['message'] = 'upload failed';
                $result['status'] = 0;
            }
        } else {
            $this->db->query('UPDATE category SET title = :title WHERE id = :id');
            $this->db->bind(':title', $title);
            $this->db->bind(':id', $id);
            if ($this->db->execute()) {
                $result['rowCount'] = $this->db->rowCount();
                $result['message'] = 'Category updated';
                $result['status'] = 1;
            } else {
                $result['message'] = 'Category failed';
                $result['status'] = 0;
                // return false;
            }
        }

        return $result;
    }

    public function updatesubCategory()
    {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $title = trim($_POST['titles']);
        $id = $_POST['id'];
        $parent_id = $_POST['parent_id'];
        $image = $_FILES['file']['name'];
        if ($image != "") {
            $path = 'assets/images/uploads/category/' . $_FILES['file']['name'];
            if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
                $this->db->query('UPDATE sub_category SET title = :title, parent_id = :parent_id, image = :image WHERE sub_id = :id');
                $this->db->bind(':id', $id);
                $this->db->bind(':title', $title);
                $this->db->bind(':parent_id', $parent_id);
                $this->db->bind(':image', $image);
                if ($this->db->execute()) {
                    $result['rowCount'] = $this->db->rowCount();
                    $result['message'] = 'Category Updated';
                    $result['status'] = 1;
                } else {
                    $result['message'] = 'Category failed';
                    $result['status'] = 0;
                    // return false;
                }
            } else {
                $result['message'] = 'upload failed';
                $result['status'] = 0;
            }
        } else {
            $this->db->query('UPDATE sub_category SET title = :title, parent_id = :parent_id, WHERE sub_id = :id');
            $this->db->bind(':title', $title);
            $this->db->bind(':id', $id);
            $this->db->bind(':parent_id', $parent_id);
            if ($this->db->execute()) {
                $result['rowCount'] = $this->db->rowCount();
                $result['message'] = 'Category updated';
                $result['status'] = 1;
            } else {
                $result['message'] = 'Category failed';
                $result['status'] = 0;
                // return false;
            }
        }

        return $result;
    }
    public function deleteCategory($id)
    {
        $cat_id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $this->db->query('DELETE  FROM category WHERE id = :id ');
        $this->db->bind(':id', $cat_id);
        if ($this->db->execute()) {
            $result['message'] = 'Category Deleted';
            $result['status'] = 1;
        } else {
            $result['message'] = 'Category failed';
            $result['status'] = 0;
        }
        return $result;
    }

    public function deletesubCategory($id)
    {
        $cat_id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $this->db->query('DELETE  FROM sub_category WHERE sub_id = :id ');
        $this->db->bind(':id', $cat_id);
        if ($this->db->execute()) {
            $result['message'] = 'Category Deleted';
            $result['status'] = 1;
        } else {
            $result['message'] = 'Category failed';
            $result['status'] = 0;
        }
        return $result;
    }

    public function getAllSubCategory()
    {
        /*
        $this->db->query('SELECT DISTINCT sub_category.title,

                            category.title as parentCategory
                          FROM sub_category
                           JOIN category
                          WHERE sub_category.parent_id = category.id
                        ');
                        */
        $this->db->query('SELECT DISTINCT sub_category.title,Sub_category.image,sub_category.sub_id, sub_category.parent_id,

                            category.title as parentCategory
                          FROM sub_category
                           JOIN category
                          WHERE sub_category.parent_id = category.id
                        ');

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

    public function getSelectedCategory($id)
    {
        // the value is sanitize to an interger


        $product_codes = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $this->db->query('SELECT DISTINCT sub_category.title,sub_category.image,sub_category.sub_id,sub_category.parent_id,

                            category.title as parentCategory
                          FROM sub_category
                            INNER JOIN category ON  sub_category.parent_id = category.id
                          WHERE parent_id = :product_code
                        ');

        $this->db->bind(':product_code', $id);
        if ($this->db->resultSet()) {

            $rows['data'] = $this->db->resultSet();
            $rows['status'] = '1';
        } else {
            $rows['data'] = [];
            $rows['status'] = '0';
        }

        return $rows;
    }
    public function getAllCategory()
    {


        $header = apache_request_headers();
        $header = array_change_key_case($header,CASE_LOWER);
        if (isset($header['gnice-authenticate'])) {
            // the value is sanitize to an interger
            $this->db->query('SELECT * from Category
                        ');

            if ($this->db->resultSet()) {
                $result['rowCounts'] = $this->db->rowCount();
                $result['data'] = $this->db->resultSet();
                $result['status'] = '1';
            } else {
                $result['data'] = [];
                $result['status'] = '0';
            }
            return $result;
        }
    }

    public function getSingleCategory($id)
    {

        // the value is sanitize to an interger
        $product_codes = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $this->db->query('SELECT DISTINCT sub_category.title,sub_category.sub_id,sub_category.parent_id,
                            category.title as parentCategory
                          FROM sub_category
                            INNER JOIN category ON  sub_category.parent_id = category.id
                          WHERE sub_id = :product_code
                        ');
        $this->db->bind(':product_code', $id);
        if ($this->db->singleResult()) {
            $rows['data'] = $this->db->singleResult();
            $rows['status'] = '1';
        } else {
            $rows['data'] = [];
            $rows['status'] = '0';
        }

        return $rows;
    }
    // FIXME: moved to admintasks

    public function addSubCategory()
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $title = trim($_POST['title']);
        $parent_id = trim($_POST['parent_id']);
        $status = 1;
        /*
        $image = $uploader['uploaded'];
        */
        $image = $_FILES['file']['name'];
        $path = 'assets/images/uploads/category/' . $_FILES['file']['name'];
        if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
            $this->db->query('INSERT INTO sub_category (title,parent_id,image,status) VALUES (:title, :parent_id, :image,:status)');
            $this->db->bind(':title', $title);
            $this->db->bind(':parent_id', $parent_id);
            $this->db->bind(':image', $image);
            $this->db->bind(':status', $status);
            if ($this->db->execute()) {
                $result['rowCount'] = $this->db->rowCount();
                $result['message'] = 'Category added';
                $result['status'] = 1;
            } else {
                $result['message'] = 'Category failed';
                $result['status'] = 0;
                // return false;
            }
        } else {
            $result['message'] = 'upload failed';
            $result['status'] = 0;
        }
        return $result;
    }

    /*
    public function deleteSubCategory($id)
    {
        $this->db->query('DELETE * FROM sub-category WHERE sub_id = :id ');
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    */

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
            $result['rowCount'] = $this->db->rowCount();
            $result['data'] = $this->db->resultSet();
            $result['status'] = '1';
        } else {
            $result['data'] = [];
            $result['status'] = '0';
        }

        return $result;
    }

    // FIXME: moved to admintasks

    public function createCategory()
    {
        $_POST = filter_var(INPUT_POST, FILTER_SANITIZE_STRING);
        $category_name = $_POST['category_name'];
        $this->db->query(
            'INSERT INTO category (name, parent_id) VALUES (:category_name, 0)'
        );
        $this->db->bind(':category_name', $category_name);

        if ($this->db->execute()) {
            $result['rowCount'] = $this->db->rowCount();
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
        $parent_id = filter_var(
            $_POST['category_id'],
            FILTER_SANITIZE_NUMBER_INT
        );
        $subcategory_name = $_POST['subcategory_name'];
        $this->db->query(
            'INSERT INTO sub_category (name, parent_id) VALUES (:subcategory_name, :parent_id)'
        );
        $this->db->bind(':subcategory_name', $subcategory_name);
        $this->db->bind(':parent_id', $parent_id);

        if ($this->db->execute()) {
            $result['rowCount'] = $this->db->rowCount();
            $result['message'] = ' subcategory added';
            $result['status'] = '1';
        } else {
            $result['message'] = 'category failed';
            $result['status'] = '0';
        }
        return $result;
    }


    public function getAllSubCategoryFromParent($parent_id)
    {
        $this->db->query("SELECT * FROM sub_category WHERE parent_id = :parent_id");
        $this->db->bind(':parent_id', $parent_id);
        //$this->db->execute();

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
}
