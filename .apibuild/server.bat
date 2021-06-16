@ECHO OFF
echo I will start PHP serverfor this project ...
WHERE node
IF %ERRORLEVEL% NEQ 0 (
    echo php is not installed on this system!
) else (
    ::node server.js
    forever start server.js
)
