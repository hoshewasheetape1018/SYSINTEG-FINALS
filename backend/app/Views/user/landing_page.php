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
        <div class="container container-animate">
            <h2>Choose from 3 different species</h2>

            <div id="features1">


                <div class="feat-item">
                    <div>
                        <img src="https://file.garden/ZrIPgCGn9kADc89z/Genopals/ab1.png" alt="PET1" height="250"
                            >
                    </div>

                    <div class="stat-container">
                        <h4>Health:</h4>
                        <div class="stat-box">
                            <div class="stat-bar" id="health" style= "width:75%;"></div>
                        </div>
                    </div>
                    <div class="stat-container">
                        <h4>Energy:</h4>
                        <div class="stat-box">
                            <div class="stat-bar" id="energy" style= "width:60%;"></div>
                        </div>
                    </div>

                    <div class="stat-container">
                        <h4>Hunger:</h4>
                        <div class="stat-box">
                            <div class="stat-bar" id="hunger" style= "width:19%;"></div>
                        </div>
                    </div>
                </div>

                <div class="feat-item">
                    <div>
                        <img src="https://file.garden/ZrIPgCGn9kADc89z/Genopals/ab2.png" alt="PET1" height="250"
                           >
                    </div>

                    <div class="stat-container">
                        <h4>Health:</h4>
                        <div class="stat-box">
                            <div class="stat-bar" id="health" style= "width:89%;"></div>
                        </div>
                    </div>
                    <div class="stat-container">
                        <h4>Energy:</h4>
                        <div class="stat-box">
                            <div class="stat-bar" id="energy" style= "width:40%;"></div>
                        </div>
                    </div>

                    <div class="stat-container">
                        <h4>Hunger:</h4>
                        <div class="stat-box">
                            <div class="stat-bar" id="hunger" style= "width:30%;"></div>
                        </div>
                    </div>
                </div>
                <div class="feat-item">
                    <div>
                        <img src="https://file.garden/ZrIPgCGn9kADc89z/Genopals/ab3.png" alt="PET1" height="250"
                            >
                    </div>

                    <div class="stat-container">
                        <h4>Health:</h4>
                        <div class="stat-box">
                            <div class="stat-bar" id="health" style= "width:30%;"></div>
                        </div>
                    </div>
                    <div class="stat-container">
                        <h4>Energy:</h4>
                        <div class="stat-box">
                            <div class="stat-bar" id="energy" style= "width:90%;"></div>
                        </div>
                    </div>

                    <div class="stat-container">
                        <h4>Hunger:</h4>
                        <div class="stat-box">
                            <div class="stat-bar" id="hunger" style= "width:70%;"></div>
                        </div>
                    </div>
                </div>


            </div>

    </section>

    <section id="section2">

        <div class="container container-animate">
            <h2>Feed, play, and care for your new pet!</h2>
            <img src="https://file.garden/ZrIPgCGn9kADc89z/Genopals/feat2.png" alt="section2 feature" height="350">
        </div>

    </section>

    <section id="section3">

            <h2 id="title" >Game Features</h2>
            <!-- carousel here or not -->

            <div class="container container-animate">
                <h2>own up to 3 pets at a time!</h2>
            </div>
            <div class="container container-animate">
                <h2>feed, play, and care for your pet and watch them grow!</h2>
            </div>
            <div class="container container-animate">
                <h2>buy and sell items for your pet!</h2>
            </div>
            <div class="container container-animate">
                <h2>... and more!</h2>
            </div>

    </section>

    <?= view('components/cta') ?>


    </body>

    <!-- footer -->
    <?= view('components/footer') ?>

</html>