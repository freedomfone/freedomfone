echo "transport_maps = hash:/etc/postfix/transport" >> /etc/postfix/main.cf
echo "ch1pmunk.nu smtp:[192.168.1.46]" > /etc/postfix/transport
postmap /etc/postfix/transport
/etc/init.d/postfix restart
