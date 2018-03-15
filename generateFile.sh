#!/bin/bash
######
#INSTALL
######
# sudo apt-get install build-essential
# sudo apt-get install php5-cli
# sudo apt-get install sox
# sudo apt-get install imagemagick
# sudo apt-get build-dep python3.2
# sudo apt-get install libreadline-dev libncurses5-dev libssl1.0.0 tk8.5-dev zlib1g-dev liblzma-dev
# sudo apt-get install python-pip
# sudo pip install beautifulsoup4
# sudo pip install gtts
# sudo apt-get install ffmpeg
# wget https://johnvansickle.com/ffmpeg/builds/ffmpeg-git-32bit-static.tar.xz
# tar -xvf ffmpeg-git-32bit-static.tar.xz
# sudo cp ./ffmpeg-git-20170101-32bit-static/ffmpeg /usr/bin/
# sudo cp ./ffmpeg-git-20170101-32bit-static/ffmpeg-10bit /usr/bin/
# sudo cp ./ffmpeg-git-20170101-32bit-static/ffprobe /usr/bin/
# sudo cp ./ffmpeg-git-20170101-32bit-static/ffserver /usr/bin/
# sudo apt-get install libsox-fmt-mp3

pathToMasters="/home/vagrant/code/@arcadeSchool"
videoFileName="master_$(date +%Y%m%d_%H%M%S)"
articleSourceUrl=$1
imageSourceUrl=$2
subjectName=$3
#rip from bing images (more reliable)
wget -O ./temp/index.html $imageSourceUrl;
#rip from bing images (more reliable)
wget -O ./temp/wiki.html $articleSourceUrl;
#get pics for movie
./imageScrape.py > ./temp/images.list;
#make picture directory
mkdir -p ./temp/pics;
#download images into pics folder
./imageDownloader.sh;
#create fancy slides for movie
./imageProcess.sh;
#rip article from html
./wikiScrape.py > ./temp/article.txt;
#run narration mp3 vo generation
./robonews.py;
#convert vo to usable wav
sox ./temp/storyvo.mp3 -r 44100 -c 2 ./temp/storyvo_final.wav speed 1.2;
#mix with background music
sox -m ./temp/storyvo_final.wav ./music/bg2low.wav ./temp/mix.wav gain -n;
#get length of vo file so we know when to fade out
sox ./temp/mix.wav ./temp/final_mix.wav fade 0 $(soxi -D ./temp/storyvo_final.wav | awk {'print $1 + 1'}) 1;
#turn images into video
ffmpeg -framerate 24 -i ./temp/pics/slide_%d.jpeg -vf "scale=trunc(iw/2)*2:trunc(ih/2)*2" ./temp/output.mp4;
#setpts should be seconds
ffmpeg -i ./temp/output.mp4 -filter:v setpts=$(soxi -D ./temp/final_mix.wav | awk {'print $1 * 1.5'})*PTS ./temp/output_slow.mp4;
#add final audio to video
ffmpeg -i ./temp/final_mix.wav -i ./temp/output_slow.mp4 -shortest ./temp/final.mp4;
#merge videos with intros problems. refactor when have more time

#clean up files from folder:
mkdir -p $pathToMasters/$videoFileName/;
mv ./temp/final.mp4 $pathToMasters/$videoFileName/$videoFileName.mp4;
mv ./temp/article.txt $pathToMasters/$videoFileName/$videoFileName.txt;
mv ./temp/pics/ytThumbFinal.jpeg $pathToMasters/$videoFileName/$videoFileName.jpeg;
rm -rf ./temp/*;