<?php
//check if the guy in the account has same id as jwt and session is not manipulated
//bacuase there is a chance that id of jwt is not same as id of session
//and attacker get's in account with valid jwt and use other's person session id and change his data in db
// //because we do all db info changing dou to the session id not the jwt
$_SESSION['id'] = $validJwt;
if ($_SESSION['id'] != $validJwt) {
    header("location:login.php");
    exit();
    
}