<?php
	use \PHPMailer\PHPMailer\PHPMailer;
	use \PHPMailer\PHPMailer\Exception;
	use \PHPMailer\PHPMailer\SMTP;
	
	require("PHPMailer/src/Exception.php"); 
    require("PHPMailer/src/PHPMailer.php"); 
	require("PHPMailer/src/SMTP.php");
	require("PHPMailer/src/OAuth.php");
	require("PHPMailer/src/POP3.php"); 
        
        
class Obavestenja extends CI_Controller {
     public function __construct() {
        parent::__construct();
    //    if (!$this->session->has_userdata('user')) {
         if (!$this->session->has_userdata('user') || $this->session->userdata('user')->statusPrijave != "registrovan") {
            redirect('Login');
        }
         $this->load->database();
         $this->load->library('form_validation'); 
        $this->load->model('ObavestenjaModel');
        
    }

    public function index(){
        $data['middle']='middle/obavestenja';
        $this->load->view('basicTemplate', $data);
        
    }
    // Selektuje obavestenja na strani recenzenta koja su njemu posalata 
    public function mojaObavestenja() {
        
        $obavestenja=$this->ObavestenjaModel
                ->mojeObavestenje($this->session->userdata('user')->idKorisnik);
        $data=['middle'=>'middle/obavestenja',
            'middle_podaci'=>['obavestenja'=>$obavestenja]];
        $this->load->view('basicTemplate',$data);
    }
    //Ucitava osnovnu stranu na kojoj admin treba da salje obavestenja recenznetima
    public function svaObavestenja() {
        $obavestenja=$this->ObavestenjaModel
                ->obavestenjaTotal();
        $sviRecenzenti=$this->ObavestenjaModel->sviRecenzentiT();
        $sveOblasti = $this->ObavestenjaModel->sveOblastiT();
        $data=['middle'=>'middle/admin_obavestenja',
            'middle_podaci'=>['obavestenja'=>$obavestenja, 'sviRecenzenti' => $sviRecenzenti, 'sveOblasti' => $sveOblasti]];
        $this->load->view('basicTemplate',$data);
        
    }
    //Slanje obavestenja putem mail-a pojedinacno ili na odredjenu grupu
    public function slanjeObavestenja()
    {
        $this->form_validation->set_rules ("naslov", "Naslov", "trim|required");
        $this->form_validation->set_rules ("obavestenje", "Obavestenje", "trim|required");
        
        if ( $this->form_validation->run() == FALSE) {
        //   redirect('Obavestenja/svaObavestenja');
            echo "Moraju biti popunjena sva polja!";
        }
        $naslov= $this->input->post ("naslov");
        $obavestenje = $this->input->post ("obavestenje");
        $Recenzent = $this->input->post ("sviRecenzenti");
        $oblastStrucnost = $this->input->post ("oblastStrucnost");
        $recenzenteOdredjeneOblasti="";
        if($oblastStrucnost){
            $recenzenteOdredjeneOblasti = $this->ObavestenjaModel->recezentOblastStrucnosti($oblastStrucnost);
        }
        $mail1 = $this->ObavestenjaModel->slanjeObavestenjaRecezentu($obavestenje, $Recenzent);
     
        if($recenzenteOdredjeneOblasti) {
            foreach($recenzenteOdredjeneOblasti as $r) {
                // $mejli=$r['mejl'];
                 $Mail = new PHPMailer(); 
                 try {
                     $Mail->SMTPDebug = false;
                     $Mail->Mailer = 'smtp';
                     $Mail->isSMTP();
                     $Mail->Host="smtp.gmail.com";
                     $Mail->Port=587;
                     $Mail->SMTPSecure="tls";
                     $Mail->SMTPAuth = true;
                      $Mail->Username="veljkoveljkovic.mdi@gmail.com";
                    $Mail->Password="";
                    $Mail->SetFrom("veljkoveljkovic.mdi@gmail.com");
                     $Mail->Subject = $naslov;
                     $Mail->Body = $obavestenje;
                     $Mail->AddAddress($r['mejl']);

                     if($Mail->Send(true))
                        echo "Poruka poslata";
                     else { 
                         echo "Poruka nije poslata<br/>"; 
                         echo "GRESKA: " . $Mail->ErrorInfo;
                     }

                 } catch (Exception $e) {
                       echo("GRESKA: " . $Mail -> ErrorInfo);
                         die();
                 }
                 
            }
        }    
      //   $mailOblastStrucnosti = $this->ObavestenjaModel->slanjeObavestenjaOblastStrucnosti($obavestenje, $oblastStrucnost);
           if($mail1){
        $mail2 =$mail1[0]['mejl'];
        $Mail = new PHPMailer(); 
        try {
            $Mail->SMTPDebug = false;
            $Mail->Mailer = 'smtp';
            $Mail->isSMTP();
            $Mail->Host="smtp.gmail.com";
            $Mail->Port=587;
            $Mail->SMTPSecure="tls";
            $Mail->SMTPAuth = true;
            $Mail->Username="veljkoveljkovic.mdi@gmail.com";
            $Mail->Password="";
            $Mail->SetFrom("veljkoveljkovic.mdi@gmail.com");
            $Mail->Subject = $naslov;
            $Mail->Body = $obavestenje;
            $Mail->AddAddress("$mail2");
  
            if($Mail->send ( )){
               // echo "Poruka poslata";
                
            }
            else { 
                echo "Poruka nije poslata<br/>"; 
                echo "GRESKA: " . $Mail->ErrorInfo;
            }

	} catch (Exception $e) {
		echo("GRESKA: " . $Mail -> ErrorInfo);
		die();
	}
      }   else {
          echo "<br>Morate izabrati mail!";
      }
    }
    
   public function obavestenjeuInbox()
   { 
        $date = date("Y-m-d h:i:sa");
        $naslov= $this->input->post ("naslov");
        $obavestenje = $this->input->post ("obavestenje");
        $recenzent = $this->input->post ("sviRecenzenti");
        if(empty($naslov)||empty($obavestenje)) {
            echo "Morate uneti naslov i tekst obavestenja!";
        } else {
        $oblastStrucnost = $this->input->post ("oblastStrucnost");
        //Priliko kreiranja obavestenja hvata se nakon inseta i poslednji snimljen red jer taj id tog red 
        // posle ubacujemo u tabelu poslata_obavestenja
        $kreirajObavestenje=$this->ObavestenjaModel->kreiranjeObavestenja($obavestenje, $naslov, $date);
        $idObavestenja = $kreirajObavestenje->idObavestenja;
        $recenzentiOdredjeneOblasti = $this->ObavestenjaModel->recezentOblastStrucnosti($oblastStrucnost);
        $recenzent = $this->ObavestenjaModel->recenzentPojedinacno($recenzent);
        
        if($oblastStrucnost)
        {
            foreach($recenzentiOdredjeneOblasti as $r)
            {
                
                $slanjeObavestenja = $this->ObavestenjaModel->slanjeObavestenja($idObavestenja,$r['idKorisnik'], $date);
                echo "<br>Uspesno poslato obavestenje";
            }
        } else if($recenzent)
        {
             $slanjeObavestenja = $this->ObavestenjaModel->slanjeObavestenja($idObavestenja,$recenzent->idKorisnik, $date);
            echo "<br>Uspesno poslato obavestenje";
        } else {
            echo "<br>Nije izabrana ni jedan mail za slanje!";
        }
        
        
        }  
   }
}
