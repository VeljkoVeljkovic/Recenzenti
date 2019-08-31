<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AnketaModel
 *
 * @author veljko
 */
class AnketaModel extends CI_Model {
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
     public function sveAnkete()
     {
         $query = $this->db->get('anketa');
         return $query->result_array(); 
     }
     
     public function kreiranjeAnkete($naziv)
     {
         $this->db->set('nazivAnkete', $naziv);
       $query = $this->db->insert('anketa');
     }
     
     public function anketaDetalj($idAnketa)
     {
         $this->db->select();
         $this->db->where('idAnketa',$idAnketa);
         $query= $this->db->get('anketa');
         return $query->result_array();
         
     }
     
     public function  anketaDetaljPitanja($idAnketa) {
         $this->db->select();
         $this->db->where('idAnketa',$idAnketa);
         $query= $this->db->get('anketa_pitanja');
         return $query->result_array();
     }
     
     public function dodajSlobodnoPitanje($idAnketaS,$pitanjeS)
     {
         $data = array(
        'idAnketa' => $idAnketaS,
        'pitanje' => $pitanjeS      
);

$this->db->insert('anketa_pitanja', $data);
     }
     
     public function dodajRadioPitanje($idAnketa,$pitanje,$odgovor1,$odgovor2,$odgovor3,$odgovor4)
     {
         $data = array(
        'idAnketa' => $idAnketa,
        'pitanje' => $pitanje,
        'odgovor1' => $odgovor1,
        'odgovor2' => $odgovor2,
        'odgovor3' => $odgovor3,
        'odgovor4' => $odgovor4           
);

$this->db->insert('anketa_pitanja', $data);
     }
     
     public function zakljucajAnketu($idAnketa)
     {
         $this->db->set('statusAnkete', 'zakljucano');
         $this->db->where('idAnketa', $idAnketa);
         $query = $this->db->update('anketa');
         
     }
     
     public function dodela($idAnketa,$idKorisnik)
     {
          $data = array(
        'idAnketa' => $idAnketa,
        'idKorisnik' => $idKorisnik
                  );
         $this->db->insert('anketu_radi', $data); 
     }
     
   public function recezentiTotal()
    {
       $this->db->select();
       $this->db->from('recenzenti as r');
       $this->db->join('oblast_strucnosti as o', 'r.idOblastiStrucnosti=o.idOblastiStrucnosti');
       $query=$this->db->get();
        return $query->result_array(); 
    }
    
    public function mojaAnketa($idKorisnik)
    {
        $this->db->select();
        $this->db->from('anketa as a');
        $this->db->join('anketu_radi as r', 'a.idAnketa = r.idAnketa');
        $this->db->where('idKorisnik',$idKorisnik);
        $query = $this->db->get();
        return $query->result_array(); 
    }
    
     public function brisanjePitanja($idAnketaPitanje)
     {
         $this->db->where('idAnketaPitanje', $idAnketaPitanje);
         $this->db->delete('anketa_pitanja');
     }
    
    public function snimanjeOdgovora($idAnketuRadi,$idAnketaPitanje,$odgovor)
    {
        $data = array(
            'idAnketuRadi' => $idAnketuRadi,
            'idAnketaPitanje' => $idAnketaPitanje,
            'odgovor' => $odgovor
        );
        $this->db->insert('anketa_odgovori', $data);         
    }
    
    public function PopunjeneAnkete($idAnketaPopunjena)
    {
        $this->db->set('status','popunjena');
        $this->db->where('idAnketuRadi', $idAnketaPopunjena);
        $query = $this->db->update('anketu_radi');
    }
    
    public function idAnkete($idAnketaPopunjena)
    {
        $this->db->select('idAnketa');
        $this->db->where('idAnketuRadi', $idAnketaPopunjena);
        $query = $this->db->get('anketu_radi');
        $idAnketa=$query->row()->idAnketa;
       
        $this->db->select();
        $this->db->from('anketa_pitanja');
        $this->db->where('idAnketa', $idAnketa);
        $id = $this->db->get();
        return $ida=$id->result_array(); 
        
    }
}
