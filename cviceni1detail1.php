<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <fieldset><legend>
    <h2>Detail anketní otázky</h2>
    </legend>
    <?php

    if (!$con = mysqli_connect('localhost', 'root', '', 'ankety')) {
        die("Nepodařilo se spojit s databází</body></html>");
    }

    if (!($hodnoty = mysqli_query($con, "select id_otazky, text_otazky from otazky where id_otazky=" . $_GET['id']))) {
        echo "Nelze vypsat";
    }

    while ($row = mysqli_fetch_array($hodnoty)) {
        echo $row["text_otazky"];
    }

    mysqli_free_result($hodnoty);
    mysqli_close($con);

    ?>
    <?php
    
    if (isset($_POST["odpoved_text"])) {
        if (!($con = mysqli_connect('localhost', 'root', '', 'ankety'))) {
            die("Nepodařilo se spojit s databází</body></html>");
        }
        mysqli_query($con, "SET NAMES 'utf8'");
        if (mysqli_query($con, "insert into odpovedi (id_otazky,text_odpovedi) 
        values ('". addslashes($_POST["idecko"]) ."','".addslashes($_POST["odpoved_text"]). "')")) {
            echo "Úspěšně vloženo";
        } else {
            echo "Vložení dat do databáze se nepodařilo";
        }
        mysqli_close($con);
        
    }
    ?>
<h3>Odpovědi</h3>
<?php
        if (isset($_POST["odpoved_text"])) {
            if (!$con1 = mysqli_connect('localhost', 'root', '', 'ankety')) {
                die("Nepodařilo se spojit s databází</body></html>");
            }

            if (!($hodnoty1 = mysqli_query($con1, "select text_odpovedi from odpovedi where id_otazky=" . $_GET['id']))) {
                echo "Nelze vypsat";
            } ?>

            
            <table>
            <?php
                while ($row1 = mysqli_fetch_array($hodnoty1)) {
                    echo "<tr><td>" . $row1["text_odpovedi"] ."</td></tr>";
                }
                ?>
            </table>
            
             <?php
            mysqli_free_result($hodnoty1);
            mysqli_close($con1);
        }
        ?>


</fieldset><br><br><fieldset><legend>Zádání odpovědí</legend>
    <h3>Zadej odpověd</h3>
    <form action="" method="POST">
    <textarea name="odpoved_text" cols="30" rows="2"></textarea><br>
    <input type="hidden" name="idecko" value='<?php echo $_GET['id'] ?>'>
    <input type="submit" value="ODESLAT">
    
    </form>
    </fieldset>
<br><br>
    <a href="cviceni2.php?id=0">Přehled všech otázek s odpověďmi</a>

    

</body>

</html>