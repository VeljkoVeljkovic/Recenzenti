Ime:
<?php echo $this->session
    ->userdata('user')->ime;
?>
<br>
Prezime:
<?php echo $this->session
    ->userdata('user')->prezime;
?>
<br>
Email:
<?php echo $this->session
    ->userdata('user')->mejl;
?>
<br>
<?php 
$slika=$this->session->userdata('user')->slika;
if($slika){

    if(file_exists('uploads/'.$slika)){


        echo "<img width='200px' src='".base_url('uploads/'.$slika)."'/>";

        echo "<a href='".site_url('User/preuzmiSliku')
                    ."'>Preuzmi</a>";
    }

}

echo "<br><br>";
echo form_open_multipart('User/dodajSliku',"method=post");

?>
<input type="file" name='slika' size='20'>

<?php
echo form_submit("dodaj","Dodaj");
echo form_close();
echo "<span style='color:red'>";
echo $error??"";
echo "</span>";
?>

