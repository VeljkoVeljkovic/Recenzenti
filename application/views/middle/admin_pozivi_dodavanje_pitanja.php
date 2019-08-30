

<div class="offset-1 col-10 offset-1">
    
     
        <div class="form-group row">
            <?php
            
                echo form_label( "Postavi pitanje:", "pitanje", array ( "class" => "control-label" ) );
                echo form_input( array ( "name" => "pitanje","id" => "pitanje", "class" => "form-control"));
                echo form_error ( "pitanje" );
            ?>
        </div>
          <div class="form-group row">
            <input type="hidden" id="idPoziv" value="<?= $sviPozivi[0]['idpoziv']??""  ?>" />
            <button class="btn" onclick='dodaj()'>Dodaj</button>
        </div>
        
    </div>
<div class="row" >
 <div class="offset-3 col-md-6 col-12 offset-3">
   <table class="table table-responsive"> 
<?php foreach($svaPitanja as $p)
{
?>
       <tr>
           <td>
              <textarea class="form-control" disabled><?= $p['pitanje']??"" ?></textarea>  
            </td>
            <td>
           <button class="btn dugme" onclick='obrisi(<?= $p['idPitanja'] ?>,<?= $p['idPoziv'] ?>)'>Obrisi</button>
           </td>
       </tr>

<?php  } ?>
   </table>
 </div>