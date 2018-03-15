#!/bin/bash
fileName="1"
while read p; do
  wget -O ./temp/pics/$fileName.jpeg $p
  fileName=$((fileName+1))
done <./temp/images.list

fileName=$((fileName-2))

rm ./temp/pics/1.jpeg;
rm ./temp/pics/2.jpeg;
rm ./temp/pics/$fileName.jpeg;