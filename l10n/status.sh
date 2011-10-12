echo "Total words to translate per release"
find pot  -name "*pot" -type f -exec pocount {} \;
echo "Total words to translate per release after migration"
find .  -name "*po" -type f -exec pocount {} \;
