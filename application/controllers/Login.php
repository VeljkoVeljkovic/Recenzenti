<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
//      if ($this->session->userdata('user')->statusPrijave == "registrovan")  {
//         
//            redirect('Recenzent');
//        }
    }

    public function index ( ) {
        $data["middle"] = "middle/login";
        $this->load->view ( 'basicTemplate', $data );
    }
    
    public function loginKor(){
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        if(empty($username)||empty($password))
        {
           redirect('Login');

        }
        $this->load->model('RecenzentModel');
        $postoji=$this->RecenzentModel->login($username, $password);

        if(!$postoji){
             $data["middle"]="middle/login";
            $data["middle_podaci"]=['poruka'=>'Neispravni podaci'];
            $this->load->view('basicTemplate', $data); } else {
            $this->session->set_userdata('user',
            $this->RecenzentModel->dohvatiUsera( $username)); 
           
           if($this->session->userdata('user')->statusPrijave == "stigla"){
            $data["middle"]="middle/login";
            $data["middle_podaci"]=['poruka'=>'Vaša registracija je u obradi'];
            $this->load->view('basicTemplate', $data);
            }
          if($this->session->userdata('user')->statusPrijave == "razmatra_se"){
            $data["middle"]="middle/login";
            $data["middle_podaci"]=['poruka'=>'Vaša registracija se razmatra molim vas sačekajte.'];
            $this->load->view('basicTemplate', $data);
            }
          if($this->session->userdata('user')->statusPrijave == "registrovan"){
            
            
            
             if($this->session->userdata('user')->rola == "recenzent") {
              redirect ('Recenzent');
           } else {
               redirect ('Administrator'); 
            }
        }
      
            }
    }
}
