<div class="row">
    <div class="offset-1 col-2">
      <?php
     
      if(!empty($mojeAnkete)){
          
      
      foreach($mojeAnkete as $a) { ?>
        <div class="row">
          <?php  if($a['status']!='popunjena') { ?>
            <div>
                <button class="submit" href="#" onclick="prikazi(<?= $a['idAnketa'] ?>)"><?= $a['nazivAnkete'] ?></button>
            </div>
            <?php }?>
           </div>
      <?php }}?>
    </div>

    <div class="col-8 " style="margin-right: 5px;">
        <?php if($uspeh??"") { ?>
            <div class="alert alert-success">
                <p><?= $uspeh??"" ?></p>
            </div>
    <?php    } ?>
        <?php if($greska??"") { ?>
            <div class="alert alert-danger">
                <p><?= $greska??"" ?></p>
            </div>
    <?php    } ?>
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
          xhttp.open("GET", "<?php echo site_url('Ankete/recenzentAnketaDetalji'); ?>?id="+id, true);
          xhttp.send();
         
        }
   </script>
