<?php $productId = $productId ?? 1; ?>
<article class="product-card">
    <a href="/products/<?= esc($productId) ?>">
        <div class="product-image"><i class="fa-solid fa-gift"></i></div>
        <div class="product-meta">
            <h2 class="product-name"><?= esc($productName ?? 'Blumies Keepsake') ?></h2>
            <span class="product-price">₱<?= esc($productPrice ?? '350.00') ?></span>
        </div>
    </a>
</article>
