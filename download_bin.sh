#!/bin/bash
REPO=http://www.it46.se/freedomfone/manguensis/
DOWNLOAD=/opt/freedomfone/
CEPSTRAL=Cepstral_Allison-8kHz_i386-linux_5.1.0.tar.gz
BUILD=12
FREESWITCH=freeswitch_1.0.head-git.master.20110530.ffone-"$BUILD"_i386.deb
FREESWITCH_LANG=freeswitch-lang-en_1.0.head-git.master.20110530.ffone-"$BUILD"_i386.deb
FREESWITCH_SPIDERMONKEY=freeswitch-spidermonkey_1.0.head-git.master.20110530.ffone-"$BUILD"_i386.deb

for i in $CEPSTRAL $FREESWITCH $FREESWITCH_LANG $FREESWITCH_SPIDERMONKEY; do

cd $DOWNLOAD; wget $REPO/$i
done

