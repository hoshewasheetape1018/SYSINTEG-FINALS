<?php
$roadmapItems = [
    ["title" => "Front end landing page", "status" => "Completed"],
    ["title" => "Front end moodboard", "status" => "Completed"],
    ["title" => "Front end roadmap", "status" => "Completed"],

    ["title" => "Front end Authorization (Login/registration)", "status" => "Completed"],
    ["title" => "Design / Layout of Care page, Authorization (Login/Sign up)", "status" => "Completed"],
    ["title" => "Repurposing Shop page for simple CRUD demonstration for inventory system", "status" => "In Progress"],

    ["title" => "Backend CRUD functionality for Authorization", "status" => "Planned"],
    ["title" => "Backend CRUD functionality for Creating and managing pets", "status" => "Planned"],
    ["title" => "Backend CRUD functionality for inventory system", "status" => "Planned"],
    ["title" => "Database connection for Authorization (Login/Signup)", "status" => "Planned"],
    ["title" => "Database connection for creating and managing pets", "status" => "Planned"],
    ["title" => "Database connection for inventory system", "status" => "Planned"],
    ["title" => "Simple functionality for Care page for CRUD demonstration of Inventory and Pet management", "status" => "Planned"],

    ["title" => "Redesign UI", "status" => "Future"],
    ["title" => "Create art assets", "status" => "Future"],
    ["title" => "Create micro-interaction animations", "status" => "Future"],
    ["title" => "Refactor and fragment code", "status" => "Future"],
];

$legend = [
    ["label" => "Completed", "class" => "completed"],
    ["label" => "In Progress", "class" => "inprogress"],
    ["label" => "Planned", "class" => "planned"],
    ["label" => "Future", "class" => "future"],
];
?>

<!DOCTYPE html>
<html lang="en">
<?= view('components/head') ?>

<body>
    <?= view('components/header') ?>

    <section id="roadmap">
        <div class="container">
            <div>
                <h2>ROADMAP</h2>
                <h4>
                    Current development roadmap for Genopals! <br>
                    Progress and features are displayed below and are subject to change.
                </h4>
            </div>

            <div class="card-row">
                <?php foreach ($roadmapItems as $item): ?>
                    <?= view('components/cards/card4', [
                        'title' => $item['title'],
                        'status' => $item['status'],
                    ]) ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?= view('components/footer') ?>
</body>
</html>
