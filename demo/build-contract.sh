#!/usr/bin/env bash

set -e
set -o pipefail

srcDir=contract
abiDir=$srcDir/build2/

if [ ! -e abiDir ];then
  mkdir -p $abiDir
fi

for file in `ls $srcDir/*.sol`; do
  target=$(basename $file .sol)
  
  echo "Compiling Solidity file ${target}.sol"

  solcjs --bin --abi --optimize --overwrite \
          --allow-paths "$(pwd)" \
          $file -o $abiDir
  echo "Complete"    
done
