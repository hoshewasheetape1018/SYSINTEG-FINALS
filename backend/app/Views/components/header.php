<header>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid px-4">

            <!-- Logo -->
            <a class="navbar-brand" href="/">
                <img
                    src="https://file.garden/ZrIPgCGn9kADc89z/blumis.png"
                    alt="BlumieS logo"
                    height="65"
                >
            </a>

            <!-- Mobile menu button -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar"
                aria-controls="mainNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Navigation -->
            <div class="collapse navbar-collapse" id="mainNavbar">

                <!-- Main links -->
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/products">Shop</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/collections">Collections</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                </ul>

                <!-- Right-side actions -->
                <div class="d-flex align-items-center gap-3">

                    <!-- Notifications -->
                    <a
                        href="/notifications"
                        class="nav-icon"
                        aria-label="Notifications"
                    >
                        <i class="fa-solid fa-bell"></i>
                    </a>

                    <!-- Cart -->
                    <a
                        href="/cart"
                        class="nav-icon"
                        aria-label="Shopping Cart"
                    >
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>

                    <?php
                    $session = session();
                    $isLoggedIn = $session->get('isLoggedIn');
                    ?>

                    <?php if ($isLoggedIn): ?>

                        <!-- Profile Dropdown -->
                        <div class="dropdown">

                            <button
                                class="btn nav-icon p-0 border-0"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                aria-label="Account"
                            >
                                <i class="fa-solid fa-circle-user"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="/profile"
                                    >
                                        Profile
                                    </a>
                                </li>

                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="/profile/settings"
                                    >
                                        Settings
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="#"
                                        id="logout-link"
                                    >
                                        Log Out
                                    </a>
                                </li>
                            </ul>

                        </div>

                        <!-- Hidden logout form -->
                        <form
                            id="logout-form"
                            action="/logout"
                            method="post"
                            class="d-none"
                        >
                        </form>

                    <?php else: ?>

                        <!-- Login -->
                        <a
                            href="/login"
                            class="nav-icon"
                            aria-label="Log In"
                        >
                            <i class="fa-solid fa-circle-user"></i>
                        </a>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const logoutLink = document.getElementById('logout-link');
        const logoutForm = document.getElementById('logout-form');

        if (logoutLink && logoutForm) {
            logoutLink.addEventListener('click', function (e) {
                e.preventDefault();
                logoutForm.submit();
            });
        }
    });
</script>