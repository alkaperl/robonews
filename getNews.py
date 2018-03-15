#!/usr/bin/env python
# -*- coding: utf-8 -*-
from bs4 import BeautifulSoup

#regex wikipedia "\[.\]"
soup = BeautifulSoup(open("./temp/index.html"))

#get title from browser
print(soup.title.string)
#print(soup.find_all(attrs={"class": "headline"}))

#main story
print(soup.find_all(attrs={"class": "all-post-body group article-content"}))