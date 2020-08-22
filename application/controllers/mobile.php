<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mobile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common');
        $this->load->driver('cache');
    }
    
    public function redirection() {
        header('Location: http://m.banglatribune.com/');
    }

}
