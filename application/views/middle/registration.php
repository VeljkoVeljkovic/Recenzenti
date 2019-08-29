<div class="row justify-content-center">
    <div class="col-sm-5">
        <?php   echo form_open_multipart(
                    "Registration/register"
                ); 
                echo form_fieldset( "Registracija" );
        ?>
        <div class="form-group row">
            <?php
                echo form_label( "Ime", "ime", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "ime", "class" => "form-control", "value" => set_value ( "ime" ) ) );
                echo form_error ( "ime" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Prezime", "prezime", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "prezime", "class" => "form-control", "value" => set_value ( "prezime" ) ) );
                echo form_error ( "prezime" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Korisnicko ime", "korIme", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "korIme", "class" => "form-control", "value" => set_value ( "korIme" ) ) );
                echo form_error ( "korIme" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Email", "mejl", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "mejl", "class" => "form-control", "value" => set_value ( "mejl" ) ) );
                echo form_error ( "mejl" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Nacionalnost", "nacionalnost", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "nacionalnost", "class" => "form-control", "value" => set_value ( "nacionalnost" ) ) );
                echo form_error ( "nacionalnost" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Zemlja", "zemlja", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "zemlja", "class" => "form-control", "value" => set_value ( "zemlja" ) ) );
                echo form_error ( "zemlja" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "NIO", "NIO", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "NIO", "class" => "form-control", "value" => set_value ( "NIO" ) ) );
                echo form_error ( "NIO" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Trenutna Firma", "trenutnaFirma", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "trenutnaFirma", "class" => "form-control", "value" => set_value ( "trenutnaFirma" ) ) );
                echo form_error ( "trenutnaFirma" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Naucno zvanje", "naucnoZvanje", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "naucnoZvanje", "class" => "form-control", "value" => set_value ( "naucnoZvanje" ) ) );
                echo form_error ( "naucnoZvanje" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Angazovanje", "angazovanje", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "angazovanje", "class" => "form-control", "value" => set_value ( "angazovanje" ) ) );
                echo form_error ( "angazovanje" );
            ?>
        </div>
        <div class="form-group row">
           <select name="oblastiStrucnosti"  class="btn btn-sm mr-5" )>
               <option value="" selected>Oblasti strucnosti</option>
              <?php foreach($sveOblasti as $s) { ?>
              <option value="<?= $s['idOblastiStrucnosti']; ?>"><?= $s['oblastStrucnosti']; ?></option>
               <?php } ?>
           </select>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Telefon (samo brojevi, sa pozivnim brojem)", "telefon", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "telefon", "class" => "form-control", "value" => set_value ( "telefon" ) ) );
                echo form_error ( "telefon" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Adresa", "adresa", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "adresa", "class" => "form-control", "value" => set_value ( "adresa" ) ) );
                echo form_error ( "adresa" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Biografija", "biografija", array ( "class" => "control-label" ) );
                echo form_upload( array ( "name" => "biografija", "class" => "form-control" ) );
                echo form_error ( "biografija" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Veb stranica", "vebStranica", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "vebStranica", "class" => "form-control", "value" => set_value ( "vebStranica" ) ) );
                echo form_error ( "vebStranica" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Lozinka", "lozinka", array ( "class" => "control-label" ) );
                echo form_password ( array ( "name" => "lozinka", "class" => "form-control" ) );
                echo form_error ( "lozinka" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Ponovljena lozinka", "ponovljenaLozinka", array ( "class" => "control-label" ) );
                echo form_password ( array ( "name" => "ponovljenaLozinka", "class" => "form-control" ) );
                echo form_error ( "ponovljenaLozinka" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_submit ( "register", "Registruj se" );
            ?>
        </div>
        <?php 
            echo form_fieldset_close();
            echo form_close(); 
        ?>
    </div>
</div>