CREATE TABLE DoctorAppointments (
    appointment_id INT AUTO_INCREMENT PRIMARY KEY,
    year INT,
    month VARCHAR(20),
    day INT,
    hour VARCHAR(12),
    patient_name VARCHAR(100),
    patient_number VARCHAR(255);
    status TINYINT
);
