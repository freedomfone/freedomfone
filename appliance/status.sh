#!/bin/sh -e
/sbin/ifconfig -a |grep Mask 
/opt/freeswitch/bin/fs_cli -x "sofia status"
/usr/bin/tail -10 /opt/freedomfone/log/dispatcher_in.log
###############################################################################
exit 0
