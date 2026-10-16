<header>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid px-4">

            <!-- Logo -->
            <a class="navbar-brand" href="/">
                <img src="https://file.garden/ZrIPgCGn9kADc89z/blumis.png" alt="BlumieS logo" height="65">
            </a>

            <!-- Mobile Menu Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>


            <!-- Navigation -->
            <div class="collapse navbar-collapse" id="mainNavbar">

                <!-- Main Links -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="/products">
                            Shop
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/collections">
                            Collections
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/about">
                            About
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/contact">
                            Contact
                        </a>
                    </li>

                </ul>


                <!-- Right Side -->
                <?php
                $session = session();
                $isLoggedIn = $session->get('isLoggedIn');

                // Change this depending on the session key used by your project.
                $username = $session->get('username') ?? 'User';
                ?>

                <div class="d-flex align-items-center gap-3">


                    <!-- ================================
                         NOTIFICATIONS
                    ================================= -->

                    <?php if ($isLoggedIn): ?>

                    <div class="dropdown notification-dropdown">

                        <button class="btn nav-icon p-0 border-0" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false" aria-label="Notifications">
                            <i class="fa-solid fa-bell"></i>

                            <!-- Optional notification count -->
                            <span class="notification-badge">3</span>
                        </button>


                        <!-- Notification Dropdown -->
                        <div class="dropdown-menu dropdown-menu-end notification-menu">

                            <div class="notification-header">
                                Recently Received Notifications
                            </div>


                            <!-- Notification 1 -->
                            <a href="/orders/1024" class="notification-item">
                                <div class="notification-title">
                                    Shipping status
                                </div>

                                <div class="notification-message">
                                    Your order has been shipped.
                                </div>
                            </a>


                            <!-- Notification 2 -->
                            <a href="/orders/1024" class="notification-item">
                                <div class="notification-title">
                                    Shipping status
                                </div>

                                <div class="notification-message">
                                    Your order has been approved.
                                </div>
                            </a>


                            <!-- Notification 3 -->
                            <a href="/orders/1024" class="notification-item">
                                <div class="notification-title">
                                    Shipping status
                                </div>

                                <div class="notification-message">
                                    Your order has been received.
                                </div>
                            </a>


                            <!-- View All -->
                            <a href="/notifications" class="notification-view-all">
                                View All
                            </a>

                        </div>

                    </div>

                    <?php endif; ?>

                    <?php if ($isLoggedIn): ?>

                    <!-- ================================
         CART
    ================================= -->

                    <a href="/cart" class="nav-icon" aria-label="Shopping Cart">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>

                    <?php endif; ?>

                    <!-- ================================
                         ACCOUNT
                    ================================= -->

                    <?php if ($isLoggedIn): ?>

                    <!-- Logged-in Account -->
                    <div class="dropdown">

                        <button class="account-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                            <i class="fa-solid fa-circle-user"></i>

                            <span class="account-username">
                                <?= esc($username) ?>
                            </span>

                            <i class="fa-solid fa-chevron-down account-arrow"></i>

                        </button>


                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>
                                <a class="dropdown-item" href="/profile">
                                    Profile
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="/profile/orders">
                                    My Orders
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="/profile/settings">
                                    Settings
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item" href="#" id="logout-link">
                                    Log Out
                                </a>
                            </li>

                        </ul>

                    </div>


                    <!-- Hidden Logout Form -->
                    <form id="logout-form" action="/logout" method="post" class="d-none"></form>


                    <?php else: ?>

                    <!-- Logged-out Account -->
                    <div class="auth-links">

                        <a href="/signup" class="nav-auth-link">
                            Register
                        </a>

                        <a href="/login" class="nav-auth-link">
                            Login
                        </a>

                    </div>

                    <?php endif; ?>


                </div>

            </div>
        </div>
    </nav>
</header>


<script>
document.addEventListener('DOMContentLoaded', function() {

    const logoutLink = document.getElementById('logout-link');
    const logoutForm = document.getElementById('logout-form');

    if (logoutLink && logoutForm) {

        logoutLink.addEventListener('click', function(e) {
            e.preventDefault();
            logoutForm.submit();
        });

    }

});
</script>