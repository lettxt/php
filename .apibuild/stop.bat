@ECHO OFF
echo I will stop the php application ...
::tasklist /v | find "node.exe"
taskkill /F /IM node.exe
