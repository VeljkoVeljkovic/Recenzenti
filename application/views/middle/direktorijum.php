 <h3>Dokumentacija Projekta:</h3>
       <?php 
     foreach($detaljiProjekta as $d) { 
                if($d!=null) { 
$putanja='uploads/'.$d['nazivProjekta'];
       }
foreach (directory_map($putanja) as $file)
{
    if(!empty(directory_map($putanja)))
    {
    echo "<a style='color:black !important;' target='_blank' href='".base_url($putanja."/".$file)."'>$file</a>&nbsp;&nbsp;&nbsp;";
   
    ?> <button onclick="obrisifile('<?= $putanja."/".$file ?>')">Obrisi</button> <?php
     echo "<br>";
    }
   }
 }
?> 

