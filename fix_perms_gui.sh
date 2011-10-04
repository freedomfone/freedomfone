chown -Rf www-data:www-data /opt/freedomfone/log
chmod 770 /opt/freedomfone/log
chown -Rf freeswitch:www-data /opt/freedomfone/gui/
find /opt/freedomfone/gui/ -type f | grep -v '\.svn' | xargs chmod 660 
find /opt/freedomfone/gui/ -type d | grep -v '\.svn' | xargs chmod 770 
