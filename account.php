<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/account.css">
    <title>Account</title>
</head>
<body>
    <?php
        if (isset($_SESSION['userid'])) {
            echo "
                <nav>
                    <div class='nav-left'>
                        <div>
                            <a href='index.php'>
                                <img class='logo' src='css/icons/image.png'></img>
                            </a>
                        </div>
                    </div>
                    <div class='nav-right'>
                        <div class='nav-cat'>
                            <div class='nav-cat-tile'>
                                <a href='shoppingcart.php'>
                                    <img class='nav-icon' src='css/icons/shopping-cart.png'></img>
                                    <!-- Warenkorb -->
                                </a>
                            </div>
                            <div class='nav-cat-tile'>
                                <a href='favorites.php'>
                                    <img class='nav-icon' src='css/icons/heart.png'></img>
                                    <!-- Favoriten -->
                                </a>
                            </div>
                            <div class='nav-cat-tile'>
                                <a href='login.php'>
                                    <img class='nav-icon' src='css/icons/user.png'></img>
                                    <!-- Konto -->
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            ";

            include 'db.php';

            $abfrage = "SELECT name, email, zipcode, city, street, country, firstname, lastname FROM users WHERE id = $_SESSION[userid]";
            $user = mysqli_fetch_assoc(mysqli_query($con, $abfrage));
            echo "    
                <main>
                    <div class='userinfo'>
                        <p>Username: $user[name]</p>
                        <p>E-Mail: $user[email]</p>
                        <p>Passwort: ***</p>
                        <br>
                        <form method='POST' action=''>
                            <input type='submit' name='logout' value='Ausloggen'>
                        </form>
                    </div>
                    <br>
                    <div class='userdata'>
                        <form method='POST' action=''>
                            <table>
                                <tr>
                                    <th>Postleitzahl:</th>
                                    <td><input type='text' name='zipcode' value='$user[zipcode]' required></td>
                                </tr>
                                <tr>
                                    <th>Stadt:</th>
                                    <td><input type='text' name='city' value='$user[city]' required></td>
                                </tr>
                                <tr>
                                    <th>Straße:</th>
                                    <td><input type='text' name='street' value='$user[street]' required></td>
                                </tr>
                                <tr>
                                    <th>Land:</th>
                                    <td><input type='text' name='country' value='$user[country]' required></td>
                                </tr>
                                <tr>
                                    <th>Vorname:</th>
                                    <td><input type='text' name='firstname' value='$user[firstname]' required></td>
                                </tr>
                                <tr>
                                    <th>Nachname:</th>
                                    <td><input type='text' name='lastname' value='$user[lastname]' required></td>
                                </tr>
                            </table>
                            <input type='submit' value='Speichern' name='save_infos'>
                        </form>
                    </div>
                </main>
            ";

            if (isset($_POST['save_infos'])) {
                $abfrage = "UPDATE users SET zipcode='$_POST[zipcode]', city='$_POST[city]', street='$_POST[street]', country='$_POST[country]', firstname='$_POST[firstname]', lastname='$_POST[lastname]' WHERE id = $_SESSION[userid]";
                mysqli_query($con, $abfrage);
            }

            if (isset($_POST['logout'])) {
                unset($_SESSION['userid']);
                echo "<meta http-equiv='refresh' content='0; url=login.php'>";
            }
        
        // falls unangemeldeter user versucht auf die account seite zuzugreifen
        } else {
            echo "Sie sind nicht angemeldet und haben somit keinen Zugriff auf diese Seite!";
            echo "<meta http-equiv='refresh' content='0; url=login.php'>";
        }
    ?>
</body>
</html>