<?php
session_start();

if (!isset($_SESSION["user"])) {
    $_SESSION['error_message'] = "Session expired. Please log in again.";
    header('Location: ../auth/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Bibliothecaires</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <style>
        /* Variables */
        :root {
            --clr-primary: #7380ec;
            --clr-danger: #ff7782;
            --clr-success: #41f1b6;
            --clr-white: #fff;
            --clr-info-dark: #7d8da1;
            --clr-info-light: #dce1eb;
            --clr-dark: #363949;
            --clr-warnig: #ff4edc;
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
            font-size: 0.8rem;
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
            /* La sidebar prend toute la hauteur disponible */
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

        aside .sidebar a span {
            font-size: 1.6rem;
            transition: all 0.3s ease-in-out;
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

        aside .sidebar a span.msg_count {
            background-color: var(--clr-danger);
            color: var(--clr-white);
            padding: 2px 5px;
            font-size: 11px;
            border-radius: var(--border-radius-1);
        }

        /* Main */
        main {
            display: flex;
            /* Utilisez flex pour centrer les cartes */
            justify-content: center;
            /* Centre les cartes horizontalement */
            align-items: center;
            /* Centre les cartes verticalement */
            margin-top: 20px;
            width: 100%;

            padding-left: 900px;
            /* Ajoutez un padding pour éviter que les cartes ne se chevauchent avec la sidebar */
            gap: 1rem;
            /* Ajoute un espacement entre les cartes */
        }

        .right {
            position: fixed;
            /* Fixe les icônes à droite */
            top: 10px;
            /* Positionne les icônes en haut */
            right: 10px;
            /* Positionne les icônes à droite */
            margin: 0;
            /* Supprime la marge en haut */
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

        a {
            text-decoration: none;
        }

        aside a:hover {
            color: var(--clr-primary);
        }

        .title {
            height: 10vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container3 {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 10px auto;
        }

        table,
        th,
        td {
            border-collapse: collapse;
            padding: 1rem;
            text-align: center;
            border: solid 2px var(--clr-primary);
            color: var(--clr-dark);
            background-color: var(--clr-white);
            width: fit-content;
        }

        table {
            width: 700px;
            box-shadow: var(--box-shadow);
            margin-bottom: 40px;
        }

        th {
            color: var(--clr-dark);
            font-size: larger;
        }

        .title h1 {
            color: var(--clr-primary);
        }

        .container3 a {
            display: inline-block;
            padding: 8px 15px;
            background-color: var(--clr-primary);
            color: var(--clr-white);
            text-decoration: none;
            border-radius: 3px;
            border: none;
            cursor: pointer;
            margin: 2px;
        }

        .container3 a:hover {
            background-color: var(--clr-dark);
            color: var(--clr-primary);
            transition: all 0.3s ease;
            box-shadow: var(--box-shadow);
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            color: var(--clr-dark);
        }

        .modal-content {
            background-color: var(--clr-white);
            margin: 15% auto;
            padding: 20px;
            border: 1px solid var(--clr-primary);
            width: 500px;
            border-radius: var(--border-radius-1);
        }

        .close {
            color: var(--clr-danger);
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: var(--clr-dark);
            text-decoration: none;
            cursor: pointer;
        }

        .modal-content input,
        .modal-content select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid var(--clr-primary);
            border-radius: var(--border-radius-1);
        }

        .modal-content button {
            padding: 10px 20px;
            background-color: var(--clr-primary);
            color: var(--clr-white);
            border: none;
            border-radius: var(--border-radius-1);
            cursor: pointer;
            margin-top: 20px;

        }

        .modal-content button:hover {
            background-color: var(--clr-dark);
        }

        /* Message section */
        .message {
            margin-top: 10px;
            padding: 10px;
            border-radius: var(--border-radius-1);
            text-align: center;
            font-weight: bold;
        }

        .message.success {
            background-color: var(--clr-success);
            color: var(--clr-white);
        }

        .message.error {
            background-color: var(--clr-danger);
            color: var(--clr-white);
        }

        /* Confirmation Modal */
        #confirmModal .modal-content {
            width: 400px;
        }

        #confirmModal .modal-content p {
            margin-bottom: 20px;
            font-size: 16px;
            text-align: center;
        }

        #confirmModal .modal-content button {
            margin: 0 10px;
        }

        /* Add Admin Button */
        .add-admin-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: var(--clr-primary);
            color: var(--clr-white);
            text-decoration: none;
            border-radius: var(--border-radius-1);
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }

        .add-admin-btn:hover {
            background-color: var(--clr-dark);
        }

        .form-btn {
            display: flex;
            justify-content: center;
            justify-items: center;
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
            <div class="container3">
                <div class="title">
                    <h1>Liste des Bibliothecaires</h1>
                </div>

                <div class="container3">
                    <?php
                    include(__DIR__ . "/../classes/classes.php");

                    $res = Bibliothecaire::lister();
                    if ($res != null && count($res) > 0) {
                        echo "<table border='1' align='center'>";
                        echo "<tr>
                                <th>ID Bibliothecaire</th>
                                <th>Login</th>
                                <th colspan='2'>Actions</th>
                              </tr>";

                        foreach ($res as $enr) {
                            echo "<tr>
                                    <td>" . $enr['id_bibliothecaire'] . "</td>
                                    <td>" . $enr['login_bibliothecaire'] . "</td>
                                    <td>
                                        <a href='#' class='edit-btn' data-id='" . $enr['id_bibliothecaire'] . "'>
                                            Modifier <i class='fas fa-user-edit' style='margin-left: 2px;'></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href='#' class='delete-btn' data-id='" . $enr['id_bibliothecaire'] . "'>
                                            Supprimer <i class='fas fa-user-times' style='margin-left: 2px;'></i>
                                        </a>
                                    </td>
                                  </tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p style='color: #F7FAFC; margin-bottom: 20px;'>Aucun bibliothecaire trouvé!</p>";
                    }
                    ?>

                    <!-- Add Admin Button -->
                    <button class="add-admin-btn" id="openAddAdminModal">Ajouter un bibliothecaire</button>
                </div>
            </div>
        </main>
    </div>

    <!-- Edit Modal -->
    <div id="editAdminModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 style="margin-bottom: 10px;color:#7380ec">Modifier bibliothecaire</h2>
            <form id="editAdminForm">
                <input type="hidden" id="id_admin" name="id_admin">
                <label for="login">Login</label>
                <input type="text" id="login" name="login">
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe">
                <div class="form-btn">
                    <button type="submit">Modifier</button>

                </div>
            </form>
            <div id="message" class="message"></div>
        </div>
    </div>

    <!-- Modal de suppression -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Êtes-vous sûr de vouloir supprimer cet bibliothecaire ?</p>
            <div class="form-btn">
                <button id="confirmDelete">Confirmer</button>
                <button id="cancelDelete">Annuler</button>
            </div>
        </div>
    </div>

    <!-- Modal d'ajout -->
    <div id="addAdminModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 style="margin-bottom: 10px;color:#7380ec">Ajouter un bibliothecaire</h2>
            <form id="addAdminForm">
                <label for="login">Login</label>
                <input type="text" id="login" name="login" required>
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                <div class="form-btn">
                    <button type="submit">Ajouter</button>
                </div>
            </form>
            <div id="addAdminMessage" class="message"></div>
        </div>
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

        const editAdminModal = document.getElementById('editAdminModal');
        const editAdminCloseBtn = document.querySelector('#editAdminModal .close');
        const editAdminBtns = document.querySelectorAll('.edit-btn');
        const editAdminForm = document.getElementById('editAdminForm');
        const editAdminMessageDiv = document.getElementById('message');

        editAdminBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const id = btn.getAttribute('data-id');
                fetchAdminDetails(id);
            });
        });

        editAdminCloseBtn.addEventListener('click', () => {
            editAdminModal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target == editAdminModal) {
                editAdminModal.style.display = 'none';
            }
        });

        function fetchAdminDetails(id) {
            fetch(`../actions/get_bib.php?id_admin=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('id_admin').value = data.id_admin;
                        document.getElementById('login').value = data.login;
                        document.getElementById('mot_de_passe').value = data.mot_de_passe;
                        editAdminModal.style.display = 'block';
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la récupération des données de la bibliothecaire:', error);
                    alert('Erreur lors de la récupération des données de la bibliothecaire');
                });
        }

        editAdminForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(editAdminForm);
            fetch('../actions/modifier_bib.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        editAdminMessageDiv.classList.remove('error');
                        editAdminMessageDiv.classList.add('success');
                        editAdminMessageDiv.textContent = 'Bibliothecaire modifié avec succès';
                        setTimeout(() => {
                            editAdminModal.style.display = 'none';
                            location.reload();
                        }, 1500);
                    } else {
                        editAdminMessageDiv.classList.remove('success');
                        editAdminMessageDiv.classList.add('error');
                        editAdminMessageDiv.textContent = 'Erreur lors de la modification';
                    }
                });
        });


        const deleteAdminModal = document.getElementById('confirmModal');
        const deleteAdminCloseBtn = document.querySelector('#confirmModal .close');
        const deleteAdminBtns = document.querySelectorAll('.delete-btn');
        const confirmDeleteBtn = document.getElementById('confirmDelete');
        const cancelDeleteBtn = document.getElementById('cancelDelete');
        let adminIdToDelete = null;

        deleteAdminBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                adminIdToDelete = btn.getAttribute('data-id');
                deleteAdminModal.style.display = 'block';
            });
        });

        deleteAdminCloseBtn.addEventListener('click', () => {
            deleteAdminModal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target == deleteAdminModal) {
                deleteAdminModal.style.display = 'none';
            }
        });

        confirmDeleteBtn.addEventListener('click', () => {
            fetch(`../actions/supprimer_bib.php?id_bibliothecaire=${adminIdToDelete}`, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Erreur lors de la suppression');
                    }
                });
        });

        cancelDeleteBtn.addEventListener('click', () => {
            deleteAdminModal.style.display = 'none';
        });

        const addAdminModal = document.getElementById('addAdminModal');
        const addAdminCloseBtn = document.querySelector('#addAdminModal .close');
        const addAdminBtn = document.getElementById('openAddAdminModal');
        const addAdminForm = document.getElementById('addAdminForm');
        const addAdminMessageDiv = document.getElementById('addAdminMessage');

        addAdminBtn.addEventListener('click', () => {
            addAdminModal.style.display = 'block';
        });

        addAdminCloseBtn.addEventListener('click', () => {
            addAdminModal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target == addAdminModal) {
                addAdminModal.style.display = 'none';
            }
        });

        addAdminForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(addAdminForm);
            fetch('../actions/ajouter_bib.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        addAdminMessageDiv.classList.remove('error');
                        addAdminMessageDiv.classList.add('success');
                        addAdminMessageDiv.textContent = 'Bibliothecaire ajouté avec succès';
                        setTimeout(() => {
                            addAdminModal.style.display = 'none';
                            location.reload();
                        }, 1500);
                    } else {
                        addAdminMessageDiv.classList.remove('success');
                        addAdminMessageDiv.classList.add('error');
                        addAdminMessageDiv.textContent = 'Erreur lors de l\'ajout';
                    }
                });
        });
    </script>
</body>

</html>