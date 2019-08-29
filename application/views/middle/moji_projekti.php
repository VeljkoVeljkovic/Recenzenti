<div class="row">
    
    <div class="offset-1 col-2">
       
        
             <?php foreach($mojiProjekti as $m) { 
                 if($mojiProjekti!=0) { ?>
        <div class="row projekat">
           
            <div class="card col-12" onclick="prikazi(<?= $m['idProjekat'] ?>, <?= $m['idPoziv'] ?>, <?= $m['idKorisnik'] ?>)">    
              
         
               
         <p><a class="" href="#" onclick="prikazi(<?= $m['idProjekat'] ?>, <?= $m['idPoziv'] ?>, <?= $m['idKorisnik'] ?>)"><?= $m['nazivProjekta']." " ?></a></p>       
         <p class=""><?= $m['rukovodiocProjekta']; ?></p>
          <p class=""><?= $m['NIOrukovodioc']; ?></p>
           </div>
           </div>
             <?php } else { echo "Trenutno niste angažovani na nijednom projektu"; } } ?>
       
      
    </div>
    <div class="col-8 " style="margin-right: 5px;">
    
         <div id="projekat">
           
         </div>
   
     
     </div>
  </div>
     <script>
         function zakljucaj(id) {
           var idOcena=document.getElementById("idOcena"+id).value;
           var idProjekta = document.getElementById("idProjekta"+id).value;
           var poziv=document.getElementById("poziv"+id).value;
         


                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200)
                  {

                      document.getElementById("projekat").innerHTML = this.responseText;
                      alert("Ocena je uspesno zakljucana");
                  } 
                };
                xhttp.open("POST", "<?php echo site_url('Projekti/zakljucavanjeOcene'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("idOcena="+idOcena+"&idProjekta="+idProjekta+"&poziv="+poziv);
              
        
        }
        //PrikaziT pokusaj preko POST metode kocio je zbog input polja otvaranje druge strane
         function prikaziT()
              {
                   var poziv = document.getElementById("poziv").value;
                   var projekat=document.getElementById("projekat").value;
                   
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200)
                  {

                      document.getElementById("projekat").innerHTML = this.responseText;
                     
                  } 
                };
                xhttp.open("POST", "<?php echo site_url('Projekti/detaljiT'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("poziv="+poziv+"&projekat="+projekat);
                
              }
        
         function obrisi(id) {
             if (confirm("Da li ste sigurni da zelite da obrisete ocenu")) {
           var idOcena=document.getElementById("idOcena"+id).value;
           var idProjekta = document.getElementById("idProjekta"+id).value;
           var   poziv=document.getElementById("poziv"+id).value;
         


                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200)
                  {

                      document.getElementById("projekat").innerHTML = this.responseText;
                  } 
                };
                xhttp.open("POST", "<?php echo site_url('Projekti/brisanjeOcene'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("idOcena="+idOcena+"&idProjekta="+idProjekta+"&poziv="+poziv);
            } 
        
        }
     
        function prikazi(id, poziv, idKorisnik) {
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {   
               
                document.getElementById("projekat").innerHTML = this.responseText;
            } 
          };
          xhttp.open("GET", "<?php echo site_url('Projekti/detaljiT'); ?>?id="+id+"&poziv="+poziv+"&idKorisnik="+idKorisnik, true);
          xhttp.send();
        
        }
        
       
  
   
        function dodavanje_ocene(id) {
            var idKorisnik=document.getElementById("idKorisnik"+id).value;
           var idPrijava=document.getElementById("idPrijava"+id).value;
           var poziv=document.getElementById("poziv"+id).value;
           var idProjekta = document.getElementById("idProjekta"+id).value;
           var idPitanja=document.getElementById("idPitanja"+id).value;
           var ocena=document.getElementById("ocena"+id).value;
           var ocenaProjekta=document.getElementById("ocenaProjekta"+id).value;
          


                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200)
                  {

                      document.getElementById("projekat").innerHTML = this.responseText;
                  } 
                };
                xhttp.open("POST", "<?php echo site_url('Projekti/dodataOcena'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("id="+idProjekta+"&ocena="+ocena+"&idPrijava="+idPrijava+"&idPitanja="+idPitanja+"&ocenaProjekta="+ocenaProjekta+"&poziv="+poziv+"&idKorisnik="+idKorisnik);

          } 
          
          function izmena_ocene(id) {
           var idKorisnik=document.getElementById("idKorisnik"+id).value;
           var idPrijava=document.getElementById("idPrijava"+id).value;
           var idProjekta = document.getElementById("idProjekta"+id).value;
           var idPitanja=document.getElementById("idPitanja"+id).value;
           var poziv=document.getElementById('poziv'+id).value;
           var ocena=document.getElementById("ocena"+id).value;          
           var ocenaProjekta=document.getElementById("ocenaProjekta"+id).value;
          


                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200)
                  {

                      document.getElementById("projekat").innerHTML = this.responseText;
                  } 
                };
                xhttp.open("POST", "<?php echo site_url('Projekti/izmenaOcene'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("id="+idProjekta+"&ocena="+ocena+"&idPrijava="+idPrijava+"&idPitanja="+idPitanja+"&ocenaProjekta="+ocenaProjekta+"&poziv="+poziv+"&idKorisnik="+idKorisnik);

          }  
          
          function predaj_izvestaj() {
           var idKorisnik=document.getElementById("idKorisnik").value;
           var idPrijava=document.getElementById("idPrijava").value;
           var idProjekta = document.getElementById("idProjekta").value;
           var poziv=document.getElementById('poziv').value;
           
          


                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200)
                  {

                      document.getElementById("projekat").innerHTML = "Izveštaj je uspešno predat. Hvala na saradnji!";
                  } 
                };
                xhttp.open("POST", "<?php echo site_url('Projekti/predavanjeIzvestaja'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("id="+idProjekta+"&idPrijava="+idPrijava+"&poziv="+poziv+"&idKorisnik="+idKorisnik);

          }      
      
    </script>
