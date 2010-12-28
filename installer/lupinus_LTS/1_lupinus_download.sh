#!/bin/bash
#####################################################################################
# Alberto Escudero Pascual for Freedom Fone <aep@it46.se>
# Ubuntu LTS 10.04
# Source code builder for trunk (2.0) and lts (1.6)
# TRUNK build
# cd /usr/local; svn co https://dev.freedomfone.org:/svn/freedomfone/trunk freedomfone 
#
#
# 1.6 LTS build
# cd /usr/local; svn co https://dev.freedomfone.org:/svn/freedomfone/branches/1.6 freedomfone 
# STEP 1 - Download all code 
#####################################################################################
# Check: 32 or 64 bits (default: 32) 
# Check: FS version  (default: git)


OS=32
#FS version if not using GIT
FREESWITCH=1.0.6
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


########################################
C=0
C=$(($C+1))

stop() {
echo "[$C] PRESS KEY TO CONTINUE"
C=$(($C+1))
read
}
########################################

step() {
echo "========================================================================="
echo "$1"
echo "========================================================================="

}

step "Building [ $SVNROOT ] [ $RELEASE ] [$TAG] [$OS]"
stop

step "DEVEL: Updating release software"
apt-get update
apt-get upgrade
stop


step "DEVEL: Downloading Development Environment (debug)"
apt-get install wireshark wget subversion openssh-server vim git-core
stop

#COMMENT: 10.04 LTS mailx is now bsd-mailx
step "DEVEL: Downloading Development Environment (build, LAMP, iwatch, lame, mailx"
apt-get install autoconf automake1.9 libtool build-essential libncurses5-dev \
apache2 php5 php5-snmp php5-curl php5-cli php5-mysql php5-xsl mysql-server libapache2-mod-php5 \
bsd-mailx iwatch lame 
stop

step "DEVEL: Downloading Development Environment (gsmopen support)"
apt-get install libgsmme-dev \
libnspr4-dev libasound2-dev libx11-dev libspandsp-dev 
stop

step "DEVEL: Downloading Development Environment (localization support)"
apt-get install gettext 
stop

step "DEVEL: Downloading Development Environment (flash support)"
#COMMENT: Adobe Flash support is needed if you use a Desktop version
#COMMENT: libflashsupport
#COMMENT: http://www.ubuntugeek.com/fix-for-firefox-crashes-on-flash-contents-when-using-libflashsupport-in-hardy.html
#COMMENT: http://www.ubuntugeek.com/how-to-install-adobe-flash-player-10-in-ubuntu-804-hardy-heron.html
apt-get install flashplugin-installer
stop

step "DEVEL: Downloading Development Environment (ESL support for PHP swig)"
apt-get install libxml2-dev libpcre3-dev libcurl4-openssl-dev libgmp3-dev libaspell-dev python-dev php5-dev libdb-dev
stop

step "DEVEL SOURCE: Downloading all the code (FS, Cesptral, Cake)"
#Building 1.06
#cd $DOWNLOAD; wget http://files.freeswitch.org/freeswitch-$FREESWITCH.tar.gz 
#Building from SVN 
#cd $SVNROOT; svn co http://svn.freeswitch.org:/svn/freeswitch/trunk freeswitch.trunk 
#Building from GIT (default) 
cd $DOWNLOAD; git clone git://git.freeswitch.org/freeswitch.git 
cd $DOWNLOAD; wget $CEPSTRALPACK
#It forces us to go trough the donation page! Please Donate!
cd $DOWNLOAD; wget "http://cakeforge.org/frs/download.php/734/cake_1.2.5.tar.gz/donation=complete" -O cake_1.2.5.tar.gz
cd $DOWNLOAD; tar zxvf $CEPSTRALSRC.tar.gz
cd $DOWNLOAD; tar zxvf cake_1.2.5.tar.gz
#Unpack Freeswitch if you fetch the tar ball
#cd $DOWNLOAD; tar zxvf freeswitch-$FREESWITCH.tar.gz
stop

echo "DOWNLOAD COMPLETED!"
