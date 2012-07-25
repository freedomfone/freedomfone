#!/bin/bash

if [ -z "$1" ]; then 
              echo $0: Converts a MP3 to WAV 
              echo usage: $0 \<av file\>  
              exit
          fi

#LAME=/usr/local/freeswitch/bin/lame397
LAME=/usr/bin/lame
FILENAME=`echo $1|sed 's/\.mp3$//g'`
WEBUSER=www-data

#Converting file to wav 
$LAME --decode $FILENAME.mp3 $FILENAME.wav -S

/bin/chown $WEBUSER:$WEBUSER $FILENAME.wav
/bin/chown $WEBUSER:$WEBUSER $FILENAME.mp3
	
