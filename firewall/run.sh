#!/bin/bash
ROOT_PATH="/opt/freedomfone/firewall"
WHITELIST_FILE="$ROOT_PATH/whitelist.txt"
INTERNAL_NET="192.168.1.0/24"

config ()  {

PUBLIC_INTFACE="eth0"
read -e -i "$PUBLIC_INTFACE" -p "What is the public interface of your freedomfone installation? " input
PUBLIC_INTFACE="${input:-$PUBLIC_INTFACE}"

PUBLIC_NET=`/sbin/ip addr show $PUBLIC_INTFACE |grep "inet "  | awk '{print $2}'`

read -e -i "y" -p "Do you want $PUBLIC_NET to be able to place calls in your freedomfone installation (y/n)? " authcalls 
case "$authcalls" in 
  y|Y ) echo $PUBLIC_NET > $WHITELIST_FILE ;;
  n|N ) ALLOW_LOCALCALLS="no";;
  * ) echo "invalid";;
esac

read -e -i "y" -p "Do you want $INTERNAL_NET to able to place calls in your freedomfone installation (y/n)? " authintcalls
case "$authintcalls" in 
  y|Y ) echo $INTERNAL_NET >> $WHITELIST_FILE ;;
  n|N ) ALLOW_INTCALLS="no";;
  * ) echo "invalid";;
esac

while [ "$NEWNETCALLS" != "n" ]; do
	read -e -i "n" -p "Do you want to allow more networks to place calls in your freedomfone installation (y/n)? " NEWNETCALLS
	if [[ $NEWNETCALLS =~ ^(yes|y)$ ]]; then
	read -p "   Enter network in CIDR format e.g. 192.168.0.0/16: " ADDNET 
	echo $ADDNET >> $WHITELIST_FILE  
	fi
done

echo "The following networks will be whitelisted in the firewall"

cat $WHITELIST_FILE
}


start () {
for NET in `cat $WHITELIST_FILE`; do
/sbin/iptables -A INPUT -p udp -m udp --dport 5060 -s $NET -j ACCEPT 
/sbin/iptables -A INPUT -p udp -m udp --dport 5080 -s $NET -j ACCEPT 
/sbin/iptables -A INPUT -p udp -m udp --dport 5060 ! -s $NET  -j LOG --log-prefix "Freedom Fone SIP registration attempt " 
/sbin/iptables -A INPUT -p udp -m udp --dport 5080 ! -s $NET  -j LOG --log-prefix "Freedom Fone SIP registration attempt " 
done
/sbin/iptables -A INPUT -p udp -m udp --dport 5060  -j DROP
/sbin/iptables -A INPUT -p udp -m udp --dport 5080  -j DROP
}


stop () {
for NET in `cat $WHITELIST_FILE`; do
/sbin/iptables -D INPUT -p udp -m udp --dport 5060 -s $NET -j ACCEPT
/sbin/iptables -D INPUT -p udp -m udp --dport 5080 -s $NET -j ACCEPT
/sbin/iptables -D INPUT -p udp -m udp --dport 5060 ! -s $NET -j LOG --log-prefix "Freedom Fone SIP registration attempt " 
/sbin/iptables -D INPUT -p udp -m udp --dport 5080 ! -s $NET -j LOG --log-prefix "Freedom Fone SIP registration attempt " 
done
/sbin/iptables -D INPUT -p udp -m udp --dport 5060  -j DROP
/sbin/iptables -D INPUT -p udp -m udp --dport 5080  -j DROP
}

show () {
echo "Networks whitelisted" 
cat $WHITELIST_FILE
/sbin/iptables -L 
}

case "$1" in
	config)
	config
	;;
	start)
	start	
	;;
	stop)
	stop
	;;
	show)
	show
	;;
  	*)
        echo "Usage: $ROOT_PATH/run.sh {config|show|start|stop}"
        exit 1

esac

