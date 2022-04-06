<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Enredo extends CI_Controller {

    private $today;
    private $encerramento;
    private $resultado;
    private $participante;

    public function __construct() {
        parent::__construct();
        $this->today = date("Y-m-d");
        $this->encerramento = $this->config->item("participacao_fim");
        $this->resultado = $this->config->item("resultado");

        $this->load->model("enredo_model");
        $this->participante = $this->enredo_model->verificaParticipacao($this->session->userdata("matricula"));
        $data['participacao'] = $this->participante;


        if (!$this->session->userdata('logged')) {
            redirect("/login", "refresh");
        }

        $this->output->enable_profiler(false);
    }

    public function index() {
        $data['title'] = "Enredo";

        if ($this->participante) {
            redirect("/enredo/votacao");
        } else {
            redirect("/enredo/enviar");
        }
    }

    public function enviar() {
        $date1 = $this->today;
        $date2 = $this->encerramento;
        $dataHeader['participacao'] = $this->participante;
        $dataHeader['title'] = ' - ENVIAR COMPOSICAO';

        if ($this->participante) {
            redirect("/enredo/participante");
        } else {
            if (strtotime($date1) < strtotime($date2)) {
                if ($this->input->post('participar')) {

                    if ($_FILES['file']['size'] > 1000000) {
                        $this->load->view('header_view');
                        echo "<div id='erro'>";
                        echo "<div class='overlay'>";
                        echo "<div class='container enredos'>";
                        echo "<div class='row login'>";
                        echo "<div class='col-sm-6 col-sm-offset-3'>";
                        echo "<div class='panel panel-default'>";
                        echo "<div class='panel-heading'>";
                        echo "<h3 class='panel-title'>Tamanho máximo excedido</h3>";
                        echo "</div>";
                        echo "<div class='panel-body'>";
                        echo "<p>O tamanho da imagem superou o tamanho permitido.</p>";
                        echo "<p><a class='btn btn-default' href='javascript:history.go(-1);'>voltar</a></p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        $this->load->view('footer_view');

                        exit;
                    }
                    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                        $file['allowed'] = array('jpg', 'png');
                        $file['filename'] = $_FILES['file']['name'];
                        $file['tempname'] = $_FILES['file']['tmp_name'];
                        $file['extension'] = pathinfo($file['filename'], PATHINFO_EXTENSION);

                        if (!in_array(strtolower($file['extension']), $file['allowed'])) {
                            echo "<div class='alert'>Esta extensão de arquivo não é permitida.</div>";
                            echo "<a href='javascript:history.go(-1);'>voltar</a>";
                            exit;
                        }

                        $file['dir'] = 'uploads/';

                        $filename = $file['dir'] . time() . "-" . $file['filename'];

                        if (move_uploaded_file($file['tempname'], $filename)) {
                            $data['imagemIlustrativa'] = $filename;
                        }
                    }

                    $data['tituloEnredo'] = addslashes($this->input->post('titulo-enredo'));
                    $data['compositor'] = addslashes($this->input->post('compositor'));
                    $data['matricula'] = addslashes($this->input->post('matricula'));
                    $data['enredo'] = addslashes($this->input->post('enredo'));
                    $data['aceite'] = addslashes($this->input->post('aceite'));
                    $data['created_at'] = date("Y-m-d H:i:s");

                    $this->load->model("enredo_model");
                    $result = $this->enredo_model->addEnredo($data);

                    #EMAIL
                    
                    $message  = "<body style='-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background: #ccc; font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 0; width: 100% !important;'>";
                    $message .= "<table cellpadding='0' cellspacing='0' border='0' class='background' style='background: #ccc; border-collapse: collapse; line-height: 100% !important; margin: 0; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 0; width: 100% !important;'>";
                    $message .= "   <tr>";
                    $message .= "       <td valign='top' style='border-collapse: collapse;'>";
                    $message .= "           <table cellpadding='0' cellspacing='0' border='0' align='center' class='container' style='background: #fff; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 600px;'>";
                    $message .= "               <tr>";
                    $message .= "                   <td valign='top' style='border-collapse: collapse;'>";
                    $message .= "                       <table cellpadding='0' cellspacing='0' border='0' align='center' class='header' style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>";
                    $message .= "                           <tr>";
                    $message .= "                               <td valign='top' style='border-collapse: collapse;'><img src='" . base_url() . "assets/img/header_email.jpg' style='-ms-interpolation-mode: bicubic; display: block; outline: none; text-decoration: none;'></td>";
                    $message .= "                           </tr>";
                    $message .= "                       </table>";
                    $message .= "                       <table cellpadding='0' cellspacing='0' border='0' align='center' class='spacer-20' style='border-collapse: collapse; height: 20px; mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>";
                    $message .= "                           <tr>";
                    $message .= "                               <td valign='top' style='border-collapse: collapse;'></td>";
                    $message .= "                           </tr>";
                    $message .= "                       </table>";
                    $message .= "                       <table cellpadding='0' cellspacing='0' border='0' align='center' class='content' style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 520px;'>";
                    $message .= "                           <tr>";
                    $message .= "                               <td valign='top' style='border-collapse: collapse; vertical-align: top;'>";
                    $message .= "                                   <table cellpadding='0' cellspacing='0' border='0' align='center' style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>";
                    $message .= "                                       <tr>";
                    $message .= "                                           <td valign='top' style='border-collapse: collapse; vertical-align: top;'>";
                    $message .= "                                               <h2 style='color: #ffa400 !important; font-family: Arial, sans-serif; line-height: 150%;'>III Concurso de Carnaval</h2>";
                    $message .= "                                               <p style='font-family: Arial, sans-serif; font-size: 12px; line-height: 150%; margin: 1em 0; padding: 0;'>A sua composi&ccedil;&atilde;o foi enviada para aprova&ccedil;&atilde;o.</p>";
                    $message .= "                                               <p style='font-family: Arial, sans-serif; font-size: 12px; line-height: 150%; margin: 1em 0; padding: 0;'>Assim que aprovada, estar&aacute; dispon&iacute;vel para vota&ccedil;&atilde;o.</p>";
                    $message .= "                                               <p style='font-family: Arial, sans-serif; font-size: 12px; line-height: 150%; margin: 1em 0; padding: 0;'>&nbsp;</p>";
                    $message .= "                                               <p style='font-family: Arial, sans-serif; font-size: 12px; line-height: 150%; margin: 1em 0; padding: 0;'><strong>Comunica&ccedil;&atilde;o e Marketing</strong></p>";
                    $message .= "                                               <p style='font-family: Arial, sans-serif; font-size: 12px; line-height: 150%; margin: 1em 0; padding: 0;'><strong>CAIA NA FOLIA CONOSCO!</strong></p>";
                    $message .= "                                           </td>";
                    $message .= "                                       </tr>";
                    $message .= "                                   </table>";
                    $message .= "                               </td>";
                    $message .= "                           </tr>";
                    $message .= "                       </table>";
                    $message .= "                       <table cellpadding='0' cellspacing='0' border='0' align='center' class='spacer-20' style='border-collapse: collapse; height: 20px; mso-table-lspace: 0pt; mso-table-rspace: 0pt;'>";
                    $message .= "                           <tr>";
                    $message .= "                               <td valign='top' style='border-collapse: collapse;'></td>";
                    $message .= "                           </tr>";
                    $message .= "                       </table>";
                    $message .= "                       <table cellpadding='0' cellspacing='0' border='0' align='center' class='footer' style='border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 600px;'>";
                    $message .= "                           <tr>";
                    $message .= "                               <td valign='top' style='background-color: #ffa400; border-collapse: collapse; color: #fff; font-family: Arial, sans-serif; font-size: 10px; font-weight: bold; height: 50px; text-align: center; vertical-align: middle;'>2018</td>";
                    $message .= "                           </tr>";
                    $message .= "                       </table>";
                    $message .= "                   </td>";
                    $message .= "               </tr>";
                    $message .= "           </table>";
                    $message .= "       </td>";
                    $message .= "   </tr>";
                    $message .= "</table>";
                    $message .= "</body>";

                    $headers = "From: contato@carnaval.com.br" . "\r\n";
                    $headers .= "Reply-To: contato@carnaval.com.br" . "\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    $recipients = $this->session->userdata("email");

                    mail($this->session->userdata('email'), '[CARNAVAL] Voce esta participando!', $message, $headers);

                    $this->load->view('header_view');
                    $this->load->view('menu_view', $dataHeader);
                    $this->load->view('enredo_enviado_view');
                    $this->load->view('footer_view');
                } else {
                    $this->load->view('header_view');
                    $this->load->view('menu_view', $dataHeader);
                    $this->load->view('enredo_enviar_view');
                    $this->load->view('footer_view');
                }
            } else {
                $this->load->view('header_view');
                $this->load->view('menu_view', $dataHeader);
                $this->load->view('enredo_votacao_encerrada_view');
                $this->load->view('footer_view');
            }
        }
    }

    public function votacao() {
        $date1 = $this->today;
        $date2 = $this->encerramento;
        $data['participacao'] = $this->participante;
        $data['title'] = ' - VOTACAO';

        $dataBody['encerramento'] = $this->encerramento;
        $dataBody['data_resultado'] = $this->resultado;

        if (strtotime($date1) < strtotime($date2)) {
            $this->load->model("enredo_model");
            $data['resultados'] = $this->enredo_model->listApproved();

            if ($data['resultados'] == false) {
                $this->load->view('header_view');
                $this->load->view('menu_view', $data);
                $this->load->view('enredo_votacao_indisponivel_view', $data);
                $this->load->view('footer_view');
            } else {
                $this->load->view('header_view');
                $this->load->view('menu_view', $data);
                $this->load->view('enredo_votacao_view', $data);
                $this->load->view('footer_view');
            }
        } else {
            $this->load->view('header_view');
            $this->load->view('menu_view', $data);
            $this->load->view('enredo_votacao_encerrada_view', $dataBody);
            $this->load->view('footer_view');
        }
    }

    public function ranking() {
        $date1 = $this->today;
        $date2 = $this->encerramento;
        $data['participacao'] = $this->participante;
        $data['title'] = ' - RANKING';

        $this->load->model("enredo_model");
        $data['resultados'] = $this->enredo_model->listApproved('total desc');

        if ($data['resultados'] == false) {
            $this->load->view('header_view');
            $this->load->view('menu_view', $data);

            $this->load->view('enredo_votacao_indisponivel_view', $data);
            $this->load->view('footer_view');
        } else {
            $this->load->view('header_view');
            $this->load->view('menu_view', $data);

            $this->load->view('enredo_ranking_view', $data);
            $this->load->view('footer_view');
        }
    }

    public function like($idEnredo) {
        $date1 = date("Y-m-d");
        $date2 = $this->encerramento;

        if (strtotime($date1) < strtotime($date2)) {
            if (!isset($idEnredo) || is_null($this->session->userdata("matricula"))) {
                $this->load->view('header_view');
                $this->load->view('errolike_view');
                $this->load->view('footer_view');
            } else {
                $data['matricula'] = $this->session->userdata("matricula");
                $data['idEnredo'] = $idEnredo;

                $this->load->model("voto_model");
                $this->voto_model->votar($data['idEnredo']);
            }
        } else {
            $this->load->view('header_view');
            $this->load->view('enredo_votacao_encerrada_view');
            $this->load->view('footer_view');
        }
    }

    public function participante() {
        $data['participacao'] = $this->participante;

        $this->load->view('header_view');
        $this->load->view('menu_view', $data);
        $this->load->view('enredo_participante_view');
        $this->load->view('footer_view');
    }

}
