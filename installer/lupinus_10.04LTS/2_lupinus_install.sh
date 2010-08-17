#!/bin/bash
# PICTUS Freedom Fone quick installer. Yes, it is a hack!
# Alberto Escudero aep@it46.se

DOWNLOAD=/usr/local/src
SVNROOT=/usr/local/freedomfone
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


step "GUI Cake: Installing Cake SDK"
cd $DOWNLOAD/cake_1.2.5; cp -Rf cake /usr/local/freedomfone/gui/
cd $DOWNLOAD/cake_1.2.5; cp -Rf vendors /usr/local/freedomfone/gui/
cd $DOWNLOAD/cake_1.2.5; cp index.php /usr/local/freedomfone/gui
stop

step "GUI Apache: Check .htaccess files"
cat $SVNROOT/gui/.htaccess
echo
cat $SVNROOT/gui/app/.htaccess
echo
cat $SVNROOT/gui/app/webroot/.htaccess
echo
head -10 /etc/apache2/sites-enabled/freedomfone
echo
cat /etc/apache2/mods-enabled/rewrite.load
stop

step "GUI Apache: Reaload Apache"
/etc/init.d/apache2 reload
stop

step "GUI Cake: Change salt value"
echo "WARNING WARNING! change the Security.salt in  app/config/core.php"
echo "WARNING WARNING! You have been warned"
stop

step "SQL: Create mysql database"
echo "You need the root password of mysql, hopefully ENTER will do!"
/usr/bin/mysql -u root -p < $SVNROOT/gui/app/install/freedomfone_db_createdb_user.sql  
/usr/bin/mysql -u root -p freedomfone < $SVNROOT/gui/app/install/freedomfone_db_schema.sql
stop


step "CRON: Adding cron to /etc/crontab"
cat $SVNROOT/cron/crontab.freedomfone
cat $SVNROOT/cron/crontab.freedomfone >> /etc/crontab
echo "Do not forget to restart crond"
stop

step "SQL: Create spooler_in database"
echo "You need the root password of mysql, hopefully ENTER will do!"
/usr/bin/mysql -u root -p < $SVNROOT/dispatcher_in/install/spooler_db_createdb_user.sql  
/usr/bin/mysql -u root -p spooler_in < $SVNROOT/dispatcher_in/install/spooler_db_schema.sql  
stop

step "GUI Fixing perms"
bash $SVNROOT/extras/fix_perms_gui.sh
bash $SVNROOT/extras/fix_perms_fs.sh
