<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	 // Facebook OAuth Crediential
     private $appId = "1474092719551518";
     private $secret = "686061d7fd256acc1f0d71dd9621ba03";


     // Google OAuth Crediential 
        private $client_id = '1009995461410-dccqpo5pmm1mql4n1341cvuimulenhim.apps.googleusercontent.com';
        private $client_secret = 'zFqWA0S9bDVWZ-gSgQeVmQOM';
        private $redirect_uri = 'http://socialconnect.dev/login/google_login';
        private $simple_api_key = 'AIzaSyBXMsd7udQFoybxuWzYRxSIHNAWZmuEuL0';

    function __construct() {
        parent::__construct();
        $this->load->model('login_m');
        $this->load->library('session');
        $this->load->helper('cookie');
        $this->load->library('email');
        
	    if(!isset($_SESSION)) 
	    { 
	        session_start(); 
	    } 

        // Load facebook library and pass associative array which contains appId and secret key
        $this->load->library('facebook', array('appId' => $this->appId, 'secret' => $this->secret));
    }

	public function index()
	{
		$this->back_browser();

		//call autologin function
        $this->autologin(); 
        $this->load->view('/admin/login');

	}
	public function facebook(){
		    $data = $this->facebook_oauth();
              // If already user login in facebook, it pass the user profile values, which get from facebook id.
		 //var_dump($data['fb_login_url']);
        if(isset($data['fb_login_url'])){
         	header('Location:' .$data['fb_login_url']);
        } 
        if (isset($data['user_email'])) {
            $user_fb_data = array(
                'user_picture' => $data['user_picture'],
                'user_name' => $data['user_name'],
                'user_email' => $data['user_email'],
                'logout_url' => $data['logout_url']
            );

            //checking email id exists or not in database	
            $data = $this->login_m->user_email_check($user_fb_data['user_email']);
            isset($data[0]) ? $check_email = trim(strtolower($data[0]->user_email)) : $check_email = '';

            //if not exists then save on database
            if ($check_email != $user_fb_data['user_email']) {
                $insert_fb_data = array( 
                    'user_name' => $user_fb_data['user_name'],
                   'user_email' => $user_fb_data['user_email'],
                     'is_active' => 1
                    );
                // Sucess New User Registration 
                $new_user = $this->login_m->new_user_registration($insert_fb_data);
            }
              // if exit save all data in session and view home page
                    $this->session->set_userdata($user_fb_data);
                    $this->session->all_userdata();
                    $this->home();
        }
	}
	 // Log In via Facebook.
    public function facebook_oauth() {
        $facebook_user = "";
         // Get user's login information
        $facebook_user = $this->facebook->getUser();
        if ($facebook_user) {

            $user_profile = $this->facebook->api('/me/');
            $data['user_email'] = $user_profile['id']."@facebook.com";
            $data['user_name'] = $user_profile['name'];
            $data['user_picture'] = "https://graph.facebook.com/" . $user_profile['id'] . "/picture";
            $data['logout_url'] = $this->facebook->getLogoutUrl(array('next' => base_url() . 'login/logout'));
        } else {
            $data['fb_login_url'] = $this->facebook->getLoginUrl(array(
               'scope'         => 'email,public_profile'
           ));
        }
        //var_dump($data);
        return $data;
      
   
 }

    public function google_login(){
        
        $data = $this->google_oauth();
                    
           if(isset($data['authUrl'])){
          header('Location:' .$data['authUrl']);
        } 
  
        //get google oauth userdata
        if (isset($data['userData'])) {

            $user_name = $data['userData']->given_name . " " . $data['userData']->family_name;
            $user_email = $data['userData']->email;
            $user_picture = $data['userData']->picture;
            $user_google_data = array(
                'user_picture' => $user_picture,
                'user_name' => $user_name,
                'user_email' => $user_email
            );

            //checking email id exists or not in database   
            $data = $this->login_m->user_email_check($user_google_data['user_email']);
            isset($data[0]) ? $check_email = trim(strtolower($data[0]->user_email)) : $check_email = '';

            //if not exists then save on db
            if ($check_email != $user_google_data['user_email']) {

                $insert_google_data = array(
                    'user_name' => $user_name,
                    'user_email' => $user_email,
                     'is_active' => 1

                );
                // Sucess New User Registration 
                $new_user = $this->login_m->new_user_registration($insert_google_data);
            }
            //set user data to session
            $this->session->set_userdata($user_google_data);
            $this->session->all_userdata();
            $this->home();
        }
        
    }

    //Google OAuth Function
    public function google_oauth() {

        // Include google-php-client library in controller
        include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Client.php";
        include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Service/Oauth2.php";

        // Store values in variables from project created in Google Developer Console
        $client_id = $this->client_id;
        $client_secret = $this->client_secret;
        $redirect_uri = $this->redirect_uri;
        $simple_api_key = $this->simple_api_key;

        // Create Client Request to access Google API
        $client = new Google_Client();
        $client->setApplicationName("PHP Google OAuth Login Example");
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->setDeveloperKey($simple_api_key);
        $client->addScope("https://www.googleapis.com/auth/userinfo.email");

        // Send Client Request
        $objOAuthService = new Google_Service_Oauth2($client);

        // Add Access Token to Session
        if (isset($_GET['code'])) {
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }

        // Set Access Token to make Request
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
        }

        // Get User Data from Google and store them in $data
        if ($client->getAccessToken()) {
            $userData = $objOAuthService->userinfo->get();
            $data['userData'] = $userData;
            $_SESSION['access_token'] = $client->getAccessToken();
        } else {
            $authUrl = $client->createAuthUrl();
            $data['authUrl'] = $authUrl;
        }

        return $data;    
    }

	 //loding home view
    public function home() {
        $this->back_browser();

        $user_email = $this->session->userdata('user_email');
        $res = $this->login_m->get_user_name($user_email);

        foreach ($res as $row) {
            $data['user_name'] = $row->user_name;
           
        }

        $this->load->view('admin/home', $data);
    }
     public function autologin() {

        $user_email = $this->input->cookie('user_email', true);
        $user_name = $this->input->cookie('user_name', true);
        $user_id = $this->input->cookie('id', true);

        if (!empty($user_email) && !empty($user_name)) {

            $user_data = array(
                'user_email' => $user_email,
                'user_name' => $user_name,
                'id' => $user_id,
            );

            $this->session->set_userdata($user_data);

            $arr = $this->session->all_userdata();
            $u_data = serialize(array("id" => $arr['user_id'], "user_name" => $arr["user_name"], "user_email" => $arr["user_email"]));

            header('Location:' . base_url() . 'login/home');
        }
    }

    //logout and destroy the session
    public function logout() {
        $newdata = array(
            'user_name' => '',
            'user_email' => '',
            'id' => '',
        );

        $this->session->unset_userdata($newdata);
        $this->session->sess_destroy();
        delete_cookie("user_email");
        delete_cookie("id");
        delete_cookie("user_name");
        unset($_SESSION['access_token']);
        session_destroy();
        header('Location:' . base_url() . 'admin/');
    }

    //Making sure a web page is not cached, across all browsers
    public function back_browser() {
        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
        header("Pragma: no-cache"); // HTTP 1.0.
        header("Expires: 0"); // Proxies.
    }
	
}
