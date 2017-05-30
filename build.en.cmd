@ECHO OFF
REM Builds css files by sassc and generates static html site for English version of site.

SETLOCAL

SET PHAINA_LANG=en
CALL .\build.cmd www.vibrobox.com
