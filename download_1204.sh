#!/bin/bash
echo "Downloading package dependencies for Freedom Fone SDK"
echo "WARNING!! This script downloads dependencies for Ubuntu 12.04 (precise) for Freeswitch 1.2.x"
echo "Press <ENTER> to continue"
read
j="";
for i in `cat .dependencies_1204`; do
j="$j $i"
done

apt-get update
apt-get install $j
apt-get upgrade
