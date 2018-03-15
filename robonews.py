#!/usr/bin/env python
# -*- coding: utf-8 -*-
import gtts
import re
articleFile = "./temp/article.txt"
#blabla = open("""stuff to read""")

with open(articleFile, 'r') as myfile:
    blabla=myfile.read().replace('\n', '')

#regex wikipedia citations
blabla = re.sub(r"\[.\]", "", blabla)

tts = gtts.gTTS(text=blabla, lang='en-uk')
tts.save("./temp/storyvo.mp3")