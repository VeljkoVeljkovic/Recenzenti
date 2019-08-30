<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Form_validation_recezent
 *
 * @author Radja
 */
class Recezent_validator {
    
    public function run(CI_Controller $ci)
    {
        $ci->form_validation->set_rules ( "ime", "Ime", "trim|required|min_length[2]|max_length[15]");
        $ci->form_validation->set_rules ( "prezime", "Prezime", "trim|required|min_length[2]|max_length[15]");
        $ci->form_validation->set_rules ( "mejl", "Email", "trim|required|valid_email");
        $ci->form_validation->set_rules ( "korIme", "Korisnicko ime", "trim|required|min_length[2]|max_length[10]|is_unique[korisnici.korIme]");
        $ci->form_validation->set_rules ( 
            "lozinka",
            "Lozinka",
            ['trim', 'required', ['lozinka_rule', [$this, 'validate_password']]],
            ['lozinka_rule' => 'Lozinka mora da bude duzine izmedju 5 i 15 karaktera i da sadrzi bar jedno malo slovo, bar jedno veliko slovo i bar jedan broj']
        );
        $ci->form_validation->set_rules ( "ponovljenaLozinka", "Ponovljena Lozinka", "trim|required|matches[lozinka]");
        $ci->form_validation->set_rules ( "zemlja", "Zemlja", "trim|required|min_length[2]|max_length[15]");
        $ci->form_validation->set_rules ( "nacionalnost", "Nacionalnost", "trim|required|min_length[2]|max_length[15]");
        $ci->form_validation->set_rules ( "NIO", "NIO", "trim|required|min_length[5]|max_length[100]");
        $ci->form_validation->set_rules ( "trenutnaFirma", "Trenutna firma", "trim|required|min_length[5]|max_length[100]");
        $ci->form_validation->set_rules ( "naucnoZvanje", "Naucno zvanje", "trim|required|min_length[5]|max_length[45]");
        $ci->form_validation->set_rules ( "angazovanje", "Angazovanje", "trim|required|min_length[5]|max_length[45]");
        $ci->form_validation->set_rules ( "oblastiStrucnosti", "Oblasti strucnosti", "required");
        $ci->form_validation->set_rules (
            "telefon",
            "Telefon",
            ['trim', 'required', 'is_natural', ['telefon_rule', [$this, 'validate_number']]],
            ['telefon_rule' => 'Broj mora da pocne sa nulom(0) i da ima izmedju 8 i 10 cifara.']
        );
        $ci->form_validation->set_rules ( "adresa", "Adresa", "trim|required|min_length[5]|max_length[100]");
//        $ci->form_validation->set_rules (
//            "biografija",
//            "Biografija",
//            [
//                'trim',
//                'xss_clean',
//                ['empty_biografija_rule', [$this, 'validate_required_biografija']],
//                ['size_biografija_rule', [$this, 'validate_size_biografija']],
//                ['type_biografija_rule', [$this, 'validate_type_biografija']],
//                ['error_biografija_rule', [$this, 'validate_biografija']]],
//            [
//                'empty_biografija_rule' => 'Biografija je obavezno polje.',
//                'size_biografija_rule' => 'Maksimalna velicina je 2MB.',
//                'type_biografija_rule' => 'Dozvoljeni format datoteke je PDF.',
//                'error_biografija_rule' => 'Greska pri snimanju biografije.',
//            ]
//        );
        $ci->form_validation->set_rules ( "vebStranica", "Veb stranica", "trim|required|valid_url");
        
        return $ci->form_validation->run();
    }
    
    /**
     * Validira lozinku
     * @param string $password
     * @return bool
     */
    public function validate_password($password) {
        return strlen($password) >= 5 && strlen($password) <= 15
                && preg_match('/[a-z]/', $password)
                && preg_match('/[A-Z]/', $password)
                && preg_match('/[0-9]/', $password);
    }
    
    /**
     * Validira telefon
     * @param string $number
     * @return bool
     */
    public function validate_number($number) {
        return (bool)preg_match('/^0[0-9]{7,9}$/', $number);
    }

    /**
     * Validira da li je poslata biografija
     * @return bool
     */
//    public function validate_required_biografija() {
//        return !empty($_FILES['biografija']['name'])
//            && $_FILES['biografija']['error'] !== 4;
//    }
    
    /**
     * Validira velicinu datoteke biografije
     * @return bool
     */
//    public function validate_size_biografija() {
//        $CI =& get_instance();
//        $CI->load->library('biografija_upload_config');
//        $config_upload = Biografija_upload_config::get();
//        $CI->load->library('upload', $config_upload);
//        $CI->upload->file_size = round($_FILES['biografija']['size'] / 1024, 2);
//        return $CI->upload->is_allowed_filesize();
//    }
    
    /**
     * Validira tip datoteke biografije
     * @return bool
     */
//    public function validate_type_biografija() {
//        $CI = get_instance();
//        $CI->load->library('biografija_upload_config');
//        $config_upload = Biografija_upload_config::get();
//        $CI->load->library('upload', $config_upload);
//        $CI->upload->file_ext = $CI->upload->get_extension($_FILES['biografija']['name']);
//        return $CI->upload->is_allowed_filetype(true);
//    }
    
    /**
     * Validira biografiju
     * @return bool
     */
//    public function validate_biografija() {
//        return $_FILES['biografija']['error'] === 0;
//    }
    
        public function update(CI_Controller $ci)
    {
        $ci->form_validation->set_rules ( "ime", "Ime", "trim|required|min_length[2]|max_length[15]");
        $ci->form_validation->set_rules ( "prezime", "Prezime", "trim|required|min_length[2]|max_length[15]");
        $ci->form_validation->set_rules ( "mejl", "Email", "trim|required|valid_email");
        
      
        $ci->form_validation->set_rules ( "zemlja", "Zemlja", "trim|required|min_length[2]|max_length[15]");
        $ci->form_validation->set_rules ( "nacionalnost", "Nacionalnost", "trim|required|min_length[2]|max_length[15]");
        $ci->form_validation->set_rules ( "NIO", "NIO", "trim|required|min_length[5]|max_length[100]");
        $ci->form_validation->set_rules ( "trenutnaFirma", "Trenutna firma", "trim|required|min_length[5]|max_length[100]");
        $ci->form_validation->set_rules ( "naucnoZvanje", "Naucno zvanje", "trim|required|min_length[5]|max_length[45]");
        $ci->form_validation->set_rules ( "angazovanje", "Angazovanje", "trim|required|min_length[5]|max_length[45]");
        $ci->form_validation->set_rules ( "oblastiStrucnosti", "Oblasti strucnosti", "required");
        $ci->form_validation->set_rules (
            "telefon",
            "Telefon",
            ['trim', 'required', 'is_natural', ['telefon_rule', [$this, 'validate_number']]],
            ['telefon_rule' => 'Broj mora da pocne sa nulom(0) i da ima izmedju 8 i 10 cifara.']
        );
        $ci->form_validation->set_rules ( "adresa", "Adresa", "trim|required|min_length[5]|max_length[100]");

        $ci->form_validation->set_rules ( "vebStranica", "Veb stranica", "trim|required|valid_url");
        
        return $ci->form_validation->run();
    }
    
}
