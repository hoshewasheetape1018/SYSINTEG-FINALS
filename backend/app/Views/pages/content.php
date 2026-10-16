<?= view('components/page_start', ['pageTitle' => $pageTitle]) ?>
<section class="page-hero">
    <div class="container-xl">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <p class="eyebrow"><?= esc($eyebrow) ?></p>
                <h1 class="display-title mb-4"><?= esc($title) ?></h1>
                <p class="lead-copy mx-auto mb-0"><?= esc($copy) ?></p>
            </div>
        </div>
    </div>
</section>
<?= view('components/page_end') ?>
