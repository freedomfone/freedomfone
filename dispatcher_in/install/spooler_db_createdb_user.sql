use mysql;

delete from user where user='dispatcher_in';
delete from db where user='dispatcher_in';


GRANT ALL PRIVILEGES ON spooler_in.* TO 'dispatcher_in'@'%' IDENTIFIED BY 'thefone' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON spooler_in.* TO 'dispatcher_in'@'localhost' IDENTIFIED BY 'thefone' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON spooler_in.* TO 'dispatcher_in'@'localhost.localdomain' IDENTIFIED BY 'thefone' WITH GRANT OPTION;

GRANT ALL PRIVILEGES ON spooler_in.poll_in TO 'poll_in'@'%' IDENTIFIED BY 'thefone' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON spooler_in.poll_in TO 'poll_in'@'localhost' IDENTIFIED BY 'thefone' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON spooler_in.poll_in TO 'poll_in'@'localhost.localdomain' IDENTIFIED BY 'thefone' WITH GRANT OPTION;

GRANT ALL PRIVILEGES ON spooler_in.lm_in TO 'lm_in'@'%' IDENTIFIED BY 'thefone' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON spooler_in.lm_in TO 'lm_in'@'localhost' IDENTIFIED BY 'thefone' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON spooler_in.lm_in TO 'lm_in'@'localhost.localdomain' IDENTIFIED BY 'thefone' WITH GRANT OPTION;

GRANT ALL PRIVILEGES ON spooler_in.callback_in TO 'callback_in'@'%' IDENTIFIED BY 'thefone' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON spooler_in.callback_in TO 'callback_in'@'localhost' IDENTIFIED BY 'thefone' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON spooler_in.callback_in TO 'callback_in'@'localhost.localdomain' IDENTIFIED BY 'thefone' WITH GRANT OPTION;

create DATABASE if not exists `spooler_in`;
flush privileges;


