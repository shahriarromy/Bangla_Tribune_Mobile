<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test_time extends CI_Controller {
    function index(){
        $this->load->view('test');
    }
}

