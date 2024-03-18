CREATE TABLE DoctorAppointments (
    appointment_id INT AUTO_INCREMENT PRIMARY KEY,
    year INT,
    month VARCHAR(20),
    day INT,
    day_of_week VARCHAR(20),
    hour VARCHAR(10),
    patient_name VARCHAR(100),
    doctor_name VARCHAR(100),
    appointment_type VARCHAR(100),
    status TINYINT
);
