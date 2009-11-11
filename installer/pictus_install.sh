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


step "Checking if an old installation exists!"
if [ -d /usr/src/pictus ];
then
echo "And old installation exists, check /usr/src/pictus!"
exit;
fi


if [ -d /usr/src/freeswitch.trunk ];
then
echo "And old installation exists, check /usr/src/freeswitch.trunk!"
exit;
fi

if [ -d /usr/local/freeswitch ];
then
echo "And old installation exists, check /usr/local/freeswitch!"
exit;
fi


step "Building $SVNROOT/$RELEASE"
stop

step "DEVEL: Updating release software"
apt-get update
apt-get upgrade
stop

step "DEVEL: Downloading Development Environment"
apt-get install autoconf libtool build-essential libncurses5-dev \
subversion openssh-server vim wireshark \
apache2 php5 php5-curl php5-cli php5-mysql php5-xsl mysql-server libapache2-mod-php5 \
iwatch lame libgsmme-dev \
libasound2-dev libx11-dev
#We remove lame as breaks FS in this release
stop

step "DEVEL: Downloading all the code (FS, Cesptral, Cake, Freedom Fone SVN"
cd $SVNROOT; svn co http://svn.freeswitch.org:/svn/freeswitch/trunk freeswitch.trunk 
cd $SVNROOT; svn co https://dev.freedomfone.org:/svn/freedomfone/trunk $RELEASE 
cd $SVNROOT; wget http://downloads.cepstral.com/cepstral/i386-linux/$CEPSTRALPACK.tar.gz
cd $SVNROOT; tar zxvf $CEPSTRALPACK.tar.gz
#It forces us to go trough the donation page! Please Donate!
cd $SVNROOT;  wget "http://cakeforge.org/frs/download.php/734/cake_1.2.5.tar.gz/donation=complete" -O cake_1.2.5.tar.gz
cd $SVNROOT; tar zxvf cake_1.2.5.tar.gz
stop

step "FS: First Freeswitch compilation (this can take 1h)"
cd $SVNROOT/freeswitch.trunk; sh bootstrap.sh 
cd $SVNROOT/freeswitch.trunk; ./configure
cd $SVNROOT/freeswitch.trunk; make			
#cd $SVNROOT/freeswitch.trunk; make cd-sounds-install
#cd $SVNROOT/freeswitch.trunk; make cd-moh-install
stop

step "CEPSTRAL: Installing Cepstral SDK"
cd $SVNROOT/$CEPSTRALPACK; ./install.sh
stop


step "CEPSTRAL: Adding libraries to system"
echo "/opt/swift/lib" > /etc/ld.so.conf.d/cepstral.conf
ldconfig
stop

step "CEPSTRAL: Register Cepstral"
#Keep this commented if you do not have license. You should!
#swift --reg-voice 
stop

step "GSMOPEN: Adding endpoint to Freeswitch trunk code"
ln -s $SVNROOT/$RELEASE/freeswitch/src/mod/endpoints/mod_gsmopen $FS_SRC/src/mod/endpoints/mod_gsmopen  
#FIXME! GSMOPEN HACK
ln -s /usr/src/freeswitch.trunk /usr/src/freeswitch-1.0.4


stop

step "FS: Enabling extra FS modules"
cp $SVNROOT/$RELEASE/freeswitch/modules.conf $FS_SRC/modules.conf
stop

step "FS: Compiling new components"
cd $FS_SRC; make; make install
stop

step "FS: Adding autoload_config files... enabling modules, adding confs"
#FIXME! Function to move from SVN to code!
cp $SVNROOT/$RELEASE/freeswitch/conf/autoload_configs/modules.conf.xml $FS_INSTALL/conf/autoload_configs/
cp $SVNROOT/$RELEASE/freeswitch/conf/autoload_configs/xml_curl.conf.xml $FS_INSTALL/conf/autoload_configs/
#FIXME! Installing config files from gsmopen
cp $SVNROOT/$RELEASE/freeswitch/conf/autoload_configs/gsmopen.conf.xml $FS_INSTALL/conf/autoload_configs/
cp $SVNROOT/$RELEASE/freeswitch/etc/asound.conf /etc
cp $SVNROOT/$RELEASE/extras/setmixers $FS_INSTALL/bin/
stop

##step "GUI: Creating Freedomfone web folder"
##mkdir -p /var/www/freedomfone/app/webroot
##ln -s $SVNROOT/$RELEASE/gui/app /var/www/freedomfone/app
##stop

step "GUI: Configuring apache2 and enabling site (rewrite, override all)"
cp $SVNROOT/$RELEASE/gui/apache2/freedomfone /etc/apache2/sites-available/
a2enmod rewrite
a2dissite default
a2ensite freedomfone
/etc/init.d/apache2 reload
stop

##step "XMLCURL: Linking XML Curl inside of apache2 folder"
##FIXME! Done in GUI script
##ln -s $SVNROOT/$RELEASE/xml_curl/ /var/www/freedomfone/app/webroot/xml_curl 
##chown -Rf www-data.www-data /var/www/freedomfone/
##stop

step "FS APP: Adding Freedom Fone applications to FS"
ln -s $SVNROOT/$RELEASE/freeswitch/scripts/freedomfone/ $FS_INSTALL/scripts/freedomfone
stop

step "FS APP: Fixing Macros"
cp $SVNROOT/$RELEASE/freeswitch/conf/lang/en/en.xml $FS_INSTALL/conf/lang/en/en.xml
cp -a $SVNROOT/$RELEASE/freeswitch/conf/lang/en/freedomfone $FS_INSTALL/conf/lang/en/
stop

step "FS APP MISC: Fixing Lame397"
cp $SVNROOT/$RELEASE/extras/lame397 $FS_INSTALL/bin/
stop
