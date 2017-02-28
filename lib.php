<?php  

function curl_post($url, array $post = NULL, array $options = array()) 
{ 
    $defaults = array(        

	    CURLOPT_POST => true, 
	    CURLOPT_POSTFIELDS => http_build_query($post), 
		
		CURLOPT_RETURNTRANSFER => true,     // return web page
		CURLOPT_HEADER         => true,     //return headers in addition to content
		
		CURLOPT_FOLLOWLOCATION => true,     // follow redirects
		CURLOPT_ENCODING       => "",       // handle all encodings
		CURLOPT_AUTOREFERER    => true,     // set referer on redirect
		CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
		CURLOPT_TIMEOUT        => 120,      // timeout on response
		CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
		CURLINFO_HEADER_OUT    => true,
		CURLOPT_SSL_VERIFYPEER => false,     // Disabled SSL Cert checks
		CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
 
        CURLOPT_URL => $url, 
       // CURLOPT_FRESH_CONNECT => 1,  
   
        
    ); 
	echo "<br>defaults['CURLOPT_POSTFIELDS'] = ", $defaults[CURLOPT_POSTFIELDS], '<br>';
    $ch = curl_init(); 
    curl_setopt_array($ch, ($options + $defaults)); 
	
// дополнительно для сохранения cookie 
	$tmpfname = dirname(__FILE__).'/cookie_kmru.txt';
	curl_setopt($ch, CURLOPT_COOKIEJAR, $tmpfname);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $tmpfname);
	
    if( !$result = curl_exec($ch)) 
    { 
        trigger_error(curl_error($ch)); 
    } 
    $err         = curl_errno( $ch );
	$errmsg  = curl_error( $ch );
	$header  = curl_getinfo( $ch );
    curl_close($ch); 
	
	$header_content = substr($result, 0, $header['header_size']);
	$body_content = trim(str_replace($header_content, '', $result));
	$pattern = "#Set-Cookie:\\s+(?<cookie>[^=]+=[^;]+)#m"; 
	preg_match_all($pattern, $header_content, $matches); 
	$cookiesOut = implode("; ", $matches['cookie']);

	$header['errno']   = $err;
	$header['errmsg']  = $errmsg;
	$header['headers']  = $header_content;
	$header['content'] = $body_content;
	$header['cookies'] = $cookiesOut;	
	
    return $header; // array($result, $header['cookies']); 
} 


function get_web_page( $url, $cookiesIn = '' ){
        $options = array(
            
			CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => true,     //return headers in addition to content
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLINFO_HEADER_OUT    => true,
            CURLOPT_SSL_VERIFYPEER => false,     // Disabled SSL Cert checks
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
         //   CURLOPT_COOKIE         => $cookiesIn
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
		
		// дополнительно для сохранения cookie 
		$tmpfname = dirname(__FILE__).'/cookie.txt';
		curl_setopt($ch, CURLOPT_COOKIEJAR, $tmpfname);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $tmpfname);
        $rough_content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch ); 
        curl_close( $ch );
 
        $header_content = substr($rough_content, 0, $header['header_size']);
        $body_content = trim(str_replace($header_content, '', $rough_content));
        $pattern = "#Set-Cookie:\\s+(?<cookie>[^=]+=[^;]+)#m"; 
        preg_match_all($pattern, $header_content, $matches); 
        $cookiesOut = implode("; ", $matches['cookie']);

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['headers']  = $header_content;
        $header['content'] = $body_content;
        $header['cookies'] = $cookiesOut;
    return $header;
}

function get_web_page_post( $url, $post=NULL){
        $options = array(
            CURLOPT_POSTFIELDS => $post ? http_build_query($post) : '',
       	    CURLOPT_POST => true,            
		    CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => true,     //return headers in addition to content
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLINFO_HEADER_OUT    => true,
            CURLOPT_SSL_VERIFYPEER => false,     // Disabled SSL Cert checks
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
         //   CURLOPT_COOKIE         => $cookiesIn
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
		
		// дополнительно для сохранения cookie 
		$tmpfname = dirname(__FILE__).'/cookie.txt';
		curl_setopt($ch, CURLOPT_COOKIEJAR, $tmpfname);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $tmpfname);
        $rough_content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch ); 
        curl_close( $ch );
 
        $header_content = substr($rough_content, 0, $header['header_size']);
        $body_content = trim(str_replace($header_content, '', $rough_content));
        $pattern = "#Set-Cookie:\\s+(?<cookie>[^=]+=[^;]+)#m"; 
        preg_match_all($pattern, $header_content, $matches); 
        $cookiesOut = implode("; ", $matches['cookie']);

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['headers']  = $header_content;
        $header['content'] = $body_content;
        $header['cookies'] = $cookiesOut;
    return $header;
}
?>