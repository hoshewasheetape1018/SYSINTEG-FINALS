<!DOCTYPE html>
<html lang="en">
<?= view('components/head') ?>

<body>

    <!-- header -->
    <?= view('components/header') ?>

    <!-- main content -->
    <section id="signup">
        <div class="container">
            <h2>Admin dashboard</h2>
            <div class="admin-dashboard">

                <!-- Top Stats -->
                <div class="stats-grid">
                    <div class="stat-box">
                        <div class="stat-number"><?= $totalUsers ?? '000' ?></div>
                        <div class="stat-label">Registered Users</div>
                    </div>

                    <div class="stat-box">
                        <div class="stat-number"><?= $activeUsers ?? '000' ?></div>
                        <div class="stat-label">Active Users</div>
                    </div>

                    <div class="stat-box">
                        <div class="stat-number"><?= $totalPets ?? '000' ?></div>
                        <div class="stat-label">Total Pets</div>
                    </div>

                    <div class="stat-box">
                        <div class="stat-number"><?= $totalSpecies ?? '000' ?></div>
                        <div class="stat-label">Total Species</div>
                    </div>
                </div>


                <!-- Right Side Popular Panel -->
                <div class="popular-panel">
                    <h2>Popular Species</h2>

                    <table class="popular-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Species</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($popularSpecies as $i => $row): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= ucfirst($row['species']) ?></td>
                                    <td><?= $row['count'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>


                <!-- Management Cards -->
                <div class="admin-card-grid">

                    <a href="/admin/users" class="admin-card">
                        <div class="admin-card-content">
                            <h3>Manage Users</h3>
                            <p>Update and Delete Users</p>
                        </div>
                    </a>

                    <a href="/admin/pets" class="admin-card">
                        <div class="admin-card-content">
                            <h3>Manage Pets</h3>
                            <p>Modify and Delete Pets</p>
                        </div>
                    </a>

                </div>

            </div>

        </div>
    </section>
    </section>

</body>

<!-- footer -->
<?= view('components/footer') ?>

</html>