<!DOCTYPE html>
<html lang="en">
<?= view('components/head') ?>

<body>
    <?php
    $session = session();

    // Redirect if not logged in
    if (!$session->has('user_id')) {
        return redirect()->to('/login');
    }

    $userId = $session->get('user_id');

    // Load models
    $UsersModel = new \App\Models\UsersModel();
    $PetModel   = new \App\Models\PetModel();

    // Get user info
    $user = $UsersModel->find($userId);

    // Get pets owned by this user (soft-deleted pets automatically ignored)
    $pets = $PetModel->where('user_id', $userId)->findAll();
    ?>


    <!-- header -->
    <?= view('components/header') ?>

    <section id="profile">
        <div class="container profile-container">
            <div class="profile-header">
                <div class="avatar">
                    <img src="<?= esc($user->avatar ?? 'https://file.garden/ZrIPgCGn9kADc89z/Genopals/ab1.png') ?>"
                        alt="avatar" style="height: 233%; width: 100%; object-fit: contain; margin-top: -15px;">
                </div>
                <div class="profile-info">
                    <div class="left-info">
                        <p class="label">Display name</p>
                        <p class="value"><?= esc($user->display_name) ?></p>

                        <p class="label">Date registered</p>
                        <p class="value"><?= esc($user->created_at) ?></p>
                    </div>

                    <div class="right-info">
                        <p class="label">Username</p>
                        <p class="value">@<?= esc($user->username) ?></p>

                        <p class="label">Number of pets owned</p>
                        <p class="value"><?= count($pets) ?></p>
                    </div>
                    <a href="/profile/settings" style="color: inherit; text-decoration: none; transition: 0.2s;">
                        <i class="fa-solid fa-pen-to-square fa-xl"></i>
                    </a>
                </div>
            </div>

            <div class="pet-container">
                <div class="pets-container">
                    <?php
                    $totalSlots = 3; // max visible slots
                    $ownedPets = $pets ?? [];
                    ?>
<?php for ($i = 0; $i < $totalSlots; $i++): ?>
    <?php if (isset($ownedPets[$i])): ?>
        <?php $pet = $ownedPets[$i]; ?>
        <div class="feat-item">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
    <span><?= esc($pet->name) ?></span>

            <a href="/pet/edit/<?= $pet->id ?>" style="color: inherit; text-decoration: none; transition: 0.2s;">
                <i class="fa-solid fa-pen-to-square fa-xl"></i>
            </a>
    </div>
            <div style="display: flex; justify-content: center;">
                <img src="<?= esc($pet->image) ?>" alt="<?= esc($pet->name) ?>" height="250">
            </div>

            <div class="stat-container">
                <h4>Affection:</h4>
                <div class="stat-box">
                    <div class="stat-bar" id="health" style="width:<?= min(100, $pet->base_affection) ?>%;"></div>
                </div>
            </div>

            <div class="stat-container">
                <h4>Energy:</h4>
                <div class="stat-box">
                    <div class="stat-bar" id="energy" style="width:<?= min(100, $pet->base_energy) ?>%;"></div>
                </div>
            </div>

            <div class="stat-container">
                <h4>Maintenance:</h4>
                <div class="stat-box">
                    <div class="stat-bar" id="hunger" style="width:<?= min(100, $pet->base_maintenance) ?>%;"></div>
                </div>
            </div>

        </div>
    <?php else: ?>
        <div class="feat-item empty-slot">
            <a href="/adopt" class="add-pet">
                <i class="fa-solid fa-plus fa-4x"></i>
                <p>Adopt a new Genopal</p>
            </a>
        </div>
    <?php endif; ?>
<?php endfor; ?>

                </div>
            </div>
        </div>
    </section>

    <?= view('components/footer') ?>
</body>

</html>