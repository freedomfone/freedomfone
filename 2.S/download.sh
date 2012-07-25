#!/bin/bash
echo "Downloading package dependencies for Freedom Fone SDK"
j="";
for i in `cat .dependencies`; do
j="$j $i"
done

apt-get update
apt-get install $j
apt-get upgrade
