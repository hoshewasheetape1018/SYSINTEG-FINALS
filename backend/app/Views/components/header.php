<header>
    <a href="/"><img src="https://file.garden/ZrIPgCGn9kADc89z/blumis.png" alt="Blumies logo"
            height="65"></a>

    <nav>
      
        <?php
        $session = session();
        $isLoggedIn = $session->get('isLoggedIn');
        ?>

        <?php if ($isLoggedIn): ?>

        <div class="profile-dropdown">
            <?= view('components/buttons/action', [
                    'btnlink' => '/profile',
                    'btntitle' => 'PROFILE'
                ]) ?>
            <div class="dropdown-content">
                <a href="/profile/settings">Settings</a>
                <a href="#" id="logout-link">Log Out</a>

                <form id="logout-form" action="/logout" method="post" style="display: none;"></form>

                <script>
                document.getElementById('logout-link').addEventListener('click', function(e) {
                    e.preventDefault(); // prevent default anchor behavior
                    document.getElementById('logout-form').submit(); // submit the hidden form
                });
                </script>
                </form>
            </div>
        </div>
        <?php else: ?>
        <?= view('components/buttons/action', [
                'btnlink' => '/login',
                'btntitle' => 'LOG IN'
            ]) ?>
        <?php endif; ?>


    </nav>
</header>