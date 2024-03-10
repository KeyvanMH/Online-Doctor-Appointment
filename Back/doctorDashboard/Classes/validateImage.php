<?php
class validateImage{
    public static function validateImage($image){
        //is writeable
        //check for size
        //check for mime
        $tmpName = $image['tmp_name'];
        $error = $image['error'];
        $size = $image['size'];
        if ($error !== UPLOAD_ERR_OK) {
            errorHandling::inValidInput();
        }
        if (!file_exists($tmpName)) {
            errorHandling::inValidRequest();
        }
        $allowed_formats = ['jpg', 'jpeg'];
        $file_info = pathinfo($image["name"]);
        $file_extension = strtolower($file_info['extension']);

        if (!in_array($file_extension, $allowed_formats)) {
            errorHandling::inValidInput();
        }

        if ($image["size"] > 1048576) { // 1MB in bytes
            errorHandling::inValidInput();
        }
    }
}