<?php
include "jwtValidator.php";
$jwt = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOm51bGwsIm5iZiI6MTM1NzAwMDAwMCwiZXhwIjoxNzAzMjU0NTA4fQ.l3PoZjjO5W_VT56mOK814zhr90-I7SiKBQjGfwWW7YA";
$decoded = jwtValidator::validator($jwt);
var_dump($decoded);

