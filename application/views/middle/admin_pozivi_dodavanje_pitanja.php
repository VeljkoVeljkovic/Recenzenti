

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

   
<?php foreach($svaPitanja as $p)
{
   // if(!empty($p['pitanje']))
   // {
?>
    <div class="col-6">
           <textarea class="form-control" disabled><?= $p['pitanje']??"" ?></textarea><br>
    </div>
</div>
<?php  } ?>