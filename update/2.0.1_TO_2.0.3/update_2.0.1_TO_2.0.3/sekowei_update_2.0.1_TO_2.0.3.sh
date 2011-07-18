#!/bin/bash
#Scipt to update Freedom Fone from 2.0.1 to 2.0.3

SVNROOT=/usr/local/freedomfone
DIR=./gui/app/


cp $DIR/config/*       $SVNROOT/gui/app/config/
cp $DIR/models/*       $SVNROOT/gui/app/models/
cp ./office_route/*    $SVNROOT/office_route/