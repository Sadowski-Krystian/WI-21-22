<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dróżyny</title>
</head>
<body>
    <form action="druzyny.php" method="post">
        <label>Nazwa dróżyny</label><input type="text" name="Dname" id="Dname"><br>
         <h2>oboba 1</h2>
         <label>Nazwisko</label><input type="text" name="nazwisko" id="nazwisko"><br>
         <label>Imie</label><input type="text" name="imie" id="imie"><br>
         <label>Klasa</label><select name="klasa" id="klasa">
             <option value="3pt4">3pt4</option>
             <option value="3pt5">3pt5</option>
         </select>
    </form>
    <?php
    $nazwa = (isset($_POST['Dname'])) ? $_POST['Dname'] : null;
    $imie = (isset($_POST['imie'])) ? $_POST['imie'] : null;
    $nazwisko = (isset($_POST['nazwisko'])) ? $_POST['nazwisko'] : null;
    $klasa = (isset($_POST['klasa'])) ? $_POST['klasa'] : null;
    var_dump($nazwa);
    var_dump($imie);
    var_dump($nazwisko);
    var_dump($klasa);
    ?>
</body>
</html>