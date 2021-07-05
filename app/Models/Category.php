<?php
//Category crud
/**
 * add, delete, create, update categories and sub categories
 *
 */
TODO: // work on category


class Category extends Model
{

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
        $query = $this->db;
        $car_makes = $query->query("SELECT * FROM car_makes WHERE status!='0' ORDER BY make DESC");
        $row['car_makes'] = $query->resultSet();
        $count = $this->db->rowCount();
        for ($a = 0; $a < $count; $a++) {
            $this->db->query("SELECT * FROM car_models WHERE make_id = :make_id AND status!='0'");
            $this->db->bind(':make_id', $row['car_makes'][$a]->make_id);
            $car_model =  $this->db->resultSet();
            $row['car_makes'][$a]->car_models = $this->db->resultSet();
        }
        $property_type = $query->query("SELECT * FROM property_types WHERE status!='0' ORDER BY type DESC");
        $row['property_types'] = $query->resultSet();

        $rows['data'] = $row;
        $rows['status'] = '1';

        return $rows;
    }

    public function addCategory($data)
    {
        $this->db->query(
            'INSERT INTO category (title, address) VALUES (:title,:address)'
        );
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
        $this->db->query(
            'UPDATE category SET title = :title,address = :address WHERE id = :id'
        );
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
        /*
        $this->db->query('SELECT DISTINCT sub_category.title,

                            category.title as parentCategory
                          FROM sub_category
                           JOIN category
                          WHERE sub_category.parent_id = category.id
                        ');
                        */
        $this->db->query('SELECT DISTINCT sub_category.title,sub_category.sub_id, sub_category.parent_id,

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
        $this->db->query('SELECT DISTINCT sub_category.title,sub_category.sub_id,sub_category.parent_id,
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

    public function addSubCategory($data)
    {
        $this->db->query(
            'INSERT INTO sub_category (title, parent_id, address) VALUES (:title, :parent_id, :address)'
        );
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':parent_id', $data['category']);
        $this->db->bind(':address', $data['address']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

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
