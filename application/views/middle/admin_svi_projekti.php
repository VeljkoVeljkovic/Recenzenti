
<div class="row">
   <div class="ml-5 mt-5"> 
        <?php   echo form_open(
                    "Projekti/pretragaProjakata"
                ); 
                echo form_fieldset( "Pretrage:" );
        ?>
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
            <button type="submit" class="btn btn-small" name="pretraga">Pretraga</button>
            
        </div>
             <?php 
            echo form_fieldset_close();
            echo form_close(); 
        ?>
    </div>
</div>
<div  class="row">
   
    <div class="offset-1 col-sm-2 col-11" id="pretraga">
       
        
             <?php foreach($sviProjekti as $s) { ?>
        <div class="row card">
            <div>
                <p><a class="link1" href="#" onclick="prikazi(<?= $s['idProjekat'] ?>, <?= $s['idPoziv'] ?>)"><?= $s['nazivProjekta']." " ?></a></p>
         <p class="link1"><?= $s['rukovodiocProjekta']; ?></p>
          <p class="link1"><?= $s['oblastProjekta']; ?></p>
            </div>
           </div>
            <?php } ?>
       
      
      </div>
      <div class="offset-1 col-2" id="rezultat" style="display: none">
       
        
      
      </div>
    
    <div class="col-sm-8 col-12" style="margin-right: 5px;">
         <div id="projekat">
             
         </div>
     </div>
    </div>
    <script>
// Pokusao sam preko ajax-a ali stalno pravi problem kada je polje prazno         
//        function pretraga(){
//            var oblastProjekta;
//           if(typeof    (document.getElementById("oblastStrucnosti").value!=="undefined") || document.getElementById("oblastStrucnosti").value!==null)
//    {
//         var oblastProjekta=document.getElementById("oblastStrucnosti").value;
//    } 
//            
//            var naziv=document.getElementById("naziv").value;
//            var xhttp = new XMLHttpRequest();
//          xhttp.onreadystatechange = function() {
//            if (this.readyState == 4 && this.status == 200)
//            {
//                document.getElementById("pretraga").style.display = 'none';
//                document.getElementById("rezultat").style.display = 'inline';
//                document.getElementById("rezultat").innerHTML = this.responseText;
//            } 
//          };
//          xhttp.open("GET", "<?php // echo site_url('Projekti/pretragaProjakata'); ?>?naziv="+naziv+"&oblastProjekta="+oblastProjekta, true);
//          xhttp.send();
//        }
        function prikazi(id, poziv) {
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

