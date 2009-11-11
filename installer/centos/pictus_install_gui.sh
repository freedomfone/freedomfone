#!/bin/bash
# PICTUS Freedom Fone quick installer. Yes, it is a hack!
# Alberto Escudero aep@it46.se

SVNROOT=/usr/src
RELEASE=pictus
CEPSTRALPACK=Cepstral_Allison-8kHz_i386-linux_5.1.0
FS_SRC=/usr/src/freeswitch.trunk
FS_INSTALL=/usr/local/freeswitch
TIMESTAMP=`date +%s` 
C=0
C=$(($C+1))

stop() {
echo "[$C] PRESS KEY TO CONTINUE"
C=$(($C+1))
read
}

step() {
echo "========================================================================="
echo "$1"
echo "========================================================================="

}




step "Building $SVNROOT/$RELEASE"
stop

step "GUI Cake: Installing Cake SDK"
cd $SVNROOT/cake_1.2.5; cp -Rf cake /var/www/html/freedomfone/
cd $SVNROOT/cake_1.2.5; cp -Rf vendors /var/www/html/freedomfone/
cd $SVNROOT/cake_1.2.5; cp index.php /var/www/html/freedomfone/
cd $SVNROOT/cake_1.2.5; cp .htaccess /var/www/html/freedomfone/
stop
stop
stop

step "GUI Apache: Linking app freedomfone"
ln -s $SVNROOT/$RELEASE/gui/app /var/www/html/freedomfone/app
stop

step "GUI Apache: Fixing perms for tmp folder"
mkdir -p /var/www/html/freedomfone
chown -RLf apache.apache /var/www/html/freedomfone/
stop

step "GUI Apache: Check .htaccess files"
cat /var/www/html/freedomfone/.htaccess
echo
cat /var/www/html/freedomfone/app/.htaccess
echo
cat /var/www/html/freedomfone/app/webroot/.htaccess
echo
#FIXME!
#head -10 /etc/apache2/sites-enabled/freedomfone
echo
#cat /etc/apache2/mods-enabled/rewrite.load
stop

step "GUI Apache: Reaload Apache"
/etc/init.d/httpd reload
stop

step "GUI Cake: Change salt value"
echo "WARNING WARNING! change the Security.salt in  app/config/core.php"
echo "WARNING WARNING! You have been warned"
stop

step "SQL: Create mysql database"
echo "You need the root password of mysql, hopefully ENTER will do!"
/usr/bin/mysql -u root -p < $SVNROOT/$RELEASE/gui/app/install/freedomfone_db_createdb_user.sql  
/usr/bin/mysql -u root -p < $SVNROOT/$RELEASE/gui/app/install/freedomfone_db_schema.sql
stop


step "CRON: Adding cron to /etc/crontab"
##FIXME! How we move this to cron engine -e
##FIXME! cron generates messages
echo "#*/1 * * * * /usr/bin/wget-O - -q -t 1 http://localhost/freedomfone/polls/refresh" >> /etc/crontab
echo "#*/1 * * * * /usr/bin/wget-O - -q -t 1 http://localhost/freedomfone/messages/refresh" >> /etc/crontab
echo "Do not forget to uncomment /etc/crontab and restart crond"
stop

step "SQL: Create spooler_in database"
echo "You need the root password of mysql, hopefully ENTER will do!"
/usr/bin/mysql -u root -p < $SVNROOT/$RELEASE/dispatcher_in/install/spooler_db_createdb_user.sql  
/usr/bin/mysql -u root -p < $SVNROOT/$RELEASE/dispatcher_in/install/spooler_db_schema.sql  
stop


