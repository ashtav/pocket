::Github
Title Pocket
mode con:cols=75 lines=20

@echo off
goto Run

:Run
    php artisan db:seed --class=UserSeeder

pause
exit