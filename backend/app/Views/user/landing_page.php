<?= view('components/page_start', ['pageTitle' => $pageTitle]) ?>

<section class="home-hero">
    <div class="home-orb home-orb-one" aria-hidden="true"></div><div class="home-orb home-orb-two" aria-hidden="true"></div>
    <div class="container-xl position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 home-hero-copy">
                <span class="home-kicker"><i class="fa-solid fa-sparkles"></i> Made for colorful everyday moments</span>
                <h1 class="home-title mt-4">Carry a little<br><span>joy with you.</span></h1>
                <p class="lead-copy my-4">Playful lanyards and small keepsakes, thoughtfully made to brighten ordinary days and make every detail feel more you.</p>
                <div class="d-flex flex-wrap gap-3"><a class="btn btn-brand home-primary-action" href="/products">Shop the collection <i class="fa-solid fa-arrow-right ms-2"></i></a><a class="btn btn-outline-brand" href="/about">Meet Blumies</a></div>
                <div class="home-proof mt-5"><span><i class="fa-solid fa-box-open"></i><strong><?= esc($productCount) ?></strong> pieces available</span><span><i class="fa-solid fa-arrows-rotate"></i>Live catalog</span><span><i class="fa-solid fa-location-dot"></i>Made in the Philippines</span></div>
            </div>
            <div class="col-lg-6">
                <div class="home-showcase">
                    <?php if (!empty($heroProducts[0])): ?><a class="home-showcase-main" href="/products/<?= esc($heroProducts[0]['id']) ?>"><img src="<?= esc($heroProducts[0]['image_url']) ?>" alt="<?= esc($heroProducts[0]['name']) ?>"><span><small>Featured today</small><strong><?= esc($heroProducts[0]['name']) ?></strong></span></a><?php else: ?><div class="home-showcase-main home-showcase-empty"><i class="fa-solid fa-gift"></i><span><small>Blumies catalog</small><strong>Something joyful is coming</strong></span></div><?php endif; ?>
                    <?php foreach (array_slice($heroProducts, 1, 2) as $index => $product): ?><a class="home-showcase-mini home-showcase-mini-<?= $index + 1 ?>" href="/products/<?= esc($product['id']) ?>"><img src="<?= esc($product['image_url']) ?>" alt="<?= esc($product['name']) ?>"></a><?php endforeach; ?>
                    <div class="home-showcase-sticker"><i class="fa-solid fa-heart"></i><span>Small joys,<br>made special</span></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-benefits" aria-label="Shopping benefits"><div class="container-xl"><div class="row g-0"><div class="col-md-4"><div class="home-benefit"><i class="fa-solid fa-wand-magic-sparkles"></i><div><strong>Playful by design</strong><span>Colorful pieces with personality.</span></div></div></div><div class="col-md-4"><div class="home-benefit"><i class="fa-solid fa-mobile-screen-button"></i><div><strong>Easy GCash checkout</strong><span>A simple and familiar way to pay.</span></div></div></div><div class="col-md-4"><div class="home-benefit"><i class="fa-solid fa-truck-fast"></i><div><strong>Track every order</strong><span>Follow updates from your account.</span></div></div></div></div></div></section>

<?php if ($categoryCards !== []): ?>
<section class="page-section section-white home-collections"><div class="container-xl"><div class="home-section-heading"><div><p class="eyebrow">Shop your mood</p><h2 class="section-title mb-0">Find your kind of happy</h2></div><a href="/collections">All collections <i class="fa-solid fa-arrow-right ms-2"></i></a></div><div class="row g-4 mt-2"><?php foreach ($categoryCards as $index => $category): ?><div class="col-md-4"><a class="home-collection-card home-collection-<?= ($index % 3) + 1 ?>" href="/collections/<?= esc($category['id']) ?>"><div class="home-collection-copy"><small><?= esc($category['product_count']) ?> <?= $category['product_count'] === 1 ? 'piece' : 'pieces' ?></small><h3><?= esc($category['name']) ?></h3><span>Explore <i class="fa-solid fa-arrow-right"></i></span></div><div class="home-collection-visual"><?php if (!empty($category['image_url'])): ?><img src="<?= esc($category['image_url']) ?>" alt=""><?php else: ?><i class="fa-solid fa-gift"></i><?php endif; ?></div></a></div><?php endforeach; ?></div></div></section>
<?php endif; ?>

<section class="page-section home-featured"><div class="container-xl"><div class="home-section-heading"><div><p class="eyebrow">Currently available</p><h2 class="section-title mb-0">Fresh picks from Blumies</h2></div><a href="/products">Shop everything <i class="fa-solid fa-arrow-right ms-2"></i></a></div><?php if ($featuredProducts === []): ?><div class="surface-card empty-state mt-5"><div><i class="fa-solid fa-box-open mb-3"></i><h3>The catalog is syncing</h3><p class="text-muted-brand mb-0">Check back in a moment for the latest Blumies pieces.</p></div></div><?php else: ?><div class="row g-4 mt-2"><?php foreach ($featuredProducts as $product): ?><div class="col-6 col-lg-3"><?= view('components/product_card', ['productId'=>$product['id'],'productName'=>$product['name'],'productPrice'=>number_format($product['price'],2),'productImage'=>$product['image_url'] ?? null,'categoryName'=>$product['category_name'] ?? null]) ?></div><?php endforeach; ?></div><?php endif; ?></div></section>

<section class="home-story"><div class="container-xl"><div class="row align-items-center g-0"><div class="col-lg-5"><div class="home-story-mark"><span class="brand-wordmark">Blumies</span><i class="fa-solid fa-heart"></i></div></div><div class="col-lg-7"><div class="home-story-copy"><p class="eyebrow">Why Blumies?</p><h2 class="section-title">Ordinary things can still feel special.</h2><p>We believe the pieces you use every day should make you smile. That is why every Blumies design leans into bright color, playful detail, and a little bit of heart.</p><a class="btn btn-outline-brand" href="/about">Read our story</a></div></div></div></div></section>

<section class="home-final-cta"><div class="container-xl"><div class="home-final-inner"><div><p class="eyebrow">Your next favorite is here</p><h2>Pick the one that feels like you.</h2></div><a class="btn btn-light" href="/products">Start shopping <i class="fa-solid fa-arrow-right ms-2"></i></a></div></div></section>

<?= view('components/page_end') ?>
