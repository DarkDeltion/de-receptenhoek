<?php
include("./backend/connection.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/Index.css">
</head>
<body>
    <!-- section 1  -->
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
                        <a href="./backend/accounts/uitloggen.php" class="dropdown-item">Uitloggen</a> <!-- Show Uitloggen if logged in -->
                    <?php else: ?>
                        <a href="./frontend/mijn-account/inloggen/inloggen.php" class="dropdown-item">Inloggen</a> <!-- Show Inloggen if not logged in -->
                    <?php endif; ?>
                </div>
            </div>
        </header>


    <div class="search-bar">
        <img src="./styles/images/Untitled.png" alt="Background Image">
        <div class="Search-function">
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Zoeken...">
                <button class="search-button">Maaltijd</button>
                <button class="search-button">Gerecht</button>
                <button class="search-submit" type="submit">Zoek</button>
            </div>
        </div>
    </div>

    <div class="recept-box">
        <div class="box-content">
            <div class="left-image">
                <img src="./styles/images/png.png" alt="Recept Image">
            </div>
            <div class="right-content">
                <div class="title-date">
                    <h2>Test Recept</h2>
                    <span class="date">09-01-2025</span>
                </div>
                <p class="description">Dit is een test bericht voor een recept dat elke dag anders is.</p>
                <button class="view-button">Bekijk</button>
            </div>
        </div>
    </div>
    </section>
    <!-- section 2 -->
    <section>
        <div class="recenten">
            <div class="Title-recenten">
                <h2>Recente Recepten</h2>
            </div>
                <table>
                    <tr>
                        <td>
                            <div class="recept">
                                <div class="image-wrapper">
                                    <img src="./styles/images/png.png" class="recent-image" alt="">
                                    <div class="recept-bg"></div>
                                </div>
                                <div class="recept-text">
                                    <h3>test recept</h3>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="recept">
                                <div class="image-wrapper">
                                    <img src="./styles/images/png.png" class="recent-image" alt="">
                                    <div class="recept-bg"></div>
                                </div>
                                <div class="recept-text">
                                    <h3>test recept</h3>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="recept">
                                <div class="image-wrapper">
                                    <img src="./styles/images/png.png" class="recent-image" alt="">
                                    <div class="recept-bg"></div>
                                </div>
                                <div class="recept-text">
                                    <h3>test recept</h3>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
        </div>
        
        <div class="recenten">
            <div class="Title-recenten">
                <h2>populaire Recepten</h2>
            </div>
                <table>
                    <tr>
                        <td>
                            <div class="recept">
                                <div class="image-wrapper">
                                    <img src="./styles/images/png.png" class="recent-image" alt="">
                                    <div class="recept-bg"></div>
                                </div>
                                <div class="recept-text">
                                    <h3>test recept</h3>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="recept">
                                <div class="image-wrapper">
                                    <img src="./styles/images/png.png" class="recent-image" alt="">
                                    <div class="recept-bg"></div>
                                </div>
                                <div class="recept-text">
                                    <h3>test recept</h3>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="recept">
                                <div class="image-wrapper">
                                    <img src="./styles/images/png.png" class="recent-image" alt="">
                                    <div class="recept-bg"></div>
                                </div>
                                <div class="recept-text">
                                    <h3>test recept</h3>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
        </div>
    </section>
    <!-- section 3 -->
    <section class="recipe-section">
        <div class="recipe-column">
            <h3>Recepten</h3>
            <ul>
            <li>Ontbijt</li>
            <li>Lunch</li>
            <li>Tussendoortjes</li>
            <li>Voorgerechten</li>
            <li>Bijgerechten</li>
            <li>Hoofdgerechten</li>
            <li>Desserts</li>
            <li>Salades</li>
            <li>Dranken</li>
            <li>Bakrecepten</li>
            <li>Dressings en sauzen</li>
            </ul>
            <h4>Seizoenen</h4>
            <ul>
            <li>Herfst recepten</li>
            <li>Winter recepten</li>
            <li>Lente recepten</li>
            <li>Zomer recepten</li>
            </ul>
        </div>

        <div class="recipe-column">
            <h3>Thema's</h3>
            <ul>
            <li>Snelle recepten</li>
            <li>Eenpansgerechten</li>
            <li>Airfryer recepten</li>
            <li>Stoofvlees recepten</li>
            <li>Soep recepten</li>
            <li>Kinderen recepten</li>
            <li>Familie recepten</li>
            <li>Risotto recepten</li>
            <li>Stamppot recepten</li>
            <li>Hamburger recepten</li>
            <li>Bowl recepten</li>
            <li>Ovenschotels</li>
            <li>Sushi recepten</li>
            <li>Lasagne recepten</li>
            <li>Smoothie recepten</li>
            </ul>
        </div>

        <div class="recipe-column">
            <h3>Keukens</h3>
            <ul>
            <li>Italiaanse recepten</li>
            <li>Griekse recepten</li>
            <li>Mexicaanse recepten</li>
            <li>Amerikaanse recepten</li>
            <li>Oosterse recepten</li>
            <li>Hollandse recepten</li>
            <li>Spaanse recepten</li>
            <li>Indische recepten</li>
            <li>Marokkaanse recepten</li>
            <li>Franse recepten</li>
            </ul>
        </div>

        <div class="recipe-column">
            <h3>Ingrediënten</h3>
            <ul>
            <li>Aardappel</li>
            <li>Avocado</li>
            <li>Bladerdeeg</li>
            <li>Brood</li>
            <li>Bloemkool</li>
            <li>Broccoli</li>
            <li>Courgette</li>
            <li>Couscous</li>
            <li>Ei</li>
            <li>Gehakt recepten</li>
            <li>Ham</li>
            <li>Havermout</li>
            <li>Kip</li>
            <li>Mozzarella</li>
            <li>Noedels</li>
            <li>Paprika</li>
            <li>Pasta</li>
            </ul>
        </div>
    </section>

    <script src="https://kit.fontawesome.com/edd30990f4.js" crossorigin="anonymous"></script>
    <script src="./styles/javascript/accountdrop.js"></script>
</body>
</html>