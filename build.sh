#!/bin/bash
#
# Builds css files by sassc and generates static html site.
#
# by Alexander Borsuk <me@alex.bio> from Minsk, Belarus.
#
# Useful debug options:
# -e aborts if any command has failed.
# -u aborts on using unset variable.
# -x prints all executed commands.
# -o pipefail aborts if on any failed pipe operation.
set -euo pipefail

if [ $# -gt 0 ]; then
  OUT_DIR=$1
else
  OUT_DIR=docs
fi

# sassc input.
SASSC_INPUT_SCSS="scss/style.scss"
# sassc output
SASSC_OUTPUT_CSS="www/css/style.css"
# One of: nested, expanded, compact, compressed.
OUTPUT_CSS_FORMAT="nested"

# Use php from the path
PHP_BINARY="php"
SASSC_BINARY="bin/sassc"

# Build css.
"$SASSC_BINARY" --style "$OUTPUT_CSS_FORMAT" "$SASSC_INPUT_SCSS" "$SASSC_OUTPUT_CSS" && \
    echo "Successfully compiled $SASSC_OUTPUT_CSS"

# Build whole site.
"$PHP_BINARY" generate.php www "$OUT_DIR"
