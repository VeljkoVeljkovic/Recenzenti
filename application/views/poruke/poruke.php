<table class="table">
  <tbody>
       <?php foreach ($poruke as $p){
            echo "<tr><td><div class='font-weight-bold'>$p->username</div>";
            echo "<div class='font-weight-normal'> $p->content</div>";
            echo "<div class='font-weight-light'>$p->sendDate</div></td></tr>";
            
        }
        ?>
  
  </tbody>
</table>
