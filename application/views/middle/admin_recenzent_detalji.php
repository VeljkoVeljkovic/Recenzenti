
<div class="row ">
    <div class="offset-1 col-md-5 col-11 mb-3">
        <table class="table table-hover link1" style="margin-top:2px;">
            <?php foreach($recenzent as $r) { 
               
                ?>
            <tr>
                <td>Recenzent:</td>
                <td><?= $r['ime']." ".$r['prezime'] ?></td>
            </tr>
            <tr>
                <td>NIO:</td>
                <td><?= $r['NIO'] ?></td>
            </tr>
            <tr>
                <td>Trenutna firma:</td>
                <td><?= $r['trenutnaFirma'] ?></td>
            </tr>
            <tr>
                <td>Oblast strucnosti</td>
                <td><?= $r['oblastStrucnosti'] ?></td>
            </tr>
            <?= $r['statusPrijave'] ?>
            <?php } ?>
        </table> 
    </div>
    <div class="offset-1 col-md-5 col-11 mb-3">
        <h5 class="link1">Biografija recenzenta:</h5>
       <?php 
     foreach($recenzent as $r) { 
               
$putanja='uploads/recezent_'.$r['idKorisnik'];
       }
       if(directory_map($putanja)!=null)
    {
foreach (directory_map($putanja) as $slika)
{
    
    echo "<a class='link1' target='_blank' href='".base_url($putanja."/".$slika)."'>$slika</a>&nbsp;&nbsp;&nbsp;";
    echo "<br>";
  
   }
 }
?> 
    </div>
</div>
<div class="row ">
    <div class="offset-1 col-5 mt-3">
   
      <h5>Angazovanje recenzenta:</h5>
        <?php
        
        foreach($angazovanje as $a) { 
         if($a!=null) { ?>
      <p><?= "Naziv projekta: ".$a['nazivProjekta'] ?></p>
      <p><?= "Rok za izveštaj: ".$a['rokZaIzvestaj'] ?></p>
        <?php } }?>
 
    </div>
    </div>
    <div class="row">
        <h5>Dodela projekta: </h5>&nbsp;&nbsp;
    
       
                  <select id="idProjekat">
            <option value="Izaberi projekta" selected></option>
            <?php foreach($projekti as $p) { ?>
           
           <option value="<?php echo $p['idProjekat'] ?>"><?php echo $p['nazivProjekta'] ?></option>
          <?php   }   ?>
                  </select>&nbsp;&nbsp;
               
                    <input type="date" id="rokZaIzvestaj" />
                    <input type="hidden" name="idKorisnik" id ="idKorisnik" value="<?= $recenzent[0]['idKorisnik']??"" ?>" />&nbsp;&nbsp;&nbsp;
                
         
        
         
              <button class='btn mt-2' onclick='dodela_projekta()'>Dodaj</button>
              
    
</div>
<div class="row">
    <?php foreach($recenzent as $r) { if($r['statusPrijave']!='registrovan') { ?>
    <h4>Status prijave: </h4>&nbsp;&nbsp;
    <input type="text"  value="<?= $r['statusPrijave'] ?>" disabled />&nbsp;&nbsp;&nbsp;
    
    <select id="status">
       <option>razmatra_se</option>
       <option>registrovan</option>
    </select>&nbsp;&nbsp;&nbsp;
    <input type="hidden" name="idKorisnik" id ="idRecenzent" value="<?= $recenzent[0]['idKorisnik']??"" ?>" />
    <button class='btn' onclick='statusPrijave()'>Promeni</button>
    
    <?php  } } ?>
</div>




