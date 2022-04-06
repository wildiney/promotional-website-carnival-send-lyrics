<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler(false);
    }

    public function index() {
        $message = "<p style='font-size:18px; font-family:Arial,sans-serif;'><strong>CARNAVAL 2017</strong></p>";
        $message .= "<p style='font-size:12px; font-family:Arial,sans-serif;'>O seu samba-enredo foi enviado para aprovação.</p>";
        $message .= "<p style='font-size:12px; font-family:Arial,sans-serif;'>Assim que aprovado, estará disponível para votação.</p>";

        $headers = 'From: contato@carnavalna.com.br' . "\r\n" .
                'Reply-To: contato@carnavalna.com.br' . "\r\n" .
                "MIME-Version: 1.0" . "\r\n" .
                "Content-type: text/html; charset=UTF-8" . "\r\n" .
                'Date:' . date('r');



        if (mail('wfpimentel@company.com', 'Teste', $message, $headers)) {
            print('Funcionou');
        } else {
            print('Nao Funcionou!');
        }
    }

    public function enviar() {
        include ("Mail.php");
        include ("Mail/mime.php");

        $recipients = 'contato@carnavalna.com.br';

        $headers = array(
                    'From' => 'contato@carnavalna.com.br', # O 'From' é *OBRIGATÓRIO*.
                    'To' => 'wfpimentel@company.com',
                    'Subject' => 'Teste',
                    'Date' => date('r')
        );

        $crlf = "\r\n";

        $text = 'Teste texto';
        $html = "<HTML><BODY><font color=blue>$text</font></BODY></HTML>";


        $mime = new Mail_mime($crlf);

        $mime->setHTMLBody($html);


        $body = $mime->get();
        $headers = $mime->headers($headers);

        $params = array(
                    'auth' => true, # Define que o SMTP requer autenticação.
                    'host' => '', # Servidor SMTP
                    'username' => '', # Usuário do SMTP
                    'password' => '' # Senha do seu MailBox.
        );

        $mail_object = & Mail::factory('smtp', $params);

        $result = $mail_object->send($recipients, $headers, $body);
        if (PEAR::IsError($result)) {
            echo "ERRO ao tentar enviar o email. (" . $result->getMessage() . ")";
        } else {
            echo "Email enviado com sucesso!";
        }
    }

}
