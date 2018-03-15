#!/usr/bin/env python
# -*- coding: utf-8 -*-
from bs4 import BeautifulSoup
import re
wikiFile = "./temp/wiki.html"
outtro = "Thank you for watching our video. We hope you learned something new. Have a nice day!"
with open(wikiFile, 'r') as myfile:
    wikiString=myfile.read().replace('\n', '')

wikiString = wikiString.split('<div id="toc" class="toc">')[-2]
wikiString = wikiString.split('</td></tr></table>')[-1]
wikiString = re.sub(r"<[^>]*>", "", wikiString)

print(wikiString)
print(outtro)