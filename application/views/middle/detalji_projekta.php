<div class="row">
   
    <div class="offset-1 col-md-5 col-11">
        <table class="table-hover link1" style="margin-top:2px;">
            <?php foreach($detaljiProjekta as $d) { ?>
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
                <td><?= $d['NIOrukovodioc'] ?></td>
            </tr>
            <tr>
                <td>Datum podnošenja</td>
                <td><?= $d['datumPodnosenja'] ?></td>
            </tr>
            <?php } ?>
        </table> 
    </div>
    <div class="offset-1 col-md-5 col-11">
        <h5 class="link1">Dokumentacija Projekta:</h5>
       <?php
    foreach($detaljiProjekta as $d) {    
$putanja='uploads/'.$d['nazivProjekta'];
  
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
</div>
<br>
<br>
<br>
<?php 
$zakljucano = 0;
foreach($ocena as $o)
  {
   if($o['statusOcene']=='zakljucana')
    {
       $zakljucano++;
    }   
  }

   if($zakljucano==count($ocena)){
       if($detaljiProjekta[0]['prijavaProjektacol']!='da') {
       ?>

<div class="col-md-4 col-sm-6 col-12 mt-3">
          <input type="hidden" name="idKorisnik" id ="idKorisnik" value="<?= $detaljiProjekta[0]['idKorisnik']??"" ?>" />
        <input type="hidden" name="idPrijava" id ="idPrijava" value="<?= $detaljiProjekta[0]['idPrijava']??"" ?>" />
        <input type="hidden" name="idProjekta" id ="idProjekta" value="<?= $detaljiProjekta[0]['idProjekat']??"" ?>" />
        <input type="hidden" name="poziv" id ="poziv" value="<?= $detaljiProjekta[0]['idPoziv']??"" ?>" />
   
          
              <button class='btn dugme' onclick='predaj_izvestaj()'>Predaj izvestaj</button>
         
    </div>
   <?php }  }

foreach($pitanja as $p) { ?>
 <div class="row form-group">
       <div class="col-md-4 col-sm-6 col-12 ">
           <textarea cols="200" class="form-control" disabled><?= $p['pitanje'] ?></textarea>
       </div>
     
     


<?php
 if(empty($ocena)) {  ?>
      <div class="col-md-4 col-sm-6 col-12 ">
           <textarea cols="100" class="form-control" id="ocena<?= $p['idPitanja']??"" ?>"></textarea>
       </div>
       <div class="col-md-2 col-sm-6 col-12 ">
       <select id="ocenaProjekta<?= $p['idPitanja']??"" ?>">
          
            <?php for($i=1; $i<=10; $i++) { ?>
           
           <option value="<?php echo $i ?>"><?php echo $i ?></option>
          <?php   }  ?>
       </select>
       </div>
  
      <div class="col-md-4 col-sm-6 col-12 mt-3">
          <input type="hidden" name="idKorisnik" id ="idKorisnik<?= $p['idPitanja']??"" ?>" value="<?= $detaljiProjekta[0]['idKorisnik']??"" ?>" />
        <input type="hidden" name="idPrijava" id ="idPrijava<?= $p['idPitanja']??"" ?>" value="<?= $detaljiProjekta[0]['idPrijava']??"" ?>" />
        <input type="hidden" name="idProjekta" id ="idProjekta<?= $p['idPitanja']??"" ?>" value="<?= $detaljiProjekta[0]['idProjekat']??"" ?>" />
        <input type="hidden" name="idPitanja" id ="idPitanja<?= $p['idPitanja']??"" ?>" value="<?= $p['idPitanja']??"" ?>" />
        <input type="hidden" name="poziv" id ="poziv<?= $p['idPitanja']??"" ?>" value="<?= $detaljiProjekta[0]['idPoziv']??"" ?>" />
   
          
              <button class='btn dugme' onclick='dodavanje_ocene(<?= $p['idPitanja']??"" ?>)'>Unesi</button>
         
    </div>
 </div>
 <br><br>
<?php } else {  
foreach($ocena as $o) {
    
   
 if($o['idPitanja']==$p['idPitanja']){ ?>

     <input type="hidden" name="idKorisnik" id ="idKorisnik<?= $o['idPitanja'] ?>" value="<?= $detaljiProjekta[0]['idKorisnik'] ?>" />
        <input type="hidden" name="idPrijava" id ="idPrijava<?= $o['idPitanja'] ?>" value="<?= $o['idPrijava'] ?>" />
        <input type="hidden" name="idProjekta" id ="idProjekta<?= $o['idPitanja'] ?>" value="<?= $o['idProjekat'] ?>" />
        <input type="hidden" name="idPitanja" id ="idPitanja<?= $o['idPitanja'] ?>" value="<?= $o['idPitanja'] ?>" />
        <input type="hidden" name="poziv" id ="poziv<?= $o['idPitanja'] ?>" value="<?= $o['idPoziv'] ?>" />
        <input type="hidden" name="idOcena" id ="idOcena<?= $o['idPitanja'] ?>" value="<?= $o['idOcena'] ?>" />

       <div class="col-md-4 col-sm-6 col-12"">
           <textarea class="form-control" id="ocena<?= $o['idPitanja'] ?>"  <?= $o['statusOcene']=="zakljucana"?"disabled":""?>><?= $o['komentarOcene'] ?></textarea>
       </div>
       <div class="col-md-4 col-sm-6 col-12">
       <select id="ocenaProjekta<?= $o['idPitanja'] ?>" <?= $o['statusOcene']=="zakljucana"?"disabled":""?>>
            <option value="<?php echo $o['ocenaProjekta'] ?>" selected><?php echo $o['ocenaProjekta'] ?></option>
            <?php for($i=1; $i<=10; $i++) { ?>
           
           <option value="<?php echo $i ?>"><?php echo $i ?></option>
          <?php   }  ?>
       </select>
       </div>
  <?php if($o['statusOcene']!='zakljucana') { ?>
    <div class="col-md-4 col-sm-6 col-12 mt-3">
       
          
              <button class='btn dugme' onclick='izmena_ocene(<?= $o['idPitanja'] ?>)'>Izmeni</button>
         
    </div>
    
    <div class="col-md-4 col-sm-6 col-12 mt-3">
        
        <button class="btn dugme" onclick='zakljucaj(<?= $o['idPitanja'] ?>)'>Zaključaj</button>
            
    </div>
 
    <div class="col-md-4 col-sm-6 col-12 mt-3">   
      
        <button class="btn dugme" onclick='obrisi(<?= $o['idPitanja'] ?>)'>Obrisi</button>
    </div>
 <?php } ?>

<?php break; } 
else if(count($ocena)<count($pitanja))
{ ?>
  
      <div class="col-md-4 col-sm-6 col-12">
           <textarea class="form-control" id="ocena<?= $p['idPitanja'] ?>" ></textarea>
       </div>
       <div class="col-md-4 col-sm-6 col-12">
       <select id="ocenaProjekta<?= $p['idPitanja'] ?>">
          
            <?php for($i=1; $i<=10; $i++) { ?>
           
           <option value="<?php echo $i ?>"><?php echo $i ?></option>
          <?php   }  ?>
       </select>
       </div>
  
      <div class="col-md-4 col-sm-6 col-12 mt-3">
          <input type="hidden" name="idKorisnik" id ="idKorisnik<?= $p['idPitanja']??"" ?>" value="<?= $detaljiProjekta[0]['idKorisnik']??"" ?>" />
        <input type="hidden" name="idPrijava" id ="idPrijava<?= $p['idPitanja']??"" ?>" value="<?= $detaljiProjekta[0]['idPrijava']??"" ?>" />
        <input type="hidden" name="idProjekta" id ="idProjekta<?= $p['idPitanja']??"" ?>" value="<?= $detaljiProjekta[0]['idProjekat']??"" ?>" />
        <input type="hidden" name="idPitanja" id ="idPitanja<?= $p['idPitanja']??"" ?>" value="<?= $p['idPitanja']??"" ?>" />
        <input type="hidden" name="poziv" id ="poziv<?= $p['idPitanja']??"" ?>" value="<?= $detaljiProjekta[0]['idPoziv']??"" ?>" />
          
              <button class='btn dugme' onclick='dodavanje_ocene(<?= $p['idPitanja'] ?>)'>Unesi</button>
         
    </div>

<?php }
 
} }  }  



   

  ?>









