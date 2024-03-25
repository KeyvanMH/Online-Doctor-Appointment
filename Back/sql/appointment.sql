CREATE TABLE IF NOT EXISTS appointment (
  id INT AUTO_INCREMENT PRIMARY KEY,
  patient_name VARCHAR(255) NOT NULL,
  patient_phone VARCHAR(20) NOT NULL,
  year INT NOT NULL,
  month VARCHAR(20) NOT NULL,
  day INT NOT NULL,
  hour VARCHAR(12) NOT NULL,
  reservation_date  VARCHAR(255) NOT NULL,
  doctor_id INT NOT NULL,
  status TINYINT
);

