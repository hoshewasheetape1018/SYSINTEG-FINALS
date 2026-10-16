<?php
$session = session();
$isLoggedIn = (bool) $session->get('isLoggedIn');
$username = $session->get('display_name') ?: $session->get('username') ?: 'Account';
?>
<header class="site-header sticky-top">
    <nav class="navbar navbar-expand-lg bg-white border-bottom" aria-label="Main navigation">
        <div class="container-xl">
            <a class="navbar-brand" href="/" aria-label="Blumies home"><span class="brand-wordmark">Blumies</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation"><i class="fa-solid fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link" href="/about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="/collections">Collections</a></li>
                    <li class="nav-item"><a class="nav-link" href="/products">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                </ul>
                <div class="nav-actions d-flex align-items-center gap-3 ms-lg-4 py-3 py-lg-0">
                    <?php if ($isLoggedIn): ?>
                        <div class="dropdown">
                            <button class="nav-icon position-relative" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notifications"><i class="fa-regular fa-bell"></i><span class="notification-badge">3</span></button>
                            <div class="dropdown-menu dropdown-menu-end notification-menu">
                                <div class="notification-header">Notifications</div>
                                <?php foreach (['Your order has been received.', 'Your order has been approved.', 'Your order has been shipped.'] as $message): ?>
                                    <a href="/profile/orders" class="notification-item"><span class="notification-title">Shipping status</span><span class="notification-message"><?= esc($message) ?></span></a>
                                <?php endforeach; ?>
                                <a href="/notifications" class="notification-view-all">View all</a>
                            </div>
                        </div>
                        <a href="/cart" class="nav-icon" aria-label="Shopping cart"><i class="fa-solid fa-bag-shopping"></i></a>
                        <div class="dropdown">
                            <button class="account-button" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-regular fa-circle-user"></i><span><?= esc($username) ?></span><i class="fa-solid fa-chevron-down small"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/profile">Profile</a></li><li><a class="dropdown-item" href="/profile/orders">My orders</a></li><li><a class="dropdown-item" href="/profile/settings">Settings</a></li><li><hr class="dropdown-divider"></li><li><button class="dropdown-item" type="submit" form="logout-form">Log out</button></li>
                            </ul>
                        </div>
                        <form id="logout-form" action="/logout" method="post" class="d-none"></form>
                    <?php else: ?>
                        <a href="/cart" class="nav-icon" aria-label="Shopping cart"><i class="fa-solid fa-bag-shopping"></i></a>
                        <a href="/login" class="nav-icon" aria-label="Log in"><i class="fa-regular fa-circle-user"></i></a>
                        <a href="/signup" class="btn btn-brand btn-sm">Sign up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>
