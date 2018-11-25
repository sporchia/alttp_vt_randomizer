#!/bin/sh

if [ ! -f "alttp.sfc" ]; then
    echo "alttp.sfc not found"
    exit 1
fi

echo 03a63945398191337e896e5771f77173  alttp.sfc | md5sum -c >/dev/null 2>&1

if [ $? != 0 ]; then
    echo "checksum error"
    exit 2
fi

rm -f base.sfc
cp alttp.sfc base.sfc

cd vendor/z3/randomizer

# xkas does not properly build or run on Linux, so you'll need 'xkas' either
# aliased or else as a script in $PATH pointing to wine /path/to/xkas.exe "$@"
# NB: wine32 is required, xkas won't run on wine64
xkas LTTP_RND_GeneralBugfixes.asm ../../../base.sfc

if [ $? != 0 ]; then
    echo "assembly error"
    exit 2
fi

cd ../../..

php artisan alttp:updatebase alttp.sfc base.sfc
sed -i "s/\(const\s*BUILD\s*=\s*'\)\(.*\)\('\s*;\)/\1$(date +%Y-%m-%d)\3/g" app/Rom.php
sed -i "s/\(const\s*HASH\s*=\s*'\)\(.*\)\('\s*;\)/\1$(md5sum base.sfc | awk '{print $1}')\3/g" app/Rom.php

npm run production
