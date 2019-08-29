<?php
               echo form_open(
                    "Ankete/predajAnketu"
                ); 
                echo form_fieldset( "Anketa" );
        
 $radi = $mojeAnkete[0]['idAnketuRadi'];
foreach($anketaPitanja as $a)
{
   if(empty($a['odgovor1']))
  {
?>
<div class="row">
    <div class="col-6">
           <textarea class="form-control" disabled><?= $a['pitanje'] ?></textarea><br>
    </div>
    <div class="col-6">
           <textarea class="form-control" name="vrednosti/<?= $radi."/".$a['idAnketaPitanje']?>"></textarea><br>
    </div>
</div>
<?php  } else {   ?>
<div class="row">
<div class="col-6">
           <textarea class="form-control" disabled><?= $a['pitanje']??"" ?></textarea><br>
    </div>
  <div class="col-6">
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="vrednosti/<?= $radi."/".$a['idAnketaPitanje']?>" value="<?= $a['odgovor1'] ?>"><?= $a['odgovor1'] ?>
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="vrednosti/<?= $radi."/".$a['idAnketaPitanje']?>" value="<?= $a['odgovor2'] ?>"><?= $a['odgovor2'] ?>
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="vrednosti/<?= $radi."/".$a['idAnketaPitanje']?>" value="<?= $a['odgovor3'] ?>"><?= $a['odgovor3'] ?>
        </label>
      </div> 
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="vrednosti/<?= $radi."/".$a['idAnketaPitanje']?>" value="<?= $a['odgovor3'] ?>"><?= $a['odgovor4'] ?>
        </label>
      </div> 
   </div>
</div>
<?php  }}  ?>
<div class="form-group">
 <input type="hidden"  name="radi" value="<?php echo $radi ?>" />
  <button class="btn submit" >Pošalji</button>
</div>
<?php 
    echo form_fieldset_close();
    echo form_close(); 
?>         