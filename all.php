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
            <div class="search-bar">
                <?php
                    echo "
                        <form class='search-form' method='POST'>
                            <input type='text' name='search-text'>
                            <input class='search-btn' type='submit' name='search-btn' value='Search'></input>
                        </form>
                    ";

                    if (isset($_POST['search-btn'])) {
                        echo "
                            
                        ";
                    }
                ?>
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
        <div class="main-filters">

        </div>

        <div class="sell-container">
            <?php 
                include 'db.php';

                $searchtext = isset($_POST['search-text']) ? $_POST['search-text'] : "";

                $abfrage = "SELECT * FROM products WHERE name LIKE '%$searchtext%'";

                foreach (mysqli_query($con, $abfrage) as $res) {
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
    </main>



    

</body>
</html>