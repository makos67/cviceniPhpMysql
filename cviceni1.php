<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<fieldset><legend>Výpis otázek</legend>
    <?php
    if (isset($_POST["otazka_text"])) {
        if (!($con = mysqli_connect('localhost', 'root', '', 'ankety'))) {
            die("Nepodařilo se spojit s databází</body></html>");
        }
        mysqli_query($con, "SET NAMES 'utf8'");
        if (mysqli_query($con, "insert into otazky (text_otazky) values ('" . addslashes($_POST["otazka_text"]) . "')")) {
            echo "Úspěšně vloženo";
        } else {
            echo "Vložení dat do databáze se nepodařilo";
        }
        

        if (!($hodnoty = mysqli_query($con, "select id_otazky, text_otazky from otazky"))) {
            echo "Nelze vypsat";
        } ?>

        <br><br>
        <table>
            <?php
            while ($row = mysqli_fetch_array($hodnoty)) {
                echo "<tr><td>" . $row["text_otazky"] . "</td><td><a href='cviceni1detail1.php?id=" . $row["id_otazky"] . "'>detail</a></td></tr>";
            }
            ?>
        </table>

    <?php
        mysqli_free_result($hodnoty);
        mysqli_close($con);
    }
    ?>
</fieldset>
<br><br>
    <fieldset>
        <legend>Zadání anketních otázek</legend>
        <h2>Zadej anketní otázku</h2>
        <form action="" method="POST">
            <textarea name="otazka_text" cols="30" rows="2"></textarea><br>
            <input type="submit" value="ODESLAT">
        </form>
    </fieldset>
</body>

</html>