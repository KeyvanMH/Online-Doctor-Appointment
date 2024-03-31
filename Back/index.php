<?php
// Sample data for demonstration purposes
$doctorProfilePhotoPath = "image/20016.jpg";
$doctorAppointmentSchedule = [
    "Monday" => "9:00 AM - 5:00 PM",
    "Tuesday" => "9:00 AM - 5:00 PM",
    // Add more days and times as needed
];
// Send the doctor's appointment schedule in JSON format with content type application/json
header('Content-Type: application/json');
echo json_encode($doctorAppointmentSchedule);
// Send a new line to separate the image and JSON data
echo "\n";

// Send the doctor's profile photo with content type image/jpeg
header('Content-Type: image/jpeg');
readfile($doctorProfilePhotoPath);


?>
