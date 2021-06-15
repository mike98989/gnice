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

    public function uploadProductImage(){
          $files = $_FILES['file'];
          $fileName = $files['name'];
          $fileSize = $files['size'];
          $fileTmpLocation = $files['tmp_name'];
          //$fileError = $files['error'];

          //allowed only jpeg,jpg, png
          $fileNameExploded =explode('.', $fileName);
         
          $fileExtention = strtolower($fileNameExploded[1]);
          $allowedExtention = array('jpeg', 'jpg','png', 'webp');

          if(in_array($fileExtention, $allowedExtention)){
            if($fileSize < 200000){
                $folder = 'upload/products/';

                if(!file_exists($folder))
			 	{
			 		mkdir($folder,0777,true);
                 }

            $fileImplode = implode(',', $fileName);
            
                 //generation new name
                $fileNewName = uniqid('pro_',true);
                $destination = $folder.$fileNewName.$fileName.$fileExtention;
                
                move_uploaded_file($fileTmpLocation,$destination);
                return array($destination);
                
            }else {
                 print_r($result['error']='file size exceed limit');
            }
          }else {
                print_r($result['error']='file type not supported');
          }
    }
}