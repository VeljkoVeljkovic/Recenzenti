<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Recenzent
 *
 * @author Obuka
 */
class Recenzent extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
     //   if (!$this->session->has_userdata('user')) {
          if (!$this->session->has_userdata('user') && $this->session->userdata('user')->statusPrijave != "registrovan") {
            redirect('Login');
        }
         $this->load->database();
         $this->load->library ( 'form_validation' );
         $this->load->library ( 'form_validators/recezent_validator' );
        $this->load->model('RecenzentModel');
         $this->load->model('ProjektiModel');
          $this->load->model('RegistrationModel');
       
    }

    public function index(){
      $mojiProjekti=$this->ProjektiModel->mojProjekat($this->session->userdata('user')->idKorisnik);
        $data=['middle'=>'middle/moji_projekti',
            'middle_podaci'=>['mojiProjekti'=>$mojiProjekti]];
        $this->load->view('basicTemplate',$data);
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect('Login');
    }
    
    
    
    
    public function prikazi(){
        $this->dohvatiPoruke($this->input->get('id'));      
    }
    
    public function dodaj(){
         $id= $this->input->post('id');
         $tekst= $this->input->post('tekst');
         $this->ConversationModel->dodajPoruku($id, $tekst, $this->session->user->idUser);
         $this->dohvatiPoruke($id);
    }
    
    
    public function users(){
        $pocetni_user=0;
        if($this->uri->segment(3)){
            $pocetni_user=$this->uri->segment(3);
        }
       // $limit=10; ne treba da se ovde definise, vec je bolje da se definise na nisou fajla
        $users=$this->RecenzentModel
                ->dohvatiSveUsere($pocetni_user,LIMIT_PO_STRANICI);
        
        $this->load->library('pagination');
        
        $config=$this->config->item('pagination');
        
        $config['base_url'] = site_url("Recenzent/users");
        $config['total_rows'] = $this->RecenzentModel->BrojUsera();
        $config['per_page'] = LIMIT_PO_STRANICI;
        $this->pagination->initialize($config);
        
        $data['middle']='middle/user_users';
        $data['middle_podaci']=['users'=>$users];
        $this->load->view('basicTemplate', $data);
    }
    
    
    public function preuzmiSliku(){
        $slika=$this->session->userdata('user')->slika;
        $this->load->helper('download');
        force_download('./uploads/'.$slika, NULL);
    }
    
    public function postaviProfilnu(){
        $username=$this->session->userdata('user')->korIme;
        $config_upload=$this->config->item('upload');
        $config_upload['upload_path']= './uploads/'.$username;
        
        if(!is_dir($config_upload['upload_path'])) 
            mkdir($config_upload['upload_path'], 0777, TRUE);
        // ako zelite da nazovete sliku na osnovu ID usera
        //$config['file_name']='user_'.$this->session->userdata('user')->idUser;
        
        $this->load->library('upload', $config_upload);
        
        if ( !$this->upload->do_upload('slika'))
        {           
            $data['middle_podaci']= ['error' => $this->upload->display_errors()];
        }
        else
        {   
            $this->RecenzentModel->izmeniSliku(
                        $username,
                        $this->upload->data('file_name'));
            
            $this->session->set_userdata('user',
                    $this->RecenzentModel->dohvatiUsera($username));
        }
        
        $data['middle']='middle/recenzent_home';
        $this->load->view('basicTemplate', $data);
    }
    
   public function dodajSliku(){
        $username=$this->session->userdata('user')->korIme;
        $config_upload=$this->config->item('upload');
        $config_upload['upload_path']= './uploads/'.$username;
        
        if(!is_dir($config_upload['upload_path'])) 
            mkdir($config_upload['upload_path'], 0777, TRUE);
       
        $this->load->library('upload', $config_upload);
        
        if ( !$this->upload->do_upload('slika'))
        {
            $data['middle_podaci']= ['errorSlika' => $this->upload->display_errors()];
        }
        
        $data['middle']='middle/recenzent_home';
        $this->load->view('basicTemplate', $data);
    }
    
    public function obrisi_sliku(){
        $slika=$this->input->get('slika');
        $username=$this->session->userdata('user')->korIme;
        $putanja='./uploads/'.$username."/".$slika;  
        unlink($putanja); 
        
        redirect("Recenzent/index");
    }
    public function promenaPodatakaRecenzenta() {
        
        $id = $this->session->userdata('user')->idKorisnik;
        $recenzenti = $this->RecenzentModel->RecenzentPodaci($id);
        $sveOblasti = $this->RegistrationModel->sveOblastiT();
        $data=['middle'=>'middle/recenzent_home',
            'middle_podaci'=>['recenzenti'=>$recenzenti, 'sveOblasti'=>$sveOblasti]];
        $this->load->view('basicTemplate',$data);
    }
    
    public function promenaPodataka ( ) {
//        if ( $this->recezent_validator->run ($this) == FALSE ) {
//             $this->index ( );
//             echo $this->input->post ( "trenutnaFirma" );// TODO da li treba ova linija ???
//            
//        } else {
            
            $this->RecenzentModel->register ( 
                $this->input->post ( "korIme" ),
                $this->input->post ( "mejl" ),      
                $this->input->post ( "ime" ),
                $this->input->post ( "prezime" ),
                $this->input->post ( "nacionalnost" ),
                $this->input->post ( "zemlja" ),
                $this->input->post ( "NIO" ),
                $this->input->post ( "trenutnaFirma" ),
                $this->input->post ( "naucnoZvanje" ),
                $this->input->post ( "angazovanje" ),
                $this->input->post ( "oblastiStrucnosti" ),
                $this->input->post ( "mejl" ),
                $this->input->post ( "adresa" ),
                $this->input->post ( "vebStranica" )
               
           );
              $username=$this->session->userdata('user')->korIme;
              $this->session->set_userdata('user',
              $this->RecenzentModel->dohvatiUsera( $username));
              redirect ( "/Recenzent" );
   //    }
      
    }
    
    public function sviRecenzenti() 
    {
        $recenzenti = $this->RecenzentModel->recezentiTotal();
        $data=['middle'=>'middle/admin_svi_recenzenti',
            'middle_podaci'=>['recenzenti'=>$recenzenti]];
        $this->load->view('basicTemplate',$data);
    }
    
    public function angazovanjeRecenzenta()
    {
        $projekti = $this->ProjektiModel->projektitotal();
        $angazovanje = $this->RecenzentModel->angazovanostRecenzenta($this->input->get('id'));
        $recenzent = $this->RecenzentModel->RecenzentPodaci($this->input->get('id'));
         $this->load->view('middle/admin_recenzent_detalji',
            ['angazovanje'=> $angazovanje, 'projekti'=>$projekti,'recenzent'=>$recenzent]);
    }
    
    public function promenaStatusPrijave()
    {
       $idRecenzent = $this->input->get('idRecenzent'); 
       $status = $this->input->get('status'); 
       $promenjenStatus = $this->RecenzentModel->promenaStatusaPrijave($idRecenzent, $status);
       redirect('Administrator');
    }
 
}
