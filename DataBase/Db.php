<?php
class Db{
    public static function connection(){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=doctordb", "root", "");
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage(); //fix it as API way
          }
    }


}