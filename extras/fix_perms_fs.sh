find /usr/local/freedomfone/freeswitch/scripts -type f | grep -v '\.svn' | xargs chown freeswitch:freeswitch
find /usr/local/freedomfone/freeswitch/scripts -type f | grep -v '\.svn' | xargs chmod 0644
find /usr/local/freedomfone/freeswitch/scripts -type f | grep -v '\.svn' | xargs chmod g-s
find /usr/local/freedomfone/freeswitch/scripts -type d | grep -v '\.svn' | xargs chown freeswitch:freeswitch
find /usr/local/freedomfone/freeswitch/scripts -type d | grep -v '\.svn' | xargs chmod 0755
	find /usr/local/freedomfone/freeswitch/scripts -type d | grep -v '\.svn' | xargs chmod g-s

#Folders writable via FS 
chown -R freeswitch:freeswitch /usr/local/freedomfone/freeswitch/scripts/freedomfone/leave_message/100/messages

#Folders writable via GUI
chown www-data:www-data /usr/local/freedomfone/freeswitch/scripts/freedomfone/leave_message/100/audio_menu
chown www-data:www-data /usr/local/freedomfone/freeswitch/scripts/freedomfone/ivr/100/nodes
chown www-data:www-data /usr/local/freedomfone/freeswitch/scripts/freedomfone/ivr/100/ivr

