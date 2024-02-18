<?php
class reNewJwt {
    public function __construct($idSession){
        setcookie('jwt', '', -1, '/'); 
        $jwt = JwtGenerator::JwtGenerator($idSession);
        setcookie("jwt",$jwt,time()+60*60*24*2,'/');
    }
}
