#!/bin/bash

DIR=MailChimp

# DON'T EDIT UNDER THIS LINE

ARCHIVE=mailchimp-api-class.zip
LIBS=ext/php/libs
LOCATION=http://apidocs.mailchimp.com/api/downloads/$ARCHIVE

mkdir $DIR
cd $DIR

wget -q $LOCATION
unzip $ARCHIVE

rm -f $ARCHIVE

cd -

mkdir -p $LIBS
cp -Rf $DIR/MCAPI.class.php $LIBS

rm -rf `pwd`/$DIR
