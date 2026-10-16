<head>
    <meta charset="UTF-8">
    <title>Blumies</title>
    <meta name="description" content="Raise a virtual angel pet in your own web browser.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CDN -->
    <!-- BOOTSTRAP CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>
    <!-- FONTAWESOME CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" />


    <!-- TAB ICON alt link: https://file.garden/ZrIPgCGn9kADc89z/blumis.png-->
    <link rel="shortcut icon" type="image/png" href="https://file.garden/ZrIPgCGn9kADc89z/blumis%20logo.png">


    <style>
        /* ========================================
       FONT IMPORTS
    ======================================== */

        @import url('https://fonts.googleapis.com/css2?family=Lily+Script+One&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap');


        /* ========================================
       BLUMIES COLOR PALETTE
       ======================================== */

        :root {
            --blumiespink: #ec4d80;
            --blumieslightpink: #f1aaa9;
            --blumiesdarkblue: #303870;
            --blumieslightblue: #6f87e7;
            --blumiesorange: #ea964e;
            --blumieslightorange: #f3c19d;
            --blumiesbeige: #f7ece8;
        }


        /* ========================================
       LOCAL FONTS
       ======================================== */

        @font-face {
            font-family: 'Poppins';
            src: url('/fonts/Poppins-Regular.ttf') format('truetype');
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: 'Poppins';
            src: url('/fonts/Poppins-SemiBold.ttf') format('truetype');
            font-weight: 600;
            font-style: normal;
        }

        @font-face {
            font-family: 'Poppins';
            src: url('/fonts/Poppins-Bold.ttf') format('truetype');
            font-weight: 700;
            font-style: normal;
        }

        @font-face {
            font-family: 'Genty';
            src: url('/fonts/GentyDemo-Regular.ttf') format('truetype');
            font-weight: 400;
            font-style: normal;
        }


        /* ========================================
       SCRIPT FONT CLASSES
       ======================================== */

        .lily-script-one-regular {
            font-family: "Lily Script One", system-ui;
            font-weight: 400;
            font-style: normal;
        }

        .oleo-script-swash-caps-regular {
            font-family: "Oleo Script Swash Caps", system-ui;
            font-weight: 400;
            font-style: normal;
        }

        .oleo-script-swash-caps-bold {
            font-family: "Oleo Script Swash Caps", system-ui;
            font-weight: 700;
            font-style: normal;
        }


        /* ========================================
       GLOBAL
       ======================================== */





        main {
            flex: 1;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 400;
            color: var(--blumiesdarkblue);
            background-color: var(--blumiesbeige);
            line-height: 1.5;
            height: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        html,
        body {
            min-height: 100%;
            margin: 0;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        a {
            color: inherit;
        }


        /* ========================================
       HEADINGS
       Style guide:
       H1 = 35pt
       H2 = 30pt
       H3 = 25pt
       H4 = 20pt
       ======================================== */

        /* ========================================
   Poppins Outline Headings
======================================== */

        h1,
        h2,
        h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;

            /* Fill */
            color: white;

            /* Manual outline */
            text-shadow:
                -4px -4px 0 var(--blumiesdarkblue),
                4px -4px 0 var(--blumiesdarkblue),
                -4px 4px 0 var(--blumiesdarkblue),
                4px 4px 0 var(--blumiesdarkblue),
                -4px 0 0 var(--blumiesdarkblue),
                4px 0 0 var(--blumiesdarkblue),
                0 -4px 0 var(--blumiesdarkblue),
                0 4px 0 var(--blumiesdarkblue);
        }

        h1 {
            font-size: 46.67px;
            line-height: 1.1;
        }

        h2 {
            font-size: 40px;
            line-height: 1.15;
        }

        h3 {
            font-size: 33.33px;
            line-height: 1.2;
        }

        h4 {
            font-family: 'Poppins', sans-serif;
            font-size: 26.67px;
            font-weight: 700;
            line-height: 1.25;

            color: var(--blumieslightblue);
        }

        h1 {
            font-size: 46.67px;
            line-height: 1.1;
        }

        h2 {
            font-size: 40px;
            line-height: 1.15;
        }

        h3 {
            font-size: 33.33px;
            line-height: 1.2;
        }

        h4 {
            font-family: 'Poppins', sans-serif;
            font-size: 26.67px;
            font-weight: 700;
            line-height: 1.25;
            color: var(--blumieslightblue);
        }


        /* ========================================
       BODY TEXT
       ======================================== */

        p {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 400;
            color: var(--blumiesdarkblue);
        }


        /* ========================================
       Y2K DISPLAY / LOGO TEXT
       ======================================== */

        .blumies-script {
            font-family: "Oleo Script Swash Caps", cursive;
            font-weight: 700;

            -webkit-text-stroke: 2px var(--blumiespink);

               /* Fill */
            color: white;

            /* Manual outline */
            text-shadow:
                -4px -4px 0 var(--blumiespink),
                4px -4px 0 var(--blumiespink),
                -4px 4px 0 var(--blumiespink),
                4px 4px 0 var(--blumiespink),
                -4px 0 0 var(--blumiespink),
                4px 0 0 var(--blumiespink),
                0 -4px 0 var(--blumiespink),
                0 4px 0 var(--blumiespink);
        }

        .blumies-logo {
            font-family: 'Genty', sans-serif;
            color: white;
            font-weight: 100;

              /* Manual outline */
            text-shadow:
                -4px -4px 0 var(--blumiespink),
                4px -4px 0 var(--blumiespink),
                -4px 4px 0 var(--blumiespink),
                4px 4px 0 var(--blumiespink),
                -4px 0 0 var(--blumiespink),
                4px 0 0 var(--blumiespink),
                0 -4px 0 var(--blumiespink),
                0 4px 0 var(--blumiespink);
        }


        /* ========================================
       NAVBAR
       ======================================== */

        .navbar {
            min-height: 80px;
        }

        .navbar-brand img {
            display: block;
            height: 65px;
            width: auto;
        }

        .nav-link {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: var(--blumiesdarkblue);
        }

        .nav-link:hover {
            color: var(--blumiespink);
        }

        .nav-icon {
            color: var(--blumiesdarkblue);
            text-decoration: none;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-icon:hover {
            color: var(--blumiespink);
        }

        .navbar-toggler {
            border: none;
            font-size: 24px;
            color: var(--blumiesdarkblue);
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }


        /* ========================================
       BUTTONS
       ======================================== */

        .btn-blumies {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: var(--blumieswhite);
            background-color: var(--blumiespink);
            border: 2px solid var(--blumiesdarkblue);
            border-radius: 999px;
            padding: 10px 24px;
        }

        .btn-blumies:hover {
            color: var(--blumieswhite);
            background-color: var(--blumieslightblue);
        }


        /* ========================================
   ACCOUNT
======================================== */

        .account-button {
            display: flex;
            align-items: center;
            gap: 7px;

            border: none;
            background: transparent;

            padding: 0;

            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 600;

            color: var(--blumiesdarkblue);
        }

        .account-button:hover {
            color: var(--blumiespink);
        }

        .account-button .fa-circle-user {
            font-size: 20px;
        }

        .account-arrow {
            font-size: 10px;
        }

        .nav-auth-link {
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 600;

            color: var(--blumiesdarkblue);
            text-decoration: none;
        }

        .nav-auth-link:hover {
            color: var(--blumiespink);
        }

        .auth-links {
            display: flex;
            align-items: center;
            gap: 15px;
        }


        /* ========================================
   NOTIFICATIONS
======================================== */

        .notification-dropdown {
            position: relative;
        }

        .notification-menu {
            width: 360px;
            padding: 0;
            overflow: hidden;

            border: none;
            border-radius: 0;

            background-color: var(--blumiesbeige);

            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }


        /* Header */

        .notification-header {
            padding: 16px 18px;

            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 600;

            color: var(--blumiesdarkblue);

            border-bottom: 1px solid rgba(48, 56, 112, 0.2);
        }


        /* Notification */

        .notification-item {
            display: block;

            padding: 15px 18px;

            color: var(--blumiesdarkblue);
            text-decoration: none;

            border-bottom: 1px solid rgba(48, 56, 112, 0.15);
        }

        .notification-item:hover {
            background-color: var(--blumieslightpink);
        }

        .notification-title {
            margin-bottom: 3px;

            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 700;
        }

        .notification-message {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 400;

            line-height: 1.4;
        }


        /* View All */

        .notification-view-all {
            display: block;

            padding: 13px;

            text-align: center;

            color: var(--blumiesdarkblue);
            text-decoration: none;

            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        .notification-view-all:hover {
            background-color: var(--blumiespink);
            color: white;
        }


        /* Notification Count */

        .notification-dropdown .nav-icon {
            position: relative;
        }

        .notification-badge {
            position: absolute;

            top: -7px;
            right: -8px;

            min-width: 17px;
            height: 17px;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 2px 5px;

            border-radius: 50%;

            background-color: var(--blumiespink);
            color: white;

            font-size: 10px;
            font-weight: 700;
        }
    </style>
</head>