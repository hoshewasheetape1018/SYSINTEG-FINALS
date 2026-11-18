<?= view('components/page_start', ['pageTitle' => $pageTitle]) ?>
<section class="page-hero pb-4"><div class="container-xl"><p class="eyebrow">From our Jotform catalog</p><h1 class="display-title">Our collections</h1></div></section>
<section class="pb-5"><div class="container-xl d-grid gap-4">
<?php foreach ($collections as $collection): ?>
<a class="collection-banner surface-card p-4 p-md-5" href="/collections/<?= esc($collection['id']) ?>"><div><p class="eyebrow">Jotform category</p><h2 class="section-title"><?= esc($collection['name']) ?></h2><?php if ($collection['description']): ?><p class="mb-0"><?= esc($collection['description']) ?></p><?php endif; ?></div></a>
<?php endforeach; ?>
</div></section>
<?= view('components/page_end') ?>
