<!DOCTYPE html>
<html lang="en">
<?= view('components/head') ?>

<body>

    <!-- header -->
    <?= view('components/header') ?>

    <!-- start of moodboard page -->

    <section id="moodboard">
        <div class="container">
            <div>
                <h2> MOODBOARD </h2>
                <h4> Visual design guide for Genopals. </h4>
            </div>
            <div class="moodboard-grid">

                <div>
                    <h4>LOGO</h4>
                    <img src="https://file.garden/ZrIPgCGn9kADc89z/Genopals/genopals-logo.png" alt="LOGO" height="100">
                </div>

                <div>
                    <h4>COLORS</h4>
                    <div class="color-row">
                        <div class="color"></div>
                        <div class="color"></div>
                        <div class="color"></div>
                        <div class="color"></div>
                        <div class="color"></div>
                    </div>
                </div>

                <div>
                    <h4>TYPOGRAPHY</h4>

                    <div class="typography">
                        <div id="playfair">
                            <h2> Playfair Display </h2>
                            <p>The quick brown fox jumps over the lazy dog.</p>
                        </div>

                        <div id="inter">
                            <h2> Inter </h2>
                            <p>The quick brown fox jumps over the lazy dog.</p>
                        </div>
                    </div>
                </div>

          <div>
    <h4>BUTTON STYLES</h4>
    <div class="button-row">
        <?= view('components/buttons/primary', [
            'btnlink' => '#',
            'btntitle' => 'PRIMARY'
        ]) ?>

        <?= view('components/buttons/secondary', [
            'btnlink' => '#',
            'btntitle' => 'SECONDARY'
        ]) ?>

        <?= view('components/buttons/action', [
            'btnlink' => '#',
            'btntitle' => 'CTA'
        ]) ?>

        <?= view('components/buttons/disabled', [
            'btnlink' => '#',
            'btntitle' => 'DISABLED'
        ]) ?>

        <?= view('components/buttons/bordered', [
            'btnlink' => '#',
            'btntitle' => 'BORDER'
        ]) ?>
    </div>
</div>

<div>
    <h4>CARD STYLES</h4>
    <div class="card-row">
        <?= view('components/cards/card1', [
            'title' => 'Card Title',
            'description' => 'This is a sample card description. It provides a brief overview of the card content.',
            'btntype' => 'primary',
            'btnlink' => '#',
            'btntitle' => 'Learn More'
        ]) ?>

        <?= view('components/cards/card2', [
            'imgsrc' => 'https://file.garden/ZrIPgCGn9kADc89z/Genopals/favicon.png',
            'title' => 'User',
            'description' => 'This is a sample card description. It provides a brief overview of the card content.',
            'btntype' => 'secondary',
            'btnlink' => '#',
            'btntitle' => 'Learn More'
        ]) ?>

        <?= view('components/cards/card3', [
            'title' => '"This game cleansed my soul and redefined my purpose."',
            'description' => '— Anonymous Player',
            'btntype' => 'action',
            'btnlink' => '#',
            'btntitle' => 'Learn More'
        ]) ?>
    </div>
</div>

                    <h4>LOGO STYLES</h4>
                    <div class="logo-row">
                        <div><img src="https://file.garden/ZrIPgCGn9kADc89z/Genopals/g-logo.png" alt="logo">
                        </div>
                        <div class="rounded"><img src="https://file.garden/ZrIPgCGn9kADc89z/Genopals/g-logo.png"
                                alt="logo"></div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</body>

<!-- footer -->
<?= view('components/footer') ?>

</html>