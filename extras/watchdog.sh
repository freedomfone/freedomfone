#!/bin/bash
while true; do
LOG=/usr/src/pictus/log/dispatcher_in_watchdog.log
PIDFS=`pidof freeswitch` 
if [ "$PIDFS" != "" ]; then
echo "Freeswitch is alive!"
else
echo "Freeswitch is dead!"
echo "FREESWITCH STOP, STOPPING WATCHER TOO" >> $LOG
exit
fi
PIDDIS=`ps -ef |grep dispatcher_in.php | grep -v grep | awk '{print $2}'`
if [ "$PIDDIS" != "" ]; then
echo "Dispatcher is alive!"
else
echo "Dispatcher is dead!"
echo "RESTARTING DISPACHER. WARNING!" >> $LOG
/usr/bin/php /usr/src/pictus/dispatcher_in/dispatcher_in.php --log=/root/dispatcher_in.log > $LOG 2>&1 &
fi
sleep 10
done
