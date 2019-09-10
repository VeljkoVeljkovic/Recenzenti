<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of RecenzentModel
 *
 * @author Obuka
 */
class RecenzentModel extends CI_Model{
    
   
    
    public function login($username, $password)
    {

        $this->db->where('korIme', $username);
        $korisnik = $this->db->get('korisnici')->row();
        if(!$korisnik)
        {
            return false;
            
        }
        else
        {
        
      if(password_verify($password, $korisnik->lozinka))
      {
       
           return true;
      }
            else
            { return false;}
        
        }
    }
    
    public function dohvatiRecezentaPoId($recezentId) {
        $stanje = null;
        $recezent = $this->db
                ->query('SELECT statusPrijave FROM recenzenti WHERE idRecezent = ' . $this->db->escape($recezentId))
                ->row();
        if (!empty($recezent->statusPrijave)) {
            $stanje = $recezent->statusPrijave;
        }
        return $stanje;
    }
    
    public function dohvatiUsera($username){
        $this->db->select('*');
        $this->db->from('korisnici as k');
        $this->db->join('recenzenti as r', 'k.idKorisnik = r.idKorisnik');
        $this->db->where('korIme', $username);
        $query=$this->db->get();
        return $query->row(); // dohvata samo jedan red iz tabele, 
        ///i mozemo da ga pozivamo vise puta i dohvatamo red po red
    }
    

    
    
    public function register ( $mejl, $ime, $prezime, $nacionalnost, $zemlja, $NIO, $trenutnaFirma, $naucnoZvanje, $angazovanje, $oblastiStrucnosti,
            $telefon,$adresa, $vebStranica) {
       $dataKorisnici = [
           "mejl" => $mejl ];
        $dataRecenzenti =[
            "ime" => $ime,
           "prezime" => $prezime,
           "nacionalnost" => $nacionalnost,
           "zemlja" => $zemlja,
           "NIO" => $NIO,
           "trenutnaFirma" => $trenutnaFirma,
           "naucnoZvanje" => $naucnoZvanje,
           "angazovanje" => $angazovanje,
           "idOblastiStrucnosti" => $oblastiStrucnosti,
            "telefon"=>$telefon,
           "adresa" => $adresa,
           "vebStranica" => $vebStranica
       ];
      
        $id = $this->session->userdata('user')->idKorisnik;
        $this->db->where('idKorisnik', $id);
        $query =$this->db->update("korisnici", $dataKorisnici);
        $this->db->where('idKorisnik', $id);
        $query1 =$this->db->update("recenzenti", $dataRecenzenti);
        
        
    }
    
    public function oblastiStrucnosti($id){
       $this->db->select();
       $this->db->from('recenzenti as r');
       $this->db->join('oblast_strucnosti as o', 'r.idOblastiStrucnosti=o.idOblastiStrucnosti');
       $this->db->where('idKorisnik', $id);
       $query=$this->db->get();
        return $query->result_array(); 
        
    }
    
    public function recezentiTotal()
    {
       $this->db->select();
       $this->db->from('recenzenti as r');
       $this->db->join('oblast_strucnosti as o', 'r.idOblastiStrucnosti=o.idOblastiStrucnosti');
       $query=$this->db->get();
        return $query->result_array(); 
    }
    
    //Selektuje sve Recenzente koji jos uvek nisu registrovani kako bi mogao da im se promeni status prijave
    public function neRegistrovaniRecenzenti()
    {
        $i = 'registrovan';
        $this->db->select();
        $this->db->from('recenzenti');
        $this->db->where('statusPrijave !=', $i);
        $query=$this->db->get();
        return $query->result_array(); 
    
   
    }
    //Prikazuje  koji projekat je recenzentu dodeljen
    public function angazovanostRecenzenta($id)
    {
        $this->db->select();
        $this->db->from('recenzenti as r');
        $this->db->join('prijava_projekta as p', 'r.idKorisnik = p.idKorisnik');
        $this->db->join('projekti as pr', 'p.idProjekat = pr.idProjekat');
        $this->db->where('r.idKorisnik', $id);
        $query=$this->db->get();
        return $query->result_array(); 
        
    }
   //Prikazuje sve recenznete kojima je prosao rok za prijavu 
    public function angazovanostSvihRecenzenata()
    {
        $date = date('Y-m-d');
        $this->db->select();
        $this->db->from('recenzenti as r');
        $this->db->join('prijava_projekta as p', 'r.idKorisnik = p.idKorisnik');
        $this->db->join('projekti as pr', 'p.idProjekat = pr.idProjekat'); 
        $this->db->where('p.rokZaIzvestaj <', $date);
        $query=$this->db->get();
        return $query->result_array(); 
        
    }
    //Selektuje podatke za pojedinacnog recenzenta
    public function RecenzentPodaci($id)
    {
        $this->db->select();
        $this->db->from('recenzenti as r');
        $this->db->join('oblast_strucnosti as o', 'r.idOblastiStrucnosti=o.idOblastiStrucnosti');
        $this->db->where('idKorisnik', $id);
        $query=$this->db->get();
        return $query->result_array(); 
        
    }
    //Vrsi promenu statusa prijave za recenzneta koji jos uvek nije registrovan
    public function promenaStatusaPrijave($idRecenzent, $status)
    {
        $this->db->set("statusPrijave", $status);
        $this->db->where('idKorisnik', $idRecenzent);
        $this->db->update('recenzenti');
        
        
    }
}
