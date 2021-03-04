@echo off

rem ---------------------------------------------------------------
rem  Yii migrator script for Windows.
rem  This is the bootstrap script for running migrator on Windows.
rem ---------------------------------------------------------------

@setlocal

set BIN_PATH=%~dp0

if "%PHP_COMMAND%" == "" set PHP_COMMAND=php.exe

%PHP_COMMAND% "%BIN_PATH%migrator.php" %*

@endlocal