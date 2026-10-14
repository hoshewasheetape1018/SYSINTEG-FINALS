<!DOCTYPE html>
<html lang="en">
<?= view('components/head') ?>

<body>
    <?= view('components/header') ?>
  <?php if (session()->getFlashdata('success')): ?>
                    <div class="success-message">
                        <?= esc(session()->getFlashdata('success')) ?>
                    </div>
                <?php endif; ?>
    <section id="login">
        <div class="container">
            <div class="login-container">
              

                <!-- Signup Prompt -->
                <div class="login-item">
                    <div class="login-img">
                        <h2>No account yet?</h2>
                        <?= view('components/buttons/primary', [
                            'btnlink' => '/signup',
                            'btntitle' => 'SIGN UP'
                        ]) ?>
                    </div>
                </div>

                <!-- Login Form -->
                <div class="login-item">
                    <?php
                    $errors = $errors ?? [];
                    $old = $old ?? [];
                    ?>
                    <form action="/login" method="post">
                        <!-- Username -->
                        <div>
                            <h2>Username (test acc: yipee)</h2>
                            <input type="text" name="username" placeholder="Username" value="<?= esc($old['username'] ?? '') ?>" required>
                            <?php if (!empty($errors['username'])): ?>
                                <p class="error"><?= esc($errors['username']) ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Password -->
                        <div>
                            <h2>Password (test acc pw: yipee123)</h2>
                            <input type="password" name="password" placeholder="Password" required>
                            <?php if (!empty($errors['password'])): ?>
                                <p class="error"><?= esc($errors['password']) ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <?= view('components/buttons/action', [
                                'btntitle' => 'LOG IN',
                                'btntype' => 'submit'
                            ]) ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?= view('components/footer') ?>
</body>

</html>