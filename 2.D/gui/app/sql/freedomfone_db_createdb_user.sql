use mysql;

delete from user where user='freedomfone';
delete from db where user='freedomfone';

GRANT ALL PRIVILEGES ON freedomfone.* TO 'freedomfone'@'%' IDENTIFIED BY 'thefone' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON freedomfone.* TO 'freedomfone'@'localhost' IDENTIFIED BY 'thefone' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON freedomfone.* TO 'freedomfone'@'localhost.localdomain' IDENTIFIED BY 'thefone' WITH GRANT OPTION;

create DATABASE if not exists `freedomfone`;
flush privileges;
