DROP DATABASE IF EXISTS uballers;
CREATE DATABASE  uballers;
USE uballers;

CREATE TABLE users(
  user_id INT NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(30) NOT NULL,
  last_name VARCHAR(30) NOT NULL,
  email NVARCHAR(320),
  mobile VARCHAR(30),
  birthday DATE NOT NULL,
  gender BIT NOT NULL,
  password CHAR(50) NOT NULL,
  PRIMARY KEY(user_id)
);

INSERT INTO users(first_name,last_name,email,birthday,gender,password) VALUES('Alice','toto','toto@gmail.com','1900-12-31',0,'azerty');
