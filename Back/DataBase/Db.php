<?php
class Db{
    private static function connection(){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=doctordb", "root", "");
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
          } catch(PDOException $e) {
            errorHandling::internalError();

            
          }
    }

    public static function insertDoctorInfo($input){
      $conn = Db::connection();
      try {
      $stmt = $conn->prepare("INSERT INTO doctor
      (first_name ,last_name ,file_number, contact_number, city, clinic_address, major, expertise, email, gender, password , ip , dateRegister,profileImage)
      VALUES(:first,:last,:file_number,:contact_number,:city,:clinic_address,:major,:expertise,:email,:gender,'1',:ip,:dateRegister,'default.jpg')"); 
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
      $stmt->bindParam(":ip",$input[10]);
      $stmt->bindParam(":dateRegister",$input[11]);

      $stmt->execute();
      $doctorID = $conn->lastInsertId();
      return $doctorID;
      } catch (\PDOException $e) {
        errorHandling::internalError();
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
        errorHandling::internalError();
      } 
    }


    public static function fetchUserEmail($email){
      $conn = Db::connection();
     try {
      $stmt = $conn->prepare("SELECT id,password FROM doctor WHERE email=:email");
      $stmt->bindParam(":email",$email);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result;
     }  catch (\PDOException $e) {
      errorHandling::internalError();
    } 
    }

    public static function fetchUserId($id){
      $conn = Db::connection();
     try {
      $stmt = $conn->prepare("SELECT id,password FROM doctor WHERE id=:id");
      $stmt->bindParam(":id",$id);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result;
     } catch (\PDOException $e) {
      errorHandling::internalError();
    } 
    }

    public static function fetchUserPhone($phoneNumber){
      $conn = Db::connection();
      try {
       $stmt = $conn->prepare("SELECT id,password FROM doctor WHERE contact_number=:phone");
       $stmt->bindParam(":phone",$phoneNumber);
       $stmt->execute();
       $result = $stmt->fetch(PDO::FETCH_ASSOC);
       return $result;
      } catch (\PDOException $e) {
        errorHandling::internalError();
      } 
    }

    // public static function insertJwt($jwt,$id){
    //   $conn = Db::connection();
    //   try {
    //     $stmt = $conn->prepare("INSERT INTO doctor(jwt)VALUES(:jwt) WHERE id=:id"); 
    //     $stmt->bindParam(":jwt",$jwt);
    //     $stmt->bindParam(":id",$id);
    //     $stmt->execute();
    //     return true;
    //   } catch (\PDOException $e) {
      // errorHandling::internalError();
    // } 

    // }


    public static function fetchUserIdJwt($id){
      $conn = Db::connection();
     try {
      $stmt = $conn->prepare("SELECT id FROM doctor WHERE id=:id");
      $stmt->bindParam(":id",$id);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if(empty($result)){
        return false;
      }else{
        return true;
      }
     } catch (\PDOException $e) {
      errorHandling::internalError();
    } 
    }

    public static function makeDataBase(string $doctorID){
      $conn = Db::connection();
      try {
        $stmt = $conn->prepare("CREATE TABLE D$doctorID (
          appointment_id INT AUTO_INCREMENT PRIMARY KEY,
          year INT,
          month VARCHAR(20),
          day INT,
          hour VARCHAR(12),
          patient_name VARCHAR(100),
          patient_number VARCHAR(255),
          status TINYINT
          )");
          
          $stmt->execute();
      
        } catch (\PDOException $e) {
          errorHandling::internalError();
        } 
    }

    public static function showDocDb($doctorID){
      $conn = Db::connection();
      try {
        $dbName = "D".$doctorID;
        $sql = "SELECT * FROM " . $dbName ." WHERE status=1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      } catch (\PDOException $e) {
        errorHandling::internalError();
      } 
    }

    public static function showDocDbForPatient($doctorID){
      $conn = Db::connection();
      try {
        $dbName = "D".$doctorID;
        $sql = "SELECT year,month,day,hour FROM " . $dbName ." WHERE status=1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      } catch (\PDOException $e) {
        errorHandling::internalError();
      } 
    }


    //doctor delete's appointment
    public static function deleteAppointment($appointmentID,$doctorID){
      $conn = Db::connection();
      try {
        $sql = 'SELECT * FROM d'.$doctorID.' WHERE appointment_id='.$appointmentID;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($result)) {
          errorHandling::inValidRequest();
        }else{
          // we have to make status to 0 , not to delete the whole appointment 
          $sql = 'DELETE FROM d'.$doctorID.' WHERE appointment_id='.$appointmentID;
          $stmt = $conn->prepare($sql);
          $stmt->execute();
        } 
      } catch (\PDOException $e) {
        errorHandling::internalError();
      } 
    }

    //fetch hour of the appointment's
    public static function fetchHourAppointment($requestUri,$doctorID){

      $conn = Db::connection();
      $array = explode("&",$requestUri);
      foreach ($array as $value) {
        $temp = explode("=",$value);
        switch ($temp[0]) {
          case 'year':
            $year = $temp[1];
            break;
          case 'month':
            $month = $temp[1];
            break;
          case 'day':
            $day = $temp[1];
            break;
          case 'hour':
            $hour = $temp[1];
            break;
          
          default:
          errorHandling::inValidRequest();
            break;
        }
      }
      //fetch hour from databse
      try {
        $sql = "SELECT hour FROM d".$doctorID." WHERE year=".$year." and month='".$month."' and day=".$day;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      } catch (\PDOException $e) {
        errorHandling::internalError();
      }
    }
    //doctor add appointment
    public static function putAppointment($requestUri,$doctorID,$phoneNum,$patientName){
      if ($phoneNum == null and $patientName == null) {
      $array = explode("&",$requestUri);
      foreach ($array as $value) {
        $temp = explode("=",$value);
        switch ($temp[0]) {
          case 'year':
            $year = $temp[1];
            break;
          case 'month':
            $month = $temp[1];
            break;
          case 'day':
            $day = $temp[1];
            break;
          case 'hour':
            $hour = $temp[1];
            break;
          
          default:
          errorHandling::inValidRequest();
            break;
        }
      }
      $conn = Db::connection();
        try {
          $sql = "INSERT INTO d".$doctorID." ( year,month,day,hour,patient_name,status) VALUES ($year,'$month',$day,'$hour', 'doctor','1')";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
        } catch (\PDOException $e) {
          errorHandling::internalError();
         } 
      }elseif ($phoneNum !== null and $patientName !== null) {

        $array = explode("&",$requestUri);
      foreach ($array as $value) {
        $temp = explode("=",$value);
        switch ($temp[0]) {
          case 'year':
            $year = $temp[1];
            break;
          case 'month':
            $month = $temp[1];
            break;
          case 'day':
            $day = $temp[1];
            break;
          case 'hour':
            $hour = $temp[1];
            break;
          
          default:
          errorHandling::inValidRequest();
            break;
        }
      }
      $conn = Db::connection();
        try {
          $sql = "INSERT INTO d".$doctorID." (year, month, day, hour, status, patient_name, patient_number) VALUES (:year, :month, :day, :hour, '1', :name, :num)";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(":year", $year);
          $stmt->bindParam(":month", $month);
          $stmt->bindParam(":day", $day);
          $stmt->bindParam(":hour", $hour);
          $stmt->bindParam(":name", $patientName);
          $stmt->bindParam(":num", $phoneNum);
          $stmt->execute();
        } catch (\PDOException $e) {
          errorHandling::internalError();
         } 
      }
    }


    public static function saveImageAddress($address){
      $conn = DB::connection();
      try {
        $sql = "UPDATE doctor
        SET profileImage = :image
        WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id',$_SESSION['id']);
        $stmt->bindParam(':image',$address);
        $stmt->execute();
      } catch (\PDOException $th) {
        errorHandling::internalError();
      }

    }

    public static function changeProfile($request){
      $requestArray = explode("=",$request);
      $column = $requestArray[0];
      $value = $requestArray[1];
      try {
        $conn = DB::connection();
        $sql = "UPDATE doctor
        SET ".$column." = :value
        WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":value",$value);
        $stmt->bindParam(":id",$_SESSION['id']);
        $stmt->execute();

      } catch (\PDOException $e) {
        errorHandling::internalError();
      }
    }


    public static function unicData($data){
      $fileNumber = $data[2];
      $phoneNumber = $data[3];
      $email = $data[8];
      try {
        $conn = DB::connection();
        $stmt = $conn->prepare('SELECT contact_number FROM doctor WHERE contact_number=:phoneNum');
        $stmt->bindParam(":phoneNum",$phoneNumber);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($result)) {
          errorHandling::inValidPhoneNum();
        }
        $stmt = $conn->prepare('SELECT file_number FROM doctor WHERE file_number=:fileNum');
        $stmt->bindParam(":fileNum",$fileNumber);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($result)) {
          errorHandling::inValidFileNum();
        }
        $stmt = $conn->prepare('SELECT email FROM doctor WHERE email=:email');
        $stmt->bindParam(":email",$email);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($result)) {
          errorHandling::inValidEmail();
        }
      } catch (\PDOException $e) {
        errorHandling::internalError();
      }
    }

    public static function showStatus(){
        $conn = db::connection();
        try {
          $sql = "SELECT appointment_id,year,month,day,hour FROM d".$_SESSION['id']." WHERE status=1";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $result;
        } catch (\PDOException $e) {
          errorHandling::internalError();
        }     
    }

    public static function changeStatus($appointmentID){
      try {
        $conn = db::connection();
        foreach ($appointmentID as $key => $value) {
          $sql = "UPDATE d".$_SESSION['id']."
           SET status = 0
          WHERE appointment_id = ".$value;
          $stmt = $conn->prepare($sql);
          $stmt->execute();
        }
      } catch (\PDOException $e) {
        errorHandling::internalError();
      } 
    }

    public static function showDocDbFilter($filterCity,$filterMajor,$filterGender){
      if (isset($filterCity) or isset($filterMajor) or isset($filterGender) ) {
        $sql = "SELECT id, first_name, last_name, contact_number, city, clinic_address, major, expertise, email, gender FROM doctor";
      }else {
        $sql = "SELECT id, first_name, last_name, contact_number, city, clinic_address, major, expertise, email, gender FROM doctor";
      }
      if ($filterCity !== null) {
        $sql = $sql." city=".$filterCity;
      }
      if ($filterMajor !== null) {
        $sql = $sql." major=".$filterMajor;
      }
      if ($filterGender !== null) {
        $sql = $sql." gender=".$filterGender;
      }
      try {
        $conn = Db::connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      }  catch (\PDOException $e) {
        errorHandling::internalError();
      }
    }

    public static function showImage($id){
      try {
        $conn = Db::connection();
        $stmt = $conn->prepare("SELECT profileImage FROM doctor WHERE id=:id");
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;

      }  catch (\PDOException $e) {
        errorHandling::internalError();
      }
    }

    public static function insertAppointmentTable($requestUri,$id,$phoneNum,$patientName){
      $reservationDate = date("Y,M,D H:i");
      $array = explode("&",$requestUri);
      foreach ($array as $value) {
        $temp = explode("=",$value);
        switch ($temp[0]) {
          case 'year':
            $year = $temp[1];
            break;
          case 'month':
            $month = $temp[1];
            break;
          case 'day':
            $day = $temp[1];
            break;
          case 'hour':
            $hour = $temp[1];
            break;
          
          default:
          errorHandling::inValidRequest();
            break;
        }
      }
      $conn = Db::connection();
        try {
          $sql = "INSERT INTO appointment ( patient_name ,patient_phone ,year,month,day,hour,reservation_date,doctor_id,status) VALUES (:patient_name,:patient_phone,:year,:month,:day,:hour,:reservation_date,:doctor_id,'1')";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(":patient_name",$patientName);
          $stmt->bindParam(":patient_phone",$phoneNum);
          $stmt->bindParam(":year",$year);
          $stmt->bindParam(":month",$month);
          $stmt->bindParam(":day",$day);
          $stmt->bindParam(":hour",$hour);
          $stmt->bindParam(":reservation_date",$reservationDate);
          $stmt->bindParam(":doctor_id",$id);
          $stmt->execute();
          $appointmentId = $conn->lastInsertId();
          return $appointmentId;
        } catch (\PDOException $e) {
          errorHandling::internalError();
         }
    }
    
    public static function showAppointmentTableStatus(){
      try {
          $conn = db::connection();
          $sql = "SELECT id,year,month,day,hour FROM appointment WHERE status=1";
          $stmt = $conn->prepare($sql);
          $stmt->execute();
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          return $result;
        } catch (\PDOException $e) {
          errorHandling::internalError();
        }
    }

    public static function changeAppointmentTableStatus($appointmentId){
      try {
        $conn = db::connection();
        foreach ($appointmentId as $key => $value) {
            $sql = "UPDATE appointment SET status = 0 WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $value, PDO::PARAM_INT);
            $stmt->execute();
        }

      } catch (\PDOException $e) {
        errorHandling::internalError();
      }
    }

    public static function cancellReservation($appointmentId){
      try {
        $conn = Db::connection();
        $stmt = $conn->prepare("UPDATE appointment
        SET status = 0
        WHERE id = :id;
        ");
        $stmt->bindParam(":id",$appointmentId);
        $stmt->execute();
      } catch (\PDOException $e) {
        errorHandling::internalError();
      }



    }
}