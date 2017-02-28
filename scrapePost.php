<?php 
echo '<h2>Try to log in with POST request</h2><hr>';
include('lib.php'); 
// for getting particulal links: http://tarex.ru/sigor/scrapeCookie.php?url=http://spb.auto.ru/cars/audi/q3/all&used=1
$postVars=array(	
	'user_name'=>'igor.savinkin555@gmail.com',	
	'user_pass'=>'godman',
	'remeber_me'=>1, 
 	'remember_me'=>1,
	'submit'=>'Войти',
);
echo 'post params: '; print_r($postVars);
echo 'http_build_query(<post params>) = ' , http_build_query($postVars);
$login_url = 'https://auth.auto.ru/login/';
$header=get_web_page_post($login_url, $postVars);

echo '<hr>header:<br>';
print_r($header);   