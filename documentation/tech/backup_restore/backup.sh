
mkdir -p /home/sharicus/Desktop/backup
mkdir -p /home/sharicus/Desktop/backup/ivr

mkdir -p /home/sharicus/Desktop/backup/leave_message
/usr/bin/mysqldump -u root -p freedomfone > /home/sharicus/Desktop/backup/backup.sql  

cp -R /opt/freedomfone/freeswitch/scripts/freedomfone/ivr/* /home/sharicus/Desktop/backup/ivr

cp -R /opt/freedomfone/freeswitch/scripts/freedomfone/leave_message/1* /home/sharicus/Desktop/backup/leave_message

cp -R /opt/freedomfone/freeswitch/scripts/freedomfone/leave_message/instance /home/sharicus/Desktop/backup/leave_message
