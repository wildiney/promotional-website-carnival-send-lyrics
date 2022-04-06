<?php
/**
 * PHP Version 7
 * Header
 *
 * @package MyPackage
 * @author  Fernando Di Masi <wfpimentel@company.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link    http://www.hashbangcode.com/
 */

defined('BASEPATH') || exit('No direct script access allowed');
/**
 * Admin Login Class
 *
 * @package MyPackage
 * @author  Fernando Di Masi <wfpimentel@company.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link    http://www.hashbangcode.com/
 */
class AdminLogin extends CI_Controller {
    /**
     * Admin Construct
     * @return mixed
     * @since 1.0.0
     */
    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler(false);
        }

    public function index() {
        if ($this->input->post('login')) {
            $data['emailAdmin'] = $this->input->post("email");
            $data['senhaAdmin'] = $this->input->post("password");

            $this->load->model("admin_model");
            $resultado = $this->admin_model->logar($data);

            if ($resultado) {
                foreach ($resultado as $row) {
                    $data = array('nome' => $row->nomeAdmin, 'email' => $row->emailAdmin, 'level' => $row->levelAdmin, 'logged' => true);
                }

                $this->session->set_userdata($data);
                redirect('/AdminDashboard/');
            } else {
                redirect('login/erro');
            }
        } else {
            $this->load->view('header_view');
            $this->load->view('admin/form_login_view');
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
        $this->session->sess_destroy();

        /**
         * Exec
         */
        redirect('/', 'refresh');
    }

    public function erro(){
        $this->load->view('header_view');
        $this->load->view('erro_view');
        $this->load->view('footer_view');
    }
}
