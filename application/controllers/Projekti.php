<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Projekti
 *
 * @author veljko
 */
class Projekti extends CI_Controller {
   public function __construct() {
        parent::__construct();
       // if (!$this->session->has_userdata('user')) {
         if (!$this->session->has_userdata('user') || $this->session->userdata('user')->statusPrijave != "registrovan") {
            redirect('Login');
        }
       
        $this->load->model('ProjektiModel');
         $this->load->model('RecenzentModel');
        $this->load->database();
        $this->load->library ( 'form_validation' );
        $this->load->helper(array('form', 'url'));
        
    }

    public function index(){
      //  $data['middle']='middle/moji_projekti';
     //   $this->load->view('basicTemplate', $data);
        
    }
    
    public function mojiProjekti() {
        
        $mojiProjekti=$this->ProjektiModel->mojProjekat($this->session->userdata('user')->idKorisnik);
        $data=['middle'=>'middle/moji_projekti',
            'middle_podaci'=>['mojiProjekti'=>$mojiProjekti]];
        $this->load->view('basicTemplate',$data);
    }
    
    public function sviProjekti()
    {
        $sviProjekti = $this->ProjektiModel->projektitotal();
        $data=['middle'=>'middle/admin_svi_projekti',
            'middle_podaci'=>['sviProjekti'=>$sviProjekti]];
        $this->load->view('basicTemplate',$data);
    }
    
     public function sviRecenzenti()
    {
        $sviRec = $this->ProjektiModel->Recenzentitotal();
        $data=['middle'=>'middle/admin_svi_recenzenti',
            'middle_podaci'=>['sviProjekti'=>$sviProjekti]];
        $this->load->view('basicTemplate',$data);
    }
    public function sviPozivi() {
         $sviPozivi = $this->ProjektiModel->pozivitotal();
         $poziviSaKomentarima = $this->ProjektiModel->poziviSaKomentarima();
        $data=['middle'=>'middle/admin_pozivi',
            'middle_podaci'=>['sviPozivi'=>$sviPozivi, 'poziviSaKomentarima' => $poziviSaKomentarima]];
        $this->load->view('basicTemplate',$data);
        
    }
    public function pozivIPitanja()
    {
       $svaPitanja =  $this->ProjektiModel->pitanjapoziv($this->input->get('id'));
       $sviPozivi = $this->ProjektiModel->podacipoziv($this->input->get('id'));
       $poziviSaKomentarima = $this->ProjektiModel->poziviSaKomentarima();
        $this->load->view('middle/admin_pozivi_dodavanje_pitanja',
            ['svaPitanja'=> $svaPitanja, 'sviPozivi' => $sviPozivi, 'poziviSaKomentarima'=>$poziviSaKomentarima]);
       
    }
    
    public function kreirajPoziv() 
    {
        $this->ProjektiModel->kreiranjePoziva($this->input->post ( "naziv" ));
        $sviPozivi = $this->ProjektiModel->pozivitotal();
        $poziviSaKomentarima = $this->ProjektiModel->poziviSaKomentarima();
        $data=['middle'=>'middle/admin_pozivi',
        'middle_podaci'=>['sviPozivi'=>$sviPozivi, 'poziviSaKomentarima' => $poziviSaKomentarima]];
        $this->load->view('basicTemplate',$data);
    }
    
    public function dodavanjePitanjaZaPoziv()
    {
       $id =  $this->input->post ( "idPoziv" );
       $pitanje =  $this->input->post ( "pitanje" );
       $this->ProjektiModel->dodavanjePitanja($id, $pitanje); 
       $svaPitanja =  $this->ProjektiModel->pitanjapoziv($id);
       $sviPozivi = $this->ProjektiModel->podacipoziv($id);
        $this->load->view('middle/admin_pozivi_dodavanje_pitanja',
            ['svaPitanja'=> $svaPitanja, 'sviPozivi' => $sviPozivi]);
           
    }
    
    public function kreiranjeProjekta()
    {
        $sviPozivi = $this->ProjektiModel->poziviTotal();
     //   $sviRukovodioci = $this->ProjektiModel->rukovodiociTotal();
  //      $sveOblasti = $this->ProjektiModel->oblastiTotal();
        $data=['middle'=>'middle/admin_projekat', 'middle_podaci'=>['sviPozivi'=>$sviPozivi]];
        $this->load->view('basicTemplate',$data);
    }
     public function kreirajProjekat() 
    {
        $this->form_validation->set_rules ( "nazivProjekta", "NazivProjekta", "required");
        $this->form_validation->set_rules ( "rukovodiocProjekta", "RukovodiocProjekta", "required");
        $this->form_validation->set_rules ( "NIORukovodioca", "NIORukovodioca", "required");
        $this->form_validation->set_rules ( "zvanjeRukovodioca", "ZvanjeRukovodioca", "required");
        $this->form_validation->set_rules ( "angazovanjeRukovodioca", "AngazovanjeRukovodioca", "required");
        $this->form_validation->set_rules ( "oblastProjekta", "OblastProjekta", "required");
        $this->form_validation->set_rules ( "odlukaProjekta", "OdlukaProjekta", "required");
      if ( $this->form_validation->run ( ) == FALSE ) {
            
            $data['middle']='middle/admin_projekat';
             $this->load->view('basicTemplate', $data);
            
       } else {   
                $date = date("Y-m-d");
                $this->ProjektiModel->kreiranjeProjekta ( 
                $this->input->post ( "nazivProjekta" ),
                $this->input->post ( "rukovodiocProjekta" ),
                $this->input->post ( "NIORukovodioca" ), 
                $this->input->post ( "zvanjeRukovodioca" ),
                $this->input->post ( "angazovanjeRukovodioca" ),
                $this->input->post ( "oblastProjekta" ),
                $date,
                $this->input->post ( "odlukaProjekta" ),
                $this->input->post ( "idPoziva" )
                
               
           );
                
                
                
       $nazivProjekta = $this->input->post ( "nazivProjekta" );
       $config_upload=$this->config->item('upload');
       $config_upload['upload_path']= './uploads/'.$nazivProjekta;          
             if(!is_dir($config_upload['upload_path'])) 
       mkdir($config_upload['upload_path'], 0777, TRUE);    
        $this->load->library('upload', $config_upload);
        $files = $_FILES;
        
     //   $this->upload->initialize($config_upload);
        $count = count($_FILES['slika']['name']);
        for($i=0; $i<$count; $i++)
                {
                $_FILES['slika']['name']= $files['slika']['name'][$i];
                $_FILES['slika']['type']= $files['slika']['type'][$i];
                $_FILES['slika']['tmp_name']= $files['slika']['tmp_name'][$i];
                $_FILES['slika']['error']= $files['slika']['error'][$i];
                $_FILES['slika']['size']= $files['slika']['size'][$i];
                //function defination below
                if ( !$this->upload->do_upload('slika'))
        {          
            $data['middle_podaci']= ['error' => $this->upload->display_errors()];
        }
                
                }
            
               
        $sviProjekti = $this->ProjektiModel->projektitotal();
        $data=['middle'=>'middle/svi_projekti',
            'middle_podaci'=>['sviProjekti'=>$sviProjekti]];
        $this->load->view('basicTemplate',$data);
                } 
          }
      
   
   public function dodavanjeRukovodiocaIOblasti()
   {
       $data=['middle'=>'middle/admin_rukovodioci_oblast_projekta'];
        $this->load->view('basicTemplate',$data);
   }
   public function rukovodiocProjekta() 
   {
       $ime = $this->input->post('ime');
       $prezime = $this->input->post('prezime');
       $this->ProjektiModel->dodajRukovodioca($ime, $prezime);
       redirect('Projekti/dodavanjeRukovodiocaIOblasti');
   }
   public function OblastProjekta() 
   {
       $naziv = $this->input->post('naziv');
       $this->ProjektiModel->dodajOblastProjekta($naziv);
       redirect('Projekti/dodavanjeRukovodiocaIOblasti');
   }
   
   public function detaljiProjekta()
   {
     $detaljiProjekta = $this->ProjektiModel->detaljiProjekat($this->input->get('id'));  
    $ocena = $this->ProjektiModel->ocene($this->input->get('id'));
    $recenzenti = $this->ProjektiModel->recenzentiNaProjektu($this->input->get('id'));
    $pitanja = $this->ProjektiModel->pitanjaZaPozivT($this->input->get('poziv'));
  $this->load->view('middle/admin_detalji_projekta', ['detaljiProjekta'=>$detaljiProjekta, 'ocena' => $ocena, 'recenzenti' =>  $recenzenti, 'pitanja'=>$pitanja]);
   
    
   }
   
   
   
   public function detaljiPomocna($id, $poziv,$idKorisnik) 
   {    
        $detaljiProjekta = $this->ProjektiModel->detaljiRecenzentovProjekat($id,$idKorisnik); 
        $ocena = $this->ProjektiModel->oceneIRecenzentiProjekta($id);
        $pitanja = $this->ProjektiModel->pitanjaZaPozivT($poziv);
        $this->load->view('middle/detalji_projekta', ['detaljiProjekta'=>$detaljiProjekta, 'ocena' => $ocena, 'pitanja'=>$pitanja]);
   }
   
   public function detalji() 
   {    
        $this->detaljiPomocna($this->input->get('id'));      
   }
   public function detaljiRecenzentovogProjekta() 
   {
        $this->detaljiPomocna($this->input->get('id')); 
       
   }
   
   public function detaljiT()
   {
       $projekat = $this->input->get('id');
       $poziv = $this->input->get('poziv');
       $idKorisnik = $this->input->get('idKorisnik');
       $detaljiProjekta = $this->ProjektiModel->detaljiRecenzentovProjekat($projekat, $idKorisnik); 
       $ocena = $this->ProjektiModel->oceneIRecenzentiProjekta($projekat);
       $pitanja = $this->ProjektiModel->pitanjaZaPozivT($poziv);
       $this->load->view('middle/detalji_projekta', ['detaljiProjekta'=>$detaljiProjekta, 'ocena' => $ocena, 'pitanja' => $pitanja]);
       
   }
   
   public function dodataOcena() {
       $id = $this->input->post('id');
       $ocenaP = $this->input->post('ocena');
       $ocenaProjekta = $this->input->post('ocenaProjekta');
       $idPrijava = $this->input->post('idPrijava');
       $idPitanja = $this->input->post('idPitanja');
       $idKorisnik = $this->input->post('idKorisnik');
       $poziv = $this->input->post('poziv');
       $ocena = $this->ProjektiModel->dodavanjeOcene($ocenaP, $ocenaProjekta, $idPitanja, $idPrijava);
      
//        $detaljiProjekta = $this->ProjektiModel->detaljiRecenzentovProjekat($id); 
//        $ocena = $this->ProjektiModel->oceneIRecenzentiProjekta($id);
//        $mojiProjekti=$this->ProjektiModel->mojProjekat($this->session->userdata('user')->idKorisnik);
//        
//        $this->load->view('middle/moji_projekti', ['detaljiProjekta'=>$detaljiProjekta, 'ocena' => $ocena, 'mojiProjekti'=>$mojiProjekti]);
       $this->detaljiPomocna($id, $poziv,$idKorisnik);
    }
    
    
     public function izmenaOcene()
     {
       $id = $this->input->post('id');
       $ocenaP = $this->input->post('ocena');
       $idPitanja = $this->input->post('idPitanja');
       $ocenaProjekta = $this->input->post('ocenaProjekta');
       $idPrijava = $this->input->post('idPrijava');
       $poziv = $this->input->post('poziv');
       $idKorisnik = $this->input->post('idKorisnik');
       $ocena = $this->ProjektiModel->izmenaOcena($ocenaP, $ocenaProjekta, $idPitanja,$idPrijava);
       $this->detaljiPomocna($id,$poziv,$idKorisnik);
     }
    
   public function zakljucavanjeOcene() {
         $idKorisnik = $this->session->userdata('user')->idKorisnik;
         $idOcena = $this->input->post('idOcena');
         $id = $this->input->post('idProjekta');
         $poziv = $this->input->post('poziv');
        $this->ProjektiModel->zakljucavanje($idOcena);
       $this->detaljiPomocna($id,$poziv,$idKorisnik);
       
   }
   public function brisanjeOcene()
   {
        $idKorisnik = $this->session->userdata('user')->idKorisnik;
         $idOcena = $this->input->post('idOcena');
         $id = $this->input->post('idProjekta');
         $poziv = $this->input->post('poziv');
         $this->ProjektiModel->brisanjeOceneR($idOcena);
         $this->detaljiPomocna($id, $poziv, $idKorisnik);
       
   }
   
   public function predavanjeIzvestaja()
    {
       $idKorisnik = $this->input->post('idKorisnik');
        $id = $this->input->post('idProjekta');
        $poziv = $this->input->post('poziv');
        $idPrijava = $this->input->post('idPrijava');
       $this->ProjektiModel->predatIzvestaj($idPrijava);
       $this->detaljiPomocna($id,$poziv,$idKorisnik);
    }
   
   public function dodelaProjekta()
   {
       $idProjekat = $this->input->post('idProjekat');
       $idKorisnik = $this->input->post('idKorisnik');
       $rokZaIzvestaj = $this->input->post('rokZaIzvestaj');
       $this->ProjektiModel->dodelaProjekata($idProjekat, $idKorisnik, $rokZaIzvestaj);
       $projekti = $this->ProjektiModel->projektitotal();
       $angazovanje = $this->RecenzentModel->angazovanostRecenzenta($idKorisnik);
       $recenzent = $this->RecenzentModel->RecenzentPodaci($idKorisnik);
         $this->load->view('middle/admin_recenzent_detalji',
            ['angazovanje'=> $angazovanje, 'projekti'=>$projekti, 'recenzent'=>$recenzent]);
   } 
   
   public function brisanjeProjekta()
   {
       $id = $this->input->get('id');
       $this->ProjektiModel->brisanjeProjekat($id);
     //  $this->sviProjekti();
        redirect('Projekti/sviProjekti');
   }
    public function promenaPodatakaProjekta(){
        $id = $this->input->get('id');
        $detaljiProjekta = $this->ProjektiModel->detaljiProjekat($id);
        $sviPozivi = $this->ProjektiModel->pozivitotal();
       $data=['middle'=>'middle/admin_izmena_projekta',
            'middle_podaci'=>['detaljiProjekta'=>$detaljiProjekta, 'sviPozivi'=>$sviPozivi]];
        $this->load->view('basicTemplate',$data);
    }
  
   public function izmenaPodatakaProjekta($id)
    {
       $id = $this->input->post('id');
       $detaljiProjekta = $this->ProjektiModel->detaljiProjekat($id);
        $sviPozivi = $this->ProjektiModel->pozivitotal();
       $data=['middle'=>'middle/admin_izmena_projekta',
            'middle_podaci'=>['detaljiProjekta'=>$detaljiProjekta, 'sviPozivi'=>$sviPozivi]];
        $this->load->view('basicTemplate',$data);
    }
    
    public function izmeniProjekat()
   {
       $this->form_validation->set_rules ( "nazivProjekta", "NazivProjekta", "required");
        $this->form_validation->set_rules ( "rukovodiocProjekta", "RukovodiocProjekta", "required");
        $this->form_validation->set_rules ( "NIOrukovodioc", "NIOrukovodioc", "required");
        $this->form_validation->set_rules ( "zvanjeRukovodioca", "ZvanjeRukovodioca", "required");
        $this->form_validation->set_rules ( "angazovanjeRukovodioca", "AngazovanjeRukovodioca", "required");
        $this->form_validation->set_rules ( "oblastProjekta", "OblastProjekta", "required");
        $this->form_validation->set_rules ( "odlukaProjekta", "OdlukaProjekta", "required");
      if ( $this->form_validation->run ( ) == FALSE ) {
            
            $data['middle']='middle/admin_projekat';
             $this->load->view('basicTemplate', $data);
            
       } else {   
                $date = date("Y-m-d");
                $this->ProjektiModel->izmenaProjekta ( 
                $this->input->post ( "nazivProjekta" ),
                $this->input->post ( "rukovodiocProjekta" ),
                $this->input->post ( "NIOrukovodioc" ), 
                $this->input->post ( "zvanjeRukovodioca" ),
                $this->input->post ( "angazovanjeRukovodioca" ),
                $this->input->post ( "oblastProjekta" ),
                $date,
                $this->input->post ( "odlukaProjekta" ),
                $this->input->post ( "idPoziva" ),
                $this->input->post ( "idProjekat" )
                
                
               
           );
                
                
                
       $nazivProjekta = $this->input->post ( "nazivProjekta" );
       $config_upload=$this->config->item('upload');
       $config_upload['upload_path']= './uploads/'.$nazivProjekta;          
             if(!is_dir($config_upload['upload_path'])) 
       mkdir($config_upload['upload_path'], 0777, TRUE);    
        $this->load->library('upload', $config_upload);
        $files = $_FILES;
        
     //   $this->upload->initialize($config_upload);
        $count = count($_FILES['slika']['name']);
        for($i=0; $i<$count; $i++)
                {
                $_FILES['slika']['name']= $files['slika']['name'][$i];
                $_FILES['slika']['type']= $files['slika']['type'][$i];
                $_FILES['slika']['tmp_name']= $files['slika']['tmp_name'][$i];
                $_FILES['slika']['error']= $files['slika']['error'][$i];
                $_FILES['slika']['size']= $files['slika']['size'][$i];
                //function defination below
                if ( !$this->upload->do_upload('slika'))
        {          
            $data['middle_podaci']= ['error' => $this->upload->display_errors()];
        }
                
                }
            
               
        $sviProjekti = $this->ProjektiModel->projektitotal();
      
        $data=['middle'=>'middle/svi_projekti',
            'middle_podaci'=>['sviProjekti'=>$sviProjekti]];
        $this->load->view('basicTemplate',$data);
                } 
   }
    public function brisanjeFile()
    {
        $file = $this->input->post('file');
        $id = $this->input->post('idProjekat');
 
if (is_readable($file) && unlink($file)) {
    $detaljiProjekta = $this->ProjektiModel->detaljiProjekat($id);
    $this->load->view('middle/direktorijum', ['detaljiProjekta'=>$detaljiProjekta]);
} else {
    echo "Doslo je do greske prilikom brisanja";
}
    }
    
   public function pretragaProjakata()
   {
       $naziv = $this->input->post('naziv');
       $oblastProjekta = $this->input->post('oblastProjekta');
       $sviProjekti= $this->ProjektiModel->pretragaProjekat($naziv, $oblastProjekta);
       $data=['middle'=>'middle/admin_svi_projekti',
            'middle_podaci'=>['sviProjekti'=>$sviProjekti]];
        $this->load->view('basicTemplate',$data);
   }
    
    
}
