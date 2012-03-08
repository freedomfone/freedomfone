#!/bin/bash
#
# Freedom Fone 2011
# Migrates translations between release using translate-toolkit 
#
#################################################################

FROM=manguensis
#TO=manguensis
TO=suyo
LANG="swa fre esp"
for i in $LANG; do
echo "Migrating $i"
pomigrate2 $FROM"/"$i"/LC_MESSAGES" $TO"/"$i"/LC_MESSAGES" "pot/"$TO
pocount $TO"/"$i"/LC_MESSAGES/default.po"
done
