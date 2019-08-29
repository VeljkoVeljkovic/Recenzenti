<table class="table-hover link1" style="margin-top:2px;">
<?php foreach($ocena as $o)
{
    if(!empty($o['komentarOcene']))
    {
?>
        <tr>

            <td><?= $o['komentarOcene'] ?></td>
            <td href="<?= site_url('Projekti/zakljucavanjeOcene'); ?>?id=<?= $o['idPrijava'] ?>">Zaključaj</td>
            <td href="<?= site_url('Projekti/brisanjeOcene'); ?>?id=<?= $o['idPrijava'] ?>">Obriši</td>
        </tr>
<?php } } ?>
</table>

