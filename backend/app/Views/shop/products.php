<?= view('components/page_start', ['pageTitle' => $pageTitle]) ?>
<section class="page-hero pb-4"><div class="container-xl"><div class="row align-items-end g-3"><div class="col-md"><p class="eyebrow">The Blumies shop</p><h1 class="display-title"><?= esc($collectionTitle ?? 'All products') ?></h1></div><div class="col-md-auto"><select class="form-select" aria-label="Sort products"><option>Featured</option><option>Price: low to high</option><option>Newest</option></select></div></div></div></section>
<section class="pb-5"><div class="container-xl"><div class="row g-3 g-md-4">
<?php foreach ($products as $product): ?><div class="col-6 col-md-4 col-lg-3"><?= view('components/product_card', ['productId'=>$product['id'],'productName'=>$product['name'],'productPrice'=>number_format($product['price'],2),'productImage'=>$product['image_url'] ?? null,'categoryName'=>$product['category_name'] ?? null]) ?></div><?php endforeach; ?>
</div></div></section>
<?= view('components/page_end') ?>
