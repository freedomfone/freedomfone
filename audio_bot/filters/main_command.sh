#!/bin/bash

#We receive the .meta file with path and we convert the wav to mp3
#We fix permissions for the files to be available via the GUI

LAME=/usr/local/freeswitch/bin/lame397
FILENAME=`echo $1|sed 's/\.meta$//g'`
WEBUSER=www-data

$LAME -V2 $FILENAME.wav $FILENAME.mp3 -S
/bin/chown $WEBUSER:$WEBUSER $FILENAME.*
