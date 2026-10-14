<div class="card">
    <h3>
        <img src="<?= $imgsrc ?>"> <?= $title ?>
    </h3>
    <p><?= $description ?></p>
    <?= view('components/buttons/' . $btntype, [
        'btnlink' => $btnlink,
        'btntitle' => $btntitle
    ]) ?></div>