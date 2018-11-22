#!/usr/bin/env bash
#set -x

FILE=/tmp/planilog.webhook.github
DIR=/home/raphael/planilog.dev
#DIR=/Users/raphael/projets/planilog

if [ ! -f ${FILE} ]; then
    exit 0
fi

if [ "$(cat ${FILE})" != "1" ]; then
    exit 0
fi


cd ${DIR}
git pull >> storage/logs/git.log 2>&1

echo 0 > ${FILE}


