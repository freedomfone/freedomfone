chown -Rf www-data:www-data /opt/freedomfone/gui/
find /opt/freedomfone/gui/ -type f | grep -v '\.svn' | xargs chmod 640 
find /opt/freedomfone/gui/ -type d | grep -v '\.svn' | xargs chmod 750 
