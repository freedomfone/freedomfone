j="";
for i in `cat dependencies`; do
j="$j $i"
done

apt-get update
apt-get install $j


echo "Other packages"
cd /usr/src; wget http://downloads.cepstral.com/cepstral/i386-linux/Cepstral_Allison-8kHz_i386-linux_5.1.0.tar.gz
cd /usr/src; wget --output-document=cakephp-1.3.12.tar.gz https://github.com/cakephp/cakephp/tarball/1.3.12
