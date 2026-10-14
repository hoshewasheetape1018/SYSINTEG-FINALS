<head>
    <meta charset="UTF-8">
    <title>〖 GENOPALS 〗</title>
    <meta name="description" content="Raise a virtual angel pet in your own web browser.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="https://file.garden/ZrIPgCGn9kADc89z/Genopals/favicon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
        :root {
            --primary: #007EB0;
            /*--secondary: ; */
        }


        /* BODY ANIMATIONS */
        @keyframes panDown {
            from {
                transform: translateY(-10px);
            }

            to {
                transform: translateY(0);
            }
        }

        @keyframes panFade {
            from {
                transform: translateY(5px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes trigger {
            to {
                --animate: true;
            }
        }


        @container style(--animate: true) {
            .container-animate {
                animation: panFade 600ms cubic-bezier(0.25, 1, 0.5, 1) forwards;
                animation-fill-mode: forwards;
            }
        }

        section {
            animation: trigger steps(1) both;
            animation-timeline: view();
            animation-range: entry 25% entry 80%;
        }

        /* HEADER STYLES */

        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* track */
        ::-webkit-scrollbar-track {
            background: #B2F2FF;
            /* light blue */
        }

        /* handle */
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #00AFD2, #005A6C);
            border-radius: 6px;
        }

        /* handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #5B9ED9, #005A6C);
        }

        a {
            text-decoration: none;
        }

        header {
            position: relative;
            z-index: 1;
            background: linear-gradient(90deg, #B2F2FF 0%, #5B9ED9 100%);
            display: flex;
            justify-content: space-around;
            padding: 1.2rem;
            border-bottom: 3px solid #005A6C;

            nav {
                display: flex;
                gap: 2rem;
            }

            img {
                margin: -10px;
            }


        }

        .profile-dropdown {
            position: relative;
            display: inline-block;
            z-index: 1000;
            /* makes sure it sits above body */
        }

        .profile-dropdown .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background: linear-gradient(180deg, #FFF8E8 0%, #FFD06A 82.69%);
            border: 3px solid #B97E00;
            border-radius: 20px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            min-width: 160px;
        }

        .profile-dropdown:hover .dropdown-content {
            display: block;
        }

        /* Dropdown items */
        .profile-dropdown .dropdown-content a,
        .profile-dropdown .dropdown-content button {
            display: block;
            width: 100%;
            padding: 0.8rem 1.2rem;
            font-family: inherit;
            font-weight: 700;
            background: none;
            border: none;
            text-align: left;
            cursor: pointer;
            color: #6B4800;
            text-decoration: none;
            transition: background 0.2s ease, transform 0.1s ease;
        }

        .profile-dropdown .dropdown-content a:hover,
        .profile-dropdown .dropdown-content button:hover {
            background-color: rgba(255, 197, 72, 0.3);
        }


        /* BUTTON STYLES */
        button {
            padding-inline: 1.5rem;
            height: 3rem;
            box-shadow: inset 0px 0px 7px 4px rgba(255, 255, 255, 0.79);
            border-radius: 38px;
            font-family: 'Inter';
            font-weight: 700;
            text-decoration: none;
            font-size: 2rem;

            a {
                font-family: 'Inter';
                font-weight: 700;
                text-decoration: none;
                font-size: 2rem;
            }
        }

        button.primary {
            background: linear-gradient(180deg, #FFFFFF 0%, #D0E2EE 82.69%);
            border: 3px solid #007EB0;
            color: #B2F2FF;

            text-shadow:
                -2px -2px 0px #005A6C,
                2px -2px 0px #005A6C,
                -2px 2px 0px #005A6C,
                2px 2px 0px #005A6C,
                0px -2px 0px #005A6C,
                -2px 0px 0px #005A6C,
                2px 0px 0px #005A6C,
                0px 2px 0px #005A6C;

            a {
                color: #B2F2FF;

                text-shadow:
                    -2px -2px 0px #005A6C,
                    2px -2px 0px #005A6C,
                    -2px 2px 0px #005A6C,
                    2px 2px 0px #005A6C,
                    0px -2px 0px #005A6C,
                    -2px 0px 0px #005A6C,
                    2px 0px 0px #005A6C,
                    0px 2px 0px #005A6C;

            }
        }

        button.action {
            background: linear-gradient(180deg, #FFF8E8 0%, #FFD06A 82.69%);
            border: 3px solid #B97E00;
            color: #FFC548;
            text-shadow:
                -2px -2px 0 #6B4800,
                2px -2px 0 #6B4800,
                -2px 2px 0 #6B4800,
                2px 2px 0 #6B4800,
                0 -2px 0 #6B4800,
                -2px 0px 0 #6B4800,
                2px 0px 0 #6B4800,
                0 2px 0 #6B4800;


            a {
                color: #FFC548;
                text-shadow:
                    -2px -2px 0 #6B4800,
                    2px -2px 0 #6B4800,
                    -2px 2px 0 #6B4800,
                    2px 2px 0 #6B4800,
                    0 -2px 0 #6B4800,
                    -2px 0px 0 #6B4800,
                    2px 0px 0 #6B4800,
                    0 2px 0 #6B4800;

            }
        }

        button.secondary {
            background: linear-gradient(180deg, #B2F2FF 0.48%, #00AFD2 83%);
            border: 3px solid #FFFFFF;
            color: #ffffffff;
            text-shadow:
                -2px -2px 0 #005A6C,
                2px -2px 0 #005A6C,
                -2px 2px 0 #005A6C,
                2px 2px 0 #005A6C,
                0px -2px 0 #005A6C,
                -2px 0px 0 #005A6C,
                2px 0px 0 #005A6C,
                0px 2px 0 #005A6C;

            a {
                color: #ffffffff;
                text-shadow:
                    -2px -2px 0 #005A6C,
                    2px -2px 0 #005A6C,
                    -2px 2px 0 #005A6C,
                    2px 2px 0 #005A6C,
                    0px -2px 0 #005A6C,
                    -2px 0px 0 #005A6C,
                    2px 0px 0 #005A6C,
                    0px 2px 0 #005A6C;
            }
        }

        button.disabled {
            background: linear-gradient(180deg, #D9D9D9 0.48%, #696969 83%);
            border: 3px solid #FFFFFF;
            box-shadow: inset 0px 0px 7px rgba(255, 255, 255, 0.79);
            color: #ffffffff;
            text-shadow:
                -2px -2px 0 #363636,
                2px -2px 0 #363636,
                -2px 2px 0 #363636,
                2px 2px 0 #363636,
                0px -2px 0 #363636,
                -2px 0px 0 #363636,
                2px 0px 0 #363636,
                0px 2px 0 #363636;


            a {
                color: #ffffffff;
                text-shadow:
                    -2px -2px 0 #363636,
                    2px -2px 0 #363636,
                    -2px 2px 0 #363636,
                    2px 2px 0 #363636,
                    0px -2px 0 #363636,
                    -2px 0px 0 #363636,
                    2px 0px 0 #363636,
                    0px 2px 0 #363636;

            }
        }

        button.bordered {
            background: transparent;
            border: 3px solid var(--primary);
            box-shadow: none;
            color: var(--primary);
            text-shadow: none;

            a {
                color: var(--primary);
                text-shadow: none;
            }
        }

        button:hover {
            cursor: pointer;
        }

        button.primary:hover {
            background: linear-gradient(0deg, #FFFFFF 0%, #D0E2EE 82.69%);

        }

        button.secondary:hover {
            background: linear-gradient(0deg, #B2F2FF 0.48%, #00AFD2 83%)
        }


        button.action:hover {
            background: linear-gradient(0deg, #FFF8E8 0%, #FFD06A 82.69%);

        }

        button.disabled:hover {
            cursor: not-allowed;

            a {
                cursor: not-allowed
            }
        }

        button.bordered:hover {
            background: var(--primary);

            a {
                color: #FFFFFF;
            }
        }

        section#hero>button {


            height: 4.5rem;
            border-radius: 25px;
            padding-inline: 3.5rem;

        }

        /*ERROR */
        .error {
            color: red;
            font-size: 0.9rem;
            margin-top: -0.3rem;
        }

        .success-message {
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: #DFF2BF;
            /* light green */
            border: 1px solid #4F8A10;
            /* dark green */
            border-radius: 5px;
            color: #4F8A10;
            font-weight: bold;
        }


        /* BODY STYLES */
        body {
            position: relative;
            z-index: 0;
            margin: 0;
            padding: 0;
            height: 100%;
            background-image: url("https://file.garden/ZrIPgCGn9kADc89z/Genopals/bg-genopals.png");
            background-size: contain;
            background-attachment: fixed;
            color: var(--primary);
            font-family: 'Inter', sans-serif;

            h1,
            h2 {
                font-family: 'Playfair Display';
                font-weight: 700;
                text-align: center;

                color: #5B9ED9;


            }

            h1 {
                font-size: 40px;
                text-shadow: 0px 4px 4px #1E1E1E;
            }

            h2 {
                font-size: 36px;
                text-shadow: 0px 1px 3px #000000ff;
            }

            img {

                object-fit: cover;
            }

            section {
                height: 100%;
                margin: 0;
                padding: 1.5rem;
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;
            }

            section#hero {
                height: 85vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: flex-end;
                background-image: url("https://file.garden/ZrIPgCGn9kADc89z/Genopals/better_hero_bg%20artge2.png");
                padding-bottom: 4rem;
                background-size: cover;
                background-position: center;
                animation: panDown 0.8s ease-out forwards;


                h1 {
                    color: #F6E8FF;
                    text-shadow:
                        -2px -2px 0 #747AFF,
                        2px -2px 0 #747AFF,
                        -2px 2px 0 #747AFF,
                        2px 2px 0 #747AFF,
                        0px -2px 0 #747AFF,
                        -2px 0px 0 #747AFF,
                        2px 0px 0 #747AFF,
                        0px 2px 0 #747AFF;
                    margin-bottom: 1.1rem;

                    background: linear-gradient(90deg, rgba(0, 175, 210, 0) 0%, rgba(0, 175, 210, 1.0) 20%, rgba(0, 175, 210, 1.0) 80%, rgba(0, 175, 210, 0) 100%);
                    padding: 0.1rem;
                }
            }


            section#section1 {
                position: relative;
                height: 105vh;
                top: -11vh;
                background: linear-gradient(180deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.318182) 4.33%, #FFFFFF 8.65%, #EBF4F5 100%);
                padding-top: 7rem;

                .container h2 {
                    margin-bottom: 0;

                }
            }

            section#section3 {
                background: linear-gradient(180deg, #00729E 0%, #005A6C 100%);

                h2#title {
                    color: white;
                }

                div.container {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin-bottom: 1rem;
                    height: 15vh;
                    min-height: unset;

                    h2 {
                        margin: 0.5rem;
                    }
                }


            }


            section#section4 {
                height: 65vh;
                background: linear-gradient(180deg, #FFFFFF 0%, #EBF4F5 100%);

                h2 {
                    margin: 0;
                }

                p {
                    font-family: 'Inter';
                    font-size: 30px;
                    color: var(--primary);
                    margin-bottom: 2rem;
                }

            }

            section#news {
                div.container {
                    justify-content: center;
                }

                .news-card {
                    margin: 1.5rem;
                    padding-inline: 10rem;
                    width: auto;
                    background-color: #B2F2FF;
                    display: flex;
                    justify-content: center;
                    align-self: center;
                    text-align: center;
                    flex-direction: column;
                    border: 5px solid #007EB0;
                    transition: transform 0.5s cubic-bezier(0.25, 1, 0.5, 1);

                    h2 {
                        margin-bottom: 1.3rem;
                    }

                    p {
                        font-family: 'Inter';
                        color: var(--primary);
                        margin-top: 0;
                        margin-bottom: 1.5rem;
                    }
                }


                .news-card:hover {
                    transform: scale(1.15);
                }


            }

            section#moodboard {

                .container {
                    padding-bottom: 5rem;
                }

                .moodboard-grid {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    gap: 2rem;

                    h4 {
                        font-family: 'Inter';
                        color: var(--primary);
                    }

                }


                .color-row {
                    display: flex;
                    gap: 1rem;
                    justify-content: center;
                    align-items: center;
                    margin-top: 1rem;
                }

                .color-row .color {
                    width: 80px;
                    height: 80px;
                    border-radius: 50%;
                    border: 3px solid #FFFFFF;
                }

                /* nth-child selectors for your palette */
                .color-row .color:nth-child(1) {
                    background-color: #EBF4F5;
                    /* off-white */
                }

                .color-row .color:nth-child(2) {
                    background-color: #B2F2FF;
                    /* light blue */
                }

                .color-row .color:nth-child(3) {
                    background-color: #005A6C;
                    /* dark blue */
                }

                .color-row .color:nth-child(4) {
                    background-color: #FFC548;
                    /* yellow */
                }

                .color-row .color:nth-child(5) {
                    background-color: #DCA8FF;
                    /* magenta */
                }

                .typography {
                    display: flex;
                    gap: 4rem;
                    justify-content: center;


                    h2 {
                        color: var(--primary);
                        margin-top: 0;
                        margin-bottom: 0.5rem;
                        text-shadow: none;
                        text-align: start;


                    }

                    p {
                        color: var(--primary);
                        font-size: 1.2rem;
                    }

                    #playfair {
                        font-family: 'Playfair Display';
                    }

                    #inter {
                        font-family: 'Inter';
                    }

                }

                .button-row {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 1rem;
                    align-items: center;
                }

                .button-row button {
                    flex: 1 1 calc(50% - 1rem);
                    width: 7rem;
                }

                .card-row {
                    display: flex;
                    gap: 1.5rem;
                    justify-content: center;
                    margin-top: 1rem;
                    width: 50rem;
                }

                .card-row:nth-child(2) {
                    margin-top: 0;

                    h3 {
                        display: flex;
                        gap: 10px;
                        align-items: center;
                        justify-content: flex-start;

                        img {
                            border-radius: 100%;
                            background-color: var(--primary);
                            padding: 5px;
                        }
                    }
                }

                .logo-row {
                    display: flex;
                    gap: 2rem;
                    justify-content: center;
                    align-items: center;
                    margin-top: 1rem;

                    div {
                        width: 100px;
                        height: 100px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        border-radius: 10px;
                        background-color: var(--primary);

                        padding: 2rem;

                        img {
                            height: 118px;
                            object-fit: cover;
                        }

                    }

                    .rounded {
                        border-radius: 100%;
                    }
                }
            }

            section#roadmap {
                text-align: center;

                .container {
                    padding-bottom: 3rem;

                }

                /* Cards Row */
                .card-row {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 1.5rem;
                    justify-content: center;
                }

                /* Individual Cards */
                .card {
                    background: #FFFFFF;
                    border: 2px solid #D0D0D0;
                    border-radius: 12px;
                    padding: 1rem 1.2rem;
                    width: 250px;
                    flex: -15 1 200px;
                    text-align: left;
                    filter: drop-shadow(0px 6px 5px #B6B6B6);
                    position: relative;
                }

                /* Card Title + Badge */
                .card h3 {
                    font-family: 'Inter', sans-serif;
                    color: var(--primary);
                    font-weight: 600;
                    font-size: 1rem;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                /* Badge styles (global) */
                .card h3 .badge {
                    font-family: 'Inter', sans-serif;
                    font-size: 0.7rem;
                    font-weight: 700;
                    padding: 0.25rem 0.6rem;
                    border-radius: 12px;
                    text-transform: uppercase;
                    border: 1px solid;
                }

                /* Badge colors */
                .badge.completed {
                    color: #007EB0;
                    border-color: #007EB0;
                    background: #B2F2FF33;
                }

                .badge.inprogress {
                    color: #B97E00;
                    border-color: #B97E00;
                    background: #FFD06A33;
                }

                .badge.planned {
                    color: #FFFFFF;
                    /* white text */
                    border-color: #FFFFFF;
                    /* white border */
                    background: #007EB0;
                    /* solid blue background */
                }

                .badge.future {
                    color: #B97E00;
                    border-color: #B97E00;
                    background: #DCA8FF33;
                }
            }


            section#login {

                .container {
                    padding-bottom: 3rem;
                }

                .login-container {
                    display: flex;
                    height: 100%;
                    width: 75vw;
                    gap: 1.5rem;
                }

                .login-item {
                    height: 80vh;
                    width: 50%;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    margin-top: 1.3rem;
                    border-style: inset;
                    border: 5px solid white;
                    box-shadow: 0px 4px 4px #00000040;
                }

                .login-item:nth-of-type(2) {
                    background-color: #D0E2EE;
                    justify-content: flex-start;
                    padding-inline: 1.3rem;


                    h2 {
                        text-align: left;
                        margin-bottom: 0.7rem;
                    }
                }

                .login-img {
                    width: 100%;
                    height: 100%;
                    background: linear-gradient(180deg, rgba(255, 255, 255, 0) 48%,
                            rgba(255, 255, 255, 0.32) 60%,
                            #ffffff 76%),
                        url("https://file.garden/ZrIPgCGn9kADc89z/Genopals/better_hero_bg%20artge2.png");
                    background-size: cover;
                    background-position: center;
                    display: flex;
                    flex-direction: column;
                    justify-content: flex-end;
                    align-items: center;
                    padding-bottom: 2rem;

                    h2 {
                        margin-block: 0;
                        font-size: 4rem;
                    }

                    div {
                        display: flex;
                        flex-direction: column;
                        justify-content: flex-end;
                        align-items: center;
                        margin-bottom: 1.3rem;
                    }


                }

                form>div:nth-of-type(3) {
                    display: flex;
                    align-items: center;
                    justify-content: flex-end;
                }
            }

            section#signup {


                .container {
                    padding-bottom: 3rem;

                    h2 {
                        margin-bottom: -0.8rem;
                    }
                }


            }

            input {
                margin-bottom: 1.5rem;
                width: 27.5rem;
                height: 2.5rem;
                font-size: 1.2rem;
            }

            .container {
                min-height: 80vh;
                width: 80vw;
                display: flex;
                flex-direction: column;
                align-items: center;
                border: 9px solid transparent;
                border-image: linear-gradient(180deg, #5B9ED9 0%, #B2F2FF 50%, #5B9ED9 90%) 1;
                background-color: #EBF4F5;
                gap: 2rem;
                filter: drop-shadow(0px 6px 16.6px #B6B6B6);
            }

            .container-animate {
                opacity: 0;
            }

            .card {
                background: #EBF4F5;
                border: 2px solid var(--primary);
                border-radius: 10px;
                padding: 1.5rem;
                filter: drop-shadow(0px 6px 5px #B6B6B6);

                button {
                    a {
                        font-size: 1.3rem;
                    }
                }
            }

            div#features1 {
                display: flex;
                gap: 2rem;
                align-items: center;
                width: 90%;


                div.feat-item {
                    padding-top: 0.5rem;
                    height: 100%;
                    width: 30%;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    background-color: #D0E2EE;

                }
            }

            div.stat-container {
                width: 90%;
                margin-bottom: -0.7rem;
                display: flex;
                gap: 4rem;
                align-items: center;

                h4 {
                    width: 50px;
                    font-family: 'Inter';
                    color: var(--primary);

                }

                .stat-box {

                    background-color: #EBF4F5;
                    height: 20px;
                    width: 300px;
                    padding: 0.5rem;
                    filter: drop-shadow(0px 3px 2px #B6B6B6);
                    display: flex;
                    align-items: center;

                    .stat-bar {
                        height: 90%;
                        width: 30%;
                    }

                    div#health {
                        background: linear-gradient(90deg, #5B9ED9 0%, #B2F2FF 100%);
                    }

                    div#energy {
                        background: linear-gradient(90deg, #E99F00 0%, #FFD06A 100%);
                    }

                    div#hunger {
                        background: linear-gradient(90deg, #005A6C 0%, #007EB0 100%);

                    }
                }


            }

            section#profile {

                .profile-container {
                    padding: 2rem;
                    gap: 1.5rem;
                    align-content: center;
                    flex-wrap: wrap;
                    align-items: center;
                    display: flex;

                }

                .profile-header {
                    display: flex;
                    align-items: center;
                    background-color: #D0E2EE;
                    width: 90%;
                    position: relative;
                    padding: 2.3rem;

                    .avatar {
                        flex: 0 0 100px;
                        height: 100px;
                        width: 100px;
                        border-radius: 50%;
                        overflow: hidden;
                        background-color: #EBF4F5;
                        border: 3px solid var(--primary);

                        img {
                            height: 100%;
                            width: 100%;
                            object-fit: cover;
                        }
                    }

                    .profile-info {
                        display: flex;
                        justify-content: space-between;
                        width: 100%;
                        padding-inline: 2rem;

                        .left-info,
                        .right-info {
                            display: flex;
                            flex-direction: column;
                            gap: 0.3rem;

                            .label {
                                font-weight: 700;
                                color: var(--primary);
                                margin-bottom: 0.1rem;
                            }

                            .value {
                                font-family: 'Inter';
                                color: #005A6C;
                                margin-top: 0;
                                margin-bottom: 0.8rem;
                            }
                        }

                        .edit-btn {
                            position: absolute;
                            top: 1rem;
                            right: 1rem;
                        }
                    }
                }


            }

            .pets-container {
                display: flex;
                justify-content: center;
                gap: 2rem;
                flex-wrap: wrap;

                .feat-item {
                    width: 25%;
                    display: flex;
                    background-color: #D0E2EE;
                    flex-direction: column;
                    padding: 1.3rem;
                    justify-content: center;
                }

                .stat-container {
                    display: flex;
                }
            }

            .feat-item.empty-slot {
                background-color: #EBF4F5;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 370px;
                width: 25%;
                border: 2px dashed #9cbfd6;
                cursor: pointer;
                transition: all 0.2s ease-in-out;
                flex-wrap: wrap;
            }

            .feat-item.empty-slot:hover {
                background-color: #D0E2EE;
                transform: scale(1.02);
            }

            .add-pet {
                text-align: center;
                color: var(--primary);
                text-decoration: none;
            }

            .add-pet i {
                color: #5B9ED9;
                margin-bottom: 0.5rem;
            }

            .add-pet p {
                font-family: 'Inter';
                font-weight: 500;
                color: #4b6172;
            }

            section#adopt_form {
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 3rem 0;

                .pet-preview {
                    width: 35%;
                    background: url(https://miro.medium.com/1*kCRanwvi4h5_E2SQGP0hJQ.jpeg);
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position: center;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    padding-block: 100px;

                    img {
                        height: 350px;
                        object-fit: contain;
                    }
                }

                .adopt-container {
                    flex-direction: row;
                    padding: 1.4rem;
                }

                .form-section {
                    width: 56%;
                    padding: 2rem;
                    display: flex;
                    flex-direction: column;
                    color: #008fd6;

                    h3 {
                        margin: 0.5rem 0;
                        color: #00a4f0;
                    }

                    input[type="text"] {
                        border: none;
                        background-color: #ddd;
                        height: 25px;
                        width: 250px;
                        border-radius: 3px;
                        margin-bottom: 0.8rem;
                        padding: 0.3rem 0.5rem;
                    }

                    .species-options {
                        display: flex;
                        gap: 1rem;
                        margin-bottom: 1rem;

                        .species-btn {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            justify-content: center;
                            cursor: pointer;
                            font-weight: bold;
                            color: #00a4f0;
                            position: relative;
                            border-radius: 6px;
                            background-color: #D0E2EE;
                            padding: 0.6rem 1.2rem;
                            border: 2px solid transparent;
                            transition: 0.2s;

                            input[type="radio"] {
                                display: none;
                            }

                            &:hover {
                                background-color: #c5e9f5;
                            }

                            input[type="radio"]:checked+span {
                                color: #007bbd;
                                font-weight: 700;
                            }

                            input[type="radio"]:checked~&,
                            &.selected {
                                border-color: #00a4f0;
                                box-shadow: 0 0 0 2px #00a4f0 inset;
                            }
                        }
                    }

                    button {
                        align-self: center;
                        margin-top: 1rem;
                    }

                    .info-box {
                        background-color: #D0E2EE;
                        font-size: 0.9rem;
                        padding: 0.8rem;
                        border-radius: 5px;
                        margin-bottom: 1rem;

                        h4 {
                            color: #00a4f0;
                            margin-bottom: 0.3rem;
                        }
                    }

                    .stats {
                        background-color: #D0E2EE;
                        padding: 1.3rem;
                    }

                    .stat {
                        display: flex;
                        align-items: center;
                        margin-bottom: 0.5rem;
                        gap: 50px;

                        label {
                            width: 60px;
                            font-weight: bold;
                            color: #008fd6;
                        }

                        .stat-bar {
                            background-color: #d8e9ef;
                            height: 18px;
                            width: 220px;
                            border-radius: 5px;
                            position: relative;
                            overflow: hidden;

                            &::after {
                                content: "";
                                position: absolute;
                                left: 0;
                                top: 0;
                                height: 100%;
                                width: 60%;
                                background: linear-gradient(90deg, #5bb4de, #a6f5ff);
                                border-radius: 5px;
                            }
                        }
                    }
                }
            }
            .pet-container {
                width:90%;
            }

            .adopt-container {
                display: flex;
                align-items: flex-start;
                gap: 2rem;
                flex-wrap: wrap;
            }

            .pet-preview img {
                width: 250px;
                height: 250px;
                object-fit: contain;
                transition: 0.3s ease;
            }

            .species-options {
                display: flex;
                gap: 10px;
                margin-bottom: 10px;
            }

            .species-btn input {
                display: none;
            }

            .species-btn span {
                padding: 8px 14px;
                border: 2px solid #ccc;
                border-radius: 10px;
                cursor: pointer;
                transition: all 0.2s ease;
                display: inline-block;
            }

            .species-btn input:checked+span {
                background: #ffd4ec;
                border-color: #ff93ca;
                font-weight: bold;
            }

            .info-box {
                background: #D0E2EE;
                border-radius: 12px;
                padding: 10px 15px;
                margin-bottom: 10px;
            }

            .stat {
                margin: 8px 0;
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .stat label {
                width: 100px;
                font-weight: 700;
                color: var(--primary);
            }

            /* OUTER bar (fixed size, background) */
            .stat-box {
                width: 240px;
                height: 14px;
                background: #EBF4F5;
                /* outer track */
                overflow: hidden;
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.6);
            }

            /* INNER fill */
            .stat-bar-fill {
                height: 100%;
                width: 0%;
                background: linear-gradient(90deg, #5B9ED9 0%, #B2F2FF 100%);
                transition: width 420ms cubic-bezier(.2, .8, .2, 1);
            }


            .add-pet {
                text-align: center;
                color: var(--primary);
                text-decoration: none;
            }

            .add-pet i {
                color: #5B9ED9;
                margin-bottom: 0.5rem;
            }

            .add-pet p {
                font-family: 'Inter';
                font-weight: 500;
                color: #4b6172;
            }



            /* ----------- ADMIN DASHBOARD ---------- */

            th,td {
                margin: 4px;
                padding: 8px;
                text-align: center;
            }

            th {
                background: #a0e7f6ff;
            }
            td {
                background: #d9f2f7ff;
            }

            #edit-user{
                label {
                    display: block;
                }

                select {
                    height: 2.5rem;
                }
            }

            .admin-dashboard {
                padding: 20px;
                max-width: 1200px;
                margin: auto;
            }

            .admin-title {
                font-family: 'Playfair Display', serif;
                font-size: 36px;
                font-weight: bold;
                margin-bottom: 25px;
                color: #005A6C;
            }

            .admin-dashboard h2 {
                margin: 0;
                padding-bottom: 10px;
            }

            /* ---- STAT BOXES ---- */

            .stats-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
            }

            .admin-dashboard .stat-box {
                background: #f4f4f4;
                border: 4px solid #00729E;
                border-radius: 12px;
                padding: 25px;
                text-align: center;
                box-shadow: 4px 4px 0px #00729E;
                width: unset;
                height: unset;
            }

            .admin-dashboard .stat-number {
                font-size: 48px;
                font-weight: bold;
                color: #005A6C;
            }

            .stat-label {
                font-size: 16px;
                color: #00a4f0;
            }

            /* ---- POPULAR PANEL ---- */

            .popular-panel {
                margin-top: 30px;
                border: 4px solid #00729E;
                border-radius: 12px;
                background: #eceff1;
                padding: 15px;
                width: 350px;
                box-shadow: 4px 4px 0px #00729E;
            }

            .popular-panel h2 {
                font-size: 22px;
                font-weight: bold;
                margin-bottom: 10px;
            }

            .popular-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 0.9rem;
            }

            .popular-table th,
            .popular-table td {
                border: 2px solid #005A6C;
                padding: 6px;
            }

            /* ---- MANAGEMENT CARDS ---- */

            .admin-card-grid {
                margin-top: 40px;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 25px;
            }

            .admin-card {
                display: block;
                text-decoration: none;
                color: #005A6C;
                background: #fafafa;
                border: 4px solid #00729E;
                border-radius: 12px;
                box-shadow: 4px 4px 0px #00729E;
                overflow: hidden;
                transition: transform 0.2s ease;
            }

            .admin-card:hover {
                transform: translateY(-4px);
                background: #d9f2f7ff;
            }

            .admin-card-image {
                height: 180px;
                background: #dcdcdc;
            }

            .admin-card-content {
                padding: 15px;
            }

            .admin-card-content h3 {
                font-size: 20px;
                margin-bottom: 5px;
            }

            .admin-card-content p {
                color: #005A6C;
                font-size: 14px;
            }


            /*USER PROFILE SETTINGS STYLES*/
            #profile-settings {
                label {
                    display: block;
                }
                padding-bottom:1rem;
            }


            /* EDIT PET STYLES */
            #edit-pet .container {
            padding-block:1rem;
           align-items: center;

           
            }


            /* FOOTER STYLES */
            footer {
                background-color: black;
                font-family: "Inter";
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;
                text-align: center;
                padding: 1.5rem;

                h1 {
                    font-family: "Playfair Display";
                    font-size: 2.5rem;
                    margin: 0;
                    color: white;
                }

                p {
                    color: #D8D8D8;
                    width: 60vw;
                    text-align: justify;
                    font-style: normal;
                    font-weight: 300;
                    font-size: 1rem;
                    line-height: 1.5rem;
                }

                div {
                    display: flex;
                    justify-content: space-between;
                    padding-inline: 1.5rem;
                    margin: 0;
                    align-items: center;

                    nav {
                        display: flex;
                        gap: 1.5rem;
                    }

                    a {
                        text-decoration: none;
                        color: #D8D8D8;

                    }

                }
            }
        }
    </style>
</head>