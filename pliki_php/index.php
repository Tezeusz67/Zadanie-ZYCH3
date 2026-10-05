<?php

$katalog = "dokumenty";

if (!file_exists($katalog)) {
    mkdir($katalog);
}

$pliki = scandir($katalog);

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Moje pliki</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>MOJE PLIKI</h1>

    <div class="katalog">
        <p><strong>Aktualny katalog:</strong></p>

        <?php
        echo getcwd();
        ?>
    </div>

    <h2>ZAWARTOŚĆ KATALOGU</h2>

    <table>

        <tr>
            <th>Nazwa</th>
            <th>Typ</th>
        </tr>

        <?php

        foreach ($pliki as $plik) {

            if ($plik == "." || $plik == "..") {
                continue;
            }

            $pelnaSciezka = $katalog . "/" . $plik;

            echo "<tr>";

            echo "<td>" . $plik . "</td>";

            if (is_file($pelnaSciezka)) {
                echo "<td>PLIK</td>";
            }

            if (is_dir($pelnaSciezka)) {
                echo "<td>KATALOG</td>";
            }

            echo "</tr>";
        }

        ?>

    </table>

    <h2>UTWÓRZ KATALOG</h2>

    <form method="post">

        <label for="nazwa">Nazwa katalogu:</label>

        <input type="text" name="nazwa" id="nazwa">

        <button type="submit" name="utworz">Utwórz</button>

    </form>

    <?php

    if (isset($_POST["utworz"])) {

        $nazwa = $_POST["nazwa"];

        if ($nazwa != "") {

            $nowyKatalog = $katalog . "/" . $nazwa;

            if (!file_exists($nowyKatalog)) {

                mkdir($nowyKatalog);

                echo "<p class='sukces'>Katalog został utworzony.</p>";

            } else {

                echo "<p class='blad'>Taki katalog już istnieje.</p>";

            }

        } else {

            echo "<p class='blad'>Podaj nazwę katalogu.</p>";
        }
    }

    ?>

</div>

</body>
</html>
