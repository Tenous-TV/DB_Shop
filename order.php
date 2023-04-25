<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
        if (!isset($_SESSION['userid'])) {
            echo "<meta http-equiv='refresh' content='0; url=shoppingcart.php'>";
        }
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/order.css" rel="stylesheet">
    <title>Schreibwarenshop.de - Bestellung aufgeben</title>
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

    <main>
        <div class='order'>
            <div class="products">
                <table class='producttable'>
                    <tr>
                        <th>Produktname</th>
                        <th>Preis</th>
                        <th>Anzahl</th>
                        <th>Gesamtpreis</th>
                    </tr>

                <?php
                    include 'db.php';

                    // auflistung der einzelnen produkte und errechnung des gesamtpreises
                    $totalCost = 0;

                    $abfrage = "SELECT * FROM shoppingcart WHERE userid = $_SESSION[userid]";
                    foreach (mysqli_query($con, $abfrage) as $res) {
                        $product = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM products WHERE id = $res[productid]"));
                        $fullCost = $product['price'] * $res['amount'];
                        echo "
                            <tr>
                                <td>$product[name]</td>
                                <td>$product[price]</td>
                                <td>$res[amount]</td>
                                <td><span>$fullCost</span>€</td>
                            </tr>
                        ";
                        $totalCost += $fullCost;
                    }
                    echo " 
                        </table>
                        <h3>Gesamtkosten: <span>$totalCost</span>€</h3>
                    ";
                ?>
            </div>
            <form method='POST' action=''>
                <?php 
                    $abfrage = "SELECT zipcode, city, street, country, firstname, lastname FROM users WHERE id = $_SESSION[userid]";
                    $user = mysqli_fetch_assoc(mysqli_query($con, $abfrage));
                    echo "
                        <div class='userdata'>
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
                                <tr>
                                    <th>Informationen speichern:</th>
                                    <td><input type='checkbox' name='save_info'>
                                </tr>
                            </table>
                            <input type='submit' value='Bestellen' name='submit_order'>
                        </div>
                    ";

                    if (isset($_POST['submit_order'])) {
                        $html = "
                            <strong><p>
                                $_POST[firstname] $_POST[lastname]
                                <br>
                                $_POST[street]
                                <br>
                                $_POST[zipcode], $_POST[city]
                            </p></strong>

                            <strong><p style='text-align=right;'>
                                Schreibwarenshop.de
                                <br>
                                Schreibwarenstraße 25
                                <br>
                                53111, Bonn
                            </p></strong>

                            <table>
                                <tr>
                                    <th>Produktname</th>
                                    <th>Preis</th>
                                    <th>Anzahl</th>
                                    <th>Gesamtpreis</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                        ";

                        $totalCost = 0;
                        $abfrage = "SELECT * FROM shoppingcart WHERE userid = $_SESSION[userid]";
                        foreach (mysqli_query($con, $abfrage) as $res) {
                            $product = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM products WHERE id = $res[productid]"));
                            $fullCost = $res['amount'] * $product['price'];
                            $html .= "
                                <tr>
                                    <td>$product[name]</td>
                                    <td>$product[price]</td>
                                    <td>$res[amount]</td>
                                    <td>$fullCost</td>
                                </tr>
                            ";
                            $totalCost += $fullCost;
                        }
                        $html .= "
                            </table>
                            <h3>$totalCost €</h3>
                        ";

                        $rechnungsnummer = 0;

                        require_once('tcpdf/tcpdf.php');

                        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                        $pdf->SetCreator(PDF_CREATOR);
                        $pdf->SetAuthor('Schreibwarenshop.de');
                        $pdf->SetTitle('Rechnung_' . $rechnungsnummer);
                        $pdf->SetSubject('Rechnung_' . $rechnungsnummer);

                        //voreinstellungen für das pdf
                        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 

                        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

                        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

                        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
                        
                        $pdf->SetFont('dejavusans', '', 10);

                        $pdf->AddPage();


                        $pdf->writeHTML($html, true, false, true, false, '');

                        $pdfName = 'Rechnung_' . $rechnungsnummer . '.pdf';
                        $pdf->Output(dirname(__FILE__) . '/rechnungen/' . $pdfName, 'F');
                    }
                ?>
            </form>
        </div>
    </main>
</body>
</html>