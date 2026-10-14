<!DOCTYPE html>
<html lang="en">
<?= view('components/head') ?>

<body>
    <?= view('components/header') ?>

    <section id="edit-user">
        <div class="container">
            <h2>Edit User: <?= esc($user->username) ?></h2>

            <form action="<?= site_url('admin/users/update/' . $user->id) ?>" method="post">

                <div>
                    <label>Username</label>
                    <input type="text" name="username" value="<?= esc($user->username) ?>" required>
                </div>

                <div>
                    <label>Display Name</label>
                    <input type="text" name="display_name" value="<?= esc($user->display_name) ?>">
                </div>

                <div>
                    <label>Email</label>
                    <input type="email" name="email" value="<?= esc($user->email) ?>" required>
                </div>

                <div>
                    <label>New Password (leave blank to keep current)</label>
                    <input type="password" name="password" placeholder="New Password">
                </div>

                <div>
                    <label>Coins</label>
                    <input type="number" name="coins" value="<?= esc($user->coins) ?>" min="0">
                </div>


                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    <div>
                        <label>Type</label>
                        <select name="type">
                            <option value="client" <?= $user->type === 'client' ? 'selected' : '' ?>>Client</option>
                            <option value="admin" <?= $user->type === 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>

                    <div>
                        <label>Email Activated</label>
                        <select name="email_activated">
                            <option value="1" <?= $user->email_activated ? 'selected' : '' ?>>Yes</option>
                            <option value="0" <?= !$user->email_activated ? 'selected' : '' ?>>No</option>
                        </select>
                    </div>

                    <div>
                        <label>Account Status</label>
                        <select name="account_status">
                            <option value="1" <?= $user->account_status ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= !$user->account_status ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                </div>

                      <div style="margin-top:20px; display:flex; gap:10px; flex-wrap:wrap; margin-bottom:20px;">
            <?= view('components/buttons/action', [
                'btntitle' => 'SAVE',
                'btntype' => 'submit'
            ]) ?>
            </form>

                <?= view('components/buttons/primary', [
                    'btnlink' => '/login',
                    'btntitle' => 'BACK'
                ]) ?>


                <!-- Delete User Button -->
                <form action="<?= site_url('admin/users/delete/' . $user->id) ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone!');">
                    <?= view('components/buttons/secondary', [
                        'btntitle' => 'DELETE',
                        'btntype' => 'submit'
                    ]) ?>
                </form>
            </div>

        </div>

        </div>
  
    </section>

    <?= view('components/footer') ?>
</body>

</html>