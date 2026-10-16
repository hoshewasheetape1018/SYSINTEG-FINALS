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
            <h1>
                Test
            </h1>
        </section>

        <section id="section1">
            test
        </section>
    </main>

    <!-- footer -->
    <?= view('components/footer') ?>

</body>


</html>