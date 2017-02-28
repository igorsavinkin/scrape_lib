<h2>Hibu sites Scraper</h2>
<?php
$start=microtime(true);
include('../lib.php');
include('../lib/dbconnection.php'); 

echo '<hr>';
$db_handler = init_db();
echo 'db connection is ok!<br />';
// var_dump($db_handler);
try { 
	$records = getTableFields($db_handler, 'tarex_yhibu', ['id','url'], 'phone="" limit 3');
	// echo '<pre>' . print_r($records, true) . '</pre>';
	
} catch  (Exception $e) {
    echo 'exception: ',  $e->faultstring;
} 

// $res=get_web_page($urls[0]); 
$regex='/tel:([+\d]+)/'; 
echo '<table border=1><tr><th>Url</th><th>Phone</th><th>dump</th><tr>';
foreach($records as $record){
     $res=get_web_page($record['url']);
	 preg_match($regex, $res['content'], $matches);
	 echo '<tr><td>', $record['url'], '</td><td><b> ' , print_r($matches[1], true), '</b></td><td><b> ' , var_dump($matches[1] ) , '</b></td></tr>';
	 settype($matches[1], 'string');
	 $phone = (string)$matches[1];
	 settype($record['url'], 'string');
	 UpdateRecord($db_handler, 'tarex_yhibu', 'phone', $phone,  'url = "' . $record['url'] . '" ' );
}
echo '</tr></table>';
echo '<br >Script execution time: ' . round((microtime(true) - $start), 1); //value in seconds

