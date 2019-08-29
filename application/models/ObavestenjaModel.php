<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ObavestenjaModel
 *
 * @author veljko
 */
class ObavestenjaModel extends CI_Model{
     public function __construct()
     {
        parent::__construct();
        if (!$this->session->has_userdata('user'))
        {
            redirect('Login');
        }
            $this->load->database();
            $this->load->library ( 'form_validation' );
   }
   //Selektuje obavestenja koje recenznet vidi na svojoj stranici
   public function mojeObavestenje($id) {
        $this->db->select('*');
        $this->db->from('poslata_obavestenja');
        $this->db->join('obavestenja', 'obavestenja.idObavestenja = poslata_obavestenja.idObavestenje');
        $this->db->where('idKorisnik', $id);
        $query = $this->db->get();
        return $query->result_array(); 
   }
  //selektuje sva obavestenja na stranici administratora 
   public function obavestenjaTotal() {
        $query = $this->db->get('obavestenja');
        return $query->result_array(); 
   }
  //selektuje spisak svih recenzenata 
   public function sviRecenzentiT()
   {
       $query = $this->db->get('recenzenti');
       return $query->result_array(); 
   }
   //Selektuje sve oblasti strucnosti
   public function sveOblastiT()
   {
       $query = $this->db->get('oblast_strucnosti');
       return $query->result_array(); 
   }
   //Ubacuje se u bazu obavestenje koje aplikant moze da vidi na svojoj stranici
   public function slanjeObavestenjaRecezentu($obavestenje, $Recenzent)
   {
       $this->db->select('mejl');
       $this->db->where('idKorisnik', $Recenzent);
       $mejlRecenzenta = $this->db->get('korisnici');
       return $mejlRecenzenta->result_array();
       
       
   }
   
   public function recezentOblastStrucnosti($oblastStrucnost)
   {
       $this->db->select();
       $this->db->from('recenzenti as r');
       $this->db->join('korisnici as k', 'k.idKorisnik = r.idKorisnik');
       $this->db->where('r.idOblastiStrucnosti', $oblastStrucnost);
       $mejloviRecenzenta = $this->db->get();
       return $mejloviRecenzenta->result_array();
   }
   
   public function recenzentPojedinacno($recenzent)
   {
       $this->db->select();
       $this->db->from('recenzenti as r');
       $this->db->join('korisnici as k', 'k.idKorisnik = r.idKorisnik');
       $this->db->where('r.idKorisnik', $recenzent);
       $query = $this->db->get();
       return $query->row();
   }
   
   public function kreiranjeObavestenja($obavestenje, $naslov, $date)
   {
       $data = array(
           'tekst' => $obavestenje,
           'naslov' => $naslov,
           'datum' => $date
       );
         $this->db->insert('obavestenja', $data);    
         $last_row=$this->db->select()->order_by('idObavestenja',"desc")->limit(1)->get('obavestenja')->row();
         return $last_row;
   }
   
   public function slanjeObavestenja($idObavestenja,$idKorisnik, $date)
   {
       $data = array(
           'idObavestenje' => $idObavestenja,
           'idKorisnik' => $idKorisnik,
           'datum' => $date
       );
         $this->db->insert('poslata_obavestenja', $data);    
   }

}
