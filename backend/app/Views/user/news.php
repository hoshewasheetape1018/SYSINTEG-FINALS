<!DOCTYPE html>
<html lang="en">
    <?= view('components/head') ?>
    
<body>

    <!-- header -->
    <?= view('components/header') ?>

    <!-- start of news page -->

    <section id="news">
<div class="container">
    <a href="/news/moodboard">
    <div class="news-card">
        <h2>MoodBoard page</h2>
        <p>Check out this site's design guide!</p>
    </div>
    </a>

    <a href="/news/roadmap">
    <div class="news-card">
        <h2>Roadmap page</h2>
        <p> See what features are coming next!</p>
    </div>
    </a>
</div>

</section>

    </body>

    <!-- footer -->
    <?= view('components/footer') ?>

</html>