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
                    <img class="logo" src="css/icons/image.png"></img>
                </a>
            </div>
            <div class="search-bar">
                <?php
                    echo "
                        <form class='search-form' method='POST'>
                            <input type='text'>
                            <input class='search-btn' type='submit' value='Search'></input>
                        </form>
                    ";
                ?>
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

    <main>
        <div class="main-filters">
            <form action='' method='POST'>
                <select name="brandfilter">  
                    <option value="Select">Marken Filter</option>  
                    <option value="Pelikan">Pelikan</option>  
                    <option value="Herlitz">Herlitz</option>  
                    <option value="M+R">M+R</option>  
                    <option value="Faber Castell"> Faber Castell</option>  
                    <option value="Betzold">Betzold</option>  
                    <option value="Stabilo">Stabilo</option>  
                    <option value="Brunnen">Brunnen</option>  
                    <option value="Oxford">Oxford</option>  
                    <option value="Landre">Landre</option> 
                    <option value="Avery">Avery</option> 
                    <option value="BIC">BIC</option>
                    <option value="Edding 500">Edding 500</option>          
                </select>   
            </form>
        </div>

        <div class="sell-container">
            <?php 
                include 'db.php';

                $abfrage = "SELECT * FROM products";

                if(isset($_POST['brandfilter'])) {
                    $abfrage .= "WHERE brand LIKE '$_POST[brandfilter]'";
                }

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