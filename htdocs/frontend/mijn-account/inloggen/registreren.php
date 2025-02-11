<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href="../../../styles/mijn-account/inloggen/registreren.css">
    <style>
        #message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }
        .success {
            background-color: #d4edda; /* Green background for success */
            border: 1px solid #c3e6cb;
            color: green;
        }
        .error {
            background-color: #f8d7da; /* Red background for error */
            border: 1px solid #f5c6cb;
            color: red;
        }
    </style>
</head>
<body>
    <section>
        <header class="navbar">
            <div class="nav-buttons">
                <a class="nav-button" href="../../../index.php"><i class="fa-solid fa-house"></i> Home</a>
                <a class="nav-button" href="#recipes"><i class="fa-solid fa-book-open"></i> Recepten</a>
            </div>
            <div class="nav-title">De ReceptenHoek</div>

            <div class="dropdown-container">
                <button id="dropdownButton" class="dropdown-button">Mijn account <i class="fa-solid fa-arrow-down"></i></button>
                <div id="dropdownMenu" class="dropdown-menu">
                    <a href="#user-settings" class="dropdown-item">User  Settings</a>
                    <a href="#favorieten" class="dropdown-item">Favorieten</a>
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                        <a href="../../../backend/accounts/uitloggen.php" class="dropdown-item">Uitloggen</a> <!-- Show Uitloggen if logged in -->
                    <?php else: ?>
                        <a href="./inloggen.php" class="dropdown-item">Inloggen</a> <!-- Show Inloggen if not logged in -->
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <div class="login-box">
            <h2>Registreren</h2>
            <!-- Display message -->
            <?php
            session_start();
            if (isset($_SESSION['message'])) {
                $message_type = $_SESSION['message_type'] === "success" ? "success" : "error";
                echo "<div id='message' class='$message_type'>{$_SESSION['message']}</div>";
                unset($_SESSION['message']); // Clear the message after displaying
                unset($_SESSION['message_type']); // Clear the message type after displaying
            }
            ?>
            <form action="../../../backend/accounts/registreren.php" method="post">
                <div class="username-input">
                    <input type="text" id="username" name="username" placeholder="Username" required><br>
                </div>
                <div class="email-input">
                    <input type="email" id="email" name="email" placeholder="E-mail" required><br>
                </div>
                <div class="password-input">
                    <input type="password" id="password" name="password" placeholder="Wachtwoord" required><br>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Herhaal Wachtwoord" required><br>
                </div>
                <div class="links">
                    <a href="./inloggen.php">Inloggen</a>
                </div>
                <div class="input">
                    <input type="submit" name="submit" value="Verstuur">
                </div>
            </form>
        </div>
    </section>

    <script src="https://kit.fontawesome.com/edd30990f4.js" crossorigin="anonymous"></script>
    <script src="../../../styles/javascript/accountdrop.js"></script>
</body>
</html>