FFROOT=/usr/local/src/3.0
#FFROOT=/usr/local/freedomfone
echo "Disabling iwatch syslog and alerts"
sed s/on\\\"/off\\\"/g $FFROOT/audio_bot/iwatch/iwatch.xml
