#!/bin/bash


if [ -z "$1" ]; then 
              echo $0: WAV to MP3 interconverter 
              echo e.g.:  $0 /usr/local/freedomfone/freeswitch/scripts/freedomfone/leave_message/100/messages/036e08a2-0431-11df-9c1b-bd0d99517a5e.wav
              exit
          fi

LAME=/usr/local/freeswitch/bin/lame397
#LAME=/usr/bin/lame
FILENAME_FULL=$1
FILENAME=$(basename $1)
EXTENSION=${FILENAME##*.}
FILE=${FILENAME%.*}
WEBUSER=www-data


#echo $FILENAME_FULL
#echo $FILENAME
#echo $EXTENSION
#echo $FILE


if [ "$EXTENSION" == "mp3" ]; then 
FILEROOT=`echo $FILENAME_FULL|sed 's/\.mp3$//g'`
$LAME --decode $FILEROOT.mp3 $FILEROOT.wav -S

/bin/chown $WEBUSER:$WEBUSER $FILEROOT.wav
/bin/chown $WEBUSER:$WEBUSER $FILEROOT.mp3

exit
fi

if [ "$EXTENSION" == "wav" ]; then 
FILEROOT=`echo $FILENAME_FULL|sed 's/\.wav$//g'`
$LAME -V2 $FILEROOT.wav $FILEROOT.mp3 -S

/bin/chown $WEBUSER:$WEBUSER $FILEROOT.wav
/bin/chown $WEBUSER:$WEBUSER $FILEROOT.mp3


exit
fi

echo "This should not happen!"
