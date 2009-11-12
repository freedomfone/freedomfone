#!/bin/bash
while true; do
DATE=`/bin/date +%c`
LOGSTATUS=/usr/src/pictus/log/dispatcher/dispatcher_in_status.log
LOGERROR=/usr/src/pictus/log/dispatcher/dispatcher_in_error.log
LOGDEBUG=/usr/src/pictus/log/dispatcher/dispatcher_in_debug.log
PIDFS=`pidof freeswitch` 
if [ "$PIDFS" != "" ]; then
echo "[$DATE] --FS--"
echo "[$DATE] --FS--" >> $LOGSTATUS
else
echo "[$DATE] FS CRASH" 
echo "[$DATE] FS CRASH" >> $LOGERROR
exit
fi
PIDDIS=`ps -ef |grep dispatcher_in.php | grep -v grep | grep -v emacs | awk '{print $2}'`
if [ "$PIDDIS" != "" ]; then
echo "[$DATE] --DIS--"
echo "[$DATE] --DIS--" >> $LOGSTATUS
else
echo "[$DATE] DIS CRASH. RESTART" 
echo "[$DATE] DIS CRASH. RESTART" >> $LOGERROR
/usr/bin/php /usr/src/pictus/dispatcher_in/dispatcher_in.php --log=$LOGDEBUG > /dev/null 2>&1 &
fi
sleep 10
done
