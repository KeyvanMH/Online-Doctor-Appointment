<?php
class errorHandling{
    public static function inValidInput(){
        http_response_code(400);
        echo json_encode("InValid Input");
    }
    public static function internalError(){
        http_response_code(500);
        echo json_encode("Internal Error!");
    }
    public static function inValidRequest(){
        http_response_code(404);
        echo json_encode("Bad Request!");
    }
}