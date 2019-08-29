<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ankete
 *
 * @author veljko
 */
class Ankete extends CI_Controller
{
  public function __construct()
  {
        parent::__construct();
     //   if (!$this->session->has_userdata('user')) {
         if (!$this->session->has_userdata('user') || $this->session->userdata('user')->statusPrijave != "registrovan") {
            redirect('Login');
        }
        
         $this->load->model('RecenzentModel');
         $this->load->model('AnketaModel');
         $this->load->database();
         $this->load->library ( 'form_validation' );
       
       
    }
    public function index(){
        $anketeTotal = $this->AnketaModel->sveAnkete();
        
        $data=['middle'=>'middle/admin_kreiranje_ankete',
            'middle_podaci'=>['anketeTotal'=>$anketeTotal]];
        $this->load->view('basicTemplate',$data);
        
    }
    
    public function kreirajAnketu()
    {
        $naziv = $this->input->post('naziv');
        $novaAnketa = $this->AnketaModel->kreiranjeAnkete($naziv);
        $this->index();
    }
    
    public function anketaDetalji()
    {
        $idAnketa = $this->input->get('id');
        $anketa = $this->AnketaModel->anketaDetalj($idAnketa);
        $recenzenti = $this->AnketaModel->recezentiTotal();
        $anketaPitanja = $this->AnketaModel->anketaDetaljPitanja($idAnketa);
        $this->load->view('middle/admin_anketa_detalji',
            ['anketa'=> $anketa, 'anketaPitanja'=>$anketaPitanja, 'recenzenti'=>$recenzenti]);
        
    }
    
    
    public function anketaPomocna($idAnketa)
    {
        $anketa = $this->AnketaModel->anketaDetalj($idAnketa);
        $anketaPitanja = $this->AnketaModel->anketaDetaljPitanja($idAnketa);
        $recenzenti = $this->AnketaModel->recezentiTotal();
        $this->load->view('middle/admin_anketa_detalji',
            ['anketa'=> $anketa, 'anketaPitanja'=>$anketaPitanja, 'recenzenti'=>$recenzenti]);
    }
    public function dodavanjeSlobodnogPitanja()
    {
        $idAnketaS = $this->input->post('idAnketaS');
        $pitanjeS = $this->input->post('pitanjeS');
        $dodavanjeSlobodnogPitanja = $this->AnketaModel->dodajSlobodnoPitanje($idAnketaS,$pitanjeS);
       $this->anketaPomocna($idAnketaS);
    }
    
    public function dodavanjeRadioPitanja()
    {
        $idAnketa = $this->input->post('idAnketa');
        $pitanje = $this->input->post('pitanje');
        $odgovor1 = $this->input->post('odgovor1');
        $odgovor2 = $this->input->post('odgovor2');
        $odgovor3 = $this->input->post('odgovor3');
        $odgovor4 = $this->input->post('odgovor4');
        
        $dodavanjeRadioPitanja=$this->AnketaModel->dodajRadioPitanje($idAnketa,$pitanje,$odgovor1,$odgovor2,$odgovor3,$odgovor4);
        $this->anketaPomocna($idAnketa);
     
    }
    
    public function zakljucavanjeAnkete()
    {
        $idAnketa = $this->input->post('idAnketa');
        $zakljucavanje = $this->AnketaModel->zakljucajAnketu($idAnketa);
        $this->anketaPomocna($idAnketa);
    }
    
    public function dodelaAnkete()
    {
        $idKorisnik = $this->input->post('idKorisnik');
        $idAnketa = $this->input->post('idAnketa');
        $dodela = $this->AnketaModel->dodela($idAnketa,$idKorisnik);
        $this->anketaPomocna($idAnketa);
        
    }
    
    public function mojeAnkete()
    {
        $idKorisnik = $this->session->userdata('user')->idKorisnik;
        $mojeAnkete = $this->AnketaModel->mojaAnketa($idKorisnik);
        $data=['middle'=>'middle/recenzent_anketa',
            'middle_podaci'=>['mojeAnkete'=>$mojeAnkete]];
        $this->load->view('basicTemplate',$data);
    }
    
    public function recenzentAnketaDetalji()
    {
        $idKorisnik = $this->session->userdata('user')->idKorisnik;
        $idAnketa = $this->input->get('id');
        $anketa = $this->AnketaModel->anketaDetalj($idAnketa);
        $anketaPitanja = $this->AnketaModel->anketaDetaljPitanja($idAnketa);
        $mojeAnkete = $this->AnketaModel->mojaAnketa($idKorisnik);
        $this->load->view('middle/recenzent_anketa_detalji',
            ['anketa'=> $anketa, 'anketaPitanja'=>$anketaPitanja, 'mojeAnkete'=>$mojeAnkete]);
        
    }
    
    public function predajAnketu()
    {     
     $idAnketaPopunjena= $this->input->post('radi');
     echo $idAnketaPopunjena;
     $key = [];
    $post = [];
   $post=$_POST;
   
        foreach($post as $key => $odgovor)
        {   
           $mykey = $key;
         if($mykey=='radi') {
              
          } else {
            $name= explode("/", $mykey);
            $idAnketuRadi = $name[1];
            $idAnketaPitanje = $name[2];
          
            $snimanjeOdgovora = $this->AnketaModel->snimanjeOdgovora($idAnketuRadi,$idAnketaPitanje,$odgovor);
           }
        }
        
       $popunjena = $this->AnketaModel->PopunjeneAnkete($idAnketaPopunjena);
        $idKorisnik = $this->session->userdata('user')->idKorisnik;
        $mojeAnkete = $this->AnketaModel->mojaAnketa($idKorisnik);
        $uspeh = "Hvala na vremenu koji ste odvojili da odgovorite na pitanja.";
        $data=['middle'=>'middle/recenzent_anketa',
            'middle_podaci'=>['mojeAnkete'=>$mojeAnkete, 'uspeh' => $uspeh]];
        $this->load->view('basicTemplate',$data);
   }
            
            
}