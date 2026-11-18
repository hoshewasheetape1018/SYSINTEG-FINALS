<?= view('components/page_start', ['pageTitle' => $pageTitle]) ?>
<section class="page-section">
    <div class="container-xl">
        <p class="eyebrow">Almost there</p>
        <h1 class="section-title mb-5">Checkout</h1>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
        <?php endif; ?>

        <form action="/checkout" method="post" enctype="multipart/form-data">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="surface-card p-4 p-md-5 mb-4">
                        <h2 class="h4 mb-4">Customer information</h2>
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label">Name</label><input class="form-control" value="<?= esc($user->display_name ?? $user->username ?? '') ?>" disabled></div>
                            <div class="col-md-6"><label class="form-label">Email</label><input class="form-control" value="<?= esc($user->email ?? '') ?>" disabled></div>
                            <div class="col-12"><label class="form-label" for="phone">Phone number</label><input class="form-control" id="phone" name="phone" type="tel" value="<?= esc($old['phone'] ?? '') ?>" required><?php if (!empty($errors['phone'])): ?><div class="form-error"><?= esc($errors['phone']) ?></div><?php endif; ?></div>
                        </div>
                    </div>

                    <div class="surface-card p-4 p-md-5 mb-4">
                        <h2 class="h4 mb-4">Delivery address</h2>
                        <div class="row g-3">
                            <div class="col-12"><label class="form-label" for="address">Street address</label><input class="form-control" id="address" name="address" value="<?= esc($old['address'] ?? '') ?>" required><?php if (!empty($errors['address'])): ?><div class="form-error"><?= esc($errors['address']) ?></div><?php endif; ?></div>
                            <div class="col-md-5"><label class="form-label" for="city">City</label><input class="form-control" id="city" name="city" value="<?= esc($old['city'] ?? '') ?>" required><?php if (!empty($errors['city'])): ?><div class="form-error"><?= esc($errors['city']) ?></div><?php endif; ?></div>
                            <div class="col-md-4"><label class="form-label" for="region">Region</label><input class="form-control" id="region" name="region" value="<?= esc($old['region'] ?? '') ?>" required><?php if (!empty($errors['region'])): ?><div class="form-error"><?= esc($errors['region']) ?></div><?php endif; ?></div>
                            <div class="col-md-3"><label class="form-label" for="postal_code">Postal code</label><input class="form-control" id="postal_code" name="postal_code" value="<?= esc($old['postal_code'] ?? '') ?>" required><?php if (!empty($errors['postal_code'])): ?><div class="form-error"><?= esc($errors['postal_code']) ?></div><?php endif; ?></div>
                            <div class="col-12"><label class="form-label" for="delivery_method">Delivery method</label><select class="form-select" id="delivery_method" name="delivery_method" required><?php foreach (['J&T (Metro Manila/Luzon) 1-3 items (₱85)', 'J&T (Metro Manila/Luzon) 4 or more items (₱95)', 'Lalamove (Contact us)', 'Grab (Contact us)'] as $method): ?><option value="<?= esc($method) ?>" <?= ($old['delivery_method'] ?? '') === $method ? 'selected' : '' ?>><?= esc($method) ?></option><?php endforeach; ?></select><?php if (!empty($errors['delivery_method'])): ?><div class="form-error"><?= esc($errors['delivery_method']) ?></div><?php endif; ?></div>
                        </div>
                    </div>

                    <div class="surface-card p-4 p-md-5 mb-4">
                        <h2 class="h4 mb-2">Payment details</h2>
                        <p class="text-muted-brand mb-4">The Jotform accepts GCash orders. Add the reference number and upload the receipt you received after payment.</p>
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label" for="payment_reference">Payment reference number</label><input class="form-control" id="payment_reference" name="payment_reference" value="<?= esc($old['payment_reference'] ?? '') ?>" required><?php if (!empty($errors['payment_reference'])): ?><div class="form-error"><?= esc($errors['payment_reference']) ?></div><?php endif; ?></div>
                            <div class="col-md-6"><label class="form-label" for="proof_of_payment">Proof of payment</label><input class="form-control" id="proof_of_payment" name="proof_of_payment" type="file" accept="image/jpeg,image/png,image/webp,application/pdf" required><div class="form-text">JPG, PNG, WebP, or PDF; up to 5 MB.</div><?php if (!empty($errors['proof_of_payment'])): ?><div class="form-error"><?= esc($errors['proof_of_payment']) ?></div><?php endif; ?></div>
                            <div class="col-12"><label class="form-label" for="comments">Comments or suggestions <span class="text-muted-brand">(optional)</span></label><textarea class="form-control" id="comments" name="comments" rows="3"><?= esc($old['comments'] ?? '') ?></textarea><?php if (!empty($errors['comments'])): ?><div class="form-error"><?= esc($errors['comments']) ?></div><?php endif; ?></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="surface-card summary-card">
                        <h2 class="h4">Order summary</h2>
                        <?php foreach ($items as $item): ?>
                            <div class="d-flex justify-content-between gap-3 py-2"><span><?= esc($item['product_name']) ?><small class="d-block text-muted-brand"><?= $item['variant'] ? esc($item['variant']) . ' · ' : '' ?>Qty <?= esc($item['quantity']) ?></small></span><strong>₱<?= number_format($item['line_total'], 2) ?></strong></div>
                        <?php endforeach; ?>
                        <div class="d-flex justify-content-between fs-5 mt-3 pt-3 border-top"><strong>Total</strong><strong>₱<?= number_format($total, 2) ?></strong></div>
                        <button class="btn btn-brand w-100 mt-4" type="submit">Place order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?= view('components/page_end') ?>
