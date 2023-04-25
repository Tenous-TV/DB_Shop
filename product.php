<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/product.css" rel="stylesheet">
    <?php
        session_start();
        include 'db.php';

        $productId = $_GET['productid'];

        $query = mysqli_query($con, "SELECT * FROM products WHERE id = $productId");
        $product = mysqli_fetch_assoc($query);

        echo "<title>Schreibwarenshop.de - $product[name] kaufen</title>";
    ?>
</head>
<body>
    <nav>
        <div class="nav-left">
            <div>
                <a href="index.php">
                    <img class="logo" src="css/icons/image.png"></img>
                </a>
            </div>
        </div>
        <div class="nav-right">
            <div class="nav-cat">
                <div class="nav-cat-tile">
                    <a href="shoppingcart.php">
                        <img class="nav-icon" src="css/icons/shopping-cart.png"></img>
                       <!-- Warenkorb -->
                    </a>
                </div>
                <div class="nav-cat-tile">
                    <a href="favorites.php">
                        <img class="nav-icon" src="css/icons/heart.png"></img>
                        <!-- Favoriten -->
                    </a>
                </div>
                <div class="nav-cat-tile">
                    <a href="login.php">
                        <img class="nav-icon" src="css/icons/user.png"></img>
                        <!-- Konto -->
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <?php
    // gibt die produktkachel  mit name, preis, description etc. aus
        echo "
            <main>
                <div>
                    <div class='product-info'>
                        <img src='css/img/products/$product[picture]'></img>
                        <h3>$product[name]</h3>
                        <br>
                        <p>$product[description]</p>
                        <br>
                        <br>
                        <span class='right-align'><strong><p>$product[price]€</p></strong></span>
        ";
        //prüft ob der user angemeldet ist und ob er dieses produkt schon im warenkorb hat
        if (isset($_SESSION['userid'])) {
            if (mysqli_num_rows(mysqli_query($con, "SELECT * FROM shoppingcart WHERE userid = $_SESSION[userid] AND productid = $productId")) == 0) {
                echo "
                            <form method='POST' action=''>
                                <div class='f-right'>
                                    <input type='number' name='amount' min='1' value='1' required>
                                    <input class='f-right' type='submit' name='shopping_cart' value='In den Warenkorb'>
                                </div>
                            </form>
                ";
            } else {
                echo "
                    <p class='right-align'>Bereits im Warenkorb</p>
                ";
            }
        }
        echo "  
            <br>
            <h4>Bewertungen</h4>
        ";
        if (isset($_SESSION['userid'])) {
            //prüft ob der user angemeldet ist und ob er schon eine bewertung geschrieben hat
            $abfrage = "SELECT * FROM ratings WHERE userid = $_SESSION[userid] AND productid = $productId";
            $canRate = mysqli_num_rows(mysqli_query($con, $abfrage)) != 0 ? false : true;
            if ($canRate) {
                echo "
                        <div class='add-rating'>
                            <form method='POST' action=''>
                                <input type='radio' name='rating_stars' value='1' required>1</input>
                                <input type='radio' name='rating_stars' value='2'>2</input>
                                <input type='radio' name='rating_stars' value='3'>3</input>
                                <input type='radio' name='rating_stars' value='4'>4</input>
                                <input type='radio' name='rating_stars' value='5'>5</input>
                                <div>
                                    <textarea name='rating_text' maxlength='255' placeholder='Bewertungstext schreiben (optional)'></textarea>
                                    <input type='submit' name='rating_submit'>
                                </div>
                            </form>
                        </div>
                ";
            } else {
                echo "<p>Du hast dieses Produkt bereits bewertet!</p>";
            }
        } else {
            echo "<p>Du musst angemeldet sein um ein Produkt zu bewerten</p>";
        }
        echo "
                    </div>
                    <div class='ratings'>
        ";
        

        // gibt alle bewertungen für das jeweilige produkt aus
        $abfrage = "SELECT * FROM ratings WHERE productid = $productId";
        foreach (mysqli_query($con, $abfrage) as $res) {
            $user = mysqli_query($con, "SELECT name FROM users WHERE id = $res[userid]");
            $username = mysqli_fetch_assoc($user)['name'];
            echo "
                <br>
                <div class='rating'>
                    <h5>$username</h5>
                    <p>Sterne: $res[stars]</p>
            ";
            echo $res['text'] != "" ? "<p>$res[text]</p>" : "";
            echo "
                </div>
            ";
        }
        echo "
                        
                    </div>
                </div>
            </main>
        ";

        // beim klick auf bewertung senden
        if (isset($_POST['rating_submit'])) {
            $stars = $_POST['rating_stars'];
            $text = isset($_POST['rating_text']) ? $_POST['rating_text'] : NULL;

            $abfrage = "INSERT INTO ratings(userid, productid, stars, text) VALUES ($_SESSION[userid], $productId, $stars, '$text')";
            mysqli_query($con, $abfrage);
            // page reload
            echo "<meta http-equiv='refresh' content='0'>";   
        }

        //beim klick auf in den warenkorb
        if (isset($_POST['shopping_cart'])) {
            $abfrage = "INSERT INTO shoppingcart(userid, productid, amount) VALUES ($_SESSION[userid], $productId, $_POST[amount])";
            mysqli_query($con, $abfrage);
            // page reload
            echo "<meta http-equiv='refresh' content='0'>"; 

        }
    ?>
</body>
</html>