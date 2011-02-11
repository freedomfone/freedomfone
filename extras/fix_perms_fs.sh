#Fixing Freeswitch permissions
chown -R freeswitch:freeswitch /usr/local/freeswitch

#Fixing Freeswitch script permissions
find /usr/local/freedomfone/freeswitch/scripts -type f | grep -v '\.svn' | xargs chown freeswitch:freeswitch
find /usr/local/freedomfone/freeswitch/scripts -type f | grep -v '\.svn' | xargs chmod 0644
find /usr/local/freedomfone/freeswitch/scripts -type f | grep -v '\.svn' | xargs chmod g-s
find /usr/local/freedomfone/freeswitch/scripts -type d | grep -v '\.svn' | xargs chown freeswitch:freeswitch
find /usr/local/freedomfone/freeswitch/scripts -type d | grep -v '\.svn' | xargs chmod 0755
find /usr/local/freedomfone/freeswitch/scripts -type d | grep -v '\.svn' | xargs chmod g-s

#We do not have JS to be visible via the GUI
find /usr/local/freedomfone/freeswitch/scripts -type f -name main.js  | grep -v '\.svn' | xargs  chmod 600

#Folders writable via FS 
chown -R freeswitch:freeswitch /usr/local/freedomfone/freeswitch/scripts/freedomfone/leave_message/1*/messages
chown -R www-data:www-data /usr/local/freedomfone/freeswitch/scripts/freedomfone/leave_message/1*/conf

#Folders writable via GUI
chown www-data:www-data /usr/local/freedomfone/freeswitch/scripts/freedomfone/leave_message/1*/audio_menu
chown www-data:www-data /usr/local/freedomfone/freeswitch/scripts/freedomfone/ivr/nodes
chown www-data:www-data /usr/local/freedomfone/freeswitch/scripts/freedomfone/ivr/1*/ivr
chown www-data:www-data /usr/local/freedomfone/freeswitch/scripts/freedomfone/ivr/1*/conf
chown -Rf www-data:www-data /usr/local/freedomfone/xml_curl

#Log folder is writable by all components
#chmod 777 /usr/local/freedomfone/log/
#chown -Rf www-data:www-data /usr/local/freedomfone/log/
