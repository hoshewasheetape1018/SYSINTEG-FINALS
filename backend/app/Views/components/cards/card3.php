<div class="card">
    <h3><?= $title ?></h3>
    <p><?= $description ?></p>

    <?= view('components/buttons/' . $btntype, [
        'btnlink' => $btnlink,
        'btntitle' => $btntitle
    ]) ?>
</div>