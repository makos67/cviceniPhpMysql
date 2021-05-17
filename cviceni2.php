<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php

    if (!$con = mysqli_connect('localhost', 'root', '', 'ankety')) {
        die("Nepodařilo se spojit s databází</body></html>");
    }

    if (!($hodnoty2 = mysqli_query($con, "select id_odpovedi,pocet_hlasu from odpovedi"))) {
        echo "Nelze zvysit pocty";
    }
    #$row2 = mysqli_fetch_array($hodnoty2);
    mysqli_query($con,"update odpovedi set pocet_hlasu=pocet_hlasu+1 where id_odpovedi = ". $_GET['id']);

    

    if (!($hodnoty = mysqli_query($con, "select id_otazky, text_otazky from otazky"))) {
        echo "Nelze vypsat otazky";
    }


    
    ?>

    <h1>Anketní otázky</h1>
    <table>
        <?php
        while ($row = mysqli_fetch_array($hodnoty)) {
            echo "<tr><td><h3>" . $row["id_otazky"] . "</h3></td><td>" . $row["text_otazky"] . "</td></tr>";
            echo "<tr><td></td><td></td><td><table>";

            if (!($hodnoty1 = mysqli_query($con, 
            'select id_odpovedi, id_otazky, text_odpovedi, pocet_hlasu from odpovedi where id_otazky='.$row["id_otazky"].''))) {
                echo "Nelze vypsat odpovedi";
            }
            while ($row1 = mysqli_fetch_array($hodnoty1)) {
                echo "<tr><td>" . $row1["text_odpovedi"] . "</td><td><a href=cviceni2.php?id=".$row1["id_odpovedi"].">" . $row1["pocet_hlasu"] . "</a></td></tr>";
            }
            echo "</table></td></tr>";
        }
        ?>
    </table>

    <?php
    mysqli_free_result($hodnoty);
    mysqli_close($con);

    ?>
</body>

</html>