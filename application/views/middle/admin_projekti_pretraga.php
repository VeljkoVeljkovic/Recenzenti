
       
        
     
             <?php foreach($sviProjekti as $s) { ?>
        <div class="row card" id="pretraga">
            <div>
                <p><a class="link1" href="#" onclick="prikazi(<?= $s['idProjekat'] ?>, <?= $s['idPoziv'] ?>)"><?= $s['nazivProjekta']." " ?></a></p>
         <p class="link1"><?= $s['rukovodiocProjekta']; ?></p>
          <p class="link1"><?= $s['oblastProjekta']; ?></p>
            </div>
           </div>
            <?php } ?>
       
      


