[gammu]
port = /dev/ttyUSB0
connection = at

[smsd]
service = sql
driver = native_mysql
LogFile = syslog
user = gammu 
password =  thefone 
pc = localhost
MaxRetries = 5
database = gammu 
phoneid=IMSI

