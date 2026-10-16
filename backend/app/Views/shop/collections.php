<?= view('components/page_start', ['pageTitle' => $pageTitle]) ?>
<section class="page-hero pb-4"><div class="container-xl"><p class="eyebrow">Browse by mood</p><h1 class="display-title">Our collections</h1></div></section>
<section class="pb-5"><div class="container-xl d-grid gap-4">
<?php foreach ([['Soft beginnings','Gentle colors and easy favorites.'],['Sunny side','Bright pieces for brighter days.'],['Afterglow','Dreamy details with a little sparkle.']] as $i => $collection): ?>
<a class="collection-banner surface-card p-4 p-md-5" href="/collections/<?= $i + 1 ?>"><div><p class="eyebrow">Collection <?= $i + 1 ?></p><h2 class="section-title"><?= esc($collection[0]) ?></h2><p class="mb-0"><?= esc($collection[1]) ?></p></div></a>
<?php endforeach; ?>
</div></section>
<?= view('components/page_end') ?>
