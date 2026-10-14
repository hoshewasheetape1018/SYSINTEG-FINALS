<?php
$type = isset($btntype) && $btntype === 'submit' ? 'submit' : 'button';
?>

<button class="secondary" type="<?= $type ?>">
    <?php if ($type === 'submit'): ?>
        <?= esc($btntitle) ?>
    <?php else: ?>
        <a href="<?= esc($btnlink) ?>"><?= esc($btntitle) ?></a>
    <?php endif; ?>
</button>
