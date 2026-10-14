<!DOCTYPE html>
<html lang="en">
<?= view('components/head') ?>

<body>

    <!-- header -->
    <?= view('components/header') ?>

    <!-- main content -->
    <section id="signup">
        <div class="container">

            <h2 class="title">Manage Users</h2>

            <div class="table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Display Name</th>
                            <th>Email</th>
                            <th>Coins</th>
                            <th>Type</th>
                            <th>Email Activated</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $userEntity): ?>
                        <tr>
                            <td><?= $userEntity->id ?></td>
                            <td><?= esc($userEntity->username) ?></td>
                            <td><?= esc($userEntity->display_name ?? '-') ?></td>
                            <td><?= esc($userEntity->email) ?></td>
                            <td><?= $userEntity->coins ?></td>
                            <td><?= esc(ucfirst($userEntity->type)) ?></td>
                            <td>
                                <?php if ($userEntity->email_activated): ?>
                                    <span class="badge active">Yes</span>
                                <?php else: ?>
                                    <span class="badge inactive">No</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($userEntity->account_status == 1): ?>
                                    <span class="badge active">Active</span>
                                <?php else: ?>
                                    <span class="badge inactive">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $userEntity->created_at ?></td>
                            <td>
                                <a href="<?= site_url('admin/users/edit/' . $userEntity->id) ?>" class="btn btn-edit">Edit</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </section>

</body>

<!-- footer -->
<?= view('components/footer') ?>

</html>
