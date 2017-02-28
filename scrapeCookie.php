<?php 
include('lib.php'); 
// for getting particulal links: http://tarex.ru/sigor/scrapeCookie.php?url=http://spb.auto.ru/cars/audi/q3/all&used=1
$header=get_web_page($_GET['url']);
echo 'header:<br>';
print_r($header);  
$patternUsed = '~http://auto.ru/cars/used/sale/[^/]+?/~';
$patternAudi = '~/cars/audi/[^/]+?/all/~'; //http://spb.auto.ru/cars/audi/all/
preg_match_all($patternAudi, $header['content'], $matches); 
if(isset($_GET['used'])) 
    preg_match_all($patternUsed, $header['content'], $usedMatches); 
$i=1;
//print_r($matches);
echo '<br>General links:';
foreach($matches[0] as $link)
	echo '<br>', $i++, '. ',  $link;  
print_r($matches[0]);

// распечатка подержанных
$i=1;	
echo '<br>Used cars links:';
foreach($usedMatches[0] as $link)
	echo '<br>', $i++, '. ',  $link;  
//