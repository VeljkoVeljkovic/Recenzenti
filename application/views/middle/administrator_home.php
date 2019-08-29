
<div class="row">
    <div class="col-sm-4 col-12 mt-3">
   <div class="col-sm-10 offset-2 col-10 mb-1">  
    <h3>Neregistrovani korisnici: </h3>
   </div>
  <?php foreach($recezentiTotal as $neRegRecenzenti) { if($neRegRecenzenti['statusPrijave']!='registrovan') {?>  
    <div class="card col-11 offset-1 mb-2" onclick="prikazi(<?= $neRegRecenzenti['idKorisnik'] ?>)">
        <p><?= $neRegRecenzenti['ime']." ".$neRegRecenzenti['prezime']?></p>
        <p><?= $neRegRecenzenti['naucnoZvanje'] ?></p>
    </div>
        <br><br>
  <?php } } ?>
   <div class="col-sm-10 offset-2 col-10 mb-1" >  
    <h3>Istekao rok za izveštaje: </h3>
   </div>
  <?php foreach($rokZaIzvestaj as $isteklo) { ?>  
    <div class="card col-11 offset-1 mb-2" onclick="prikazi(<?= $isteklo['idKorisnik'] ?>)">
        <p><?= $isteklo['ime']." ".$isteklo['prezime']?></p>
        <p><?= $isteklo['naucnoZvanje'] ?></p>
    </div>
    <br><br>
  <?php } ?>
  </div>
    <div class="col-sm-8 col-12">
       <div id="projekat"></div> 
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
        
        function statusPrijave() {
            var idRecenzent=document.getElementById("idRecenzent").value;
           var status = document.getElementById("status").value;
            var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("projekat").innerHTML = "";
            } 
          };
          xhttp.open("GET", "<?php echo site_url('Recenzent/promenaStatusPrijave'); ?>?idRecenzent="+idRecenzent+"&status="+status, true);
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
