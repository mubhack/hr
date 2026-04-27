CREATE DATABASE IF NOT EXISTS hr_management;
USE hr_management;
-- Users table for authentication
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('hr', 'employee') NOT NULL,
    employee_id INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Employees table with all requested fields
CREATE TABLE IF NOT EXISTS employees (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `designation` VARCHAR(100),
    `gender` ENUM('Male', 'Female', 'Other'),
    `salary` DECIMAL(10, 2),
    `date_of_joining` DATE,
    `nationality` VARCHAR(50),
    `passport_no` VARCHAR(50),
    `passport_issue_date` DATE,
    `passport_expiry_date` DATE,
    `labour_card` VARCHAR(50),
    `eid_no` VARCHAR(50),
    `visa_stamping` DATE,
    `visa_expiry` DATE,
    `iloe_insurance_exp` DATE,
    `medical_insurance_exp` DATE,
    `bank_acct` VARCHAR(50),
    `mob_no` VARCHAR(20),
    `email_id` VARCHAR(100),
    `resigned` BOOLEAN DEFAULT FALSE,
    `terminated` BOOLEAN DEFAULT FALSE,
    `esob` DECIMAL(10, 2) DEFAULT 0.00,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
-- Leaves table
CREATE TABLE IF NOT EXISTS leaves (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    leave_type VARCHAR(50),
    start_date DATE,
    end_date DATE,
    reason TEXT,
    status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE
);
-- Insert a default HR user (Password: admin123)
-- In a real app, use password_hash() in PHP. I'll provide a setup script.
INSERT INTO users (username, password, role)
VALUES (
        'admin',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'hr'
    );