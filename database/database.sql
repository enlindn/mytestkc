CREATE DATABASE IF NOT EXISTS 'CMS_mini';
USE 'CMS_mini';

--管理员表
DROP TABLE IF EXISTS admin;
CREATE TABLE admin (
  id TINYINT UNSIGNED AUTO_INCREMENT key,
  username VARCHAR(20) NOT NULL UNIQUE ,
  password VARCHAR(32) not NULL,
  email VARCHAR(50) NOT NULL
);

INSERT INTO admin(username, password, email) VALUES ("root", "root", "root@cmsmini.com");