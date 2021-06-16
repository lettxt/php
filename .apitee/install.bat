@echo off
:: silent install php on windows console
:: https://www.ibm.com/support/knowledgecenter/SSZUMP_7.2.1/install_grid_sym/install_silent.html
echo I will install NODE, NPM on Windows system, if is existing i will stop this script

WHERE node
IF %ERRORLEVEL% EQU 0 (
    echo NODE JS is installed, the installation is stopped!
    exit
)

NET SESSION >nul 2>&1
IF %ERRORLEVEL% NEQ 0 (
	echo This setup needs admin permissions. Please run this file as admin.
	pause
	exit
)

setlocal

set PHP_VERSION=v12.16.3
set PHP_FILENAME=node-%PHP_VERSION%-x64.msi
set PHP_URL=https://php.org/dist/%PHP_VERSION%/%PHP_FILENAME%
::set PHP_DOWNLOAD_LOCATION=.\
set PHP_LOG=node-log.txt
set INSTALLDIR=C:\php\

@echo on

msiexec.exe /i %PHP_FILENAME% INSTALLDIR=%INSTALLDIR% /qn /L*v %PHP_LOG%

echo program: %PHP_FILENAME% is installed!

endlocal
dir
