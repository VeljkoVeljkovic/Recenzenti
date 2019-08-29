
<div class="row">
    
    <div class="offset-2 col-sm-3 col-sm-3 col-9  offset-1">
         <?php   echo form_open_multipart(
                    "Projekti/kreirajProjekat"
                ); 
                
        ?>
        <h3>Kreiranje Projekta: </h3>
        <div class="form-group row">
            <?php
                echo form_label( "Naziv Projekta", "nazivProjekta", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "nazivProjekta", "class" => "form-control", "value" => set_value("nazivProjekta") ) );
                echo form_error ( "nazivProjekta" );
            ?>
        </div>
         <div class="form-group row">
            <?php
                echo form_label( "Rukovodioc projekta", "rukovodiocProjekta", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "rukovodiocProjekta", "class" => "form-control", "value" => set_value("rukovodiocProjekta") ) );
                echo form_error ( "rukovodiocProjekta" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "NIO Rukovodioca", "NIORukovodioca", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "NIORukovodioca", "class" => "form-control", "value" => set_value("NIORukovodioca") ) );
                echo form_error ( "NIORukovodioca" );
            ?>
        </div>
	<div class="form-group row">
            <?php
                echo form_label( "Zvanje Rukovodioca", "zvanjeRukovodioca", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "zvanjeRukovodioca", "class" => "form-control", "value" => set_value("zvanjeRukovodioca") ) );
                echo form_error ( "zvanjeRukovodioca" );
            ?>
        </div>
       
	<div class="form-group row">
            <?php
                echo form_label( "Angazovanje Rukovodioca", "angazovanjeRukovodioca", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "angazovanjeRukovodioca", "class" => "form-control", "value" => set_value("angazovanjeRukovodioca") ) );
                echo form_error ( "angazovanjeRukovodioca" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Oblast projekta", "oblastProjekta", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "oblastProjekta", "class" => "form-control", "value" => set_value("oblastProjekta") ) );
                echo form_error ( "oblastProjekta" );
            ?>
        </div>
        
	<div class="form-group row">
            <?php
                echo form_label( "Odluka Projekta", "odlukaProjekta", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "odlukaProjekta", "class" => "form-control", "value" => set_value("odlukaProjekta") ) );
                echo form_error ( "odlukaProjekta" );
            ?>
        </div>
        <div class="form-group row">
            <select name="idPoziva" class="btn dugme" )>
              <?php foreach($sviPozivi as $s) { ?>
           <option value="<?= $s['idpoziv']; ?>"><?= $s['naziv']; ?></option>
               <?php } ?>
           </select>
        </div>
	
    </div>
	<div class="offset-2 col-sm-3 col-9 offset-1">
	<h3>Dodavanje projektne dokumentacije: </h3>
	






<input type="file" name='slika[]' size='20'  multiple />
<br>
<br>
<?php
echo form_submit("kreiraj","Kreiraj Projekat", array ( "class" => "btn" ));
echo form_close();
echo "<span style='color:red'>";
 echo $errorSlika??"";
echo "</span>";
?>

	</div>
</div>




