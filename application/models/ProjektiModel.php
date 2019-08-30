<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjektiModel
 *
 * @author veljko
 */
class ProjektiModel  extends CI_Model{
     public function __construct()
     {
        parent::__construct();
        if (!$this->session->has_userdata('user'))
        {
            redirect('Login');
        }
           
   }
   //Selektuje projekat koji je dodeljen recenzentu
   public function mojProjekat($id) {
        $this->db->select('*');
        $this->db->from('projekti');
        $this->db->join('prijava_projekta', 'projekti.idProjekat = prijava_projekta.idProjekat');
        $this->db->where('idKorisnik', $id);
        $query = $this->db->get();
        return $query->result_array(); 
   }  
  //Selektuje sve projekte da bi bili prikazani na admin delu 
   public function projektitotal() 
   {
       $query = $this->db->get('projekti');
        return $query->result_array(); 
   }
   //Vrsi pretragu projekta po nazivu, NIOrukovodioc ili po oblasti kojoj projekat pripada
   public function pretragaProjekat($naziv, $oblastProjekta)
   {
       $this->db->select('*');
       $this->db->or_like(array('nazivProjekta' => $naziv, 'NIOrukovodioc' => $naziv));
       if(isset($oblastProjekta)){
          $this->db->where('oblastProjekta', $oblastProjekta); 
       }
       $query = $this->db->get('projekti');
       return $query->result_array(); 
       
   }
   
   //Selektuje pitanja za odredjeni poziv
  public function pitanjapoziv($id)
  {
      $this->db->select();
      $this->db->where('idPoziv', $id);
      $query = $this->db->get('pitanja_poziv'); 
      return $query->result_array(); 
  }
  //Selektuje podatke za odredjeni poziv
  public function podacipoziv($id)
  {
      $this->db->select();
      $this->db->where('idpoziv', $id);
      $query = $this->db->get('programski_poziv'); 
      return $query->result_array(); 
  }
   //Selektuje sve pozive
   public function pozivitotal()
   {
      
        $query = $this->db->get('programski_poziv');
        return $query->result_array(); 
   }
   
//   public function rukovodiociTotal()
//   {
//       $query = $this->db->get('rukovodioc_projekta');
//        return $query->result_array(); 
//   }
//    public function oblastiTotal()
//   {
//       $query = $this->db->get('oblast_projekta');
//        return $query->result_array(); 
//   }
   public function poziviSaKomentarima()
   {
       $this->db->select('*');
        $this->db->from('programski_poziv');
        $this->db->join('pitanja_poziv', 'programski_poziv.idPoziv = pitanja_poziv.idPoziv');
        $query = $this->db->get();
        return $query->result_array(); 
   }
   
   public function kreiranjePoziva($naziv) {
       $this->db->set('naziv', $naziv);
       $query = $this->db->insert('programski_poziv');
      //  return $query->row();
   }
  
      public function dodavanjePitanja($id, $pitanje)
      {
       $this->db->set('idPoziv', $id);   
       $this->db->set('pitanje', $pitanje);
       $query = $this->db->insert('pitanja_poziv');
       // return $query->row(); 
      }
      
      public function obrisiPitanjaZaPoziv($id)
      {
          $this->db->where('idPitanja', $id);
          $this->db->delete('pitanja_poziv');
      }
      
      public function kreiranjeProjekta($nazivProjekta, $rukovodiocProjekta, $NIORukovodioc, $zvanjeRukovodioca, $angazovanjeRukovodioca, $oblastProjekta,$date, $odlukaProjekta, $idPoziva)
      {
          $data = [
          'nazivProjekta'=> $nazivProjekta,
          'rukovodiocProjekta'=> $rukovodiocProjekta,
          'NIOrukovodioc'=> $NIORukovodioc,
          'zvanjeRukovodioca'=> $zvanjeRukovodioca,
          'angazovanjeRukovodioca'=> $angazovanjeRukovodioca,
          'oblastProjekta'=> $oblastProjekta,
          'datumPodnosenja' => $date,
          'odlukaProjekta'=> $odlukaProjekta,
          'idPoziv'=> $idPoziva];
          $query = $this->db->insert('projekti',$data);
          
      }
//      public function dodajRukovodioca($ime, $prezime)
//      {
//          $data = [
//          'ime'=> $ime,
//          'prezime'=> $prezime];
//          $query = $this->db->insert('rukovodioc_projekta', $data);
//      }
//      
//      public function dodajOblastProjekta($naziv)
//      {
//           $this->db->set('naziv', $naziv);
//          $query = $this->db->insert('oblast_projekta');
//      }
     public function detaljiProjekat($id)
     {
       $this->db->select('*');
       $this->db->from('projekti');
       $this->db->where('idProjekat', $id);
       $query = $this->db->get();
        return $query->result_array(); 
     }
     public function oceneIRecenzentiProjekta($id)
     {
         
        
         $idKor = $this->session->userdata('user')->idKorisnik;
         $this->db->select('*');
         $this->db->from('prijava_projekta');
         $this->db->join('ocene', 'prijava_projekta.idPrijava = ocene.idPrijava');
         $this->db->join('pitanja_poziv', 'ocene.idPitanja = pitanja_poziv.idPitanja');
         $this->db->where('prijava_projekta.idProjekat', $id);
         $this->db->where('idKorisnik', $idKor);
         $this->db->order_by("idOcena", "desc");
         $query = $this->db->get();
        return $query->result_array(); 
     }
      public function ocene($id)
     {
         
         $this->db->select('*');
        $this->db->from('prijava_projekta');
         $this->db->join('ocene', 'prijava_projekta.idPrijava = ocene.idPrijava');
        
         $this->db->join('pitanja_poziv', 'ocene.idPitanja = pitanja_poziv.idPitanja');
         $this->db->join('recenzenti', 'recenzenti.idKorisnik=prijava_projekta.idKorisnik');
         $this->db->where('prijava_projekta.idProjekat', $id);
        $this->db->where('statusOcene', 'zakljucana');
         $this->db->order_by("idOcena", "desc");
         $query = $this->db->get();
         return $query->result_array(); 
     }
     
     public function recenzentiNaProjektu($id)
     {
         $this->db->select('*');
         $this->db->from('prijava_projekta');
         $this->db->join('recenzenti', 'prijava_projekta.idKorisnik =recenzenti.idKorisnik');
         $this->db->where('idProjekat', $id);
         $query = $this->db->get();
         return $query->result_array(); 
     }
     
     public function detaljiRecenzentovProjekat($id, $idKorisnik)
     {
         $this->db->select('*');
         $this->db->from('projekti');
         $this->db->join('prijava_projekta', 'projekti.idProjekat = prijava_projekta.idProjekat');
     //   $this->db->join('rukovodioc_projekta', 'projekti.idRukovodiocProjekta = rukovodioc_projekta.idRukovodiocProjekta');
     //   $this->db->join('oblast_projekta', 'projekti.idOblastProjekta = oblast_projekta.idOblastProjekta');
        
         $this->db->where('projekti.idProjekat', $id);
         $this->db->where('prijava_projekta.idKorisnik', $idKorisnik);
         
         $query = $this->db->get();
         return $query->result_array(); 
     }
     // Ovo je pokusaj kada se sve ide preko mysqli verzija sa T na kraju je kombinacija php i mysqli
     public function pitanjaZaPoziv($id)
     {
         $this->db->select('*');
         $this->db->from('projekti as r');
         $this->db->join('pitanja_poziv as p', 'r.idPoziv = p.idPoziv');
        // $this->db->join('ocene as o', 'r.idProjekat = o.idProjekat');
         $this->db->where('r.idProjekat', $id);
         $query = $this->db->get();
         return $query->result_array();
     }
     
     public function pitanjaZaPozivT($poziv)
     {
         $this->db->select('*');
         $this->db->from('pitanja_poziv');
         $this->db->where('idPoziv', $poziv);
         $query = $this->db->get();
         return $query->result_array();
     }
     
    public function dodavanjeOcene($ocenaP, $ocenaProjekta, $idPitanja, $idPrijava)
    {
        $this->db->set('komentarOcene', $ocenaP);
        $this->db->set('ocenaProjekta', $ocenaProjekta);
        $this->db->set('idPitanja', $idPitanja);
        $this->db->set('idPrijava', $idPrijava);
        $query = $this->db->insert('ocene');
    }
    
    public function  izmenaOcena($ocenaP, $ocenaProjekta, $idPitanja, $idPrijava)
    {
       $this->db->set('komentarOcene', $ocenaP);
       $this->db->set('ocenaProjekta', $ocenaProjekta); 
       $this->db->where('idPitanja', $idPitanja);
       $this->db->where('idPrijava', $idPrijava);
       $query = $this->db->update('ocene');
    }   
    
    public function zakljucavanje($idOcena)
    {
       $this->db->set('statusOcene', 'zakljucana'); 
       $this->db->where('idOcena', $idOcena);
       $this->db->update('ocene');
        
         
    }
  
    public function brisanjeOceneR($idOcena)
    {
        $this->db->where('idOcena', $idOcena);
        $this->db->delete('ocene');
    }
    
    public function predatIzvestaj($idPrijava)
    {
       $this->db->set('prijavaProjektacol', 'da'); 
       $this->db->where('idPrijava', $idPrijava);
       $this->db->update('prijava_projekta');
    }
    
    public function dodelaProjekata($idProjekat, $idKorisnik, $rokZaIzvestaj)
    {
        $date = date("Y-m-d");
        $this->db->set('idProjekat', $idProjekat);
        $this->db->set('idKorisnik', $idKorisnik);
        $this->db->set('rokZaIzvestaj', $rokZaIzvestaj);
        $this->db->set('stanjePrijave', 'dodeljen');
        $this->db->set('datumPodnosenja', $date);
        $query = $this->db->insert('prijava_projekta');
    }
    
    public function brisanjeProjekat($id)
    {
        $this->db->where('idProjekat', $id);
        $this->db->delete('projekti');
    }
    
    
     public function izmenaProjekta($nazivProjekta, $rukovodiocProjekta, $NIOrukovodioc, $zvanjeRukovodioca, $angazovanjeRukovodioca, $oblastProjekta,$date, $odlukaProjekta, $idPoziva, $idProjekat)
      {
          $data = [
          'nazivProjekta'=> $nazivProjekta,
          'rukovodiocProjekta'=> $rukovodiocProjekta,
          'NIOrukovodioc'=> $NIOrukovodioc,
          'zvanjeRukovodioca'=> $zvanjeRukovodioca,
          'angazovanjeRukovodioca'=> $angazovanjeRukovodioca,
          'oblastProjekta'=> $oblastProjekta,
          'datumPodnosenja' => $date,
          'odlukaProjekta'=> $odlukaProjekta,
          'idPoziv'=> $idPoziva];
          $this->db->where('idProjekat', $idProjekat);
          $query = $this->db->update('projekti',$data);
          
      }
    
}
