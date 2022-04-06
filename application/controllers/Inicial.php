<?php

defined('BASEPATH') || exit('No direct script access allowed');

class Inicial extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('header_view');
        $this->load->view('home_view');
        $this->load->view('footer_view');
    }

}
