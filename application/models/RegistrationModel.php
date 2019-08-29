<?php

class RegistrationModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        
        $this->load->database ( );
       $this->load->model ( "RecenzentModel" );
    }
    
    public function register ( $ime, $prezime, $mejl, $korIme, $lozinka, $nacionalnost,
                               $zemlja, $NIO, $trenutnaFirma, $naucnoZvanje, $angazovanje,
                               $oblastiStrucnosti, $telefon, $adresa, $rola, $vebStranica) {
        $dataKorisnik = [
            "korIme" => $korIme,
            "lozinka" => password_hash($lozinka, PASSWORD_DEFAULT),
            "mejl" => $mejl,
            "rola" => $rola,
        ];
        $this->db->insert ( "korisnici", $dataKorisnik );
        $idKorisnik = $this->db->insert_id();
        
        $dataRecezent = [
            'idKorisnik' => $idKorisnik,
            "ime" => $ime,
            "prezime" => $prezime,
            "zemlja" => $zemlja,
            "nacionalnost" => $nacionalnost,
            "NIO" => $NIO,
            "trenutnaFirma" => $trenutnaFirma,
            "naucnoZvanje" => $naucnoZvanje,
            "angazovanje" => $angazovanje,
            "idOblastiStrucnosti" => $oblastiStrucnosti,
            "telefon" => $telefon,
            "adresa" => $adresa,
            "vebStranica" => $vebStranica,
            'statusPrijave' => RecenzentModel::STATUS_PRIJAVE_STIGLA
        ];
        $this->db->insert ( "recenzenti", $dataRecezent );
        
        return $this->db->insert_id();
    }
    
    /**
     * Snima biografija.pdf na HD
     * @param int $recezentId
     * @throws Exception
     */
    public function sacuvajBiografiju($recezentId) {
        $this->load->library('biografija_upload_config');
        $config_upload = Biografija_upload_config::get($recezentId);
        if (!is_dir($config_upload['upload_path'])) {
            mkdir($config_upload['upload_path'], 0777, TRUE);
        }
        
        $this->load->library('upload', $config_upload);
        $this->upload->set_upload_path($config_upload['upload_path']);
        
        if ( !$this->upload->do_upload('biografija'))
        {
            if (is_dir($config_upload['upload_path'])) {
                $this->load->helper('file');
                delete_files($config_upload['upload_path'], true);
                rmdir($config_upload['upload_path']);
            }
            throw new Exception($this->upload->display_errors());
        }
        
        
    }
     public function sveOblastiT()
   {
       $query = $this->db->get('oblast_strucnosti');
       return $query->result_array(); 
   }
}