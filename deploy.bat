@echo off

if "C:\xampp\htdocs\mage2-dev\" == "" goto destnotfound

REM copying to webroot folder
echo Copying to C:\xampp\htdocs\mage_1901_fixbug\
xcopy F:\simpleaffmage2\* C:\xampp\htdocs\mage2-dev\ /s /e /d /y /c /r

goto exitfile

:destnotfound

REM show error and guide to config
echo Set Destination Folder to Project's Arguments.
echo Example: C:\xampp\htdocs\mage2-dev\

:exitfile

