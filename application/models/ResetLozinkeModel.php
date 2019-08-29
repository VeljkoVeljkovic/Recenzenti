<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of ResetLozinkeModel
 *
 * @author Radja
 */
class ResetLozinkeModel extends CI_Model {
    
    public function sendNewPasswordMail($korIme) {
        $korisnik = $this->db->query('SELECT idKorisnik, mejl FROM korisnici WHERE korIme = ?', [$korIme])->row();
        if (!$korisnik) {
            return false;
        }
        $this->load->helper('string');
        $novaLozinka = random_string('alnum', 15);
        $datum = date('Y-m-d H:i:s', time() + 3600);
        $data = [
            'idKorisnik' => $korisnik->idKorisnik,
            'lozinka' => password_hash($novaLozinka, PASSWORD_DEFAULT),
            'datum' => $datum
        ];
        $this->db->insert('reset', $data);
        $text = '<html><body><p>Nova lozinka je: ' . $novaLozinka . '</p><p>Vazi 1 h. </p></body></html>';
        $this->load->library('email');
        $this->email->from('your@example.com', 'Your Name');
        $this->email->to($korisnik->mejl);
//        $this->email->cc('another@another-example.com');
//        $this->email->bcc('them@their-example.com');
        $this->email->subject('Reset lozinke');
        $this->email->message($text);
        return $this->email->send();
    }
    
}
