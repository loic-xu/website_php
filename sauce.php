<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sauces</title>

    <?php include 'inc\navigation.php'; ?>
    <?php include 'config/database.php'; ?>

    <?php 
    $sql = 'SELECT * FROM sauce_date';
    $result = mysqli_query($conn, $sql);
    $sauce = mysqli_fetch_all($result, MYSQLI_ASSOC); ?>

    <br>
    <table>
        <tr>
            <th>Nom</th>
            <th>Date ouverture</th>
            <th>Date expiration</th>
        </tr>
    
    <?php foreach($sauce as $item)
    {
        echo 
        '<tr>' .
            '<td>' .  $item['nom_sauce'] . '</td>' .
            '<td>' .  $item['date_ouverture'] . '</td>' .
            '<td>' .  $item['date_expiration'] . '</td>' .
        '</tr>';
    } 
    ?>
    </table>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <br> <br> 
        <label>Nom : </label>
        <input type="text" name="nom"> <br>
        <label>Date ouverture : </label>
        <input type="date" name="date_ouverture"> <br>
        <label>Date expiration : </label>
        <input type="date" name="date_expiration"> <br> 

        <input type="submit" value="Submit" name="submit"> <br> <br>

    </form>

<?php

    $nom = $date_ouverture = $date_expiration = $nomErr = $date_expirationErr = $date_ouvertureErr = '';
if (isset($_POST['submit'])) 
  {
    if(empty($_POST['nom']))
    {
      $nomErr = 'Il manque le nom du produit.';
    }
    else
    {
      $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if(empty($_POST['date_ouverture']))
    {
      $date_ouvertureErr = 'Il manque la date d\'ouverture.';
    }
    else
    {
      $date_ouverture = filter_input(INPUT_POST, 'date_ouverture', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if(empty($_POST['date_expiration']))
    {
      $date_expirationErr = 'Il manque la date d\'expiration.';
    }
    else
    {
      $date_expiration = filter_input(INPUT_POST, 'date_expiration', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    if (empty($nomErr) && empty($date_ouvertureErr) && empty($date_expirationErr))
    {
      $sql = "INSERT INTO sauce_date (nom_sauce, date_ouverture, date_expiration) VALUES ('$nom', '$date_ouverture', '$date_expiration')";

      if(mysqli_query($conn, $sql))
      {
        header('Location: sauce.php');
      }
      else
      {
        echo 'Error ' . mysqli_error($conn);
      }
    }
    else
    {
        echo '<div class=error>' . $nomErr . '</div>';
        echo '<div class=error>' . $date_ouvertureErr . '</div>';
        echo '<div class=error>' . $date_expirationErr . '</div>';
        echo '<div class=error>Veuillez resaissir votre entrée.</div>';
    }
  }
?>


