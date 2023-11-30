<?php
class errorHandling{
    public static function unvalidInput(){
        http_response_code(400);
        return json_encode("UnValid Input");
    }
    public static function internalError(){
        http_response_code(500);
        return json_encode("Internal Error!");
    }
}