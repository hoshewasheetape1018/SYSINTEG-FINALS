<!DOCTYPE html>
<html lang="en">
<?= view('components/head') ?>

<body>

    <!-- header -->
    <?= view('components/header') ?>

    <!-- main content -->
    <section id="signup">
        <div class="container">


<h2 class="title">Manage Pets</h2>

<div class="table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Species</th>
                <th>Owner</th>
                <th>Health</th>
                <th>Energy</th>
                <th>Hunger</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($pets as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= esc($p['name']) ?></td>
                <td><?= ucfirst($p['species']) ?></td>
                <td><?= esc($p['username']) ?></td>
                <td><?= $p['health'] ?></td>
                <td><?= $p['energy'] ?></td>
                <td><?= $p['hunger'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
    
        </div>
    </section>
    </section>

</body>

<!-- footer -->
<?= view('components/footer') ?>

</html>