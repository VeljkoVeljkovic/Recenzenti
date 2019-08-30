
<div class="row">
   
    <div class="offset-2 col-3 offset-1">
        <?php 
        
        echo form_open(
                    "Recenzent/promenaPodataka"
                ); 
                echo form_fieldset( "Izmena podataka" );
        ?>
       
        <div class="form-group row">
            <?php
                echo form_label( "Email", "email", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "mejl", "class" => "form-control", "value" => $this->session
    ->userdata('user')->mejl) );
                echo form_error ( "mejl" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Ime", "ime", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "ime", "class" => "form-control", "value" => $this->session
    ->userdata('user')->ime ) );
                echo form_error ( "ime" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Prezime", "prezime", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "prezime", "class" => "form-control", "value" => $this->session
    ->userdata('user')->prezime ) );
                echo form_error ( "prezime" );
            ?>
        </div>
		
       
	<div class="form-group row">
            <?php
                echo form_label( "Nacionalnost", "nacionalnost", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "nacionalnost", "class" => "form-control", "value" => $this->session
    ->userdata('user')->nacionalnost ) );
                echo form_error ( "nacionalnost" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Zemlja", "zemlja", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "zemlja", "class" => "form-control", "value" => $this->session
    ->userdata('user')->zemlja ) );
                echo form_error ( "zemlja" );
            ?>
        </div>
	<div class="form-group row">
            <?php
                echo form_label( "NIO", "NIO", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "NIO", "class" => "form-control", "value" => $this->session
    ->userdata('user')->NIO ) );
                echo form_error ( "NIO" );
            ?>
        </div>
	<div class="form-group row">
            <?php
                echo form_label( "Trenutna Firma", "trenutnaFirma", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "trenutnaFirma", "class" => "form-control", "value" => $this->session
    ->userdata('user')->trenutnaFirma ) );
                echo form_error ( "trenutnaFirma" );
            ?>
        </div>
	<div class="form-group row">
            <?php
                echo form_label( "Naucno zvanje", "naucnoZvanje", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "naucnoZvanje", "class" => "form-control", "value" => $this->session
                    ->userdata('user')->naucnoZvanje ) );
                echo form_error ( "naucnoZvanje" );
            ?>
        </div>
	<div class="form-group row">
            <?php
                echo form_label( "Angazovanje", "angazovanje", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "angazovanje", "class" => "form-control", "value" => $this->session
    ->userdata('user')->angazovanje ) );
                echo form_error ( "angazovanje" );
            ?>
        </div>
		<div class="form-group row">
           <select name="oblastiStrucnosti"  class="btn btn-sm mr-5" )>
               
               <option value="<?= $this->session->userdata('user')->idOblastiStrucnosti ?>" selected><?= $oblastiStrucnosti[0]['oblastStrucnosti']?></option>
              <?php foreach($sveOblasti as $s) { ?>
              <option value="<?= $s['idOblastiStrucnosti']; ?>"><?= $s['oblastStrucnosti']; ?></option>
               <?php } ?>
           </select>
           </div>
		
		<div class="form-group row">
            <?php
                echo form_label( "Telefon", "telefon", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "telefon", "class" => "form-control", "value" => $this->session
    ->userdata('user')->telefon ) );
                echo form_error ( "telefon" );
            ?>
        </div>
		<div class="form-group row">
            <?php
                echo form_label( "Adresa", "adresa", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "adresa", "class" => "form-control", "value" => $this->session
    ->userdata('user')->adresa ) );
                echo form_error ( "adresa" );
            ?>
        </div>
		
		<div class="form-group row">
            <?php
                echo form_label( "Veb stranica", "vebStranica", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "vebStranica", "class" => "form-control", "value" => $this->session
    ->userdata('user')->vebStranica ) );
                echo form_error ( "vebStranica" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_submit ( "izmeni", "Izmeni" );
            ?>
        </div>
        <?php 
            echo form_fieldset_close();
            echo form_close(); 
        ?>
    </div>
	

 <div class="offset-2 col-3 offset-1">
<h4>Lična dokumentacija: </h4>
<br><br><br>

<!-- 
izlistavanje svih slika
forma za postavljanje dodavanje slike
echo "<br><br>"; -->

<?php
$putanja='uploads/'.$this->session->userdata('user')->korIme;
  if(!empty(directory_map($putanja))) {   
foreach (directory_map($putanja) as $slika){
    
 
    echo "<a class='link' href='".base_url($putanja."/".$slika)."'>$slika</a>&nbsp;&nbsp;&nbsp;";
    ?>
<a class="link" href="<?php echo site_url('Recenzent/obrisi_sliku')
."?slika=$slika" ?>"
onclick="return confirm('Da li ste sigurni da zelite da obrisete sliku?');">Obrisi</a>
<?php
echo "<br>";}
}

echo form_open_multipart('Recenzent/dodajSliku',"method=post");

?>
<input type="file" name='slika' size='20'>

<?php
echo form_submit("dodaj","Dodaj dokument");
echo form_close();
echo "<span style='color:red'>";
echo $errorSlika??"";
echo "</span>";
?>
     </div>
   </div>
</div>


