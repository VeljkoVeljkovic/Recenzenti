
<div class="row">
   <div class="ml-5 mt-5"> 
       
        <div class="form-group">
            <input name="naziv" id="naziv" type="text" class="" placeholder="Pretraga po nazivu"/>
            
       
            <select  class="" name="oblastProjekta" id="oblastProjekta">
               <option value="" selected>Oblast projekta</option>
              <?php foreach($sviProjekti as $s) { ?>
           <option value="<?= $s['oblastProjekta']; ?>"><?= $s['oblastProjekta']; ?></option>
               <?php } ?>
           </select>
           </div>
        <div class="form-group rowml-5">
            <button type="submit" class="btn btn-small" name="pretraga" id="pretrag" onclick="pretraga()">Pretraga</button>
            
        </div>
             
    </div>
</div>
<div  class="row">
   
    <div class="offset-1 col-sm-2 col-11" id="pretraga" >
       
        
             <?php foreach($sviProjekti as $s) { ?>
        <div class="row card" id="pretraga">
            <div>
                <p><a class="link1" href="#" onclick="prikazi(<?= $s['idProjekat'] ?>, <?= $s['idPoziv'] ?>)"><?= $s['nazivProjekta']." " ?></a></p>
         <p class="link1"><?= $s['rukovodiocProjekta']; ?></p>
          <p class="link1"><?= $s['oblastProjekta']; ?></p>
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
	
    
     function pretraga(){
           
          
   
        var oblastProjekta=document.getElementById("oblastProjekta").value;    
       var naziv=document.getElementById("naziv").value;    
        
            
           
           var xhttp = new XMLHttpRequest();
         xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
           {
                document.getElementById("pretraga").innerHTML = "";
           //  document.getElementById("pretraga").style.display = "none"; 
         //    document.getElementById("rezultat").style.display = 'inline';
             document.getElementById("pretraga").innerHTML = this.responseText;
           } 
         };
         
         if(oblastProjekta==null){
         xhttp.open("GET", "<?php  echo site_url('Projekti/pretragaProjakata'); ?>?naziv="+naziv, true);}
         else if(naziv==null){
         xhttp.open("GET", "<?php  echo site_url('Projekti/pretragaProjakata'); ?>?oblastProjekta="+oblastProjekta, true); }
        else {
         xhttp.open("GET", "<?php  echo site_url('Projekti/pretragaProjakata'); ?>?naziv="+naziv+"&oblastProjekta="+oblastProjekta, true);}
        xhttp.send();
        }
        
        function prikaziProjekat(id, poziv) {
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("projekat").innerHTML = this.responseText;
            } 
          };
          xhttp.open("GET", "<?php echo site_url('Projekti/detaljiProjekta'); ?>?id="+id+"&poziv="+poziv, true);
          xhttp.send();
         
        }
        
         function obrisiProjekat(id) {
             if (confirm("Da li ste sigurni da zelite da obrisete projekat")) {
           
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200)
                  {

                     // document.getElementById("projekat").innerHTML = this.responseText;
                  } 
                };
                xhttp.open("POST", "<?php echo site_url('Projekti/brisanjeProjekta'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("id="+id);
            } 
            }
            
        function promeniProjekat(id)
        {
            var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200)
                  {

                      // document.getElementById("projekat").innerHTML = this.responseText;
                  } 
                };
                xhttp.open("POST", "<?php echo site_url('Projekti/promenaPodatakaProjekta'); ?>", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("id="+id);
        }
    </script>

