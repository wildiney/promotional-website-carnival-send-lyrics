<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Regulamento extends CI_Controller {

    private $participante;

    public function __construct() {
        parent::__construct();

        $this->load->model("enredo_model");
        $this->participante = $this->enredo_model->verificaParticipacao($this->session->userdata("matricula"));
    }

    public function index() {
        $data['participacao'] = $this->participante;
        $data['title'] = " - REGULAMENTO";
        $dataBody=array();
        $dataBody['participacao_inicio'] = date_converter($this->config->item("participacao_inicio"),'%d de %B');
        $dataBody['participacao_fim'] = date_converter($this->config->item("participacao_fim"),'%d de %B');
        $dataBody['resultado'] = date_converter($this->config->item("resultado"),'%d de %B');

        $this->load->view('header_view');
        $this->load->view('menu_view', $data);
        $this->load->view('regulamento_view',$dataBody);
        $this->load->view('footer_view');
    }

}
