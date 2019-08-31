<?php

if($anketa[0]['statusAnkete']!='zakljucano'){ ?>
<div class="row">
   <div class="form-group col-sm-6 col-12">
    
     <input type="hidden" id="idAnketaS" value="<?= $anketa[0]['idAnketa']??""  ?>" />
        
            <?php
                echo form_label( "Postavi pitanje:", "pitanjeS", array ( "class" => "control-label" ) );
                echo form_textarea( array ( "name" => "pitanjeS","id" => "pitanjeS", "class" => "form-control", "rows"=>"4"));
                echo form_error ( "pitanjeS" );
            ?>
     </div>  
     <div class="col-6 mt-5"> 
            <button class="btn" onclick='dodajSlobodnoPitanje()'>Dodaj slobodno pitanje</button>
     </div>   
        
 </div>
<div class="row">
    <div class="col-sm-6 col-12 mt-5">
        <input type="hidden" id="idAnketa" value="<?= $anketa[0]['idAnketa']??""  ?>" />
       
            <?php
                echo form_label( "Postavi pitanje:", "pitanje", array ( "class" => "control-label" ) );
                echo form_textarea( array ( "name" => "pitanje","id" => "pitanje", "class" => "form-control", "rows"=>"4"));
                echo form_error ( "pitanje" );
            ?>
     </div>
     <div class="col-6 mt-5">
            <?php
                echo form_label( "Odgovor 1:", "odgovor1", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "odgovor1","id" => "odgovor1", "class" => "form-control"));
                echo form_error ( "odgovor1" );
            ?>

            <?php
                echo form_label( "Odgovor 2:", "odgovor2", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "odgovor2","id" => "odgovor2", "class" => "form-control"));
                echo form_error ( "odgovor2" );
            ?>
       
            <?php
                echo form_label( "Odgovor 3:", "odgovor3", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "odgovor3","id" => "odgovor3", "class" => "form-control"));
                echo form_error ( "odgovor3" );
            ?>
       
            <?php
                echo form_label( "Odgovor 4:", "odgovor4", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "odgovor4","id" => "odgovor4", "class" => "form-control"));
                echo form_error ( "odgovor4" );
            ?>
           <div class="mt-2">
               <button class="btn" onclick='dodajRadioPitanje()'>Dodaj pitanje sa više odgovora</button>
           </div>
        </div>
    </div>
    <div class="row">
        
         <button class="btn" onclick='zakljucavanjeAnkete()'>Završi izradu ankete</button>
    </div>



<?php } ?>
<table class="table table-responsive">
<?php foreach($anketaPitanja as $a)
{
   if(empty($a['odgovor1']))
  {
?>
    <tr>
        <td>
           <textarea class="form-control" disabled><?= $a['pitanje']??"" ?></textarea>
        </td>
        <td colspan="2" class="text-right">
            <button class="btn dugme" onclick='obrisi(<?= $a['idAnketaPitanje'] ?>,<?= $a['idAnketa'] ?>)'>Obrisi</button>
        </td>
    </tr>

<?php  } else { ?>
       <tr>
         <td>
           <textarea class="form-control" disabled><?= $a['pitanje']??"" ?></textarea><br>
         </td>
         <td>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="optradio" disabled><?= $a['odgovor1']??"" ?>
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="optradio" disabled><?= $a['odgovor2']??"" ?>
        </label>
      </div>
      <div class="form-check disabled">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="optradio" disabled><?= $a['odgovor3']??"" ?>
        </label>
      </div> 
      <div class="form-check disabled">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="optradio" disabled><?= $a['odgovor4']??"" ?>
        </label>
      </div>
    </td>
    <td>
        <button class="btn dugme"  onclick='obrisi(<?= $a['idAnketaPitanje'] ?>,<?= $a['idAnketa'] ?>)'>Obrisi</button>
    </td>
</tr>
<?php  }}  ?>
</table>
<?php
if($anketa[0]['statusAnkete']=='zakljucano'){
    ?>

 <div class="row">
        <h5>Dodela anketu: </h5>&nbsp;&nbsp;
    
       
                  <select id="idKorisnik">
            <option value="Izaberi projekta" selected></option>
            <?php foreach($recenzenti as $r) { ?>
           
           <option value="<?php echo $r['idKorisnik'] ?>"><?php echo $r['ime']." ".$r['prezime'] ?></option>
          <?php   }   ?>
                  </select>&nbsp;&nbsp;
               
                   
                
         
              <input type="hidden" id="idAnketaS" value="<?= $anketa[0]['idAnketa']??""  ?>" />
         
              <button class='btn mt-2' onclick='dodela_ankete()'>Dodaj</button>
              
    
</div>

<?php } ?>