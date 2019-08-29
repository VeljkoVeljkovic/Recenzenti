<div class="row">
   
    <div class="offset-1 col-5">
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
    <div class="offset-1 col-5">
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

foreach($pitanja as $p) { ?>
 <div class="row">
       <div class="col-2">
           <textarea class="form-control" disabled><?= $p['pitanje'] ?></textarea>
       </div>
     
     
<br><br><br>  

<?php
 if(empty($ocena)) {  ?>
      <div class="col-2">
           <textarea class="form-control" id="ocena" ></textarea>
       </div>
       <div class="col-2">
       <select id="ocenaProjekta">
          
            <?php for($i=1; $i<=10; $i++) { ?>
           
           <option value="<?php echo $i ?>"><?php echo $i ?></option>
          <?php   }  ?>
       </select>
       </div>
  
      <div class="col-2">
          <input type="hidden" name="idKorisnik" id ="idKorisnik" value="<?= $detaljiProjekta[0]['idKorisnik']??"" ?>" />
        <input type="hidden" name="idPrijava" id ="idPrijava" value="<?= $detaljiProjekta[0]['idPrijava']??"" ?>" />
        <input type="hidden" name="idProjekta" id ="idProjekta" value="<?= $detaljiProjekta[0]['idProjekat']??"" ?>" />
        <input type="hidden" name="idPitanja" id ="idPitanja" value="<?= $p['idPitanja']??"" ?>" />
        <input type="hidden" name="poziv" id ="poziv" value="<?= $detaljiProjekta[0]['idPoziv']??"" ?>" />
   
          
              <button class='btn dugme' onclick='dodavanje_ocene()'>Unesi</button>
         
    </div>
 </div>
 <br><br>
<?php } else {  
foreach($ocena as $o) {
    
   
 if($o['idPitanja']==$p['idPitanja']){ ?>

    

       <div class="col-2">
           <textarea class="form-control" id="ocena" ><?= $o['komentarOcene']??"" ?></textarea>
       </div>
       <div class="col-2">
       <select id="ocenaProjekta">
            <option value="<?php echo $o['ocenaProjekta']??"" ?>" selected><?php echo $o['ocenaProjekta']??"" ?></option>
            <?php for($i=1; $i<=10; $i++) { ?>
           
           <option value="<?php echo $i ?>"><?php echo $i ?></option>
          <?php   }  ?>
       </select>
       </div>
  <?php if($o['statusOcene']!='zakljucana') { ?>
    <div class="col-2">
        <input type="hidden" name="idKorisnik" id ="idKorisnik" value="<?= $detaljiProjekta[0]['idKorisnik']??"" ?>" />
        <input type="hidden" name="idPrijava" id ="idPrijava" value="<?= $o['idPrijava']??"" ?>" />
        <input type="hidden" name="idProjekta" id ="idProjekta" value="<?= $o['idProjekat']??"" ?>" />
        <input type="hidden" name="idPitanja" id ="idPitanja" value="<?= $o['idPitanja']??"" ?>" />
        <input type="hidden" name="poziv" id ="pozivIzmeni" value="<?= $o['idPoziv']??"" ?>" />
          
              <button class='btn dugme' onclick='izmena_ocene()'>Izmeni</button>
         
    </div>
    
    <div class="col-2">
        <input type="hidden" name="idKorisnik" id ="idKorisnik" value="<?= $detaljiProjekta[0]['idKorisnik']??"" ?>" />
        <input type="hidden" name="idProjekta" id ="idProjekta" value="<?php echo $o['idProjekat'] ?>" /> 
        <input type="hidden" name="idOcena" id ="idOcena" value="<?php echo $o['idOcena'] ?>" /> 
        <input type="hidden" name="poziv" id ="pozivZakljucaj" value="<?= $o['idPoziv']??"" ?>" />
        <button class="btn dugme" onclick='zakljucaj()'>Zaključaj</button>
            
    </div>
  <?php } ?>
    <div class="col-2">   
        <input type="hidden" name="idKorisnik" id ="idKorisnik" value="<?= $detaljiProjekta[0]['idKorisnik']??"" ?>" />
        <input type="hidden" name="idProjekta" id ="idProjekta" value="<?= $o['idProjekat']??"" ?>" /> 
        <input type="hidden" name="idOcena" id ="idOcena" value="<?= $o['idOcena']??"" ?>" /> 
        <input type="hidden" name="poziv" id ="pozivObrisi" value="<?= $o['idPoziv']??"" ?>" />
        <button class="btn dugme" onclick='obrisi()'>Obrisi</button>
    </div>
 </div>
<br><br>

<?php $idprobaaa = "etoresenja"; } 
else if($o['idPitanja']!=$p['idPitanja'])
{ 
   if(isset($idprobaaa)) {  ?>
      <div class="col-2">
           <textarea class="form-control" id="ocena" ></textarea>
       </div>
       <div class="col-2">
       <select id="ocenaProjekta">
          
            <?php for($i=1; $i<=10; $i++) { ?>
           
           <option value="<?php echo $i ?>"><?php echo $i ?></option>
          <?php   }  ?>
       </select>
       </div>
  
      <div class="col-2">
        <input type="hidden" name="idKorisnik" id ="idKorisnik" value="<?= $detaljiProjekta[0]['idKorisnik']??"" ?>" />
        <input type="hidden" name="idPrijava" id ="idPrijava" value="<?= $o['idPrijava']??"" ?>" />
        <input type="hidden" name="idProjekta" id ="idProjekta" value="<?= $o['idProjekat']??"" ?>" />
        <input type="hidden" name="idPitanja" id ="idPitanja" value="<?= $p['idPitanja']??"" ?>" />
        <input type="hidden" name="poziv" id ="poziv" value="<?= $o['idPoziv']??"" ?>" />
   
          
              <button class='btn dugme' onclick='dodavanje_ocene()'>Unesi</button>
         
    </div>
 </div>
 <br><br>
<?php }
 

    }

} } } 
  ?>









