#!/bin/bash
#####################################################################################
# Alberto Escudero Pascual for Freedom Fone <aep@it46.se>
# LUPINUS 1.6.X for Ubuntu LTS 10.04
# Source code builder
# STEP 1 - Download all code 
#####################################################################################
# Check: 32 or 64 bits (default: 64) 
# Check: FS version  (default: 1.0.6)






OS=32
FREESWITCH=1.0.6
RELEASE=lupinus
TAG=10.04-LTS


DOWNLOAD=/usr/local/src
SVNPREFIX=/usr/local/
SVNROOT=$SVNPREFIX/freedomfone

if [ "$OS" = "64" ]; then
CEPSTRALPACK="http://downloads.cepstral.com/cepstral/x86-64-linux/Cepstral_Allison_x86-64-linux_5.1.0.tar.gz"
CEPSTRALSRC="$DOWNLOAD/Cepstral_Allison_x86-64-linux_5.1.0"
else
CEPSTRALPACK="http://downloads.cepstral.com/cepstral/i386-linux/Cepstral_Allison_i386-linux_5.1.0.tar.gz"
CEPSTRALSRC="$DOWNLOAD/Cepstral_Allison_i386-linux_5.1.0"
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
#install subversion and get freedomfone under /usr/local/freedomfone
#cd $SVNROOT; svn co https://dev.freedomfone.org:/svn/freedomfone/trunk freedomfone 
#cd $SVNROOT; svn co https://dev.freedomfone.org:/svn/freedomfone/branches/1.6 freedomfone 
stop

step "DEVEL: Updating release software"
#/etc/apt/source.lists for Lucid 10.04
#deb http://archive.ubuntu.com/ubuntu lucid main restricted universe multiverse
#deb http://archive.ubuntu.com/ubuntu lucid-updates main restricted universe multiverse
#deb http://archive.ubuntu.com/ubuntu lucid-security main restricted universe multiverse

apt-get update
apt-get upgrade
stop


#10.04 LTS mailx is now bsd-mailx
step "DEVEL: Downloading Development Environment"
apt-get install autoconf automake1.9 libtool build-essential libncurses5-dev \
wget vim subversion openssh-server vim wireshark \
apache2 php5 php5-snmp php5-curl php5-cli php5-mysql php5-xsl mysql-server libapache2-mod-php5 \
bsd-mailx iwatch lame libgsmme-dev \
libnspr4-dev gettext libasound2-dev libx11-dev libspandsp-dev
stop


step "DEVEL: Downloading Development Environment (II)"
#FIXME!
#http://www.ubuntugeek.com/fix-for-firefox-crashes-on-flash-contents-when-using-libflashsupport-in-hardy.html
#http://www.ubuntugeek.com/how-to-install-adobe-flash-player-10-in-ubuntu-804-hardy-heron.html
#
#apt-get install libflashsupport
#for skypiax in 1.0.6 makefile
apt-get install git-core 
stop

step "DEVEL: Requirements for ESL.so"
apt-get install libxml2-dev libpcre3-dev libcurl4-openssl-dev libgmp3-dev libaspell-dev python-dev php5-dev libdb-dev
stop

step "DEVEL: Downloading all the code (FS, Cesptral, Cake, Freedom Fone SVN"
#Building release instead of trunk
cd $DOWNLOAD; wget http://files.freeswitch.org/freeswitch-$FREESWITCH.tar.gz 
##cd $SVNROOT; svn co http://svn.freeswitch.org:/svn/freeswitch/trunk freeswitch.trunk 
##cd $DOWNLOAD; wget http://downloads.cepstral.com/cepstral/i386-linux/$CEPSTRALPACK32.tar.gz
cd $DOWNLOAD; wget $CEPSTRALPACK
#It forces us to go trough the donation page! Please Donate!
cd $DOWNLOAD; wget "http://cakeforge.org/frs/download.php/734/cake_1.2.5.tar.gz/donation=complete" -O cake_1.2.5.tar.gz
cd $DOWNLOAD; tar zxvf $CEPSTRALSRC.tar.gz
cd $DOWNLOAD; tar zxvf cake_1.2.5.tar.gz
cd $DOWNLOAD; tar zxvf freeswitch-$FREESWITCH.tar.gz
stop

echo "Download completed! Fix freeswitch download link if needed!!"
