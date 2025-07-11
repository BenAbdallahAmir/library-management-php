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
    <title>Liste des Genres</title>
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
            grid-template-columns: 10rem auto 10rem;
            margin-top: 0;
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
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            width: 100%;

            padding-left: 900px;

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
            width: 650px;
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

        /* Add genre Button */
        .add-genre-btn {
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

        .add-genre-btn:hover {
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
                    <h3 class="sidebT">Livre</h3>
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
                    <h1>Liste des Genres</h1>
                </div>

                <div class="container3">
                    <?php
                    include(__DIR__ . "/../classes/classes.php");

                    $res = Genre::lister();
                    if ($res != null && count($res) > 0) {
                        echo "<table border='1' align='center'>";
                        echo "<tr>
                                <th>ID genre</th>
                                <th>Nom genre</th>
                                <th colspan='2'>Actions</th>
                              </tr>";

                        foreach ($res as $enr) {
                            echo "<tr>
                                    <td>" . $enr['id_genre'] . "</td>
                                    <td>" . $enr['nom_genre'] . "</td>
                                    <td>
                                        <a href='#' class='edit-btn' data-id='" . $enr['id_genre'] . "'>
                                            Modifier <i class='fas fa-edit' style='margin-left: 8px;'></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href='#' class='delete-btn' data-id='" . $enr['id_genre'] . "'>
                                            Supprimer <i class='fa-solid fa-trash' style='margin-left: 8px;'></i>
                                        </a>
                                    </td>
                                  </tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p style='color: var(--clr-dark); margin-bottom: 20px;'>Aucune genre trouvée!</p>";
                    }
                    ?>

                    <!-- Add Genre Button -->
                    <button class="add-genre-btn" id="openAddgenreModal">Ajouter un genre</button>
                </div>
            </div>
        </main>
    </div>

    <!-- Edit Modal -->
    <div id="editgenreModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 style="margin-bottom: 10px;color:#7380ec">Modifier genre</h2>
            <form id="editgenreForm">
                <input type="hidden" id="edit_id_genre_hidden" name="id_genre">
                <label for="edit_id_genre">ID genre</label>
                <input type="text" id="edit_id_genre" name="edit_id_genre" readonly>
                <label for="edit_nom_genre">Nom genre</label>
                <input type="text" id="edit_nom_genre" name="nom_genre" required>
                <p class="form-btn">
                    <button type="submit">Modifier</button>
                </p>
            </form>
            <div id="message" class="message"></div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Êtes-vous sûr de vouloir supprimer ce genre ?</p>
            <div class="form-btn">
                <button id="confirmDelete">Confirmer</button>
                <button id="cancelDelete">Annuler</button>
            </div>
        </div>
    </div>

    <div id="addgenreModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 style="margin-bottom: 10px;color:#7380ec">Ajouter un genre</h2>
            <form id="addgenreForm">
                <label for="id_genre">ID genre</label>
                <input type="text" id="id_genre" name="id_genre" required>
                <label for="nom_genre">Nom genre</label>
                <input type="text" id="nom_genre" name="nom_genre" required>
                <div class="form-btn">
                    <button type="submit">Ajouter</button>

                </div>
            </form>
            <div id="addgenreMessage" class="message"></div>
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

        const editgenreModal = document.getElementById('editgenreModal');
        const editgenreCloseBtn = document.querySelector('#editgenreModal .close');
        const editgenreBtns = document.querySelectorAll('.edit-btn');
        const editgenreForm = document.getElementById('editgenreForm');
        const editgenreMessageDiv = document.getElementById('message');

        editgenreBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const id = btn.getAttribute('data-id');
                fetchgenreDetails(id);
            });
        });

        editgenreCloseBtn.addEventListener('click', () => {
            editgenreModal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target == editgenreModal) {
                editgenreModal.style.display = 'none';
            }
        });

        function fetchgenreDetails(id) {
            fetch(`../actions/get_genre.php?id_genre=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('edit_id_genre_hidden').value = data.id_genre;
                        document.getElementById('edit_id_genre').value = data.id_genre;
                        document.getElementById('edit_nom_genre').value = data.nom_genre;
                        editgenreModal.style.display = 'block';
                    } else {
                        alert('Erreur lors de la récupération des données: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert('Erreur lors de la récupération des données');
                });
        }

        editgenreForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(editgenreForm);

            fetch('../actions/modifier_genre.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        editgenreMessageDiv.classList.remove('error');
                        editgenreMessageDiv.classList.add('success');
                        editgenreMessageDiv.textContent = 'Genre modifié avec succès';
                        setTimeout(() => {
                            editgenreModal.style.display = 'none';
                            location.reload();
                        }, 1500);
                    } else {
                        editgenreMessageDiv.classList.remove('success');
                        editgenreMessageDiv.classList.add('error');
                        editgenreMessageDiv.textContent = 'Erreur lors de la modification: ' + (data.message || 'Erreur inconnue');
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    editgenreMessageDiv.classList.remove('success');
                    editgenreMessageDiv.classList.add('error');
                    editgenreMessageDiv.textContent = 'Erreur lors de la modification';
                });
        });

        const deletegenreModal = document.getElementById('confirmModal');
        const deletegenreCloseBtn = document.querySelector('#confirmModal .close');
        const deletegenreBtns = document.querySelectorAll('.delete-btn');
        const confirmDeleteBtn = document.getElementById('confirmDelete');
        const cancelDeleteBtn = document.getElementById('cancelDelete');
        let genreIdToDelete = null;

        deletegenreBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                genreIdToDelete = btn.getAttribute('data-id');
                deletegenreModal.style.display = 'block';
            });
        });

        deletegenreCloseBtn.addEventListener('click', () => {
            deletegenreModal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target == deletegenreModal) {
                deletegenreModal.style.display = 'none';
            }
        });

        confirmDeleteBtn.addEventListener('click', () => {
            fetch(`../actions/supprimer_genre.php?id_genre=${genreIdToDelete}`, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        return;
                    }
                });
        });

        cancelDeleteBtn.addEventListener('click', () => {
            deletegenreModal.style.display = 'none';
        });

        const addgenreModal = document.getElementById('addgenreModal');
        const addgenreCloseBtn = document.querySelector('#addgenreModal .close');
        const addgenreBtn = document.getElementById('openAddgenreModal');
        const addgenreForm = document.getElementById('addgenreForm');
        const addgenreMessageDiv = document.getElementById('addgenreMessage');

        addgenreBtn.addEventListener('click', () => {
            addgenreModal.style.display = 'block';
        });

        addgenreCloseBtn.addEventListener('click', () => {
            addgenreModal.style.display = 'none';
        });

        window.addEventListener('click', (e) => {
            if (e.target == addgenreModal) {
                addgenreModal.style.display = 'none';
            }
        });

        addgenreForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(addgenreForm);
            fetch('../actions/ajouter_genre.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        addgenreMessageDiv.classList.remove('error');
                        addgenreMessageDiv.classList.add('success');
                        addgenreMessageDiv.textContent = 'genre ajoutée avec succès';
                        setTimeout(() => {
                            addgenreModal.style.display = 'none';
                            location.reload();
                        }, 1500);
                    } else {
                        addgenreMessageDiv.classList.remove('success');
                        addgenreMessageDiv.classList.add('error');
                        addgenreMessageDiv.textContent = 'Erreur lors de l\'ajout';
                    }
                });
        });
    </script>
</body>

</html>