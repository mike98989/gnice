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

// form sanitizations
function sanitizeData($data)
{
    $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
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

function uploadMultiple($prefix, $location)
{
    if (!empty($_FILES['files']['name'][0])) {
        $files = $_FILES['files'];

        $uploaded = [];
        $failed = [];

        // $data = array();

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
                    if ($fileSize <= 2097152) {
                        $folder = "assets/images/uploads/$location/";

                        if (!file_exists($folder)) {
                            mkdir($folder, 0777, true);
                        }
                        // generate new unique name
                        $fileNewName =
                            uniqid($prefix, false) .
                            random(1000000, 100000000) .
                            '.' .
                            $fileExtention;

                        $fileDestination = $folder . $fileNewName;

                        if (move_uploaded_file($fileTmp, $fileDestination)) {
                            //upload file if all criteria are met
                            // $uploaded[$position] = $fileDestination;
                            $uploaded[$position] = $fileNewName;
                        } else {
                            //errors array
                            $failed[
                                $position
                            ] = "{$fileName} failed to uploaded";
                        }
                    } else {
                        $failed[
                            $position
                        ] = "{$fileName} is too large {$fileSize}";
                    }
                } else {
                    $failed[
                        $position
                    ] = "{$fileName} errored with code {$fileError}";
                }
            } else {
                $failed[
                    $position
                ] = "{$fileName} file extension '{$fileExtention}' is not allowed";
            }
        }
    }

    // return implode(',',$uploaded);
    $result['image_error'] = implode(',', $failed);
    // $result['uploaded'] = implode(',', $uploaded);
    $result['imageUrl'] = implode(',', $uploaded);

    // return $result;
    return $result;
}