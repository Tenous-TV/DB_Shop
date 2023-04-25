<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/products.css" rel="stylesheet">
    <title>Schulsachen Shop</title>
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

    <main>

        <?php
            echo "
                <div>
                    <center><h2>Unsere Top 5 bewerteten Produkte!</h2></center>
                </div>
            ";
        ?>

        <!-- anderer style um die produkte zu "highlighten" -->
        <div class="sell-container">
            <?php 
                include 'db.php';

                $abfrage = "SELECT productid, AVG(stars) AS star FROM ratings GROUP BY productid ORDER BY star DESC LIMIT 5";
                

                foreach (mysqli_query($con, $abfrage) as $res) {

                    $query = mysqli_query($con, "SELECT * FROM products WHERE id = $res[productid]");
                    $res = mysqli_fetch_assoc($query);
                    echo "
                        <div class='product-tile'>
                            <a href='product.php?productid=$res[id]'>
                                <img class='product-tile-img' src='css/img/products/$res[picture]'></img>
                                <h3>$res[name]</h3>
                                <br>
                                <p>$res[price]€</p>
                            </a>
                        </div>
                    ";
                }
            ?>
        </div>

        <div>
            <h4><a href='all.php'>Durchstöbern</a></h4>
        </div>
    </main>



    

</body>
</html>