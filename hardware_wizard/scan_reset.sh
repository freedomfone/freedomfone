echo ""> tmp/usb.list
echo ""> tmp/usb.huawei

for X in /sys/bus/usb/devices/*; do
    VENDOR=`cat "$X/idVendor" 2>/dev/null`
    PRODUCT=`cat "$X/idProduct" 2>/dev/null`
    echo "$X" "$VENDOR" "$PRODUCT" >> tmp/usb.list
done
    grep 12d1 tmp/usb.list | awk '{print $1}' > tmp/usb.huawei

for i in `cat tmp/usb.huawei`; do

echo "Let us reset "$i
echo 0 > $i/authorized
sleep 1
echo 1 > $i/authorized
done
