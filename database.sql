CREATE TABLE users (
    u_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    u_name VARCHAR(50) NOT NULL,
    u_password VARCHAR(255) NOT NULL
);

INSERT INTO users (u_name, u_password) VALUES ('admin', 'admin');
