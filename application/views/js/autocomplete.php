<?php

$rec = $_POST['tekst'];
$rezultat = "";
$konekcija = mysqli_connect("localhost", "root", "", "forum");
//$sql = "select username from user where username like '%$rec%' ";
//$recnik1 = $konekcija->query($sql);
//$recnik = mysqli_fetch_row($recnik1);
if(empty($_GET['tekst']))
{
    $rezultat = "Nema predloga!!!";
} 

else

{
    $sql = "select * from user where ime like'%$rec%' or prezime like '%$rec%' ";
   $result=$konekcija->query($sql);
   while($row=$result->fetch_array()) {
       $vr=$row['username'];
        $rezultat .="<div class='predlog' "
           ."onclick='izbor(\"$vr\")'>$vr</div>";
   }
//  for($i=0; $i<count($recnik); $i++) {
//      
//      if (strcasecmp($rec, substr($recnik[$i],0,strlen($rec))) == 0) {
//      // ako treba da se poklapa cela rec  if ($rec==$recnik[$i])
//              $vr=$recnik[$i];
//        $rezultat .="<div class='predlog' "
//             ."onclick='izbor(\"$vr\")'>$vr</div>";
//      }
//  }
    
}
echo $rezultat;


