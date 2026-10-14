<!DOCTYPE html>
<html lang="en">
<?= view('components/head') ?>

<body>
    <?= view('components/header') ?>

    <section id="signup">
        <div class="container">
            <h2>Sign Up</h2>

            <?php
            $errors = session()->getFlashdata('signup_errors') ?? [];
            $old    = session()->getFlashdata('signup_old') ?? [];
            $success = session()->getFlashdata('success') ?? null;

            ?>

            <?php if (!empty($success)): ?>
                <p class="success"><?= esc($success) ?></p>
            <?php endif; ?>

            <?php if (!empty($errors['general'])): ?>
                <p class="error"><?= esc($errors['general']) ?></p>
            <?php endif; ?>

            <form action="/signup" method="post">
                <div>
                    <h3>Username</h3>
                    <input type="text" name="username" placeholder="Username"
                        value="<?= esc($old['username'] ?? '') ?>" required>
                    <?php if (!empty($errors['username'])): ?>
                        <p class="error"><?= esc($errors['username']) ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <h3>Display Name</h3>
                    <input type="text" name="display_name" placeholder="Display Name"
                        value="<?= esc($old['display_name'] ?? '') ?>" required>
                    <?php if (!empty($errors['display_name'])): ?>
                        <p class="error"><?= esc($errors['display_name']) ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <h3>Email</h3>
                    <input type="email" name="email" placeholder="Email"
                        value="<?= esc($old['email'] ?? '') ?>" required>
                    <?php if (!empty($errors['email'])): ?>
                        <p class="error"><?= esc($errors['email']) ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <h3>Password</h3>
                    <input type="password" name="password" placeholder="Password" required>
                    <?php if (!empty($errors['password'])): ?>
                        <p class="error"><?= esc($errors['password']) ?></p>
                    <?php endif; ?>
                </div>

                <div>
                    <h3>Confirm Password</h3>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    <?php if (!empty($errors['confirm_password'])): ?>
                        <p class="error"><?= esc($errors['confirm_password']) ?></p>
                    <?php endif; ?>
                </div>

                <div class="button-group">
                    <?= view('components/buttons/primary', [
                        'btnlink' => '/login',
                        'btntitle' => 'BACK'
                    ]) ?>

                    <?= view('components/buttons/secondary', [
                        'btntitle' => 'SIGN UP',
                        'btntype' => 'submit'
                    ]) ?>
                </div>
            </form>
        </div>
    </section>

    <?= view('components/footer') ?>
</body>

</html>