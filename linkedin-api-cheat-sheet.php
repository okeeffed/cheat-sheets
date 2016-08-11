<?php
	// Change these back to your things
	define('API_KEY',      '752cmnp06ee9z6');
	define('API_SECRET',   'HvLZrPuG26cq4hxD');
	define('REDIRECT_URI',  'http://localhost/');

	// I've changed the scope to work for what we generally have access to
	define('SCOPE', 'r_basicprofile r_emailaddress');
	
	// This stuff I believe it used if you have a database
	session_name('linkedin');
	session_start();

	// OAuth 2 Control Flow
	if (isset($_GET['error'])) {
		// LinkedIn returned an error
		print $_GET['error'] . ': ' . $_GET['error_description'];
		exit;
	} elseif (isset($_GET['code'])) {
		// User authorized your application
		if ($_SESSION['state'] == $_GET['state']) {
			// Get token so you can make API calls
			getAccessToken();
		} else {
			// CSRF attack? Or did you mix up your states?
			exit;
		}
	} else { 
		if ((empty($_SESSION['expires_at'])) || (time() > $_SESSION['expires_at'])) {
			// Token has expired, clear the state
			$_SESSION = array();
		}
		if (empty($_SESSION['access_token'])) {
			// Start authorization process
			getAuthorizationCode();
		}
	}

	// You have a valid token. Now fetch your profile. 
	// I've just put in some dummy fields for now, but hopefully these should do it.
	$user = fetch('GET', '/v1/people/~:(first-name,last-name,email-address,phone-numbers,num-connections,picture-url,location,positions,summary,specialties,industry)');

	// I've just shoved the responses into some variables from the $user dict response

	// STORE THE RESULTS IN AN ARRAY

	$res = array();

	$res[] = $user->firstName;
	$res[] = $user->lastName;
	$res[] = $user->emailAddress;
	$res[] = $user->phoneNumbers;
	$res[] = $user->numConnections;
	$res[] = $user->pictureUrl;
	$res[] = $user->location->country->code;
	$res[] = $user->location->name;
	$res[] = $user->summary;
	$res[] = $user->specialties;
	$res[] = $user->industry;
	$res[] = $user->positions;

	echo  nl2br("First name: ". $res[0] . "\n");
	echo  nl2br("Last name: ". $res[1] . "\n");
	echo  nl2br("Email Address: " . $res[2] . "\n");
	echo  nl2br("Phone Numbers: ". $res[3] . "\n");
	echo  nl2br("Num Connections: ". $res[4] . "\n");
	echo  nl2br("Picture Url: " . $res[5] . "\n");
	echo  nl2br("Location Country Code: " . $res[6]. "\n");
	echo  nl2br("Location Name: ". $res[7] . "\n");
	echo  nl2br("Summary: " . $res[8] . "\n");
	echo  nl2br("Specialties: ". $res[9] . "\n");
	echo  nl2br("Industry: ". $res[10] . "\n");
	echo  nl2br("Positions: " . $res[11] . "\n");

	exit;

	function getAuthorizationCode() {
		$params = array('response_type' => 'code',
						'client_id' => API_KEY,
						'scope' => SCOPE,
						'state' => uniqid('', true), // unique long string
						'redirect_uri' => REDIRECT_URI,
				  );
		// Authentication request
		$url = 'https://www.linkedin.com/uas/oauth2/authorization?' . http_build_query($params);
		
		// Needed to identify request when it returns to us
		$_SESSION['state'] = $params['state'];
		// Redirect user to authenticate
		header("Location: $url");
		exit;
	}
		
	function getAccessToken() {
		$params = array('grant_type' => 'authorization_code',
						'client_id' => API_KEY,
						'client_secret' => API_SECRET,
						'code' => $_GET['code'],
						'redirect_uri' => REDIRECT_URI,
				  );
		
		// Access Token request
		$url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);
		
		// Tell streams to make a POST request
		$context = stream_context_create(
						array('http' => 
							array('method' => 'POST',
		                    )
		                )
		            );
		// Retrieve access token information
		$response = file_get_contents($url, false, $context);
		// Native PHP object, please
		$token = json_decode($response);
		// Store access token and expiration time
		$_SESSION['access_token'] = $token->access_token; // guard this! 
		$_SESSION['expires_in']   = $token->expires_in; // relative time (in seconds)
		$_SESSION['expires_at']   = time() + $_SESSION['expires_in']; // absolute time
		
		return true;
	}

	// this fetch should be the main thing that you really need to add to what you already have!

	function fetch($method, $resource, $body = '') {
		$params = array('oauth2_access_token' => $_SESSION['access_token'],
						'format' => 'json',
				  );
		
		// Need to use HTTPS
		$url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
		// Tell streams to make a (GET, POST, PUT, or DELETE) request
		$context = stream_context_create(
						array('http' => 
							array('method' => $method,
		                    )
		                )
		            );

		// Hocus Pocus
		$response = file_get_contents($url, false, $context);
		// Native PHP object, please
		return json_decode($response);
	}

?>