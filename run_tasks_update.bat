@echo off

:waitFor7AM
:: Display the current date and next execution time at the start
echo Waiting for 7:00:00 AM...

:: Get current date
for /f "tokens=1-3 delims=/ " %%D in ("%date%") do (
    set currentDay=%%D
    set currentMonth=%%E
    set currentYear=%%F
)

:: Get current time
for /f "tokens=1-3 delims=:., " %%A in ("%time%") do (
    set currentHour=%%A
    set currentMinute=%%B
    set currentSecond=%%C
)

:: Determine the next execution date and time
if "%currentHour%" GEQ "07" (
    :: If it's past 7:00 AM today, the next execution will be tomorrow at 7:00:00 AM
    set /a nextDay=%currentDay% + 1
    echo Next task execution will be tomorrow at 07:00:00 AM.
) else (
    :: If it's before 7:00 AM, the next execution is today at 7:00:00 AM
    echo Next task execution will be today at 07:00:00 AM.
)

:checkTime
:: Get the current time in hours, minutes, and seconds
for /f "tokens=1-3 delims=:., " %%A in ("%time%") do (
    set hour=%%A
    set minute=%%B
    set second=%%C
)

:: Check if it's exactly 07:00:00
if "%hour%"=="07" if "%minute%"=="00" if "%second%"=="00" goto runTask

:: Wait for 1 second before checking the time again
timeout /t 1 /nobreak >nul
goto checkTime

:runTask
echo Running tasks:update-status at exactly 7:00:00 AM...
php artisan tasks:update-status

:: Get the current date and time after the task is done
for /f "tokens=1-3 delims=/ " %%D in ("%date%") do (
    set day=%%D
    set month=%%E
    set year=%%F
)

:: Calculate the time until the next 7:00:00 AM tomorrow
set /a secondsUntil7AM=(24-%hour%)*3600-(%minute%*60)-%second%

:: Calculate tomorrow's date for the next execution
set /a nextDay=%day% + 1

:: Display the next execution time
echo Task completed. The next execution will be at 07:00:00 AM Tomorrow.

:: Wait for the next 7:00:00 AM
timeout /t %secondsUntil7AM% /nobreak >nul
goto waitFor7AM
