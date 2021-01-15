<?php
session_start();

// Holds the Google application Client Id, Client Secret and Redirect Url
require_once('credentials.json');

// Holds the various APIs involved as a PHP class - need to change ?????
require_once('google-login-api.php');

// redirect url to google login
$login_url = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/calendar') . '&redirect_uri=' . APPLICATION_REDIRECT_URL . '&response_type=code&client_id=' . APPLICATION_ID . '&access_type=online';

// Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	try {
		$capi = new GoogleCalendarApi();
		
		// Get the access token 
		$data = $capi->GetAccessToken(APPLICATION_ID, APPLICATION_REDIRECT_URL, APPLICATION_SECRET, $_GET['code']);

		// Access Token
		$access_token = $data['access_token'];

		// The rest of the code to add event to Calendar will come here
	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}

?>

