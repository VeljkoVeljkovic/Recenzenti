<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if ($this->session->has_userdata('user')) {
//      if (!$this->session->has_userdata('user') && $this->session->userdata('user')->statusPrijave != "registrovan") {
//            redirect('Login');
       }
        $this->load->model('RegistrationModel');
        $this->load->library ( 'form_validation' );
        $this->load->library ( 'form_validators/recezent_validator' );
        
    }

    public function index ( ) {
       
//        $data["middle"] = "middle/registration";
//        
//        $this->load->view ( 'basicTemplate', $data );
         $sveOblasti = $this->RegistrationModel->sveOblastiT();
        $data=['middle' => 'middle/registration', 'middle_podaci'=>['sveOblasti'=>$sveOblasti]];
        $this->load->view ( 'basicTemplate', $data );
    }
    
    public function register ( ) {
        if ( $this->recezent_validator->run ($this) == FALSE ) {
            $this->index ( );
            return;
        }
        $this->load->database ( );
        /**
         * RegistrationModel
         */
        $this->load->model ( "RegistrationModel" );
        try {
            $this->db->trans_start();
            $recezentId = $this->RegistrationModel->register ( 
                $this->input->post ( "ime" ),
                $this->input->post ( "prezime" ),
                $this->input->post ( "mejl" ), 
                $this->input->post ( "korIme" ),
                $this->input->post ( "lozinka" ), 
                $this->input->post ( "zemlja" ),
                $this->input->post ( "nacionalnost" ),
                $this->input->post ( "NIO" ),
                $this->input->post ( "trenutnaFirma" ),
                $this->input->post ( "naucnoZvanje" ),
                $this->input->post ( "angazovanje" ),
                $this->input->post ( "oblastiStrucnosti" ),
                $this->input->post ( "telefon" ),
                $this->input->post ( "adresa" ),
                'recenzent',
                $this->input->post ( "vebStranica" )
            );
            if ($recezentId) {
                $this->RegistrationModel->sacuvajBiografiju($recezentId);
            }
            $this->db->trans_complete();
        } catch (Exception $e) {
            $this->db->trans_rollback();
            $this->index ( );
            return;
        }
        redirect ( "/Stanje_prijave?id=" . $recezentId );
    }
    
//    public function ageValidation ( $string, $minimumAge ) {
//        $dateOfBirth = new DateTime ( $string );
//        $now = new DateTime ( );
//        
//        $this->form_validation->set_message ( "ageValidation", "User must at least " . $minimumAge . " years old" );
//        
//        return $now->diff ( $dateOfBirth )->y > (int) $minimumAge ? true : false;
//    }
    
}
