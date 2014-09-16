CREATE USER 'trello'@'localhost' IDENTIFIED BY 'dp5Trr8Ux5CeAed8';
GRANT USAGE ON *.* TO 'trello'@'localhost' IDENTIFIED BY 'dp5Trr8Ux5CeAed8' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
CREATE DATABASE IF NOT EXISTS `trello`;
GRANT ALL PRIVILEGES ON `trello`.* TO 'trello'@'localhost';
GRANT ALL PRIVILEGES ON `trello\_%`.* TO 'trello'@'localhost';
