<?php
session_start();

require_once(__DIR__ . "/../actions/nombre_livre.php");
require_once(__DIR__ . "/../actions/nombre_genre.php");
require_once(__DIR__ . "/../actions/nombre_bib.php");

if (!isset($_SESSION["user"])) {
    $_SESSION['error_message'] = "Session expired. Please log in again.";
    header('Location: ../auth/index.php');
    exit;
}

echo "<h1 style='text-align: center; color: var(--clr-primary); margin-top: 20px; font-size: 30px;'>Bienvenue  " . htmlspecialchars($_SESSION['user']) . " !</h1>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Bibliothecaire</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;0,800;1,600&display=swap');

        /* Variables */
        :root {
            --clr-primary: #7380ec;
            --clr-danger: #ff7782;
            --clr-success: #41f1b6;
            --clr-white: #fff;
            --clr-info-dark: #7d8da1;
            --clr-info-light: #dce1eb;
            --clr-dark: #363949;
            --clr-warning: #ff4edc;
            --clr-light: rgba(132, 139, 200, 0.18);
            --clr-primary-variant: #111e88;
            --clr-dark-variant: #677483;
            --clr-color-background: #f6f6f9;

            --card-border-radius: 2rem;
            --border-radius-1: 0.4rem;
            --border-radius-2: 0.8rem;
            --border-radius-3: 1.2rem;

            --card-padding: 1.8rem;
            --padding-1: 1.2rem;
            --box-shadow: 0 2rem 3rem var(--clr-light);

            --d: 2500ms;
            --angle: 90deg;
            --gradX: 100%;
            --gradY: 50%;
            --c1: #7380ec;
            --c2: rgba(168, 239, 255, 0.1);
        }

        /* Dark theme */
        .dark-theme-variables {
            --clr-color-background: #181a1e;
            --clr-white: #202528;
            --clr-light: rgba(0, 0, 0, 0.4);
            --clr-dark: #edeffd;
            --clr-dark-variant: #677483;
            --box-shadow: 0 2rem 3rem var(--clr-light);
        }

        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            border: 0;
            text-decoration: none;
            list-style: none;
            appearance: none;
        }

        body {
            width: 100vw;
            height: 100vh;
            font-size: 0.7rem;
            background: var(--clr-color-background);
            font-family: 'Poppins', sans-serif;
        }

        .container {
            display: grid;
            width: 100%;
            gap: 1.8rem;
            grid-template-columns: 14rem auto 16rem;
            margin: 0 auto;
        }

        a {
            color: var(--clr-dark);
        }

        /* Aside */
        aside {
            position: fixed;
            top: 20px;
            left: 20px;
            height: 95vh;
            width: 15rem;
            background: var(--clr-white);
        }

        aside .top {
            background: var(--clr-white);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            margin: 0;
        }

        /* Sidebar */
        aside .sidebar {
            background: var(--clr-white);
            display: flex;
            flex-direction: column;
            height: 100%;
            position: relative;
        }

        aside h3 {
            font-weight: 500;
        }

        aside .sidebar a {
            display: flex;
            color: var(--clr-info-dark);
            margin-left: 2rem;
            gap: 1rem;
            align-items: center;
            height: 3.3rem;
            transition: all 0.1s ease;
        }

        aside .sidebar a:last-child {
            position: absolute;
            bottom: 1rem;
            width: 100%;
        }

        aside .sidebar a.active {
            background-color: var(--clr-light);
            color: var(--clr-primary);
            margin-left: 0;
            border-left: 5px solid var(--clr-primary);
            margin-left: calc(1rem - 3px);
        }

        aside .sidebar a:hover span {
            margin-left: 1rem;
        }

        /* Main */
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 200px;
            width: 100%;
            padding-left: 900px;
            gap: 1rem;
        }

        .right {
            position: fixed;
            top: 10px;
            right: 10px;
            margin: 0;
        }

        .right .theme-toggler {
            background: var(--clr-white);
            display: flex;
            justify-content: space-between;
            height: 1.6rem;
            width: 4.2rem;
            cursor: pointer;
            border-radius: var(--border-radius-1);
        }

        .right .theme-toggler span {
            font-size: 1.2rem;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .right .theme-toggler span.active {
            background: var(--clr-primary);
            color: #fff;
        }

        img {
            max-width: 100%;
            height: 100%;
        }

        /*===== CARD =====*/
        .container2 {
            display: flex;
            place-items: center;
            gap: 20px;
            padding: 20px;
        }

        .card {
            width: 300px;
            height: 270px;
            box-shadow: var(--box-shadow);
            border-radius: 0.9rem;
            background: var(--clr-white);
            color: var(--clr-dark);
            padding: 1rem;
            transition: transform 0.2s;
        }

        section.card:hover {
            border: 0.35rem solid;
            border-image: conic-gradient(from var(--angle), var(--c2), var(--c1) 0.1turn, var(--c1) 0.15turn, var(--c2) 0.25turn) 50;
            animation: borderRotate var(--d) linear infinite forwards;
            box-shadow: none;
        }

        .product-image {
            height: 100px;
            width: 100%;
            filter: drop-shadow(2px 2px 2px rgba(8, 9, 13, 0.4));
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .counter {
            font-size: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .subT {
            font-size: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bienv {
            font-size: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Animations */
        @property --angle {
            syntax: '<angle>';
            initial-value: 90deg;
            inherits: true;
        }

        @keyframes borderRotate {
            100% {
                --angle: 420deg;
            }
        }

        aside a:hover {
            color: var(--clr-primary);
        }
    </style>
</head>

<body>
    <div class="container">
        <aside>
            <div class="sidebar">
                <!-- Sidebar links -->
                <a href="espace_bib.php" <?php if (basename($_SERVER['PHP_SELF']) === 'espace_bib.php') echo 'class="active"'; ?>>
                    <span class="material-symbols-sharp">home</span>
                    <h3 class="sidebT">Accueil</h3>
                </a>
                <a href="liste_bib.php" <?php if (basename($_SERVER['PHP_SELF']) === 'liste_bib.php') echo 'class="active"'; ?>>
                    <span class="material-symbols-sharp">local_library</span>
                    <h3 class="sidebT">Bibliothecaires</h3>
                </a>
                <a href="liste_genre.php" <?php if (basename($_SERVER['PHP_SELF']) === 'liste_genre.php') echo 'class="active"'; ?>>
                    <span class="material-symbols-sharp">grid_view</span>
                    <h3 class="sidebT">Genres</h3>
                </a>
                <a href="liste_livre.php" <?php if (basename($_SERVER['PHP_SELF']) === 'liste_livre.php') echo 'class="active"'; ?>>
                    <span class="material-symbols-sharp">book_5</span>
                    <h3 class="sidebT">Livres</h3>
                </a>
                <a href="../auth/logout.php">
                    <span class="material-symbols-sharp">logout</span>
                    <h3 class="sidebT">Déconnexion</h3>
                </a>
            </div>
        </aside>

        <div class="right">
            <div class="top">
                <div class="theme-toggler">
                    <span class="material-symbols-sharp active">light_mode</span>
                    <span class="material-symbols-sharp">dark_mode</span>
                </div>
            </div>
        </div>

        <main>
            <div class="container2">
                <section class="card">
                    <div class="product-image">
                        <img src="../images/bib.png" draggable="false" />
                    </div>
                    <div class="infos">
                        <div class="counter"><?php echo htmlspecialchars($bib_result); ?></div> <!-- Sécurisation des données -->
                        <p class="subT">Bibliothecaires</p>
                    </div>
                </section>
                <section class="card">
                    <div class="product-image">
                        <img src="../images/genres.png" draggable="false" />
                    </div>
                    <div class="infos">
                        <div class="counter"><?php echo htmlspecialchars($resultat_genre); ?></div> <!-- Sécurisation des données -->
                        <p class="subT">Genres</p>
                    </div>
                </section>
                <section class="card">
                    <div class="product-image">
                        <img src="../images/livres.png" draggable="false" />
                    </div>
                    <div class="infos">
                        <div class="counter"><?php echo htmlspecialchars($resultat_livre); ?></div> <!-- Sécurisation des données -->
                        <p class="subT">Livres</p>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <script>
        const themeToggler = document.querySelector('.theme-toggler');

        const currentTheme = localStorage.getItem('theme');
        if (currentTheme === 'dark') {
            document.body.classList.add('dark-theme-variables');
            themeToggler.querySelector('span:nth-child(2)').classList.add('active');
            themeToggler.querySelector('span:nth-child(1)').classList.remove('active');
        } else {
            document.body.classList.remove('dark-theme-variables');
            themeToggler.querySelector('span:nth-child(1)').classList.add('active');
            themeToggler.querySelector('span:nth-child(2)').classList.remove('active');
        }

        themeToggler.addEventListener('click', () => {
            document.body.classList.toggle('dark-theme-variables');

            if (document.body.classList.contains('dark-theme-variables')) {
                localStorage.setItem('theme', 'dark');
                themeToggler.querySelector('span:nth-child(2)').classList.add('active');
                themeToggler.querySelector('span:nth-child(1)').classList.remove('active');
            } else {
                localStorage.setItem('theme', 'light');
                themeToggler.querySelector('span:nth-child(1)').classList.add('active');
                themeToggler.querySelector('span:nth-child(2)').classList.remove('active');
            }
        });
    </script>
</body>

</html>