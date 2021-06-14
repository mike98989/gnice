<?php

class ImageUploader extends Model{


    public function upload(){

        $targetDir= "uploading/products/";
        $image = $_FILES['files']['name'];
        
        $fileName = implode(',', $image);
        
        if(!empty($image)){
            foreach ($image as $key => $value) {
                $targetFilePath = $targetDir. $value;
                move_uploaded_file($_FILES['files']['tmp_name'][$key], $targetFilePath);
            }
            $query = "INSERT INTO data ";
        } 
    }
}