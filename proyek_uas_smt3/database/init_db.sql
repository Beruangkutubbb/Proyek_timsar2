CREATE DATABASE IF NOT EXISTS penggajian_cirebon;
USE penggajian_cirebon;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);
INSERT INTO users (username, password) VALUES ('admin', MD5('admin123'));

CREATE TABLE karyawan (
  employee_id VARCHAR(20) PRIMARY KEY,
  name VARCHAR(100),
  sector VARCHAR(100),
  job_level VARCHAR(50),
  experience_years INT,
  basic_salary_idr BIGINT,
  allowance_idr BIGINT,
  overtime_idr BIGINT,
  total_compensation_idr BIGINT,
  location VARCHAR(100),
  source VARCHAR(100),
  created_at DATETIME
);

CREATE TABLE penggajian (
  id INT AUTO_INCREMENT PRIMARY KEY,
  employee_id VARCHAR(20),
  bulan VARCHAR(20),
  tahun YEAR,
  potongan BIGINT DEFAULT 0,
  total_gaji BIGINT,
  FOREIGN KEY (employee_id) REFERENCES karyawan(employee_id) ON DELETE CASCADE
);