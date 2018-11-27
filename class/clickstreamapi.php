<?php

/**
 * Guideline:
 *
 * new ClickStreamAPI(string $method, [optional string $uid])
 *
 * Parameters
 * @param string 	$method 	either 'cookie' or 'session'
 * @param string 	$uid 		Pass if the user id is defined
 *
 * Examples
 * 
 * new ClickStreamAPI('session') //using session, no uid passed, it is a guest
 * new ClickStreamAPI('cookie','12') //using cookie, uid passed, it is a known user
 *
 * new ClickStreamAPI('cookie','12')->log('browse',111) //log user activites, id 12 user browsed id 111 item
 *
 *
 */

class ClickStreamAPI{
	/**
	 * API class only for the clickstream handling
	 * Version beta 1.0
	 *
	 * 2018 Brian Chan
	 */ 

	/**
     * @var string 	$user_id 			User id
     * @var string 	$guest_id 			Guest id if user id not defined
     * @var string 	$account_id 		Client id
     * @var string 	$account_api_key 	Client API key
     * @var string 	$method 			Method name either 'cookie' or 'session'
     * @var bool 	$debug 				On/Off debug mode
     */

	private $user_id = null;
	private $guest_id = null;
	private $account_id = "1";
	private $account_api_key = "abdRDXE4I6XhRvKbg4S29DR2di97RNOC";
	private $method = '';
	private $debug = true;

	public function __construct($method,$uid = null ){
		/**
		 * Constructor of the object
		 * @param string 		$method 	Method name either 'cookie' or 'session'
		 * @param int/string 	$uid 		Pass if the user id is known
		 * 
		 */ 

		//if method name is not recongized
		if($method != 'cookie' && $method != 'session'){
			$data['code'] = 'INVALID_PARAMS';
    		$data['err_msg'] = 'Invalid first parameters, please select either cookie or session';
    		$this->error_handler($data);
		}

		//if cookie used
		if($method == 'cookie'){
			if(isset($_COOKIE['deeprec_user_id']) && $_COOKIE['deeprec_user_id'] != ''){
			//existed cookie and is user
				$this->user_id = $_COOKIE['deeprec_user_id'];
			}elseif(isset($_COOKIE['deeprec_guest_id']) && $_COOKIE['deeprec_guest_id'] != ''){
			//existed cookie and is guest
				$this->guest_id = $_COOKIE['deeprec_guest_id'];
				if(!is_null($uid)){				
				//user login, convert the guest id to user id
					$this->user_id = (string)$uid;
					$this->update_guest_to_user();	
				}
			}else{
			//no any cookie or cookie expired
				if(is_null($uid)){
				// new guest
					$this->get_guest_id();
				}else{
				// new user
					$this->user_id = (string)$uid;
				}
			}

			$this->method = 'cookie';

		//if session used
		}elseif($method == 'session'){

			// PHP_SESSION_DISABLED if sessions are disabled.
			// PHP_SESSION_NONE if sessions are enabled, but none exists.
			// PHP_SESSION_ACTIVE if sessions are enabled, and one exists.

			if(session_status() == PHP_SESSION_DISABLED){
				$data['code'] = 'SESSION_ERR';
    			$data['err_msg'] = 'Please enable the session in PHP setting';
    			$this->error_handler($data);
			}elseif(session_status() == PHP_SESSION_NONE){
				$data['code'] = 'SESSION_ERR';
    			$data['err_msg'] = 'Session not started';
    			$this->error_handler($data);
			}

			if(isset($_SESSION['deeprec']['expired_time']) && $_SESSION['deeprec']['expired_time'] >= time()){
				if(isset($_SESSION['deeprec']['user_id']) && $_SESSION['deeprec']['user_id'] != ''){
				//existed session and is user
					$this->user_id = $_SESSION['deeprec']['user_id'];
				}elseif(isset($_SESSION['deeprec']['guest_id']) && $_SESSION['deeprec']['guest_id'] != ''){
				//existed session and is guest
					$this->guest_id = $_SESSION['deeprec']['guest_id'];

					if(!is_null($uid)){				
					//user login, convert the guest id to user id
						$this->user_id = (string)$uid;
						$this->update_guest_to_user();	
					}
				}
			}else{
			//no any session or session expired
				if(is_null($uid)){
				// new guest
					$this->get_guest_id();
				}else{
				// new user
					$this->user_id = (string)$uid;
				}
			}
			$this->method = 'session';
		}
		$this->refresh_life_time();
    }

    private function get_guest_id(){
		/**
		 * Recive a temporary unique guest id for the current viewer 
		 */

    	$url = "https://deep-rec.com/api/guest";
		$fields = array(
			"account_api_key" => $this->account_api_key,
			"account_id" => $this->account_id
		);

		$result = $this->request_sender($url,$fields);

		if($result['code'] == 'OK'){
			$this->guest_id = $result['guest_id'];
		}else{
			$this->error_handler($result);
		}
    }

    private function update_guest_to_user(){
    	/**
		 * Map guest id to a existed user id once the viewer login 
		 */

    	$url = "https://deep-rec.com/api/map_user_guest";
		$fields = array(
			"user_id" => $this->user_id,
			"guest_id" => $this->guest_id,
			"account_api_key" => $this->account_api_key,
			"account_id" => $this->account_id
		);

		$result = $this->request_sender($url,$fields);

		if($result['code'] == 'OK'){
			if($this->method == 'cookie'){
				setcookie("deeprec_guest_id", '', -1, "/"); 
			}elseif($this->method == 'session'){
				unset($_SESSION['deeprec']['guest_id']);
			}
		}else{
			$this->error_handler($result);
		}
    }

    private function request_sender($url,$data){
    	/**
		 * Handle the HTTPS POST request to the API server
		 * @param string 	$url 	URL of the request
		 * @param array 	$url 	Data of the request
		 */

    	$postdata = json_encode($data);
		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/json',
		        'content' => $postdata
		    )
		);

		$context  = stream_context_create($opts);
		$result = file_get_contents($url, false, $context);
		$result = json_decode($result,true);

		return $result;
    }

    private function error_handler(array $response){
    	/**
		 * Handle the error, will die the program if debug mode is on 
		 * @param array		$response 	Response of the request
		 */

    	if($this->debug){ 
	    	echo "<DIV Style='Font-Family: Courier New; Font-Size:12pt; ";
			echo " Padding: 5px; ";
			echo " Background-Color: MistyRose ; Color: Red; Border: 1px Solid Pink;";
			echo " '>";
			echo "[$response[code]] $response[err_msg]";
			echo "</DIV>";
	    	die;
    	}
    }

    private function refresh_life_time(){
    	/**
		 * Renew the life time of the cookie/session, if the user is inactive, the cookie/session will expired after half hour 
		 */

    	if($this->method == 'cookie'){
	    	if(!is_null($this->user_id)){
	    		setcookie("deeprec_user_id", $this->user_id, time() + (60*30), "/"); //expire after half hour

	    	}elseif(!is_null($this->guest_id)){
	    		setcookie("deeprec_guest_id", $this->guest_id, time() + (60*30), "/");
	    	}
    	}elseif($this->method == 'session'){
    		if(!is_null($this->user_id)){
    			$_SESSION['deeprec']['user_id'] = $this->user_id;	
    		}elseif(!is_null($this->guest_id)){
    			$_SESSION['deeprec']['guest_id'] = $this->guest_id;
    		}

	    	$_SESSION['deeprec']['expired_time'] = time() + (60*30);
    	}
    }

    public function log($action, $item_id){
    	/**
		 * Log the user activities to the API server
		 * @param string 		$action 	Action of the user to item
		 * @param int/string	$response 	Item id
		 */

    	$act_array = ['browse','add_to_cart','purchase'];

    	if(!in_array($action,$act_array)){
    		$data['code'] = 'INVALID_PARAMS';
    		$data['err_msg'] = 'Invalid first parameters, only accept string [browse, add_to_cart, purchase]';
    		$this->error_handler($data);
    	}

    	$item_id = (string)$item_id;
    	$url = "https://deep-rec.com/api/click";
		$fields = array(
			"user_id" => !is_null($this->user_id) ? $this->user_id : $this->guest_id,
			"item_id" => $item_id,
			"type" => $action,
			"account_api_key" => $this->account_api_key,
			"account_id" => $this->account_id
		);
		$result = $this->request_sender($url,$fields);

		if($result['code'] != 'OK'){
			$this->error_handler($result);
		}
    }

    public function clean_cookie(){
    	/**
		 * Clean all cookie related to the clickstream API
		 */

    	//expire immediately
    	setcookie("deeprec_user_id", '', -1, "/");
    	setcookie("deeprec_guest_id", '', -1, "/"); 
    }

    public function clean_session(){
    	/**
		 * Clean all session related to the clickstream API
		 */

    	//expire immediately
    	unset($_SESSION['deeprec']); 
    }

    public function get_id(){
    	/**
		 * Return id of the current viewer
		 * @return string 	user id of the user is recongized else guest id
		 */

    	if(!is_null($this->user_id)){
    		return $this->user_id;
    	}
    	elseif (!is_null($this->guest_id)) {
    	 	return $this->guest_id;
    	}
    	else{
    		return null;
    	}
    }

    public function get_method(){
    	/**
		 * Return method name
		 * @return string 	method name either cookie or session
		 */
    	return $this->method;
    }
}

?>