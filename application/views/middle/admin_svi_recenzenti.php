
<div class="row">
    
    <div class="offset-1 col-sm-2 col-11 mt-5">
       
        
             <?php foreach($recenzenti as $r) { ?>
        <div class="row card mb-4">
            <div>
                <p><a class="link1" href="#" onclick="prikazi(<?= $r['idKorisnik'] ?>)"><?= $r['ime']." ".$r['prezime'] ?></a></p>
        
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
          xhttp.open("GET", "<?php echo site_url('Recenzent/angazovanjeRecenzenta'); ?>?id="+id, true);
          xhttp.send();
         
        }
        
        function dodela_projekta()
        {
            var idKorisnik=document.getElementById("idKorisnik").value;
           var idProjekat = document.getElementById("idProjekat").value;
            var rokZaIzvestaj = document.getElementById('rokZaIzvestaj').value;
         


                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200)
                  {

                      document.getElementById("projekat").innerHTML = this.responseText;
                      alert("Projekat je uspesno dodeljen!");
                  } 
                };
                xhttp.open("POST", "<?php echo site_url('Projekti/dodelaProjekta'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("idKorisnik="+idKorisnik+"&idProjekat="+idProjekat+"&rokZaIzvestaj="+rokZaIzvestaj);
              
        }
    </script>


