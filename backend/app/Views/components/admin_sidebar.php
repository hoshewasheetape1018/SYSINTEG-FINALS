<?php $path = trim(uri_string(), '/'); ?>
<aside class="col-lg-auto admin-sidebar">
    <div class="admin-brand-panel">
        <a class="admin-brand" href="/admin/dashboard">BluMies</a>
        <button class="admin-menu-toggle d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminMenu" aria-label="Toggle admin menu"><i class="fa-solid fa-bars"></i></button>
    </div>
    <div class="admin-profile-panel">
        <span class="admin-avatar"><i class="fa-solid fa-user"></i></span>
        <span><strong><?= esc(session()->get('display_name') ?: session()->get('username') ?: 'Admin') ?></strong><small><?= esc(session()->get('email') ?: 'Administrator') ?></small></span>
    </div>
    <nav id="adminMenu" class="collapse d-lg-block admin-menu">
        <p class="admin-menu-title">Main Menu</p>
        <a class="<?= $path === 'admin/dashboard' ? 'active' : '' ?>" href="/admin/dashboard"><i class="fa-solid fa-house"></i>Home</a>
        <span class="admin-menu-group"><i class="fa-solid fa-shop"></i>My Shop</span>
        <div class="admin-submenu">
            <a class="<?= str_starts_with($path, 'admin/products') ? 'active' : '' ?>" href="/admin/products"><i class="fa-solid fa-box-open"></i>Products</a>
            <a class="<?= str_starts_with($path, 'admin/orders') ? 'active' : '' ?>" href="/admin/orders"><i class="fa-solid fa-receipt"></i>Orders</a>
            <a class="<?= str_starts_with($path, 'admin/collections') ? 'active' : '' ?>" href="/admin/collections"><i class="fa-solid fa-layer-group"></i>Collections</a>
            <a class="<?= str_starts_with($path, 'admin/users') ? 'active' : '' ?>" href="/admin/users"><i class="fa-solid fa-users"></i>Customers</a>
        </div>
        <a href="/admin/dashboard"><i class="fa-solid fa-chart-line"></i>Shop Management</a>
        <p class="admin-menu-kicker">Others</p>
        <a href="/support"><i class="fa-solid fa-bullhorn"></i>Promotion</a>
        <a href="/profile/settings"><i class="fa-solid fa-gear"></i>Settings</a>
        <a href="/" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square"></i>View Store</a>
    </nav>
</aside>
