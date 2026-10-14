<!DOCTYPE html>
<html lang="en">
<?= view('components/head') ?>

<body>

<?= view('components/header') ?>

<section id="profile-settings">
    <div class="container">

        <h2 class="title">Edit Profile</h2>

        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert success">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>

        <form action="/profile/settings" method="post" class="settings-form">

            <label>Display Name</label>
            <input type="text" name="display_name" value="<?= esc($user->display_name) ?>" required>

            <label>Username</label>
            <input type="text" name="username" value="<?= esc($user->username) ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= esc($user->email) ?>" required>

            <label>New Password (optional)</label>
            <input type="password" name="password" placeholder="Leave empty to keep current password">
            <div>
            <?= view('components/buttons/action', [
                                'btntitle' => 'SAVE',
                                'btntype' => 'submit'
                            ]) ?>
            </div>
        </form>

    </div>
</section>

<?= view('components/footer') ?>

</body>
</html>
