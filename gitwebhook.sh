#!/usr/bin/env bash
if [ ! -f /tmp/planilog.webhook.github ]; then
    exit 0;
fi

cd /home/raphael/planilog.dev
git pull >> storage/logs/git.log 2>&1


rm -f /tmp/planilog.webhook.github
