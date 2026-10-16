<?= view('components/page_start', ['pageTitle' => $pageTitle]) ?>
<section class="page-section">
    <div class="container-xl">
        <div class="row g-5 align-items-start">
            <div class="col-lg-5"><p class="eyebrow">Say hello</p><h1 class="display-title mb-4">Let’s talk.</h1><p class="lead-copy">Questions about a product or an order? Leave us a note and we’ll get back to you.</p></div>
            <div class="col-lg-7"><form class="surface-card p-4 p-md-5"><div class="row g-3"><div class="col-md-6"><label class="form-label" for="contactName">Name</label><input class="form-control" id="contactName" type="text"></div><div class="col-md-6"><label class="form-label" for="contactEmail">Email</label><input class="form-control" id="contactEmail" type="email"></div><div class="col-12"><label class="form-label" for="contactMessage">Message</label><textarea class="form-control" id="contactMessage" rows="6"></textarea></div><div class="col-12"><button class="btn btn-brand" type="button">Send message</button></div></div></form></div>
        </div>
    </div>
</section>
<?= view('components/page_end') ?>
