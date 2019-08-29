<table class="table table-striped">
    <thead>
        <tr>
            <td>Tekst</td>
            <td>Datum</td>
            <td>Naslov</td>
            <td>Potpis</td>
        </tr>
    </thead> 
    <tbody>
        <?php foreach($obavestenja as $s) { ?>
        <tr>
          <td><?= $s['tekst'] ?></td>
          <td><?= $s['datum'] ?></td>
          <td><?= $s['naslov'] ?></td>
          <td><?= $s['potpis'] ?></td> 
        </tr>
        <?php } ?>
    </tbody>
</table>






