



<div class="row">
    <div class="offset-2 col-3 offset-1">
        <?php   echo form_open(
                    "Ankete/kreirajAnketu"
                ); 
                echo form_fieldset( "Kreiranje ankete" );
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
    <div class="offset-1 col-sm-2 col-11">
      <?php foreach($anketeTotal as $a) { ?>
        <div class="row">
            <div>
                <button class="btn" href="#" onclick="prikazi(<?= $a['idAnketa'] ?>)"><?= $a['nazivAnkete'] ?></button>
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
          xhttp.open("GET", "<?php echo site_url('Ankete/anketaDetalji'); ?>?id="+id, true);
          xhttp.send();
         
        }
        
        function dodajSlobodnoPitanje() {
           var idAnketaS=document.getElementById("idAnketaS").value;
           var pitanjeS = document.getElementById("pitanjeS").value;

         


                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200)
                  {

                      document.getElementById("projekat").innerHTML = this.responseText;
                  } 
                };
                xhttp.open("POST", "<?php echo site_url('Ankete/dodavanjeSlobodnogPitanja'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("idAnketaS="+idAnketaS+"&pitanjeS="+pitanjeS);
              
        
        }
        
        function dodajRadioPitanje() {
           var idAnketa=document.getElementById("idAnketa").value;
           var pitanje = document.getElementById("pitanje").value;
           var odgovor1 = document.getElementById("odgovor1").value;
           var odgovor2 = document.getElementById("odgovor2").value;
           var odgovor3 = document.getElementById("odgovor3").value;
           var odgovor4 = document.getElementById("odgovor4").value;

         


                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200)
                  {

                      document.getElementById("projekat").innerHTML = this.responseText;
                  } 
                };
                xhttp.open("POST", "<?php echo site_url('Ankete/dodavanjeRadioPitanja'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("idAnketa="+idAnketa+"&pitanje="+pitanje+"&odgovor1="+odgovor1+"&odgovor2="+odgovor2+"&odgovor3="+odgovor3+"&odgovor4="+odgovor4);
        }
        
        function zakljucavanjeAnkete(){
          if (confirm("Da li ste sigurni da je anketa završena"))
          {
           var idAnketa=document.getElementById("idAnketa").value;
            var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200)
                  {

                      document.getElementById("projekat").innerHTML = this.responseText;
                      alert("Anketa je uspesno zavrsena");
                  } 
                };
                xhttp.open("POST", "<?php echo site_url('Ankete/zakljucavanjeAnkete'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("idAnketa="+idAnketa);
              
            }
        }
        
         function obrisi(idAnketaPitanje, idAnketa) {
             if (confirm("Da li ste sigurni da zelite da obrisete pitanje")) {
          
         


                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200)
                  {

                      document.getElementById("projekat").innerHTML = this.responseText;
                  } 
                };
                xhttp.open("POST", "<?php echo site_url('Ankete/brisanjePitanjaZaAnketu'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("idAnketaPitanje="+idAnketaPitanje+"&idAnketa="+idAnketa);
            } 
        
        }
        
    </script>



