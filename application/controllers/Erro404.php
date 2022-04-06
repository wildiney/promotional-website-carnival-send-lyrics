<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Erro404 extends CI_Controller
{
    public function index()
    {
        $this->load->view('header_view');
        $this->load->view('erro404_view');
        $this->load->view('footer_view');
    }
}