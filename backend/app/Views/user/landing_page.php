<!DOCTYPE html>
<html lang="en">
<?= view('components/head') ?>

<body>

    <!-- header -->
    <?= view('components/header') ?>

    <!-- error if from admin -->
    <?php if (session()->getFlashdata('error')): ?>
    <div class="error-message">
        <?= esc(session()->getFlashdata('error')) ?>
    </div>
    <?php endif; ?>

    <!-- start of landing page -->
    <main>
  <section id="hero">

    <h1>H1 — 35pt</h1>

    <h2>H2 — 30pt</h2>

    <h3>H3 — 25pt</h3>

    <h4>H4 — 20pt</h4>

    <p>
        Body — Poppins Regular — 16px
    </p>

    <p class="lily-script-one-regular">
        Lily Script One
    </p>

    <p class="oleo-script-swash-caps-regular">
        Oleo Script Swash Caps Regular
    </p>

    <p class="oleo-script-swash-caps-bold">
        Oleo Script Swash Caps Bold
    </p>

    <h3 class="blumies-logo">
        BLUMIES — Genty
    </p>

</section>

        <section id="section1">
            test
        </section>
    </main>

    <!-- footer -->
    <?= view('components/footer') ?>

</body>


</html>