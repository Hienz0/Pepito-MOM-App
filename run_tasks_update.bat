@echo off
:loop
php artisan tasks:update-status
timeout /t 60
goto loop
