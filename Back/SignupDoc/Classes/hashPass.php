<?php
class hashPass{
    public static function hashPassword($input){
        $hashed = password_hash($input,PASSWORD_DEFAULT);
        return $hashed;
    }
}