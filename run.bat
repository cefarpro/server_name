@ECHO OFF
SET this_path=%~dp0
CALL php %this_path%server.php
set /p input=