<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Reset_lozinke
 *
 * @author Radja
 */
class Reset_lozinke extends CI_Controller {
    
    public function index() {
        $data["middle"] = "middle/reset_lozinke";
        $data['middle_podaci'] = ['forma' => true];
        $this->load->view ( 'basicTemplate', $data );
    }

    public function send() {
        $this->load->library ( 'form_validation' );
        $this->form_validation->set_rules ("korIme", "Korisnicko ime", "trim|required");
        if ( $this->form_validation->run() == FALSE) {
            redirect('//');
        }
        $this->load->model("ResetLozinkeModel");
        $poruka = $this->ResetLozinkeModel->sendNewPasswordMail($this->input->post('korIme'));
        $data=['middle'=>'middle/reset_lozinke',
            'middle_podaci'=>['poruka'=>$poruka]];        
        $this->load->view ( 'basicTemplate', $data );
    }
    
}
