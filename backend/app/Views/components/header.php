<?php
use App\Models\NotificationModel;

$session = session();
$isLoggedIn = (bool) $session->get('isLoggedIn');
$isAdmin = $isLoggedIn && strtolower((string) $session->get('type')) === 'admin';
$username = $session->get('display_name') ?: $session->get('username') ?: 'Account';
$navbarNotifications = [];
$unreadNotificationCount = 0;
if ($isLoggedIn && db_connect()->tableExists('notifications')) {
    $userId = (int) $session->get('user_id');
    $navbarNotifications = (new NotificationModel())
        ->where('user_id', $userId)
        ->orderBy('id', 'DESC')
        ->findAll(5);
    $unreadNotificationCount = (new NotificationModel())
        ->where('user_id', $userId)
        ->where('read_at', null)
        ->countAllResults();
}
?>
<header class="site-header sticky-top">
    <nav class="navbar navbar-expand-lg bg-white border-bottom" aria-label="Main navigation">
        <div class="container-xl">
            <a class="navbar-brand text-decoration-none" href="/" aria-label="Blumies home"><span class="brand-wordmark">Blumies</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation"><i class="fa-solid fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link" href="/about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="/collections">Collections</a></li>
                    <li class="nav-item"><a class="nav-link" href="/products">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                    <?php if ($isAdmin): ?><li class="nav-item"><a class="nav-link fw-bold" href="/admin/dashboard"><i class="fa-solid fa-gauge-high me-1"></i>Admin</a></li><?php endif; ?>
                </ul>
                <div class="nav-actions d-flex align-items-center gap-3 ms-lg-4 py-3 py-lg-0">
                    <?php if ($isLoggedIn): ?>
                        <div class="dropdown">
                            <button class="nav-icon position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notifications"><i class="fa-regular fa-bell"></i><?php if ($unreadNotificationCount > 0): ?><span class="notification-badge"><?= esc($unreadNotificationCount > 99 ? '99+' : $unreadNotificationCount) ?></span><?php endif; ?></button>
                            <div class="dropdown-menu dropdown-menu-end notification-menu">
                                <div class="notification-header">Notifications</div>
                                <?php if ($navbarNotifications === []): ?><div class="notification-item text-muted-brand">No notifications yet.</div><?php endif; ?>
                                <?php foreach ($navbarNotifications as $notification): ?>
                                    <form action="/notifications/read/<?= esc($notification['id']) ?>" method="post"><button class="notification-item notification-button w-100 text-start <?= empty($notification['read_at']) ? 'notification-item-unread' : '' ?>" type="submit"><span class="notification-title"><?= esc($notification['title']) ?></span><span class="notification-message"><?= esc($notification['message']) ?></span></button></form>
                                <?php endforeach; ?>
                                <a href="/notifications" class="notification-view-all">View all</a>
                            </div>
                        </div>
                        <a href="/cart" class="nav-icon" aria-label="Shopping cart"><i class="fa-solid fa-bag-shopping"></i></a>
                        <div class="dropdown">
                            <button class="account-button" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-regular fa-circle-user"></i><span><?= esc($username) ?></span><i class="fa-solid fa-chevron-down small"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <?php if ($isAdmin): ?><li><a class="dropdown-item" href="/admin/dashboard"><i class="fa-solid fa-gauge-high me-2"></i>Admin Dashboard</a></li><li><hr class="dropdown-divider"></li><?php endif; ?>
                                <li><a class="dropdown-item" href="/profile">Profile</a></li><li><a class="dropdown-item" href="/profile/orders">My orders</a></li><li><a class="dropdown-item" href="/profile/settings">Settings</a></li><li><hr class="dropdown-divider"></li><li><button class="dropdown-item" type="submit" form="logout-form">Log out</button></li>
                            </ul>
                        </div>
                        <form id="logout-form" action="/logout" method="post" class="d-none"></form>
                    <?php else: ?>
                        <a href="/cart" class="nav-icon" aria-label="Shopping cart"><i class="fa-solid fa-bag-shopping"></i></a>
                        <a href="/login" class="btn btn-brand btn-sm">Log in</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>
