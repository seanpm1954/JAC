<?php
// A class to help work with Sessions
// In our case, primarily to manage logging users in and out

// Keep in mind when working with sessions that it is generally 
// inadvisable to store DB-related objects in sessions

class Session {
	
	private $logged_in;
	public $id;
	public $message;
    public $access;

	function __construct() {
		session_start();
        $this->check_message();
		$this->check_login();
    if($this->logged_in) {
      // actions to take right away if user is logged in
    } else {
      // actions to take right away if user is not logged in
    }
	}
	
  public function is_logged_in() {
    return $this->logged_in;
  }

	public function login($user) {
    // database should find user based on username/password
    if($user){
      $this->user_id = $_SESSION['user_id'] = $user->id;
      $this->access = $_SESSION['access'] = $user->access;
      $this->logged_in = true;
    }
  }
  
  public function logout() {
    unset($_SESSION['user_id']);
    unset($this->user_id);
    unset($_SESSION['message']);
    unset($this->message);
    unset($_SESSION['access']);
    unset($this->access);
    $this->logged_in = false;
     //session_destroy();
  }

    public function message($msg=""){
        if(!empty($msg)){
         $_SESSION['message']=$msg;
        }else{
            return $this->message;
        }
    }

	private function check_login() {
    if(isset($_SESSION['user_id'])) {
      $this->user_id = $_SESSION['user_id'];
      $this->access = $_SESSION['access'];
      $this->logged_in = true;
    } else {
      unset($this->user_id);
      unset($this->access);
      $this->logged_in = false;
    }
  }
  


private function check_message(){
    if(isset($_SESSION['message'])){
        $this->message = $_SESSION['message'];
        unset($_SESSION['message']);
    }else{
        return $this->message;
    }
}

}//end class
$session = new Session();
$message=$session->message();
?>