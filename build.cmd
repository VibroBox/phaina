@ECHO OFF
REM Builds css files by sassc and generates static html site.
REM
REM Created by Alexander Borsuk <me@alex.bio> from Minsk, Belarus.

SETLOCAL

REM Optional output directory can be passed as a first parameter.
IF [%1] EQU [] (
  SET out_dir=docs
)ELSE (
  SET out_dir=%1
)

REM Use PHP from the PATH.
SET php=php.exe
SET generate_command=%php% generate.php www %out_dir%
for %%f in (bin\sassc*%PROCESSOR_ARCHITECTURE%.exe) do SET sassc=%%f

SET sassc_input=scss/style.scss
SET sassc_output=www/css/style.css
REM One of: nested, expanded, compact, compressed
SET sassc_style=nested

%sassc% --style %sassc_style% %sassc_input% %sassc_output% || ECHO ERROR while launching %sassc%. && EXIT /B 1
%generate_command% || ECHO ERROR while launching `%generate_command%`. Do you have php.exe in your PATH? && EXIT /B 1
