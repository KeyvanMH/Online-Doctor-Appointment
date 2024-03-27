<?php
class errorHandling{
    public static function inValidInput(){
        http_response_code(400);
        echo json_encode("InValid Input");
        exit();
    }
    public static function internalError(){
        http_response_code(500);
        echo json_encode("Internal Error!");
        exit();
    }
    public static function inValidRequest(){
        http_response_code(404);
        echo json_encode("Bad Request!");
        exit();
    }
    public static function inValidCookie(){
        http_response_code(404);
        if (isset($_COOKIE['jwt'])) {
            unset($_COOKIE['jwt']); 
            setcookie('jwt', '', -1, '/'); 
        }
    }
    public static function inValidEmail(){
        http_response_code(404);
        echo json_encode("inValidEmail!");
        exit();
    }
    public static function inValidFileNum(){
        http_response_code(404);
        echo json_encode("inValidFileNum!");
        exit();
    }
    public static function inValidPhoneNum(){
        http_response_code(404);
        echo json_encode("inValidPhoneNum!");
        exit();
    }
    public static function inValidUser(){
        http_response_code(404);
        echo json_encode("no user found!");
        exit();
    }
    public static function wrongPassword(){
        http_response_code(404);
        echo json_encode("wrong Password");
        exit();
    }
    

}