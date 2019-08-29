<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of RecenzentModel
 *
 * @author Obuka
 */
class RecenzentModel extends CI_Model{
    
    const STATUS_PRIJAVE_STIGLA = 'stigla';
    const STATUS_PRIJAVE_RAZMATRA_SE = 'razmatra_se';
    const STATUS_PRIJAVE_PRIHVACENA = 'prihvacena';
    const STATUS_PRIJAVE_ODBIJENA = 'odbijena';
    
    public function login($username, $password) {
# 1. NACIN
        $korisnik = $this->db
                ->query('SELECT lozinka FROM korisnici WHERE korIme = ' . $this->db->escape($username))
                ->row();
        
# 2. NACIN
//        $korisnik = $this->db
//                ->query('SELECT lozinka FROM korisnici WHERE korIme = ?', [$username])
//                ->row();
        
# 3. NACIN
//        $this->db->where('korIme', $username);
//        $korisnik = $this->db->get('korisnici')->row();
        
        $logedIn = $korisnik && password_verify($password, $korisnik->lozinka);
        if (!$logedIn) {
          /* $this->db->select('r.idKorisnik, r.lozinka');
           $this->db->from('reset AS r');
           $this->db->join('korisnici as k', 'k.idKorisnik = r.idKorisnik');
           $this->db->where('k.korIme', '>' '?');
           $this->db->where('r.datum > ')*/
           $sql = 'SELECT r.idKorisnik, r.lozinka '
                    . 'FROM reset AS r '
                    . 'JOIN korisnici AS k USING (idKorisnik)'
                    . 'WHERE k.korIme = ?'
                    . '  AND r.datum > ? '
                    . 'ORDER BY r.datum DESC '
                    . 'LIMIT 1';
            $params = [$username, date('Y-m-d H:i:s')];
            $resetLozinke = $this->db->query($sql, $params)->row();
            $logedIn = $resetLozinke && password_verify($password, $resetLozinke->lozinka);
            if ($logedIn) {
                $this->db->where('idKorisnik', $resetLozinke->idKorisnik);
                $this->db->update('korisnici', ['lozinka' => $resetLozinke->lozinka]);
            }
        }
        
        return $logedIn;
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
    
//    public function dohvatiSveUsere($pocetni_user,$limit){
//        return $this->db->get('korisnici', $limit, $pocetni_user)->result();
//    }
//    
//    public function BrojUsera(){
//        return $this->db->count_all_results('korisnici');
//    }
    
//    public function izmeniSliku($username, $slika) {// TODO promeni naziv funkcije
//        // TODO promeniti da cita iz direktorijuma a ne iz dB-a
//        $this->db->set('biografija', $slika);
//        $this->db->where('korIme', $username);
//        $this->db->update('korisnici');
//    }
    
    
    public function register ( $korIme, $mejl, $ime, $prezime, $nacionalnost, $zemlja, $NIO, $trenutnaFirma, $naucnoZvanje, $angazovanje, $oblastiStrucnosti,
            $adresa, $vebStranica) {
       $dataKorisnici = [
           "korIme" => $korIme,
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
           "adresa" => $adresa,
           "vebStranica" => $vebStranica
       ];
      
        $id = $this->session->userdata('user')->idKorisnik;
        $this->db->where('idKorisnik', $id);
        $query =$this->db->update("korisnici", $dataKorisnici);
        $this->db->where('idKorisnik', $id);
        $query1 =$this->db->update("recenzenti", $dataRecenzenti);
        
        
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
