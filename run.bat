::Github
Title Pocket
mode con:cols=75 lines=20

@echo off
goto Commit

:Commit
    start "chrome.exe" http://127.0.0.1:8000
    php artisan serve

pause
exit