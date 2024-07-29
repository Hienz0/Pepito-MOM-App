#!/bin/bash

while true
do
    php artisan tasks:update-status
    sleep 60
done
