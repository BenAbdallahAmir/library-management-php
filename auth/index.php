<?php
session_start();

$errorMessage = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : null;
unset($_SESSION['error_message']);

$loginError = isset($_SESSION['login_error']) && $_SESSION['login_error'] === true;
$passwordError = isset($_SESSION['password_error']) && $_SESSION['password_error'] === true;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #c9d6ff;
            background: linear-gradient(to right, #e2e2e2, #c9d6ff);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
            display: flex;
        }

        .container p {
            font-size: 14px;
            line-height: 20px;
            letter-spacing: 0.3px;
            margin: 20px 0;
        }

        .container span {
            font-size: 12px;
        }

        .container a {
            color: #333;
            font-size: 13px;
            text-decoration: none;
            margin: 15px 0 10px;
        }

        .container button {
            background-color: #7380ec;
            color: #fff;
            font-size: 12px;
            padding: 10px 45px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            margin-top: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        .container button:hover {
            background-color: #fff;
            color: #7380ec;
            border-color: #7380ec;
        }

        .container form {
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            height: 100%;
        }

        .container input {
            background-color: #EEEFFFFF;
            margin: 10px 0;
            padding: 10px 15px;
            font-size: 15px;
            border-radius: 8px;
            width: 100%;
            outline: none;
        }

        .form-container {
            position: relative;
            width: 50%;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .image-container {
            position: relative;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to right, #5c6bc0, #7380ec);
        }

        .image-container img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 0 30px 30px 0;
        }

        .password-field {
            position: relative;
            width: 100%;
        }

        .password-field i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7380ec;
            cursor: pointer;
            font-size: 1rem;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-top: 1rem;
            font-size: 14px;
        }

        .input-error {
            border: 1px solid red;
        }

        input:focus {
            outline: none;
            border-color: #7380ec;
            box-shadow: 0 0 5px rgba(115, 128, 236, 0.5);
        }

        input::placeholder {
            color: #7CA3FFFF;
            font-size: 0.8rem;
        }

        input {
            padding: 0.8rem;
            border-radius: 5px;
            border: 1px solid #7380ec;
            color: #000000FF;
            box-sizing: border-box;
            width: 400px;
        }

        h1 {
            margin-bottom: 20px;
            color: #7380ec;
        }
    </style>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-in">
            <form method="post" action="login.php">
                <h1>Login</h1>
                <input type="text" id="login" name="login_bibliothecaire" placeholder="Entrer votre login" class="<?php echo $loginError ? 'input-error' : ''; ?>" required aria-describedby="loginError">
                <div class="password-field">
                    <input type="password" id="mp" name="mot_de_passe_bibliothecaire" placeholder="Entrer votre mot de passe" class="<?php echo $passwordError ? 'input-error' : ''; ?>" required aria-describedby="passwordError">
                    <i id="pass-toggle-btn" class="fa-solid fa-eye"></i>
                </div>
                <div class="btn-container"><button type="submit" name="connexion" class="submit-btn">Se connecter</button></div>
                <?php if ($errorMessage): ?>
                    <div class="error-message">
                        <?php echo htmlspecialchars($errorMessage); ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
        <div class="image-container">
            <img src="../images/login.png" alt="Login Image">
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById("mp");
        const passToggleBtn = document.getElementById("pass-toggle-btn");
        passToggleBtn.addEventListener('click', () => {
            passToggleBtn.className = passwordInput.type === "password" ? "fa-solid fa-eye-slash" : "fa-solid fa-eye";
            passwordInput.type = passwordInput.type === "password" ? "text" : "password";
        });
    </script>
</body>

</html>