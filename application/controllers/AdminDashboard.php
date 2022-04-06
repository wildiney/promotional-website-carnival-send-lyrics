<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdminDashboard extends CI_Controller {
     public function __construct() {
        parent::__construct();
        
        $this->output->enable_profiler(false);
        
        if(!$this->session->userdata('level')){
            redirect("/AdminLogin","refresh");
        }
    }


    public function index(){
        $data['participacao']=false;
        $this->load->model("enredo_model");
        $data['resultados'] = $this->enredo_model->listAllPending();
        
        $this->load->view('header_view');
        $this->load->view('menu_view',$data);
        $this->load->view('admindashboard_view', $data);
        $this->load->view('footer_view');
    }
    
    public function pesquisar_matricula($matricula){
        $data['participacao']=false;
        $this->load->model("user_model");
        $data['resultados'] = $this->user_model->search_user($matricula);
        
        $this->load->view('header_view');
        print_r($data);
        $this->load->view('footer_view');
    }
    
    public function add_user(){}
    
}
