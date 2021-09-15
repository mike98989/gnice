<?php

function show($stuff)
{
    echo '<pre>';
    print_r($stuff);
    echo '</pre>';
}

// function redirect($page, $code){
// 	header('location: ' . URL_ROOT . '/'. $page, $code);
// }

//code to generate product code
function random($length, $chars = '')
{
    if (!$chars) {
        $chars = implode(range('a', 'z'));
        $chars .= implode(range('0', '9'));
        $chars .= implode(range('A', 'Z'));
    }
    $shuffled = str_shuffle($chars);
    return substr($shuffled, 0, $length);
}
function generateCode()
{
    return random(8) . random(8);
}

function generateToken($length)
{
    $array = [
        0,
        1,
        2,
        3,
        4,
        5,
        6,
        7,
        8,
        9,
        'a',
        'b',
        'c',
        'd',
        'e',
        'f',
        'g',
        'h',
        'i',
        'j',
        'k',
        'l',
        'm',
        'n',
        'o',
        'p',
        'q',
        'r',
        's',
        't',
        'u',
        'v',
        'w',
        'x',
        'y',
        'z',
        'A',
        'B',
        'C',
        'D',
        'E',
        'F',
        'G',
        'H',
        'I',
        'J',
        'K',
        'L',
        'M',
        'N',
        'O',
        'P',
        'Q',
        'R',
        'S',
        'T',
        'U',
        'V',
        'W',
        'X',
        'Y',
        'Z',
    ];
    $code = '';

    $length = rand(30, $length);

    for ($i = 0; $i < $length; $i++) {
        $random = rand(0, 100);

        $code .= $array[$random];
    }

    return $code;
}


function flash($name = '', $message = '', $class = 'alert alert-success')
{
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class'])
                ? $_SESSION[$name . '_class']
                : '';
            echo '<div class="' .
                $class .
                '" id="msg-flash">' .
                $_SESSION[$name] .
                '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}

/**
 * Image uploader function I
 */

function uploadProductImage($type, $location)
{
    $files = $_FILES['file'];
    $fileName = $files['name'];
    $fileSize = $files['size'];
    $fileTmpLocation = $files['tmp_name'];
    //$fileError = $files['error'];

    //allowed only jpeg,jpg, png
    $fileNameExploded = explode('.', $fileName);

    $fileExtention = strtolower($fileNameExploded[1]);
    $allowedExtention = ['jpeg', 'jpg', 'png', 'webp'];

    if (in_array($fileExtention, $allowedExtention)) {
        if ($fileSize < 200000) {
            $folder = "upload/$location/";

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }
            //generation new name
            $fileNewName = uniqid($type, false);
            $destination =
                $folder .
                $fileNewName .
                random(100000, 10000000) .
                $fileNameExploded[0] .
                '.' .
                $fileExtention;

            move_uploaded_file($fileTmpLocation, $destination);
            // return array($destination);
            $result['route'] = $destination;
            $result['status'] = '1';
        } else {
            print_r($result['error'] = 'file size exceed limit');
            $result['status'] = '0';
        }
    } else {
        print_r($result['error'] = 'file type not supported');
        $result['status'] = '0';
    }
    return $result;
}

/**
 * upload multiple files
 * set form to enctype="multipart/form-data"
 * set input name to name='files[]' multiple
 * <input type="file" name="files[]" multiple>
 */

function uploadMultiple($prefix, $location, $size)
{
    $uploaded = [];
    $failed = [];

    if (!empty($_FILES['files']['name'][0])) {
        $files = $_FILES['files'];
        //print_r($files);exit;
        // $data = array();
        //convert file  size from mb to kb
        $sizeLimit = round($size * 1024 * 1024, 4);
        $allowedExtention = ['jpeg', 'jpg', 'png', 'webp'];

        foreach ($files['name'] as $position => $fileName) {
            $fileTmp = $files['tmp_name'][$position];
            $fileSize = $files['size'][$position];
            $fileError = $files['error'][$position];

            $fileExtention = explode('.', $fileName);
            $fileExtention = strtolower(end($fileExtention));

            if (in_array($fileExtention, $allowedExtention)) {
                if ($fileError === 0) {
                    //set upload limit to 2mb
                    // if ($fileSize <= 2097152) {
                    if ($fileSize <= $sizeLimit) {
                        $folder = "public/assets/images/uploads/$location/";
                        if (!file_exists($folder)) {
                            mkdir($folder, 0777, true);
                        }
                        // generate new unique name
                        $fileNewName =
                            uniqid($prefix, false) .
                            random(1000000, 100000000) . '.' . $fileExtention;

                        $fileDestination = $folder . trim($fileNewName);

                        if (move_uploaded_file($fileTmp, $fileDestination)) {
                            //upload file if all criteria are met
                            // $uploaded[$position] = $fileDestination;
                            $uploaded[$position] = $fileNewName;
                        } else {
                            //errors array
                            $failed[$position] = "{$fileName} failed to uploaded";
                        }
                    } else {
                        $failed[$position] = "{$fileName} exceeds {$size}mb";
                    }
                } else {
                    $failed[$position] = "{$fileName} errored with code {$fileError}";
                }
            } else {
                $failed[$position] = "{$fileName} file extension '{$fileExtention}' is not allowed";
            }
        }
    }
    // return implode(',',$uploaded);
    $result['image_error'] = implode(',', $failed);
    $result['imageUrl'] = implode(',', $uploaded);

    // return $result;
    return $result;
}

function deleteFile($itemName, $location)
{
    $split = explode(',', $itemName);
    foreach ($split as $filename) {
        $path = "public/assets/images/uploads/$location/" . $filename;
        if (is_file($path)) {
            unlink($path);
        }
    }
    // $path = "assets/images/uploads/$location/";
    // foreach (glob($path . $itemName) as $toDelete) {
    //     unlink($toDelete);
    //     //echo $toDelete . " was deleted!";
    // }

    /**
     * 
     * 
            $filePath = "file/path/if/any/";
            $wildcard = "*.png"

            //will delete all png files
            array_map( "unlink", glob( $filePath.$wildcard ));
        
     * 
     * 
     */
}



function redirect($location, $isbool, $http_code)
{
    header('location: ' . APP_URL . '/' . $location, $isbool, $http_code);
}

function deleteElement($element, $array)
{
    $index = array_search($element, $array);
    if ($index !== false) {
        unset($array[$index]);
    }
}

// function removeElements($elements, $array)
// {
//     foreach ($elements as $key) {

//         unset($array[array_search($key, $array)]);
//         # code...
//     }

//     return $array;
// }


function resize_image($file, $max_resolution)
{
    if (file_exists($file)) {
        $original_image = imagecreatefromjpeg($file);

        // resolutions 
        $original_width = imagesx($original_image);
        $original_height = imagesy($original_image);

        //try width first
        $ratio = $max_resolution / $original_width;
        $new_width = $max_resolution;
        $new_height = $original_height * $ratio;

        //if that didnt work
        if ($new_height > $max_resolution) {
            $ratio = $max_resolution / $original_height;
            $new_height = $max_resolution;
            $new_width = $original_width * $ratio;
        }

        if ($original_image) {
            $new_image = imagecreatetruecolor($new_width, $new_height);

            imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
            imagejpeg($new_image, $file, 90);
        }
    }
}