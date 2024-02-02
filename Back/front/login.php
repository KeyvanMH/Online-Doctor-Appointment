<?php session_start();
if (empty($_SESSION['check'])) {
        header("location:../LoginDoc/LoginJwt.php");
        exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="../LoginDoc/Login.php" method="post">
        <label >login:</label>
        </br>
        <label >phone,email,id:</label>
        <input type="text" name="input" ></br>
        <label >password:</label>
        <input type="text" name="password" ></br>
        <input type="submit" value="submit">
    </form>
    
</body>
</html>
<?php
unset($_SESSION['check']);
session_unset();
session_destroy();
?>