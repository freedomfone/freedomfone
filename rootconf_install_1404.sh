#!/bin/bash
# Freedom Fone 2012 - rootconf Ubuntu 12.04 installer
#
# This installation script configures the following services
# 
# * WWW: Enables apache2 freedomfone site and disables the default
# * WWW: Configures php.ini to accept correct file sizes for uploads
# * WWW: Configures php.ini to set up the correct memory size
# * FF INIT: Creates init.d scripts for dispatcher, gsmopen and iwatch
# * AUDIOBOT: Configures iwatch.xml
# * CROND: Setups the cronjobs for freedomefone
# * GSMOPEN: Blacklists pl2303 driver for gsmopen
# * ALSA: setmixers in /bin 
# * ALSA: asound.conf in /etc
# * TTS: fixes ldconfig libraries for cepstral
# * SCRIPTS: Adds FS scripts and conf under /opt/freeswitch

echo "PRESS ANY KEY TO CONTINUE"
read
echo "******************************************************************"
echo "Packing rootconf"
echo "******************************************************************"
cd /opt/freedomfone/rootconf_1404; tar zcvf /opt/freedomfone/rootconf_1404.tar.gz . --exclude='.svn'
echo "PRESS ANY KEY TO CONTINUE"
read
echo "******************************************************************"
echo "Uncompressing rootconf"
echo "******************************************************************"
echo "PRESS ANY KEY TO CONTINUE"
read
cd /; tar zxvf /opt/freedomfone/rootconf_1404.tar.gz
echo "******************************************************************"
echo "Enabling Apache2 rewrite and enabling site"
echo "******************************************************************"
echo "PRESS ANY KEY TO CONTINUE"
read
a2enmod rewrite
a2dissite default
a2ensite freedomfone
echo "******************************************************************"
echo "Fixing init.d permissions"
echo "******************************************************************"
echo "PRESS ANY KEY TO CONTINUE"
read
chmod 0755 /etc/init.d/freeswitch
chmod 0755 /etc/init.d/dispatcher_in
chmod 0755 /etc/init.d/iwatch
chmod 0755 /etc/init.d/gsmopen
chmod 0755 /etc/init.d/gammu-smsd
chmod 0755 /etc/rc.local
echo "******************************************************************"
echo "Restarting services"
echo "******************************************************************"
echo "PRESS ANY KEY TO CONTINUE"
read
/etc/init.d/apache2 reload
/etc/init.d/cron restart
