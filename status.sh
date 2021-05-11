#!/bin/bash
status=$(ps -ef | grep "python /home/mqtt-python/main.py" | grep -v "grep" | awk "{print $2}")
publish=$(ps -ef | grep "python /home/mqtt-python/web.py" | grep -v "grep" | awk "{print $2}")


if [ -z "$status" ]
then
    echo "status: offine"

else
    echo "status: online"

fi

if [ -z "$publish" ]
then
    echo "publish: offine"

else
    echo "publish: online"

fi