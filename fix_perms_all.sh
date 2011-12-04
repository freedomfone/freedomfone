#!/bin/bash
#
echo "log: log folder is writable by dispatcher_in, freeswitch and apache2"
chmod 777 /opt/freedomfone/log
chown -Rf www-data:www-data /opt/freedomfone/log

echo "gui: gui files writable by www-data"
find /opt/freedomfone/gui/ -type f | grep -v '\.svn' | xargs chmod 664 
find /opt/freedomfone/gui/ -type d | grep -v '\.svn' | xargs chmod 775 
chown -Rf www-data:freeswitch /opt/freedomfone/gui/

echo "FS scripts: scripts are owned by freeswitch"
chmod 775 /opt/freeswitch/
find /opt/freeswitch/scripts -type f | grep -v '\.svn' | xargs chown freeswitch:www-data
find /opt/freeswitch/scripts -type f | grep -v '\.svn' | xargs chmod 0664
find /opt/freeswitch/scripts -type f | grep -v '\.svn' | xargs chmod g-s
find /opt/freeswitch/scripts -type d | grep -v '\.svn' | xargs chown freeswitch:www-data
find /opt/freeswitch/scripts -type d | grep -v '\.svn' | xargs chmod 0775
find /opt/freeswitch/scripts -type d | grep -v '\.svn' | xargs chmod g-s

echo "FS scripts: javascript only visible to freeswitch"
find /opt/freeswitch/scripts -type f -name main.js  | grep -v '\.svn' | xargs  chmod 600

echo "FS audio: mp3 and wav files are owned by freeswitch and www-data"
find /opt/freeswitch/scripts -type f -name "*mp3"  | grep -v '\.svn' | xargs  chown freeswitch:www-data
find /opt/freeswitch/scripts -type f -name "*wav"  | grep -v '\.svn' | xargs  chown freeswitch:www-data 

#echo ""
#chown -R freeswitch:www-data /opt/freeswitch/scripts/freedomfone/leave_message/1*/conf
#chown www-data:www-data /opt/freeswitch/scripts/freedomfone/leave_message/1*/audio_menu
#chown www-data:www-data /opt/freeswitch/scripts/freedomfone/ivr/nodes
#chown www-data:www-data /opt/freeswitch/scripts/freedomfone/ivr/1*/ivr
#chown www-data:www-data /opt/freeswitch/scripts/freedomfone/ivr/1*/conf

echo "XML curl: xml_curl server is readable by www-data"
chown -Rf www-data:www-data /opt/freedomfone/xml_curl
