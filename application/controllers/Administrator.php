<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Administrator
 *
 * @author Obuka
 */
class Administrator extends CI_Controller{
   public function __construct() {
        parent::__construct();
         if (!$this->session->has_userdata('user') || $this->session->userdata('user')->statusPrijave != "registrovan") {
            redirect('Login');
        }
        $this->load->model('ProjektiModel');
         $this->load->model('RecenzentModel');
         $this->load->database();
         $this->load->library ( 'form_validation' );
        $this->load->model('AdministratorModel');
       
    }
    //Na pocetnoj strani prikazuje recenzente za koje nije zavrsen proces registracije i projekte 
    //  za koje su recenzneti probili rok za izvestaj


    public function index(){
        $recezentiTotal = $this->RecenzentModel->neRegistrovaniRecenzenti();
        $rokZaIzvestaj = $this->RecenzentModel->angazovanostSvihRecenzenata();
        $data=['middle'=>'middle/administrator_home',
            'middle_podaci'=>['recezentiTotal'=>$recezentiTotal, 'rokZaIzvestaj'=>$rokZaIzvestaj]];
        $this->load->view('basicTemplate',$data);
        
    }
     public function logout(){
        $this->session->sess_destroy();
        redirect('Login');
    
     }
    
    
    
  
   
 
}


