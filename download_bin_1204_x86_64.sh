#!/bin/bash
REPO=http://archive.it46.se/freedomfone_x86_64/
DOWNLOAD=/opt/freedomfone/packages/
CEPSTRAL=Cepstral_Allison-8kHz_x86-64-linux_6.0.1.tar.gz
BUILD="1.2.11~FF64-1~precise+1_amd64"
MOBIGATER=freeswitch-mod-gsmopen_mobigater_1.2.11~FF64-2~precise+1_amd64.deb

cd $DOWNLOAD; wget $REPO/$CEPSTRAL
for i in `cat /opt/freedomfone/.deb_1204`; do
cd $DOWNLOAD; wget $REPO/$i\_$BUILD.deb
done
cd $DOWNLOAD; wget $REPO/$MOBIGATER
cd $DOWNLOAD; wget $REPO/install_fs_1204.sh
