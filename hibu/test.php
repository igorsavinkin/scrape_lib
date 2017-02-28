<h2>Hibu sites Scraper</h2>
<?php
include('../lib.php');
$urls=['http://aaaplusflooring.com/contact/1813627', 'http://www.superiorhandymantucson.com/contact-us/1257795', 'http://bestwayelectric.com/contact/3294220'];
//print_r($urls);
echo '<hr>';
$res=get_web_page($urls[0]);
// writing into file
/*$myfile = fopen("temp.txt", "w");
fwrite($myfile, $res['content']);
fclose($myfile);*/
$regex='/tel:([+\d]+)/';
// preg_match($regex, $res['content'], $matches);

echo '<pre>' . print_r($matches[1], true) . '</pre>';
// echo '<pre>' . print_r($res['content'], true) . '</pre>';
echo '<table border=1><tr><th>Url</th><th>Phone</th><tr>';
foreach($urls as $url){
     $res=get_web_page($url);
	 preg_match($regex, $res['content'], $matches);
	 echo '<tr><td>', $url, '</td><td><b> ' , print_r($matches[1], true), '</b></td></tr>';
}
echo '</tr></table>';


