<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Stanje_prijave
 *
 * @author Radja
 */
class Stanje_prijave extends CI_Controller {
   
    public function index ( ) {
        $recezentId = (int)$this->input->get('id');
        if (!$recezentId) {
            redirect('Login');
        }
        $this->load->model('RecenzentModel');
        $statusPrijave = $this->RecenzentModel->dohvatiRecezentaPoId($recezentId);
        $data["middle"] = "middle/stanje_prijave";
        $data['middle_podaci']=['statusPrijave' => $statusPrijave];
        $this->load->view ( 'basicTemplate', $data );
    }
    
}
