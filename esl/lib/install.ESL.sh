test -d "/usr/lib/php5/20090626+lfs" || mkdir -p "/usr/lib/php5/20090626+lfs"
cp ESL.so "/usr/lib/php5/20090626+lfs"
test -d "/usr/share/php" || mkdir -p "/usr/share/php"
cp ESL.php "/usr/share/php"
test -d "/etc/php5/apache2/conf.d" || mkdir -p "/etc/php5/apache2/conf.d"
test -f "/etc/php5/apache2/conf.d/esl.ini" || echo 'extension=ESL.so' > "/etc/php5/apache2/conf.d/esl.ini"
echo "Checking that ESL.so ESL.php exits"
ls -l /usr/lib/php5/20090626+lfs/ESL.so
ls -l /usr/share/php5/ESL.so
echo "Checking that extension is loaded"
cat /etc/php5/apache2/conf.d/esl.ini

