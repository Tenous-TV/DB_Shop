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
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
<nav>
        <div class="nav-left">
            <div>
                <a href="index.php">
                    <img class="logo" src="css/icons/user.png"></img>
                </a>
            </div>
        </div>
        <div class="nav-right">
            <div class="nav-cat">
                <div class="nav-cat-tile">
                    <a href="shoppingcart.php">
                        <img class="nav-icon" src="css/icons/shopping-cart.png"></img>
                        Warenkorb
                    </a>
                </div>
                <div class="nav-cat-tile">
                    <a href="favorites.php">
                        <img class="nav-icon" src="css/icons/heart.png"></img>
                        Favoriten
                    </a>
                </div>
                <div class="nav-cat-tile">
                    <a href="account.php">
                        <img class="nav-icon" src="css/icons/user.png"></img>
                        Konto
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main> 

        <?php
            include 'db.php';

            if (isset($_SESSION['userid'])) {
                // link falls der browser nicht lädt
                echo "<p><a href='account.php'>Zur Kontoseite</a></p>";
                // weiterleitung auf die account seite, falls der benutzer angemeldet ist
                echo "<meta http-equiv='refresh' content='0; url=account.php'>";
            } else {
                // falls user nicht angemeldet ist
                if (!isset($_POST['login_submit']) && !isset($_POST['register_submit'])) {
                    echo "
                        <div class='login-register'>
                            <p>Sie sind noch nicht angemeldet!</p>

                            <div class='break'></div>

                            <div class='login-tile'>
                                <h3>Anmelden</h3>
                                <form method='POST' action=''>
                                    <table>
                                        <tr>
                                            <th>Benutzername:</th>
                                            <td><input name='login_name' type='text' required></td>
                                        </tr>
                                        <tr>
                                            <th>Passwort:</th>
                                            <td><input name='login_password' type='password' required></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input name='login_submit' type='submit' value='Einloggen'></td>
                                        </tr>
                                    </table>
                                    
                                </form>
                            </div>

                            <div class='break'></div>

                            <div class='register-tile'>
                                <h3>Registrieren</h3>
                                <form method='POST' action=''>
                                    <table>
                                        <tr>
                                            <th>Benutzername:</th>
                                            <td><input type='text' name='register_name' required></td>
                                        </tr>
                                        <tr>
                                            <th>E-Mail:</th>
                                            <td><input type='email' name='register_email' required></td>
                                        </tr>
                                        <tr>
                                            <th>Passwort:</th>
                                            <td><input type='password' name='register_password' required></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><input type='submit' name='register_submit' value='Registrieren'></td>
                                        </tr>
                                    </table>
                                </form>
                            </div>

                        </div>
                    ";
                    
                // nachdem user sich angemeldet/registriert hat
                } else {
                    $shouldReload = false;
                    if (isset($_POST['login_submit'])) {
                        $query = mysqli_query($con, "SELECT * FROM users WHERE name LIKE '$_POST[login_name]'");
                        if (mysqli_num_rows($query) != 0) {
                            $res = mysqli_fetch_assoc($query);
                            if (password_verify($_POST['login_password'], $res['password'])) {
                                $_SESSION['userid'] = $res['id'];
                                $shouldReload = true;
                            }
                        }
                        echo "Anmeldung fehlgeschlagen!";
                    } else {
                        // prüft ob der name oder die email bereits mit einem anderen konto übereinstimmen
                        $nameProofQuery = "SELECT * FROM users WHERE name LIKE '$_POST[register_name]'";
                        $emailProofQuery = "SELECT * FROM users WHERE email LIKE '$_POST[register_email]'";
                        $error = false;
                        if (mysqli_num_rows(mysqli_query($con, $nameProofQuery)) != 0) {
                            echo "Dieser Name ist bereits vergeben!";
                            $error = true;
                        }
                        if (mysqli_num_rows(mysqli_query($con, $emailProofQuery)) != 0) {
                            echo "Diese E-Mail ist bereits mit einem anderen Konto verknüpft!";
                            $error = true;
                        }

                        // falls keine doppelten daten gefunden wurden registrierung abschließen
                        if (!$error) {
                            $hashedPassword = password_hash($_POST['register_password'], PASSWORD_DEFAULT);
                            $query = mysqli_query($con, "INSERT INTO users (name, email, password) VALUES ('$_POST[register_name]', '$_POST[register_email]', '$hashedPassword')");
                            $shouldReload = true;
                        }
                    }
                    
                    if ($shouldReload) {
                        // page reload
                        echo "<meta http-equiv='refresh' content='0'>";    
                    }
                }
                
            }

        ?>

    </main>
</body>
</html>
