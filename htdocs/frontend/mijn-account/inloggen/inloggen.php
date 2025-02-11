<?php
session_start();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="../../../styles/mijn-account/inloggen/inloggen.css">
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
                        <a href="../../../backend/accounts/uitloggen.php" class="dropdown-item">Uitloggen</a>
                    <?php else: ?>
                        <a href="./inloggen.php" class="dropdown-item">Inloggen</a>
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <div class="login-box">
            <h2>Inloggen</h2>

            <!-- ✅ Display success/error message -->
            <?php
            if (isset($_SESSION['message'])) {
                $message_type = $_SESSION['message_type'] === "success" ? "success" : "error";
                echo "<div id='message' class='$message_type'>{$_SESSION['message']}</div>";
                unset($_SESSION['message']); 
                unset($_SESSION['message_type']);
            }
            ?>

            <form action="../../../backend/accounts/inloggen.php" method="post">
                <div class="username-input">
                    <input type="text" id="username" name="username" placeholder="Username" required><br>
                </div>
                <div class="password-input">
                    <input type="password" id="password" name="password" placeholder="Wachtwoord" required><br>
                </div>
                <div class="links">
                    <a href="./wachtwoord-vergeten.php">Wachtwoord vergeten</a>
                    <a href="./registreren.php">Registreren</a>
                </div>
                <div class="input">
                    <input type="submit" name="submit" value="Verstuur">
                </div>
            </form>
        </div>
    </section>

    <script src="https://kit.fontawesome.com/edd30990f4.js" crossorigin="anonymous"></script>
    <script src="../../../styles/javascript/accountdrop.js"></script>

    <!-- ✅ JavaScript delay redirect (only when ?success=true is in URL) -->
    <script>
        if (window.location.search.includes("success=true")) {
            setTimeout(() => {
                window.location.href = "../../../index.php";
            }, 1000);
        }
    </script>

</body>
</html>
