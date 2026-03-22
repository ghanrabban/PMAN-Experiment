<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class language extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $lang = $this->input->get("lang");
     
        $lang = $lang == "ID" ? "ID" : "ENG";


        $url = $this->input->get("redirect");
        $url = urldecode($url);
        $this->session->set_userdata("lang", $lang);
       
        redirect($url);
    }

}

