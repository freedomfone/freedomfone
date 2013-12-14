#!/bin/bash
REPO=http://archive.freedomfone.org/installer_1204
DOWNLOAD=/opt/freedomfone/packages/
CEPSTRAL=Cepstral_Allison-8kHz_i386-linux_5.1.0.tar.gz
BUILD="1.2~ffrc3-1_i386"

#cd $DOWNLOAD; wget $REPO/$CEPSTRAL
for i in `cat /opt/freedomfone/.deb_1204`; do
cd $DOWNLOAD; wget $REPO/$i\_$BUILD.deb
done
cd $DOWNLOAD; wget $REPO/install_fs_1204.sh
