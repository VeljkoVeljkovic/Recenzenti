
<div class="row">
    
    <div class="offset-2 col-sm-3 col-9 offset-1">
         <?php   echo form_open_multipart(
                    "Projekti/izmeniProjekat"
                ); 
              
        ?>
          <?php foreach($detaljiProjekta as $d) { ?>
        <h3>Izmena podataka Projekta: </h3>
        <div class="form-group row">
            <?php
                echo form_label( "Naziv Projekta", "nazivProjekta", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "nazivProjekta", "class" => "form-control", "value" => $d['nazivProjekta'], 'readonly' => 'readonly' ) );
                echo form_error ( "nazivProjekta" );
            ?>
        </div>
         <div class="form-group row">
            <?php
                echo form_label( "Rukovodioc projekta", "rukovodiocProjekta", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "rukovodiocProjekta", "class" => "form-control", "value" => $d['rukovodiocProjekta'] ) );
                echo form_error ( "rukovodiocProjekta" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "NIO Rukovodioca", "NIOrukovodioc", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "NIOrukovodioc", "class" => "form-control", "value" => $d['NIOrukovodioc'] ) );
                echo form_error ( "NIORukovodioca" );
            ?>
        </div>
	<div class="form-group row">
            <?php
                echo form_label( "Zvanje Rukovodioca", "zvanjeRukovodioca", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "zvanjeRukovodioca", "class" => "form-control", "value" => $d['zvanjeRukovodioca'] ) );
                echo form_error ( "zvanjeRukovodioca" );
            ?>
        </div>
       
	<div class="form-group row">
            <?php
                echo form_label( "Angazovanje Rukovodioca", "angazovanjeRukovodioca", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "angazovanjeRukovodioca", "class" => "form-control", "value" => $d['angazovanjeRukovodioca'] ) );
                echo form_error ( "angazovanjeRukovodioca" );
            ?>
        </div>
        <div class="form-group row">
            <?php
                echo form_label( "Oblast projekta", "oblastProjekta", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "oblastProjekta", "class" => "form-control", "value" => $d['oblastProjekta'] ) );
                echo form_error ( "oblastProjekta" );
            ?>
        </div>
        
	<div class="form-group row">
            <?php
                echo form_label( "Odluka Projekta", "odlukaProjekta", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "odlukaProjekta", "class" => "form-control", "value" => $d['odlukaProjekta'] ) );
                echo form_error ( "odlukaProjekta" );
            ?>
            <input type="hidden" name="idProjekat" value="<?= $d['idProjekat'] ?>" />
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
        
       
       <br><br><br>     
	<h3>Dodavanje projektne dokumentacije: </h3>


<input type="file" name='slika[]' size='20'  multiple />
<br>
<br>
<?php
echo form_submit("izmeni","Izmeni Projekat", array ( "class" => "btn dugme" ));
echo form_close();
echo "<span style='color:red'>";
 echo $errorSlika??"";
echo "</span>";
}?>
<br><br><br>
<div id="direktorijum">
        <h3>Dokumentacija Projekta:</h3>
       <?php 
     foreach($detaljiProjekta as $d) { 
                if($d!=null) { 
$putanja='uploads/'.$d['nazivProjekta'];
       }
foreach (directory_map($putanja) as $file)
{
    if(!empty(directory_map($putanja)))
    {
    echo "<a style='color:black !important;' target='_blank' href='".base_url($putanja."/".$file)."'>$file</a>&nbsp;&nbsp;&nbsp;";
   
    ?>
      
        <button class="btn" onclick="obrisifile('<?= $putanja."/".$file ?>', '<?= $d['idProjekat'] ?>')">Obrisi</button> <?php
     echo "<br>";
    }
   }
 }
?> 
	</div>
</div> 

    <script>
    function obrisifile(file, idProjekat) {
             if (confirm("Da li ste sigurni da zelite da obrisete fajl")) {
          
                 


                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200)
                  {

                     document.getElementById("direktorijum").innerHTML = this.responseText;
                  } 
                };
                xhttp.open("POST", "<?php echo site_url('Projekti/brisanjeFile'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("file="+file+"&idProjekat="+idProjekat);
            } 
        
        }
    </script>
</div>





