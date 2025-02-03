<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inloggen</title>
    <link rel="stylesheet" href="../../../styles/mijn-account/inloggen/regristreren.css">
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
                    <a href="#user-settings" class="dropdown-item">User Settings</a>
                    <a href="#favorieten" class="dropdown-item">Favorieten</a>
                    <a href="./frontend/mijn-account/inloggen/inloggen.php" class="dropdown-item">inloggen</a>
                </div>
            </div>
        </header>

        <div class="login-box">
            <h2>regristreren</h2>
            
            <form action="" method="post">
                <div class="username-input">
                    <input type="text" id="username" name="username" placeholder="Username" required><br>
                </div>
                <div class="email-input">
                <input type="email" id="email" name="email" placeholder="E-mail" required><br>
                </div>
                <div class="password-input">
                    <input type="password" id="password" name="password" placeholder="Password" required><br>
                    <input type="password" id="password" name="password" placeholder="Password Again" required><br>
                </div>
                <div class="links">
                    <a href="./inloggen.php">login</a>
                </div>
                <div class="input">
                    <input type="submit" name="submit" value="submit">
                </div>
            </form>
        </div>

    </section>
    <script src="https://kit.fontawesome.com/edd30990f4.js" crossorigin="anonymous"></script>
    <script src="../../../styles/javascript/accountdrop.js"></script>
</body>
</html>