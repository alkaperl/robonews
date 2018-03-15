#!/usr/bin/env python
# -*- coding: utf-8 -*-
from bs4 import BeautifulSoup

soup = BeautifulSoup(open("./temp/index.html"), "html.parser")

for imageLink in soup.findAll("img"):
	imageLink = imageLink["src"].split("src=")[-1]
	#for bing images
	imageLink = imageLink.split("&w")[0]
	print(imageLink)