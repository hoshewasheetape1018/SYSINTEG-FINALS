<?php $productId = $productId ?? 1; ?>
<article class="product-card">
    <a href="/products/<?= esc($productId) ?>">
        <div class="product-image"><?php if (!empty($productImage)): ?><img src="<?= esc($productImage) ?>" alt="<?= esc($productName ?? 'Product') ?>" class="w-100 h-100 object-fit-cover" loading="lazy"><?php else: ?><i class="fa-solid fa-gift"></i><?php endif; ?></div>
        <div class="product-meta">
            <?php if (!empty($categoryName)): ?><small class="text-muted-brand d-block mb-1"><?= esc($categoryName) ?></small><?php endif; ?>
            <h2 class="product-name"><?= esc($productName ?? 'Blumies Keepsake') ?></h2>
            <span class="product-price">₱<?= esc($productPrice ?? '350.00') ?></span>
        </div>
    </a>
</article>
