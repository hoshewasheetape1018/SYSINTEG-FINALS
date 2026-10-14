<!DOCTYPE html>
<html lang="en">
<?= view('components/head') ?>

<body>

    <?= view('components/header') ?>

    <section id="edit-pet">
        <div class="container adopt-container">

            <div class="pet-preview">
                <img src="<?= esc($pet->image) ?>" alt="<?= esc($pet->name) ?>" style="max-width:200px;">
            </div>

            <div class="form-section">

                <h2>Edit Your Pet</h2>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="flash-message success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="flash-message error">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="/profile/pet/update/<?= $pet->id ?>" method="post">

                    <label for="name">Pet Name</label>
                    <input type="text" name="name" value="<?= esc($pet->name) ?>" required>
            <div style= "display: flex; gap: 10px; justify-content:center;">
                         <?= view('components/buttons/action', [
                                'btntitle' => 'SAVE',
                                'btntype' => 'submit'
                            ]) ?>
                </form>
                <form action="/profile/pet/delete/<?= $pet->id ?>" method="post"
                    onsubmit="return confirmDelete();">

                 <?= view('components/buttons/secondary', [
                                'btntitle' => 'DELETE',
                                'btntype' => 'submit'
                            ]) ?>

                </form>
            </div>
                <script>
                    function confirmDelete() {
                        return confirm("Are you sure you want to delete this pet?\nThis action cannot be undone!");
                    }
                </script>

            </div>
        </div>
    </section>

    <?= view('components/footer') ?>
</body>

</html>