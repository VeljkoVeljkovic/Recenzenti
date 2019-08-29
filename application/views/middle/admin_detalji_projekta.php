<div class="row">
    <div class="offset-1 col-sm-5 col-11">
        <table class="table table-hover link1" style="margin-top:2px;">
            <?php foreach($detaljiProjekta as $d) { 
               
                ?>
            <tr>
                <td>Naziv projekta:</td>
                <td><?= $d['nazivProjekta'] ?></td>
            </tr>
            <tr>
                <td>Rukovodioc projekta:</td>
                <td><?= $d['rukovodiocProjekta'] ?></td>
            </tr>
            <tr>
                <td>Oblast projekta:</td>
                <td><?= $d['oblastProjekta'] ?></td>
            </tr>
            <tr>
                <td>Datum podnošenja</td>
                <td><?= $d['datumPodnosenja'] ?></td>
            </tr>
            <?php } ?>
        </table> 
    </div>
    <div class="offset-1 col-sm-5 col-11">
        <div>
        <h5 class="link1">Dokumentacija Projekta:</h5>
       <?php 
     foreach($detaljiProjekta as $d) { 
                if($d!=null) { 
$putanja='uploads/'.$d['nazivProjekta'];
       }
foreach (directory_map($putanja) as $slika)
{
    if(!empty(directory_map($putanja)))
    {
    echo "<a class='link1' target='_blank' href='".base_url($putanja."/".$slika)."'>$slika</a>&nbsp;&nbsp;&nbsp;";
    echo "<br>";
    }
   }
 }
?> 
    </div>
     <br>
        <br>
        <div>

          <a class="btn dugme" href="<?= site_url('Projekti/brisanjeProjekta'); ?>?id=<?= $detaljiProjekta[0]['idProjekat'] ?>" onclick="return confirm('Da li ste sigurni da zelite da obrisete projekat?')">Obrisi projekat</a>
        </div>
        <br>
        <div>
            <a class="btn dugme" href="<?= site_url('Projekti/promenaPodatakaProjekta'); ?>?id=<?= $detaljiProjekta[0]['idProjekat'] ?>">Promeni podatke</a>
        </div>
        </div>
</div>
<div class="row">
    <div class="offset-1 col-5">
    <table class="table table-hover link1" style="margin-top:2px;">
        <tr><td><h5>Recezenti projekta:</h5></td></tr>
        <?php
        
        foreach($recenzenti as $r) { 
         if($r!=null) { ?>
        <tr><td ><a class="link1"  href="<?= site_url('Recenzent/projektiRecenzent'); ?>"><?= $r['ime']." ".$r['prezime'] ?></a></td></tr>
        <?php } }?>
    </table>
    </div>
</div>
 
        <?php foreach($pitanja as $p) { ?>
<div class="row">
       <div class="col-4">
           <textarea class="form-control" disabled><?= $p['pitanje'] ?></textarea>
       </div>
   
   
 <div class="8"> 
<?php

foreach($ocena as $o) {
 if($o['idPitanja']==$p['idPitanja']){ ?>
  
    
     <div class="row" >
       <div class="col-4">
           <textarea class="form-control" id="ocenaKomentar" disabled ><?= $o['komentarOcene']??"" ?></textarea>
       </div>
       <div class="col-2">
       
            <textarea class="form-control" id="ocena" disabled ><?= $o['ocenaProjekta']??"" ?></textarea>
            
       </div>
          <div class="col-4">
       
            <?= $o['ime']??"" ?> <?= $o['prezime']??"" ?>
            
       </div>
        
       </div> 
     
      
      <br><br>
      
        <?php $idprobaaa = "etoresenja";  } else if($o['idPitanja']!=$p['idPitanja']) {
         if(!isset($idprobaaa)) { 
         echo "</div>";
          echo "<br><br>";
       }
        
        }
      
          }
          
        ?>   </div><br><br>
       </div>
  <?php    
          } ?>

    