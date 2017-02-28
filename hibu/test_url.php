Hibu sites Scraper<br />
<?php
include('../lib.php');
$url = $_GET['url'];
if(!$url) {
	die('Wrong url');  
	}
echo '<hr>Url: '. $url . '<br />';
$res=get_web_page($url); 
$regex='/tel:([+\d]+)/';
preg_match($regex, $res['content'], $matches);
echo 'Phone: ', print_r($matches[1], true); 


