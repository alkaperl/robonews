<?
#Usage: ./generateFile.sh articleUrl imageUrl;
#doesn't like weird characters like ":" and "."
#./generateFile.sh'wiki'''https://www.bing.com/images/search?q=Super_Mario_Bros_2_videogame_nes';

$defaultSearchTerms = " videogame";
$articlesToDo = array(
'https://en.wikipedia.org/wiki/Super_Mario_Land',
'https://en.wikipedia.org/wiki/Super_Mario_64',
'https://en.wikipedia.org/wiki/Streets_of_Rage_(video_game)',
'https://en.wikipedia.org/wiki/Streets_of_Rage_2',
'https://en.wikipedia.org/wiki/Streets_of_Rage_3',
'https://en.wikipedia.org/wiki/Golden_Axe_(video_game)',
'https://en.wikipedia.org/wiki/Gauntlet_(1985_video_game)',
'https://en.wikipedia.org/wiki/Altered_Beast',
'https://en.wikipedia.org/wiki/Sega_Genesis',
'https://en.wikipedia.org/wiki/Master_System',
'https://en.wikipedia.org/wiki/Sega',
'https://en.wikipedia.org/wiki/Dreamcast',
'https://en.wikipedia.org/wiki/Jet_Set_Radio',
'https://en.wikipedia.org/wiki/Crazy_Taxi',
'https://en.wikipedia.org/wiki/CP_System_II',
'https://en.wikipedia.org/wiki/Panasonic_M2',
'https://en.wikipedia.org/wiki/Konami',
'https://en.wikipedia.org/wiki/Dance_Dance_Revolution',
'https://en.wikipedia.org/wiki/Gradius',
'https://en.wikipedia.org/wiki/Frogger',
'https://en.wikipedia.org/wiki/Castlevania',
'https://en.wikipedia.org/wiki/Family_Computer_Disk_System',
'https://en.wikipedia.org/wiki/Super_Contra',
'https://en.wikipedia.org/wiki/Contra_(video_game)',
'https://en.wikipedia.org/wiki/MSX',
'https://en.wikipedia.org/wiki/Metal_Gear',
'https://en.wikipedia.org/wiki/Adventure_Island_(video_game)',
'https://en.wikipedia.org/wiki/Hudson_Soft',
'https://en.wikipedia.org/wiki/Bonk_(series)',
'https://en.wikipedia.org/wiki/Bloody_Roar',
'https://en.wikipedia.org/wiki/Fighting_game',
'https://en.wikipedia.org/wiki/Activision',
'https://en.wikipedia.org/wiki/Atari_2600',
'https://en.wikipedia.org/wiki/Sega_Genesis',
'https://en.wikipedia.org/wiki/Atari_5200',
'https://en.wikipedia.org/wiki/Combat_(1977_video_game)',
'https://en.wikipedia.org/wiki/Pac-Man_(1982_video_game)',
'https://en.wikipedia.org/wiki/Pac-Man',
'https://en.wikipedia.org/wiki/Robert_Kotick',
'https://en.wikipedia.org/wiki/Activision_Blizzard',
'https://en.wikipedia.org/wiki/Bomberman',
'https://en.wikipedia.org/wiki/Japan',
'https://en.wikipedia.org/wiki/CP_System_III',
'https://en.wikipedia.org/wiki/Mortal_Kombat',
'https://en.wikipedia.org/wiki/Palette_swap',
'https://en.wikipedia.org/wiki/Pong',
'https://en.wikipedia.org/wiki/Defender_(1981_video_game)',
'https://en.wikipedia.org/wiki/Joust_(video_game)',
'https://en.wikipedia.org/wiki/Sinistar',
'https://en.wikipedia.org/wiki/Moon_Patrol',
'https://en.wikipedia.org/wiki/Sprite_(computer_graphics)',
'https://en.wikipedia.org/wiki/ROM_cartridge',
'https://en.wikipedia.org/wiki/Giga_Wing',
'https://en.wikipedia.org/wiki/Takumi_Corporation',
'https://en.wikipedia.org/wiki/CP_System_II',
'https://en.wikipedia.org/wiki/Radiant_Silvergun',
'https://en.wikipedia.org/wiki/Sega_Saturn',
'https://en.wikipedia.org/wiki/Ikaruga',
'https://en.wikipedia.org/wiki/Cave_(company)',
);

foreach ($articlesToDo as $item => $wikiUrl) {
	$stringExploded = explode("/wiki/", $wikiUrl);
	$name = $stringExploded[1];
	$name = str_replace('.', '', $name);
	$name = str_replace('_', ' ', $name);
	$name = str_replace('(', '', $name);
	$name = str_replace(')', '', $name);
	
	$bingString = "https://www.bing.com/images/search?q=";
	$safeName = str_replace(' ', '_', $name);
	$bingString = $bingString . $safeName . $defaultSearchTerms;
	$bingString = str_replace(' ', '_', $bingString);
	
	//tell user what is being worked on
	print "Generating video for " . $name . "\n";
	$cmd = './generateFile.sh "'. $wikiUrl . '" "'. $bingString . '" "'. $name . '" 2>&1 ./logs/"'. $safeName . '"_output.log;';
	exec($cmd);
	$cmd = "";
}
?>