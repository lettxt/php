@ECHO OFF
echo I will install PHP packages on this project over composer ...
WHERE php
IF %ERRORLEVEL% NEQ 0 (
    echo PHP is not installed on this system!
    echo try to install PHP over command:
    echo .apitee\\install.bat
) else (
    php composer.phar install
)