#!/bin/bash
fileName="1"
for f in ./temp/pics/*.jpeg
do
	convert $f -resize %222 $f;
	convert ./art/retrobg.png $f -gravity center -composite ./temp/pics/slide_$fileName.jpeg;
	fileName=$((fileName+1))
done
#create youtube thumbnail
convert ./temp/pics/slide_1.jpeg -gravity Center -crop 1280x720+0+0 +repage ./temp/pics/thumb_bg.jpeg;
convert ./temp/pics/thumb_bg.jpeg ./art/ytlogos.png -gravity center -composite ./temp/pics/ytThumbFinal.jpeg;