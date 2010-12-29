#!/bin/bash
#####################################################################################
# Alberto Escudero Pascual for Freedom Fone <aep@it46.se>
# LUPINUS 1.6.X for Ubuntu LTS 10.04 FS git and 32 bits
# Source code builder
# STEP 2 - Compile and install Cepstral, Freeswitch, ESL SWIG 
#####################################################################################

OS=32
#FREESWITCH=-1.0.6
#Git build no version
FREESWITCH=
RELEASE=lupinus
TAG=10.04-LTS


DOWNLOAD=/usr/local/src
SVNPREFIX=/usr/local/
SVNROOT=$SVNPREFIX/freedomfone

if [ "$OS" = "64" ]; then
#CEPSTRALPACK="http://downloads.cepstral.com/cepstral/x86-64-linux/Cepstral_Allison_x86-64-linux_5.1.0.tar.gz"
#CEPSTRALSRC="$DOWNLOAD/Cepstral_Allison_x86-64-linux_5.1.0"
CEPSTRALPACK="http://downloads.cepstral.com/cepstral/x86-64-linux/Cepstral_Allison-8kHz_x86-64-linux_5.1.0.tar.gz"
CEPSTRALSRC="$DOWNLOAD/Cepstral_Allison-8kHz_x86-64-linux_5.1.0"
else
#CEPSTRALPACK="http://downloads.cepstral.com/cepstral/i386-linux/Cepstral_Allison_i386-linux_5.1.0.tar.gz"
#CEPSTRALSRC="$DOWNLOAD/Cepstral_Allison_i386-linux_5.1.0"
CEPSTRALPACK="http://downloads.cepstral.com/cepstral/i386-linux/Cepstral_Allison-8kHz_i386-linux_5.1.0.tar.gz"
CEPSTRALSRC="$DOWNLOAD/Cepstral_Allison-8kHz_i386-linux_5.1.0"
fi

TIMESTAMP=`date +%s`
#FS_SRC=/usr/local/src/freeswitch-$FREESWITCH
#Source path for git build
FS_SRC=/usr/local/src/freeswitch
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


step "CEPSTRAL: Installing Cepstral SDK - $CEPSTRALSRC"
cd $CEPSTRALSRC; ./install.sh
stop


step "CEPSTRAL: Adding libraries to system"
echo "/opt/swift/lib" > /etc/ld.so.conf.d/cepstral.conf
ldconfig
stop

step "CEPSTRAL: Register Cepstral"
#Keep this commented if you do not have license. You should!
/usr/local/bin/swift --reg-voice 
stop

###########################################################################
#step "GSMOPEN: Adding endpoint to Freeswitch trunk code"
#echo "From freeswitch 1.5 this step is not needed!"
#ln -s $SVNROOT/freeswitch/src/mod/endpoints/mod_gsmopen $FS_SRC/src/mod/endpoints/mod_gsmopen  
#stop
##########################################################################

step "GSMOPEN: Blacklisting pl2303"
#10.04 LTS change, we use .conf file for blacklisting
cat $SVNROOT/extras/blacklist.pl2303 >> /etc/modprobe.d/blacklist-freedomfone.conf
stop

step "FS: Enabling extra FS modules"
#FIXME! Copying 1.0.6 modules.conf to git build
#cp $SVNROOT/freeswitch/modules-$FREESWITCH.conf $FS_SRC/modules.conf
cp $SVNROOT/freeswitch/modules-1.0.6.conf $FS_SRC/modules.conf
stop

step "FS: First Freeswitch compilation (this can take 1h)"
cd $FS_SRC; sh bootstrap.sh 
cd $FS_SRC; ./configure
cd $FS_SRC; make			
stop

step "FS: Compiling new components"
cd $FS_SRC; make; make install
stop


###Skype channel in openvz container devices!
###http://www.myatus.co.uk/2009/08/24/x-server-with-sound-inside-an-openvz-proxmox-container/#more-87

step "FS: Adding autoload_config files... enabling modules, adding confs"
#FIXME! Function to move from SVN to code!
cp $SVNROOT/freeswitch/conf/autoload_configs/modules.conf.xml $FS_INSTALL/conf/autoload_configs/
cp $SVNROOT/freeswitch/conf/autoload_configs/xml_curl.conf.xml $FS_INSTALL/conf/autoload_configs/
cp $SVNROOT/freeswitch/conf/sip-profiles/officeroute.xml $FS_INSTALL/conf/sip_profiles/
#FIXME! Installing config files from gsmopen
cp $SVNROOT/freeswitch/conf/autoload_configs/gsmopen.conf.xml $FS_INSTALL/conf/autoload_configs/
cp $SVNROOT/freeswitch/etc/asound.conf /etc
cp $SVNROOT/extras/setmixers $FS_INSTALL/bin/
stop

step "GUI: Configuring apache2 and enabling site (rewrite, override all)"
cp $SVNROOT/gui/apache2/freedomfone /etc/apache2/sites-available/
mv /var/www/index.html /var/www/index_bak.html
cp $SVNROOT/gui/apache2/index.html /var/www/
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
cp $SVNROOT/init.d/gsmopen /etc/init.d/
cp $SVNROOT/init.d/iwatch /etc/init.d/
cp $SVNROOT/init.d/etc/default/iwatch /etc/default
cp $SVNROOT/init.d/rc.local /etc/rc.local
chmod 0755 /etc/init.d/freeswitch
chmod 0755 /etc/init.d/dispatcher_in
chmod 0755 /etc/init.d/iwatch
chmod 0755 /etc/init.d/gsmopen

cd /etc/init.d; update-rc.d freeswitch stop 95 0 1 6 . 
cd /etc/init.d; update-rc.d dispatcher_in stop 95 0 1 6 .
cd /etc/init.d; update-rc.d gsmopen stop 95 0 1 6 . 

#cp $SVNROOT/skype/init.d/skypopen /etc/init.d/
#chmod 0755 /etc/init.d/skypopen
#cd /etc/init.d; update-rc.d skypopen defaults 89 
stop

step "FS APP: Adding user freeswitch"
useradd freeswitch -s /bin/false
adduser freeswitch dialout
adduser freeswitch audio 
stop

step "Fixing ESL CLI dynamic load"
#FIXME! LTS 10.04
#Disable -Wall in Makefile libs/esl
#http://jira.freeswitch.org/browse/ESL-31;jsessionid=4781C2CD1D4B3F30A0C026A615C12AEE
#CXXFLAGS=$(BASE_FLAGS) -Wall -Werror -Wno-unused-variable
#cp $SVNROOT/installer/lupinus_LTS/extras/libs/esl/Makefile $FS_SRC/libs/esl/Makefile 
echo "FIXME! FIXME! Remove the -Werror in libs/esl/Makefile"
stop
cd $FS_SRC/libs/esl; make; make phpmod; make phpmod-install 
#cp $FS_SRC/libs/esl/php/ESL.so /usr/lib/php5/200*/ 
#FIXME! LTS 10.04 Finetune memory for PHP.INI
sed -i 's/enable_dl = Off/enable_dl = On/' /etc/php5/cli/php.ini
sed -i 's/enable_dl = Off/enable_dl = On/' /etc/php5/apache2/php.ini
sed -i 's/memory_limit = 16M/memory_limit = 64M/' /etc/php5/apache2/php.ini
sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 5M/' /etc/php5/apache2/php.ini
grep upload_max_filesize /etc/php5/apache2/php.ini
grep memory_limit  /etc/php5/apache2/php.ini
stop
