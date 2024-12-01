CREATE TABLE applicants (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) DEFAULT NULL,
    last_name VARCHAR(50) DEFAULT NULL,
    email VARCHAR(100) DEFAULT NULL,
    subjects VARCHAR(255) DEFAULT NULL,
    years_of_experience INT(11) DEFAULT NULL,
    education VARCHAR(100) DEFAULT NULL,
    skills VARCHAR(255) DEFAULT NULL
);
