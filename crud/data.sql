-- You can use database name what ever you want

USE test;
--  get this lists of tables 
SHOW TABLES;

CREATE TABLE users(
	id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    passowrd VARCHAR(255) NOT NULL,
    gender VARCHAR(25) NOT NULL
);

-- for getting the details of the table
DESC users;


-- for deleting one column from the table 

ALTER TABLE users DROP COLUMN gender;



-- Creation of new data into it

