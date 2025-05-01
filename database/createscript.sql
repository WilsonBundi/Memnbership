-- Create Database
CREATE DATABASE IF NOT EXISTS membership_admin;
USE membership_admin;

-- Table 1: Families
CREATE TABLE families (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address TEXT NOT NULL
);

-- Table 2: Member Types (Defines age-based discounts)
CREATE TABLE member_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type_name VARCHAR(50) UNIQUE NOT NULL, -- e.g., "Youth", "Senior"
    min_age INT NOT NULL,
    max_age INT NOT NULL,
    discount DECIMAL(5,2) NOT NULL
);

-- Table 3: Financial Years
CREATE TABLE financial_years (
    id INT AUTO_INCREMENT PRIMARY KEY,
    year YEAR UNIQUE NOT NULL
);

-- Table 4: Family Members
CREATE TABLE family_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    date_of_birth DATE NOT NULL,
    family_id INT NOT NULL,
    FOREIGN KEY (family_id) REFERENCES families(id) ON DELETE CASCADE
);

-- Table 5: Contributions (Core fee calculation logic)
CREATE TABLE contributions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    family_member_id INT NOT NULL,
    financial_year_id INT NOT NULL,
    age INT NOT NULL, -- Calculated age at financial year start
    member_type_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (family_member_id) REFERENCES family_members(id) ON DELETE CASCADE,
    FOREIGN KEY (financial_year_id) REFERENCES financial_years(id),
    FOREIGN KEY (member_type_id) REFERENCES member_types(id)
);

-- Table 6: Users (Role-based access)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(155) UNIQUE NOT NULL,
    password_hash VARCHAR(155) NOT NULL,
    role ENUM('secretary', 'treasurer') NOT NULL
);

-- Prepopulate Member Types (Critical for fee calculations)
INSERT INTO member_types (type_name, min_age, max_age, discount) VALUES
('Youth', 0, 7, 50.00),
('Aspirant', 8, 12, 40.00),
('Junior', 13, 17, 25.00),
('Senior', 18, 50, 0.00),
('Elder', 51, 120, 45.00);

-- Sample Financial Year
INSERT INTO financial_years (year) VALUES (2023), (2024);

-- Default Users (Securely hashed passwords)
-- Password for both: "admin123"
INSERT INTO users (username, password_hash, role) VALUES
('secretary', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'secretary'),
('treasurer', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'treasurer');