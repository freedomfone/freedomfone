#!/bin/bash


case $1 in
  pids)

PID_APACHE="/var/run/apache2/apache2.pid"
PID_MYSQL="/var/run/mysqld/mysqld.pid"
PID_IWATCH="/var/run/iwatch.pid"
PID_DISPATCHER="/opt/freedomfone/gui/app/webroot/system/pid/dispatcher_in.pid"
PID_GAMMU="/opt/freedomfone/gammu-smsd/conf/*pid"
PID_FREESWITCH="/var/run/freeswitch/freeswitch.pid"

for i in $PID_APACHE $PID_MYSQL $PID_IWATCH $PID_DISPATCHER $PID_GAMMU $PID_FREESWITCH; do
if [ -f "$i" ]; then
PID=`cat $i`
echo -e "\e[32m$PID\e[0m        $i" 
else
echo -e "\e[31mERROR\e[0m       $i"
fi
done
  ;;
  active)
S_APACHE=`pidof apache2`
S_MYSQL=`pidof mysqld`
S_IWATCH=`ps -ef |grep perl |grep iwatch | awk '{print $2}'`
S_DISPATCHER=`ps -ef |grep php |grep dispatcher | awk '{print $2}'`
S_GAMMU=`pidof gammu`
S_FREESWITCH=`pidof freeswitch`


if [ -z "$S_APACHE" ]
then
echo -e "\e[31mERROR\e[0m	Apache"
else
echo -e "\e[32mOK\e[0m	Apache $S_APACHE" 
fi

if [ -z "$S_MYSQL" ]
then
echo -e "\e[31mERROR\e[0m	Mysql"
else
echo -e "\e[32mOK\e[0m	Mysql $S_MYSQL" 
fi


if [ -z "$S_IWATCH" ]
then
echo -e "\e[31mERROR\e[0m	IWatch"
else
echo -e "\e[32mOK\e[0m	IWatch $S_IWATCH" 
fi


if [ -z "$S_DISPATCHER" ]
then
echo -e "\e[31mERROR\e[0m	Dispatcher"
else
echo -e "\e[32mOK\e[0m	Dispatcher $S_DISPATCHER" 
fi

if [ -z "$S_GAMMU" ]
then
echo -e "\e[31mERROR\e[0m       Gammu"
else
echo -e "\e[32mOK\e[0m  Gammu $S_GAMMU" 
fi

if [ -z "$S_FREESWITCH" ]
then
echo -e "\e[31mERROR\e[0m       Freeswitch"
else
echo -e "\e[32mOK\e[0m	Freeswitch $S_FREESWITCH" 
fi
  ;;
  *)
  echo "heartbeat.sh pids/active" 
  ;;
esac


