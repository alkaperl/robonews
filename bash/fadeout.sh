#! /bin/bash
WAV_IN=$1
WAV_OUT=$2

FADE_IN_L="0:5"
FADE_OUT_L="0:7"

LENGTH=`soxi -d $WAV_IN`

sox $WAV_IN $WAV_OUT fade $FADE_IN_L $LENGTH $FADE_OUT_L