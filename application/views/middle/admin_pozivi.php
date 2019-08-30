



<div class="row">
    <div class="offset-2 col-sm-3 col-9 offset-1">
        <?php   echo form_open(
                    "Projekti/kreirajPoziv"
                ); 
                echo form_fieldset( "Kreiranje poziva" );
        ?>
        <div class="form-group row">
            <?php
                echo form_label( "Naziv", "naziv", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "naziv", "class" => "form-control"));
                echo form_error ( "naziv" );
            ?>
        </div>
          <div class="form-group row">
              <button class="btn" >Kreiraj</button>
            
        </div>
        <?php 
            echo form_fieldset_close();
            echo form_close(); 
        ?>
    </div>
   
</div>  
<div class="row">
    <div class="offset-1  col-sm-2 col-11">
      <?php foreach($sviPozivi as $s) { ?>
        <div class="row card" onclick="prikazi(<?= $s['idpoziv'] ?>)">
            <div>
                <p><?= $s['naziv'] ?></p>
            </div>
           </div>
      <?php } ?>
    </div>

    <div class="col-sm-8 col-12" style="margin-right: 5px;">
         <div id="projekat">
             
         </div>
     </div>
 </div>
    <script>
        
        function prikazi(id) {
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("projekat").innerHTML = this.responseText;
            } 
          };
          xhttp.open("GET", "<?php echo site_url('Projekti/pozivIPitanja'); ?>?id="+id, true);
          xhttp.send();
         
        }
        
        function dodaj() {
           var idPoziv=document.getElementById("idPoziv").value;
           var pitanje = document.getElementById("pitanje").value;

         


                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200)
                  {

                      document.getElementById("projekat").innerHTML = this.responseText;
                  } 
                };
                xhttp.open("POST", "<?php echo site_url('Projekti/dodavanjePitanjaZaPoziv'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("idPoziv="+idPoziv+"&pitanje="+pitanje);
              
        
        }
        
        function obrisi(idpitanja, idpoziv) {
             if (confirm("Da li ste sigurni da zelite da obrisete pitanje")) {
          
         


                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200)
                  {

                      document.getElementById("projekat").innerHTML = this.responseText;
                  } 
                };
                xhttp.open("POST", "<?php echo site_url('Projekti/brisanjePitanjaZaPoziv'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("idpitanja="+idpitanja+"&idpoziv="+idpoziv);
            } 
        
        }
    </script>

