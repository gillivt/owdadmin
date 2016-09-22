<?php
/*
 * File: class.session.php
 * 
 * Copyright © 2016 Terry Gilliver <terry@comp-solutions.org.uk> - Computer Solutions
 * 
 * Created: 04-Mar-2016 20:44:55
 * 
 * Purpose: 
 * A class to help work with Sessions
 * In our case, primarily to manage logging users in and out
 * Keep in mind when working with sessions that it is generally
 * inadvisable to store DB-related objects in sessions
 * 
 * Modification History:
 * 
 */

class Session {

    private $logged_in = false;
    public $token;
    public $name;
    public $message;

    function __construct() {
        session_start();
        $this->check_message();
        $this->check_login();
        if ($this->logged_in) {
            // actions to take right away if user is logged in
        } else {
            // actions to take right away if user is not logged in
        }
    }

    public function is_logged_in() {
        return $this->logged_in;
    }

    public function login($token, $name) {
        // save login token in Session and $session
        if ($token) {
            $this->token = $_SESSION['token'] = $token;
            $this->name = $_SESSION['name'] = $name;
            $this->logged_in = true;
        }
    }

    public function logout() {
        unset($_SESSION['token']);
        unset($this->token);
        $this->logged_in = false;
    }
    
    public function fullname() {
        if(isset($_SESSION['name'])) {
            $this->name = $_SESSION['name'];
            return $this->name;
        } else {
            return '';
        }
    }

    public function message($msg = "", $alert="", $glyph="") {
        if (!empty($msg)) {
            // then this is "set message"
            //check if alert/glyph is set
            if ($alert !== "") {
                if ($glyph !== "") {
                    $_SESSION['message'] = "<div class='alert ".$alert."'><span class='glyphicon ".$glyph."'></span>&nbsp;&nbsp;".$msg."</div>"; 
                } else {
                    $_SESSION['message'] = "<div class='alert ".$alert."'>".$msg."</div>";
                }
            } else {
                $_SESSION['message'] = $msg;
            }
        } else {
            // then this is "get message"
            return $this->message;
        }
    }
    
    private function check_login() {
        if (isset($_SESSION['token'])) {
            $this->token = $_SESSION['token'];
            $this->name = $_SESSION['name'];
            $this->logged_in = true;
        } else {
            unset($this->token);
            $this->logged_in = false;
        }
    }

    private function check_message() {
        // Is there a message stored in the session?
        if (isset($_SESSION['message'])) {
            // Add it as an attribute and erase the stored version
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }

}

$session = new Session();
$message = $session->message();
$name = $session->fullname();
?>