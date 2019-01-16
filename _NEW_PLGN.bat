@echo off
@echo Arguments that contain spaces spaces must me enclosed in "".

:promptowner
set /p Ow= Enter owner name (e.g. NPEU): 

if [%Ow%]==[] goto checkowner

:promptname
set /p Nm= Enter new plugin name (e.g. Alerts): 

if [%Nm%]==[] goto checkname

:promptgroup
set /p Gp= Enter new plugin group (e.g. User): 

if [%Gp%]==[] goto checkgroup

:promptdesc
set /p Ds= Enter new component description (e.g. "User alerts plugin"):

if [%Ds%]==[] goto checkdesc

php -f _build-new-plugin/index.php owner=%Ow% name=%Nm% group=%Gp% description=%Ds%

pause
goto :eof


:checkowner
@echo You must enter an owner name
pause
goto :promptowner

:checkname
@echo You must enter a name
pause
goto :promptname

:checkgroup
@echo You must enter a group
pause
goto :promptgroup

:checkdesc
@echo You must enter a description
pause
goto :promptdesc

