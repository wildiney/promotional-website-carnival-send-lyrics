<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->today = date("Y-m-d");
        $this->encerramento = "2018-02-13";

        $this->load->model("enredo_model");
        $this->participante = $this->enredo_model->verificaParticipacao($this->session->userdata("matricula"));
        $data['participacao'] = $this->participante;
        $this->output->enable_profiler(false);
    }

    public function index() {
        if ($this->input->post('login')) {
            $data['matricula'] = $this->input->post("matricula");
            $data['dataDeNascimento'] = $this->input->post("data-de-nascimento");

            $this->load->model("user_model");
            $resultado = $this->user_model->logar($data);

            if ($resultado) {
                foreach ($resultado as $row) {
                    $dataDeNascimento = new DateTime($row->dataDeNascimento);
                    $nascimento = $dataDeNascimento->format("d-m-Y");
                    $data = array('nome' => $row->nomeCompleto, 'email' => $row->email, 'matricula' => $row->matricula, 'dataDeNascimento' => $nascimento, 'logged' => true);
                }

                $this->user_model->updatedAt($row->idUsuario);

                $this->session->set_userdata($data);

                if ($this->participante) {
                    redirect('/enredo/votacao/');
                } else {
                    redirect('/enviar/enredo');
                }
            } else {
                redirect('login/erro');
            }
        } else {
            $this->load->view('header_view');
            $this->load->view('form_login_view');
            $this->load->view('footer_view');
        }
    }

    public function logout() {
        /**
         * Sessions Admins
         */
        $this->session->unset_userdata('logged');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('nome');
        $this->session->unset_userdata('level');
        $this->session->sess_destroy();

        /**
         * Exec
         */
        redirect('/', 'refresh');
    }

    public function erro() {
        $encerramento = new DateTime($this->encerramento);
        $data['encerramento'] = $encerramento->format("dd/mm/YYYY");
        
        $this->load->view('header_view');
        $this->load->view('login_erro_view', $data);
        $this->load->view('footer_view');
    }

}
