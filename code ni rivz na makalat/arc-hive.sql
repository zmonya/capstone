

CREATE TABLE files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    department VARCHAR(255) NOT NULL,
    building VARCHAR(255) NOT NULL,
    office VARCHAR(255) NOT NULL,
    shelf VARCHAR(255) NOT NULL,
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE recently_deleted (
    id INT PRIMARY KEY AUTO_INCREMENT,
    file_name VARCHAR(255) NOT NULL,
    department VARCHAR(255),
    building VARCHAR(255),
    office VARCHAR(255),
    shelf VARCHAR(255)
);
