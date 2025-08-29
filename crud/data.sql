-- You can use database name what ever you want
USE test;
--  get this lists of tables 
SHOW TABLES;
CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    gender VARCHAR(25) NOT NULL
);
-- for getting the details of the table
DESC users;
-- for deleting one column from the table 
ALTER TABLE users DROP COLUMN lastname;
-- change the column name 
ALTER TABLE users CHANGE firstname name VARCHAR(255);
--
ALTER TABLE users
CHANGE passowrd password VARCHAR(255);
ALTER TABLE users
ADD COLUMN mobile VARCHAR(20) NOT NULL
AFTER email;
SELECT *
FROM users;
-- Creation of new data into it
-- INSERT INTO `users` (`name`,`email`,`mobile`, `password`) VALUE ('$name','$email','$mobile','$password')
-- deleting the data from the database
-- DELETE FROM `users` WHERE `id`=$id
-- for update via php
-- UPDATE `users` SET `id` = $id, `name`='$name', `email`='$email',`mobile`='$mobile', `password`='$password' WHERE `id`=$id