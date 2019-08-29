<table class="table table-striped">
    <thead>
        <tr>
            <td>Naziv</td>
            <td>Rukovodioc</td>
            <td>Oblast</td>
            <td>Odluka</td>
        </tr>
    </thead> 
    <tbody>
        <?php foreach($sviProjekti as $s) { ?>
        <tr>
          <td><?= $s['nazivProjekta'] ?></td>
          <td><?= $s['rukovodiocProjekta'] ?></td>
          <td><?= $s['oblastProjekta'] ?></td>
          <td><?= $s['odlukaProjekta'] ?></td> 
        </tr>
        <?php } ?>
    </tbody>
</table>

