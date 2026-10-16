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
    :root {
        --blumiespink: #ec4d80;
        --blumieslightpink: #f1aaa9;
        --blumiesdarkblue: #303870;
        --blumieslightblue: #6f87e7;
        --blumiesyellow: #ea964e;
        --blumieslightyellow: #f3c19d;
        --blumiesbeige: #f7ece8;

        /*USE THE STYLE GUIDE*/
    }

    /* == IMPORTS == */
    @import url('https://fonts.googleapis.com/css2?family=Lily+Script+One&family=Oleo+Script+Swash+Caps:wght@400;700&display=swap');

    @font-face {
        font-family: 'Poppins';
        src: url('/fonts/Poppins-Regular.ttf') format('truetype');
        font-weight: 400;
        font-style: normal;
    }

    @font-face {
        font-family: 'Poppins';
        src: url('/fonts/Poppins-Bold.ttf') format('truetype');
        font-weight: 700;
        font-style: normal;
    }

    @font-face {
        font-family: 'Poppins';
        src: url('/fonts/Poppins-SemiBold.ttf') format('truetype');
        font-weight: 600;
        font-style: normal;
    }

    @font-face {
        font-family: 'Genty';
        src: url('/fonts/GentyDemo-Regular.ttf') format('truetype');
        font-weight: 400;
        font-style: normal;
    }

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

    /*NAVBAR*/

    .navbar {
        min-height: 80px;
    }

    .navbar-brand img {
        display: block;
    }

    .nav-link {
        font-size: 16px;
    }

    .nav-icon {
        color: inherit;
        text-decoration: none;
        font-size: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .nav-icon:hover {
        opacity: 0.7;
    }

    .navbar-toggler {
        border: none;
        font-size: 24px;
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }
    </style>
</head>