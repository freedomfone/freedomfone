use mysql;

delete from user where user='gammu';
delete from db where user='gammu';

GRANT ALL PRIVILEGES ON gammu.* TO 'gammu'@'%' IDENTIFIED BY 'thefone' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON gammu.* TO 'gammu'@'localhost' IDENTIFIED BY 'thefone' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON gammu.* TO 'gammu'@'localhost.localdomain' IDENTIFIED BY 'thefone' WITH GRANT OPTION;

create DATABASE if not exists `gammu`;
flush privileges;

