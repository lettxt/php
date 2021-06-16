@ECHO OFF
echo I will start PHP server ...
WHERE php
IF %ERRORLEVEL% NEQ 0 (
    echo PHP is not installed on this system!
    echo try to install PHP over command:
    echo .apitee\\install.bat
) else (
    php -S 0.0.0.0:8080 -t php
)
::nohup php -S 0.0.0.0:8080 -t src
