CREATE USER 'libertyclothing'@'%' IDENTIFIED BY 'libertyclothing';
GRANT ALL PRIVILEGES ON `libertyclothing`.* TO 'libertyclothing'@'%';

CREATE USER 'libertyclothing'@'localhost' IDENTIFIED BY 'libertyclothing';
GRANT ALL PRIVILEGES ON `libertyclothing`.* TO 'libertyclothing'@'localhost';