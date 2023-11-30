<?php
class Db{
    private static function connection(){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=doctordb", "root", "");
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage(); //TODO:fix it as API way (json encode)
          }
    }

    public static function insertDoctorInfo($input){
      $conn = Db::connection();
      try {
      $stmt = $conn->prepare("INSERT INTO doctor
      (first_name ,last_name ,file_number, contact_number, city, clinic_address, major, expertise, email, gender, password)
      VALUES(:first,:last,:file_number,:contact_number,:city,:clinic_address,:major,:expertise,:email,:gender,'1')"); 
      $stmt->bindParam(":first",$input[0]);
      $stmt->bindParam(":last",$input[1]);
      $stmt->bindParam(":file_number",$input[2]);
      $stmt->bindParam(":contact_number",$input[3]);
      $stmt->bindParam(":city",$input[4]);
      $stmt->bindParam(":clinic_address",$input[5]);
      $stmt->bindParam(":major",$input[6]);
      $stmt->bindParam(":expertise",$input[7]);
      $stmt->bindParam(":email",$input[8]);
      $stmt->bindParam(":gender",$input[9]);

      $stmt->execute();
      $doctorID = $conn->lastInsertId();
      return $doctorID;
      } catch (\PDOException $e) {
        echo "Connection failed: " . $e->getMessage(); //TODO:fix it as API way (json encode)
      }  
    }


    public static function updatePassword($input,$id){
      $conn = DB::connection();
      try {
        $stmt = $conn->prepare("UPDATE doctor
        SET password = :password
        WHERE id = :id;
        ");
        $stmt->bindParam(":id",$id);
        $stmt->bindParam(":password",$input);
        $stmt->execute();
      } catch (\PDOException $e) {
        echo "Connection failed: " . $e->getMessage(); //TODO:fix it as API way (json encode)
            }
    }


    public static function fetchUserEmail($email){
      $conn = Db::connection();
     try {
      $stmt = $conn->prepare("SELECT password FROM doctor WHERE email=:email");
      $stmt->bindParam(":email",$email);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result['password'];
     } catch (\Throwable $th) {
      //TODO: error handling;
     } 
    }

    public static function fetchUserId($id){
      $conn = Db::connection();
     try {
      $stmt = $conn->prepare("SELECT password FROM doctor WHERE id=:id");
      $stmt->bindParam(":id",$id);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result['password'];
     } catch (\Throwable $th) {
      //TODO: error handling;
     } 
    }

    public static function fetchUserPhone($phoneNumber){
      $conn = Db::connection();
      try {
       $stmt = $conn->prepare("SELECT password FROM doctor WHERE contact_number=:phone");
       $stmt->bindParam(":phone",$phoneNumber);
       $stmt->execute();
       $result = $stmt->fetch(PDO::FETCH_ASSOC);
       return $result['password'];
      } catch (\Throwable $th) {
       //TODO: error handling;
      } 
    }
}