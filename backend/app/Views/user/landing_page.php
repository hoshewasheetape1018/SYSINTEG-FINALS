<?= view('components/page_start', ['pageTitle' => $pageTitle]) ?>
<section class="hero-home">
    <div class="container-xl">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <p class="eyebrow">Made for your happy place</p>
                <h1 class="display-title mb-4">Little things.<br>Big feelings.</h1>
                <p class="lead-copy mb-4">Meet colorful keepsakes and thoughtful pieces designed to make the everyday feel a little more special.</p>
                <div class="d-flex flex-wrap gap-3"><a class="btn btn-brand" href="/products">Shop now</a><a class="btn btn-outline-brand" href="/collections">Browse collections</a></div>
            </div>
            <div class="col-lg-6"><div class="hero-art" aria-hidden="true"><div class="hero-blob hero-blob-main"></div><div class="hero-blob hero-blob-small"></div><div class="hero-flower"><i class="fa-solid fa-fan"></i></div></div></div>
        </div>
    </div>
</section>
<section class="page-section section-white">
    <div class="container-xl">
        <div class="text-center mb-5"><p class="eyebrow">Find your favorite</p><h2 class="section-title">Something joyful for everyone</h2></div>
        <div class="row g-4"><div class="col-md-4"><div class="feature-tile feature-pink surface-card"><h3>Sweet & soft</h3><p class="mb-0">Playful everyday favorites.</p></div></div><div class="col-md-4"><div class="feature-tile feature-blue surface-card"><h3>Made to gift</h3><p class="mb-0">Tiny surprises with heart.</p></div></div><div class="col-md-4"><div class="feature-tile feature-orange surface-card"><h3>Bright details</h3><p class="mb-0">Color for the little moments.</p></div></div></div>
    </div>
</section>
<section class="page-section"><div class="container-xl"><div class="row align-items-center g-5"><div class="col-lg-5"><p class="eyebrow">Featured picks</p><h2 class="section-title">Fresh from Blumies</h2><p class="text-muted-brand">A handful of feel-good pieces to start your collection.</p><a class="btn btn-outline-brand" href="/products">View all products</a></div><div class="col-lg-7"><div class="row g-3"><?php foreach ([['Pocket Bloom','280.00'],['Happy Charm','350.00'],['Cloud Keychain','320.00']] as $i => $item): ?><div class="col-6 col-md-4"><?= view('components/product_card', ['productId' => $i + 1, 'productName' => $item[0], 'productPrice' => $item[1]]) ?></div><?php endforeach; ?></div></div></div></div></section>
<section class="cta-band"><div class="container-xl text-center"><h2 class="section-title mb-3">A little joy is waiting.</h2><p class="mb-4">Find the one that feels like you.</p><a class="btn btn-brand" href="/collections">Explore collections</a></div></section>
<?= view('components/page_end') ?>
