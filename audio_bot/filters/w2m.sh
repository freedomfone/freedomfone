#!/bin/bash

# A bidirectional MP3-WAV file converter using lame
# Freedom Fone 2010

DEBUG=no
LAME=/usr/bin/lame
#LAME=/usr/local/freeswitch/bin/lame397

if [ -z "$1" ]; then 
              echo $0: WAV/MP3-MP3/WAV Audio Converter.   
              exit
fi

#Full filename with path
	FILENAME_FULL=$1
#Full filename
	FILENAME=$(basename $1)
#File extension
	EXTENSION=${FILENAME##*.}
#File without extension
	FILE=${FILENAME%.*}

WEBUSER=www-data

#Debug

if [ "$DEBUG" == "yes" ]; then
echo "Full name     :" $FILENAME_FULL
echo "File name     :" $FILENAME
echo "File extension:" $EXTENSION
echo "File root     :" $FILE
exit 
fi

if [ "$EXTENSION" == "mp3" ]; then 
FILEROOT=`echo $FILENAME_FULL|sed 's/\.mp3$//g'`

#File conversion
$LAME --decode $FILEROOT.mp3 $FILEROOT.wav -S

#Fixing permissions
/bin/chown $WEBUSER:$WEBUSER $FILEROOT.wav
/bin/chown $WEBUSER:$WEBUSER $FILEROOT.mp3
exit

fi

if [ "$EXTENSION" == "wav" ]; then 
FILEROOT=`echo $FILENAME_FULL|sed 's/\.wav$//g'`

#File conversion
$LAME -V2 $FILEROOT.wav $FILEROOT.mp3 -S

#Fixing permissions
/bin/chown $WEBUSER:$WEBUSER $FILEROOT.wav
/bin/chown $WEBUSER:$WEBUSER $FILEROOT.mp3
exit

fi

echo "ERROR! File with wrong extension given to filter"
