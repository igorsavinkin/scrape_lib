<?php

include('lib.php');
$postVars=array(	
	'user_name'=>'igor.savinkin555@gmail.com',	
	'user_pass'=>'godman',
	
/*	'LoginForm[email]' => 'igor.savinkin1@gmail.com',
	'LoginForm[password]' => 'manager1',
	'LoginForm[rememberMe]' => 1,*/
//	'remember_me'=>1,
	'submit'=>'Войти',
//	'referer'=>'http%3A%2F%2Fauto.ru%2Fcars%2Fused%2Fsale%2F41963504-49893%2F',
	// decoded: urlencode('http://auto.ru/cars/used/sale/41963504-49893/'); 
	); 
	
$tmpfname = dirname(__FILE__).'/cookie.txt';	
$cookieJar =array(
	  // дополнительно для сохранения cookie 	
	  CURLOPT_COOKIEJAR => $tmpfname,
	  CURLOPT_COOKIEFILE => $tmpfname
	  );
$options = array(	  
	  CURLOPT_HEADER        => true,     //return headers in addition to content
      CURLOPT_FOLLOWLOCATION => true,     // follow redirects
	  CURLINFO_HEADER_OUT    => true,
	  //CURLOPT_AUTOREFERER    => true,     // set referer on redirect
	  CURLOPT_REFERER => 'http%3A%2F%2Fauto.ru%2Fcars%2Fused%2Fsale%2F41963504-49893%2F',
);	
//list($page, $cookie) = curl_post('https://auth.auto.ru/login/', $postVars/*s, $options */);
/*print_r($cookie);
  print_r($page);  
*/
$url = 'http://spb.auto.ru/cars/audi/q3/all/';
echo '<h3>url = ', $url;
$header = get_web_page($url);
$header = curl_post($url, $postVars  /*,$options  /* + $cookieJar */  );
//print_r($header);

echo   '<br> HEADERS = ', $header['headers'];

//echo '<br> CONTENT = ', $header['content'];

echo  '<br> COOKIES = ', $header['cookies'];