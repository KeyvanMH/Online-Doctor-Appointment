<?php
class reNewJwt {
    public function __construct($idSession){
        $jwt = JwtGenerator::JwtGenerator($idSession['id']);
        setcookie("jwt",$jwt,time()+60*60*24*2);
        // echo $idSession;
    }
}
