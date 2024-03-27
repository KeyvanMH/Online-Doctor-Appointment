<?php
if (isset($_COOKIE['jwt'])) {
    //insert jwt module
    $jwt = $_COOKIE['jwt'];
    $validJwt = jwtValidator::validator($jwt);
    if ($validJwt == false) {
        echo json_encode(false);
        http_response_code(401);
        exit();
    }
}elseif (empty($_COOKIE['jwt'])) {
    echo json_encode(false);
    http_response_code(401);
    exit();
}
