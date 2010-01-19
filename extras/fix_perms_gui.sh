find /usr/local/freedomfone/gui -type f | grep -v '\.svn' | xargs chmod 0644 
find /usr/local/freedomfone/gui -type f | grep -v '\.svn' | xargs chmod g-s 
find /usr/local/freedomfone/gui -type f | grep -v '\.svn' | xargs chown www-data:www-data 
find /usr/local/freedomfone/gui -type d | grep -v '\.svn' | xargs chmod 0755 
find /usr/local/freedomfone/gui -type d | grep -v '\.svn' | xargs chmod g-s 
find /usr/local/freedomfone/gui -type d | grep -v '\.svn' | xargs chown www-data:www-data 
