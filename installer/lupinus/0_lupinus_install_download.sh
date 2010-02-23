#!/bin/bash
# LUPINUS Freedom Fone quick installer. Yes, it is a hack!
# Alberto Escudero aep@it46.se

DOWNLOAD=/usr/local/src
SVNROOT=/usr/local/
CEPSTRALPACK=Cepstral_Allison-8kHz_i386-linux_5.1.0
TIMESTAMP=`date +%s` 
RELEASE=lupinus
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
if [ -d /usr/local/NOfreedomfone ];
then
echo "And old installation exists, check /usr/local/freedomfone!"
exit;
fi


if [ -d /usr/src/freeswitch-1.0.5 ];
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
apt-get install autoconf automake1.9 libtool build-essential libncurses5-dev \
vim subversion openssh-server vim wireshark \
apache2 php5 php5-curl php5-cli php5-mysql php5-xsl mysql-server libapache2-mod-php5 \
mailx iwatch lame libgsmme-dev \
libnspr4-dev gettext libasound2-dev libx11-dev libspandsp-dev
stop

step "DEVEL: Requirements for ESL.so"
apt-get install libxml2-dev libpcre3-dev libcurl4-openssl-dev libgmp3-dev libaspell-dev python-dev php5-dev libdb-dev
stop

step "DEVEL: Downloading all the code (FS, Cesptral, Cake, Freedom Fone SVN"
#cd $SVNROOT; svn co http://svn.freeswitch.org:/svn/freeswitch/trunk freeswitch.trunk 
#cd $DOWNLOAD; wget http://latest.freeswitch.org/freeswitch-1.0.5-latest.tar.gz
#cd $SVNROOT; svn co https://dev.freedomfone.org:/svn/freedomfone/trunk freedomfone 
#cd $DOWNLOAD; wget http://downloads.cepstral.com/cepstral/i386-linux/$CEPSTRALPACK.tar.gz
#It forces us to go trough the donation page! Please Donate!
#cd $DOWNLOAD; wget "http://cakeforge.org/frs/download.php/734/cake_1.2.5.tar.gz/donation=complete" -O cake_1.2.5.tar.gz
cd $DOWNLOAD; tar zxvf $CEPSTRALPACK.tar.gz
cd $DOWNLOAD; tar zxvf cake_1.2.5.tar.gz
cd $DOWNLOAD; tar zxvf freeswitch-1.0.5-latest.tar.gz
stop

echo "Download completed! Fix freeswitch download link if needed!!"
