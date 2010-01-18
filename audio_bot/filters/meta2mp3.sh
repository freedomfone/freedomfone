#!/bin/bash

#We receive the .meta file with path and we convert the wav to mp3
#We fix permissions for the files to be available via the GUI

if [ -z "$1" ]; then 
              echo $0: Converts a META-WAV to MP3 
              echo usage: $0 \<meta file\>  
              echo e.g.:  $0 /usr/local/freedomfone/freeswitch/scripts/freedomfone/leave_message/100/messages/036e08a2-0431-11df-9c1b-bd0d99517a5e.meta
              exit
          fi

#LAME=/usr/local/freeswitch/bin/lame397
LAME=/usr/bin/lame
FILENAME=`echo $1|sed 's/\.meta$//g'`
WEBUSER=www-data

#Converting file to mp3
$LAME -V2 $FILENAME.wav $FILENAME.mp3 -S

/bin/chown $WEBUSER:$WEBUSER $FILENAME.meta
/bin/chown $WEBUSER:$WEBUSER $FILENAME.wav
/bin/chown $WEBUSER:$WEBUSER $FILENAME.mp3
	
