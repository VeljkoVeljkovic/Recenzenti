 <div id="projekat">
             
    </div>
<div class="row">
    <div class="offset-2 col-8 offset-2  mt-5">
        <input type="text" id="naslov" class="form-control" placeholder="Uneti naslov obaveštenja" />
    </div>  
    <div class="offset-2 col-8 offset-2  mt-5">
        <textarea id="obavestenje" class="form-control" placeholder="Uneti tekst obaveštenja"></textarea>
    </div>  
    </div>
   <div class="row justify-content-center">
            <br><br>
            <div class="col-sm-4 col-12 mt-5 ">
                <select name="sviRecenzenti" id="sviRecenzenti" class="btn btn-sm r" )>
               <option value="" selected>Svi Recenzenti</option>
              <?php foreach($sviRecenzenti as $s) { ?>
           <option value="<?= $s['idKorisnik']; ?>"><?= $s['ime']." ".$s['prezime']; ?></option>
               <?php } ?>
           </select>
           </div>
           <div class="col-sm-4 col-12 mt-5">
            <select name="oblastStrucnost" id="oblastStrucnost" class="btn btn-sm" )>
               <option value="" selected>Oblasti strucnosti</option>
              <?php foreach($sveOblasti as $s) { ?>
           <option value="<?= $s['idOblastiStrucnosti']; ?>"><?= $s['oblastStrucnosti']; ?></option>
               <?php } ?>
           </select>
          </div>
        <div class="col-sm-2 col-12 mt-5">
            <button class="btn btn-sm ml-2 submit" onclick='dodaj()'>Posalji mejl</button>
        </div>
        <div class="col-sm-2 col-12 mt-5">
            <button class="btn btn-sm ml-2 submit" onclick='posalji()'>Posalji u inbox</button>
        </div>
       
    </div>

<!--<div class="row" id="obavestenje">
<table class="table table-striped">
    <thead>
        <tr>
            <td>Tekst</td>
            <td>Datum</td>
            <td>Naslov</td>
            <td>Potpis</td>
        </tr>
    </thead> 
    <tbody>
        <?php // foreach($obavestenja as $s) { ?>
        <tr>
          <td><?php // echo $s['tekst'] ?></td>
          <td><?php // echo  $s['datum'] ?></td>
          <td><?php // echo  $s['naslov'] ?></td>
          <td><?php // echo  $s['potpis'] ?></td> 
        </tr>
        <?php //} ?>
    </tbody>
</table>
</div>-->
   
    <script>
    function dodaj() {
           var naslov=document.getElementById("naslov").value;
           var obavestenje=document.getElementById("obavestenje").value;
           var sviRecenzenti = document.getElementById("sviRecenzenti").value;
           var oblastStrucnost = document.getElementById("oblastStrucnost").value;
         


                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200)
                  {
                      document.getElementById("obavestenje").value="";
              //        document.getElementById("projekat").innerHTML = this.responseText;
                      alert('Obavestenje je uspesno poslato!');
                  } 
                };
                xhttp.open("POST", "<?php echo site_url('obavestenja/slanjeObavestenja'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("obavestenje="+obavestenje+"&sviRecenzenti="+sviRecenzenti+"&oblastStrucnost="+oblastStrucnost+"&naslov="+naslov);
              
        
        }   
        
        function posalji() {
           var naslov=document.getElementById("naslov").value;
           var obavestenje=document.getElementById("obavestenje").value;
           var sviRecenzenti = document.getElementById("sviRecenzenti").value;
           var oblastStrucnost = document.getElementById("oblastStrucnost").value;
         


                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200)
                  {
                      document.getElementById("obavestenje").value="";
                      document.getElementById("projekat").innerHTML = this.responseText;
                      alert('Obavestenje je uspesno poslato!');
                  } 
                };
                xhttp.open("POST", "<?php echo site_url('obavestenja/obavestenjeuInbox'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("obavestenje="+obavestenje+"&sviRecenzenti="+sviRecenzenti+"&oblastStrucnost="+oblastStrucnost+"&naslov="+naslov);
              
        
        }   
    </script>