CREATE TABLE IF NOT EXISTS appointment (
  id INT AUTO_INCREMENT PRIMARY KEY,
  patient_name VARCHAR(255) NOT NULL,
  patient_phone VARCHAR(20) NOT NULL,
  appointment_date DATETIME NOT NULL,
  reservation_date DATETIME NOT NULL,
  clinic_address VARCHAR(255) NOT NULL,
  doctor_id INT NOT NULL,
  doctor_name VARCHAR(255) NOT NULL,
  illness VARCHAR(255) NOT NULL,
  FOREIGN KEY (doctor_id) REFERENCES doctor(id)
);

ALTER TABLE appointment AUTO_INCREMENT = 20000;
