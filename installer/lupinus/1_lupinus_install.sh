#!/bin/bash
# LUPINUS Freedom Fone quick installer. Yes, it is a hack!
# Alberto Escudero aep@it46.se

SVNROOT=/usr/local/freedomfone
RELEASE=freedomfone
CEPSTRALPACK=Cepstral_Allison-8kHz_i386-linux_5.1.0
FS_SRC=/usr/local/src/freeswitch-1.0.5
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


step "CEPSTRAL: Installing Cepstral SDK"
cd $SVNROOT/$CEPSTRALPACK; ./install.sh
stop


step "CEPSTRAL: Adding libraries to system"
echo "/usr/local/swift/lib" > /etc/ld.so.conf.d/cepstral.conf
ldconfig
stop

step "CEPSTRAL: Register Cepstral"
#Keep this commented if you do not have license. You should!
#swift --reg-voice 
stop


step "GSMOPEN: Adding endpoint to Freeswitch trunk code"
ln -s $SVNROOT/freeswitch/src/mod/endpoints/mod_gsmopen $FS_SRC/src/mod/endpoints/mod_gsmopen  
stop

step "FS: Enabling extra FS modules"
cp $SVNROOT/freeswitch/modules.conf $FS_SRC/modules.conf
stop

step "FS: First Freeswitch compilation (this can take 1h)"
cd $FS_SRC; sh bootstrap.sh 
cd $FS_SRC/freeswitch-1.0.5; ./configure
cd $FS_SRC/freeswitch-1.0.5; make			
stop

step "FS: Compiling new components"
cd $FS_SRC; make; make install
stop

step "FS: Adding autoload_config files... enabling modules, adding confs"
#FIXME! Function to move from SVN to code!
cp $SVNROOT/freeswitch/conf/autoload_configs/modules.conf.xml $FS_INSTALL/conf/autoload_configs/
cp $SVNROOT/freeswitch/conf/autoload_configs/xml_curl.conf.xml $FS_INSTALL/conf/autoload_configs/
#FIXME! Installing config files from gsmopen
cp $SVNROOT/freeswitch/conf/autoload_configs/gsmopen.conf.xml $FS_INSTALL/conf/autoload_configs/
cp $SVNROOT/freeswitch/etc/asound.conf /etc
cp $SVNROOT/extras/setmixers $FS_INSTALL/bin/
stop

step "GUI: Configuring apache2 and enabling site (rewrite, override all)"
cp $SVNROOT/gui/apache2/freedomfone /etc/apache2/sites-available/
a2enmod rewrite
a2dissite default
a2ensite freedomfone
/etc/init.d/apache2 reload
stop

step "FS APP: Adding Freedom Fone applications to FS"
ln -s $SVNROOT/freeswitch/scripts/freedomfone/ $FS_INSTALL/scripts/freedomfone
stop

step "FS APP: Fixing Macros"
cp $SVNROOT/freeswitch/conf/lang/en/en.xml $FS_INSTALL/conf/lang/en/en.xml
cp -a $SVNROOT/freeswitch/conf/lang/en/freedomfone $FS_INSTALL/conf/lang/en/
stop

step "Fixing init.d scripts"
cp $SVNROOT/init.d/freeswitch /etc/init.d/
cp $SVNROOT/init.d/dispatcher_in /etc/init.d/
cp $SVNROOT/init.d/iwatch /etc/init.d/
cp $SVNROOT/init.d/etc/default/iwatch /etc/default
chmod 0755 /etc/init.d/freeswitch
chmod 0755 /etc/init.d/dispatcher_in
chmod 0755 /etc/init.d/iwatch
cd /etc/init.d; update-rc.d freeswitch defaults 90
cd /etc/init.d; update-rc.d dispatcher_in defaults 91
stop

step "FS APP: Adding user freeswitch"
useradd freeswith
adduser freeswitch dialout
adduser freeswitch audio 
stop

step "Fixing ESL CLI dynamic load"
cd $FS_SRC/libs/esl; make; make phpmod
cp $FS_SRC/libs/esl/php/ESL.so /usr/lib/php5/200*/ 
sed -i 's/enable_dl = Off/enable_dl = On/' /etc/php5/cli/php.ini
sed -i 's/enable_dl = Off/enable_dl = On/' /etc/php5/apache2/php.ini
stop
