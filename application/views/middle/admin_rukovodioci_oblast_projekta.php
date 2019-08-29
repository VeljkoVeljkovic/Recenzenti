<div class="row">
    <div class="offset-2 col-sm-3 col-9 offset-1">
        <?php   echo form_open(
                    "Projekti/rukovodiocProjekta"
                ); 
                echo form_fieldset( "Dodaj novog rukovodioca projekta" );
        ?>
        <div class="form-group row">
            <?php
                echo form_label( "Ime", "ime", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "ime", "class" => "form-control", "value" => set_value("ime") ));
                echo form_error ( "ime" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Prezime", "prezime", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "prezime", "class" => "form-control", "value" => set_value("prezime") ));
                echo form_error ( "prezime" );
            ?>
        </div>
          <div class="form-group row">
            <?php
                echo form_submit ( "dodaj", "Dodaj", array ( "class" => "btn dugme" ) );
            ?>
        </div>
        <?php 
            echo form_fieldset_close();
            echo form_close(); 
        ?>
    </div>
   
    <div class="offset-2 col-sm-3 col-9 offset-1">
        <?php   echo form_open(
                    "Projekti/OblastProjekta"
                ); 
                echo form_fieldset( "Dodaj novu oblast projekta" );
        ?>
        <div class="form-group row">
            <?php
                echo form_label( "Naziv", "naziv", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "naziv", "class" => "form-control", "value" => set_value("naziv") ));
                echo form_error ( "naziv" );
            ?>
        </div>
          <div class="form-group row">
            <?php
               echo form_submit ( "dodaj", "Dodaj", array ( "class" => "btn dugme" ) );
            ?>
        </div>
        <?php 
            echo form_fieldset_close();
            echo form_close(); 
        ?>
    </div>
</div>

