BASEDIR=/usr/local/freedomfone
APPLICATION_DIR=/freeswitch/scripts/freedomfone/leave_message/100/messages
AUDIO_CONVERTER_COMMAND=$BASEDIR/audio_bot/leave_message/main_command.sh

/usr/bin/iwatch -e close_write -t "^(.*)\.meta$" -c "$AUDIO_CONVERTER_COMMAND %f" $BASEDIR$APPLICATION_DIR

