<?php

function show($stuff)
{
	echo "<pre>";
	print_r($stuff);
	echo "</pre>";
}

// function redirect($page, $code){
// 	header('location: ' . URL_ROOT . '/'. $page, $code);
// }

//code to generate product code
function random($length, $chars = '')
{
	if (!$chars) {
		$chars = implode(range('a','z'));
		$chars .= implode(range('0','9'));
        $chars .= implode(range('A', 'Z'));
	}
	$shuffled = str_shuffle($chars);
	return substr($shuffled, 0, $length);
}
function generateCode()
{
	return random(8).random(8);
}



function to_json($data){
    $data = json_encode($data);
}


function sanitizeData($data){
	$data = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
}

 function flash($name = '', $message = '', $class = 'alert alert-success'){
     if(!empty($name)){
         if(!empty($message) && empty($_SESSION[$name])){
             if(!empty($_SESSION[$name])){
                 unset($_SESSION[$name]);
             }
             if(!empty($_SESSION[$name . '_class'])){
                 unset($_SESSION[$name . '_class']);
             }

             $_SESSION[$name] = $message;
             $_SESSION[$name. '_class'] = $class;

         }elseif (empty($message) && !empty($_SESSION[$name])) {
             $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
             echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
             unset($_SESSION[$name]);
             unset($_SESSION[$name . '_class']);
         }
     }
 }

//   function uploadProductImage($type,$location){
//           $files = $_FILES['file'];
//           $fileName = $files['name'];
//           $fileSize = $files['size'];
//           $fileTmpLocation = $files['tmp_name'];
//           //$fileError = $files['error'];

//           //allowed only jpeg,jpg, png
//           $fileNameExploded =explode('.', $fileName);
         
//           $fileExtention = strtolower($fileNameExploded[1]);
//           $allowedExtention = array('jpeg', 'jpg','png', 'webp');
//           $filesImploded = implode(',', $fileName);

//           if(in_array($fileExtention, $allowedExtention)){
//             if($fileSize < 200000){
//                 $folder = "upload/$location/";

//                 if(!file_exists($folder)){
// 			 		mkdir($folder,0777,true);
//                  }

//                  if(!empty($fileName)){
//                     foreach ($fileName as $key => $value) {

//                          return print_r("key is $key and value is $value, ");
//                         exit;
//                         // move_uploaded_file($_FILES['file']['tmp_name'][$key],));
//                     }
//                  }
//                  //generation new name
//                 $fileNewName = uniqid($type,false);
//                 $destination = $folder.$fileNewName.random(100000,10000000).$fileNameExploded[0].'.'.$fileExtention;
                
//                 move_uploaded_file($fileTmpLocation,$destination);
//                 // return array($destination);
//                 $result['route']= $destination;
//                 $result['status'] = '1';
                
//             }else {
//                  print_r($result['error']='file size exceed limit');
//                  $result['status'] = '0';
//             }
//           }else {
//                 print_r($result['error']='file type not supported');
//                 $result['status'] = '0';
//           }
//           return $result;
//     }


    function uploadProductImage($type,$location){
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
                $folder = "upload/$location/";

                if(!file_exists($folder))
			 	{
			 		mkdir($folder,0777,true);
                 }
                 //generation new name
                $fileNewName = uniqid($type,false);
                $destination = $folder.$fileNewName.random(100000,10000000).$fileNameExploded[0].'.'.$fileExtention;
                
                move_uploaded_file($fileTmpLocation,$destination);
                // return array($destination);
                $result['route']= $destination;
                $result['status'] = '1';
                
            }else {
                 print_r($result['error']='file size exceed limit');
                 $result['status'] = '0';
            }
          }else {
                print_r($result['error']='file type not supported');
                $result['status'] = '0';
          }
          return $result;
    }