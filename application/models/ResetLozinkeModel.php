    <?php
defined('BASEPATH') OR exit('No direct script access allowed');
        use \PHPMailer\PHPMailer\PHPMailer;
	use \PHPMailer\PHPMailer\Exception;
	use \PHPMailer\PHPMailer\SMTP;
	
	require("PHPMailer/src/Exception.php"); 
        require("PHPMailer/src/PHPMailer.php"); 
	require("PHPMailer/src/SMTP.php");
	require("PHPMailer/src/OAuth.php");
	require("PHPMailer/src/POP3.php"); 
        
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
                     $Mail->Subject = "Reset Lozinke";
                     $Mail->Body = "Imate sat vremena da uradite reset lozinke";
                     $Mail->AddAddress($korisnik->mejl);

                     if($Mail->Send(true)) {
                        return true;
                     } 
                         
                }  catch (Exception $e) {
                       echo("GRESKA: " . $Mail -> ErrorInfo);
                         die();
        }
    }
    
}
