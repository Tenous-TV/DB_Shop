<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/shoppingcart.css" rel="stylesheet">
    <title>Warenkorb</title>
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
                    <a href="login.php">
                        <img class="nav-icon" src="css/icons/user.png"></img>
                        Konto
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <?php
        session_start();
        include 'db.php';

        if (isset($_SESSION['userid'])) {
            echo "
                <center><button onclick='redirectToOrder()'>Bestellung aufgeben</button></center>
                <main>
                    <form method='POST'>
                        <div class='shopping-cart'>
                            <h1>Dein Warenkorb</h1>
                            <input type='submit' name='save' value='Speichern'>
                            <div class='items'>
            ";
            $totalCost = 0;
            $abfrage = "SELECT * FROM shoppingcart WHERE userid = $_SESSION[userid]";
            // für jedes produkt im warenkorb des angemeldeten users
            foreach (mysqli_query($con, $abfrage) as $res) {
                $abfrage = "SELECT * FROM products WHERE id = $res[productid]";
                $product = mysqli_fetch_assoc(mysqli_query($con, $abfrage));

                // abfrage für durchschnittliche bewertung des produkts
                $query = mysqli_query($con, "SELECT productid, AVG(stars) AS staravg FROM `ratings` WHERE productid = 4");
                $averageRating = mysqli_fetch_assoc($query);
                $averageRating = round(floatval($averageRating['staravg']), 2);

                $sum = number_format($res['amount'] * $product['price'], 2);
                echo "
                    <div id='item_$product[id]' class='item'>
                        <img onclick='redirectToProduct($product[id])' src='css/img/products/$product[picture]'></img>
                        <div>
                            <br>
                            <h4>$product[name]</h4>
                            <br>
                            <p>Preis: $product[price]€</p>
                            <p>Bewertung: $averageRating</p>
                            <p>Anzahl: <input type='number' name='amount_$product[id]' value='$res[amount]' min='0'></input></p>
                            <p>Summe: <strong>$sum</strong>€</p>
                        </div>
                        <div>
                            <button type='button' onclick='deleteItem($product[id])'>Löschen</button>
                        </div>
                    </div>
                ";
                $totalCost += $sum;
            }
            echo "
                            </div>
                        </div>
                        <p>Gesamtkosten: <strong>$totalCost</strong>€</p>
                    </form>
                </main>
            ";

            // aktualisiert jeden warenkorbeintrag eines user nach klick auf speichern, amount = 0 -> objekt aus warenkorb löschen
            if (isset($_POST['save'])) {
                $abfrage = "SELECT * FROM shoppingcart WHERE userid = $_SESSION[userid]";
                foreach (mysqli_query($con, $abfrage) as $res) {
                    $inputName = 'amount_' . $res['productid'];
                    $amount = $_POST[$inputName];
                    if ($amount == 0) {
                        mysqli_query($con, "DELETE FROM shoppingcart WHERE id = $res[id]");
                    } else {
                        mysqli_query($con, "UPDATE shoppingcart SET amount = $amount WHERE id = $res[id]");
                    }
                }
                // page reload nach 0.5s
                echo "<meta http-equiv='refresh' content='0.5'>"; 
            }
        } else {
            echo "
                <center><h1>Bitte melden Sie sich an um Zugriff auf den Warenkorb zu bekommen.</h1></center>
            ";
        }
    ?>

    <script>
        function deleteItem(id) {
            document.getElementsByName('amount_' + id)[0].value = 0;
            document.getElementById('item_' + id).style.display = 'none';
        }

        function redirectToProduct(id) {
            location.href = 'product.php?productid=' + id;
        }

        function redirectToOrder() {
            location.href = 'order.php';
        }
    </script>
</body>
</html>