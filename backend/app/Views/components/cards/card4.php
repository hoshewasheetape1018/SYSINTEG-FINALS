<?php
/**
 * Props expected:
 * - $title (string)
 * - $status (string)
 */

$statusClass = strtolower(str_replace(' ', '', $status ?? ''));
?>

<div class="card">
    <h3>
        <?= $title ?? '' ?>
        <span class="badge <?= $statusClass ?>"><?= $status ?? '' ?></span>
    </h3>
</div>
