  <?php
    if(!count($_REQUEST)) {
        die("No Access!");
    } 
    //Core Url For Services
   // define ('ServiceCore', 'http://XXX.com/core/');  
    //Which Internal Service Should Be Called
   // $path = $_GET['service'];
    //Service To Be Queried
    //$url = ServiceCore.$path;
	$postVars=array(	 
		'LoginForm[email]' => 'igor.savinkin1@gmail.com',
		'LoginForm[password]' => 'manager1',
		'LoginForm[rememberMe]' => 1
	);
	$url = 'http://k-m.ru/app2/index.php?r=site/login2';
    //Open the Curl session
    $session = curl_init($url);


 

    //Create And Save Cookies
    $tmpfname = dirname(__FILE__).'/cookieConnector.txt';
    curl_setopt($session, CURLOPT_COOKIEJAR, $tmpfname);
    curl_setopt($session, CURLOPT_COOKIEFILE, $tmpfname);

  
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($session, CURLOPT_FOLLOWLOCATION, true);

    // EXECUTE
    $result = curl_exec($session);
  //  echo '<h3>Result GET= ', $result;
//	exit;
	
    $post = http_build_query($postVars);
	echo '$post = ', $post;
	curl_setopt ($session, CURLOPT_HEADER, false);
	curl_setopt ($session, CURLOPT_POST, true);
	curl_setopt ($session, CURLOPT_POSTFIELDS, $post);
	
	$result2 = curl_exec($session);
    echo '<h3>Result2 = ', $result2;
	
	
    
	curl_close($session);
?>