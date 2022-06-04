<?php
    // On se connecte à la BDD via notre fichier db.php :
    require "db.php";
    $db = connexionBase();

    // On récupère l'ID passé en paramètre :
    $id = $_GET["id"];

    // On crée une requête préparée avec condition de recherche :
    $requete = $db->prepare("SELECT * FROM artist WHERE artist_id=?");
    // on ajoute l'ID du disque passé dans l'URL en paramètre et on exécute :
    $requete->execute(array($id));

    // on récupère le 1e (et seul) résultat :
    $myArtist = $requete->fetch(PDO::FETCH_OBJ);
  
    if($myArtist == false){
      echo "Votre artiste  N'est pas dans la liste"."<br>";
}  


    // on clôt la requête en BDD
    $requete->closeCursor();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PDO - Détail</title>
    </head>

    <body>
        Artiste N°<?php echo $myArtist->artist_id ?>
        Nom de l'artiste : <?= $myArtist->artist_name ?>
        Site Internet : <?= $myArtist->artist_url ?>
        <a href="artist_form.php?id=<?= $myArtist->artist_id ?>">Modifier</a>

        <form action ="script_artist_modif.php" method="post">

        <input type="hidden" name="id" value="<?= $myArtist->artist_id ?>">

        <label for="nom_for_label">Nom de l'artiste :</label><br>
        <input type="text" name="nom" id="nom_for_label" value="<?= $myArtist->artist_name ?>">
        <br><br>

        <label for="url_for_label">Adresse site internet :</label><br>
        <input type="text" name="url" id="url_for_label" value="<?= $myArtist->artist_url ?>">
        <br><br>

        <input type="reset" value="Annuler">
        <input type="submit" value="Modifier">

    </form>
    </body>

</html>