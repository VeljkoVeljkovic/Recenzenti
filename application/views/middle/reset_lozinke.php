<div class="row justify-content-center">
    <div class="col-sm-5">
        <?php
        if (!isset($poruka)) {
            echo form_open("Reset_lozinke/send"); 
            echo form_fieldset( "Reset lozinke" );
        ?>
        <div class="form-group row">
            <?php
                echo form_label( "Korisnicko ime", "korIme", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "korIme", "class" => "form-control", "value" => set_value ( "korIme" ) ) );
                echo form_error ( "korIme" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_submit( "reset", "Resetuj" );
            ?>
        </div>
        <?php
        } else {
            if ($poruka == true) {
                echo "<p>Nova lozinka vam je poslata na mail. Vazi 1 sat.</p>";
            } else {
                echo "<p>Doslo je do greske pri slanju maila.</p>";
            }
        }
        ?>
    </div>
</div>