#!/bin/bash

if [ -z "$1" ]; then 
              echo $0: Meta Info Audio Sweeper.   
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

DEBUG="no"
WEBUSER=www-data
MP3INFO=/usr/bin/mp3info
SOX=/usr/bin/sox

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
$MP3INFO -d $FILEROOT.mp3 

#Fixing permissions
/bin/chown $WEBUSER:$WEBUSER $FILEROOT.mp3
exit

fi

if [ "$EXTENSION" == "wav" ]; then 
FILEROOT=`echo $FILENAME_FULL|sed 's/\.wav$//g'`

#File conversion
$SOX $FILEROOT.wav $FILEROOT.WAV
if [ ! -f $FILEROOT.WAV ];
then
    echo "Coverted file could not be found!"
    exit
fi
cp $FILEROOT.WAV $FILEROOT.wav
rm $FILEROOT.WAV 

#Fixing permissions
/bin/chown $WEBUSER:$WEBUSER $FILEROOT.wav
exit

fi

echo "ERROR! File with wrong extension given to filter"
