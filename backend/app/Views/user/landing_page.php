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

    <section id="hero">
        <h1>
            Create and take care of your own virtual angel pet!
        </h1>

<?php if (!session('isLoggedIn')): ?>
    <?= view('components/buttons/secondary', [
        'btnlink' => '/signup',
        'btntitle' => 'SIGN UP'
    ]) ?>
<?php endif; ?>

    </section>


    <section id="section1">
        test
    </section>


    </body>

    <!-- footer -->
    <?= view('components/footer') ?>

</html>