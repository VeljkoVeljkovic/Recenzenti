<p>
    <?php
    switch ($statusPrijave) {
        case RecenzentModel::STATUS_PRIJAVE_RAZMATRA_SE: $poruka = 'Vasa prijava se razmatra.'; break;
        case RecenzentModel::STATUS_PRIJAVE_PRIHVACENA: $poruka = 'Vasa prijava je prihvacena.'; break;
        case RecenzentModel::STATUS_PRIJAVE_ODBIJENA: $poruka = 'Vasa prijava je odbijena.'; break;
        default: $poruka = 'Vasa prijava je stigla i bice razmotrena.';
    }
    echo $poruka;
    ?>
</p>