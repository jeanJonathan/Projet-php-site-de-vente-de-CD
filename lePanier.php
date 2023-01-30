<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <!-- Description du contenue du site-->
  <meta name="description" content="Vente en ligne de CD de tous les annimes" />
  <!-- pour indiquer aux navigateurs comment ajuster la mise en page de ,cette page sur les appareils mobiles -->
  <!-- pour indiquer les mots-clés associés à ma page  -->
  <meta name="keywords" content="CD, musique, vente en ligne" />
  <title>le panier page</title>
  <link rel="stylesheet" type="text/css" href="style.css"> <!-- On charge le framework Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
  <header class="site-header">
    <div class="container">
      <a href="#" class="site-logo">
        <img width="148" height="258" alt="Vente de CD" src=https://upload.wikimedia.org/wikipedia/commons/f/f3/CD_icon.svg>
      </a>
      <ul>
     <form method="get" action="recherche.php" class="site-search" >
        <input class="search-input" type="text" name="search-bar" placeholder="Rechercher titre ou auteur ex: One piece" aria-label="Que recherchez-vous ?" id="search-bar">
      </form>
    </div>
  </header>
    <h1>Panier </h1><?php // On affiche le nombre d'element dans le panier ?>
  <main class="site-main">
  <?php
session_start();
// On verifie si le panier de l'utilisateur est défini dans la variable de session
if (isset($_SESSION['lePanier']) && !empty($_SESSION['lePanier'])) {
  // Dans ce cas on reccupere les identifiants id des cd du panier
  $cdIds = array_keys($_SESSION['lePanier']);
  // print_r($cdIds);
  // On creer un string avec les ids séparés par le caractere espace pour l'
  $stringCdIds = implode(',', $cdIds);
  // echo $stringCdIds;
$db = new PDO('mysql:host=localhost;dbname=projetphp', 'root', '');
//On reccupere les informations sur les cd du panier
$stmt = $db->query("SELECT * FROM cd WHERE id IN ($stringCdIds)");
$cds = $stmt->fetchAll();
  // On affiche le contenu du panier via foreach

  foreach ($cds as $cd) {
    echo '<div>';
    echo '<img src="' . $cd['cheminVignette'] . '" alt="' . $cd['titre'] . '">';
    echo '<h2>' . $cd['titre'] . '</h2>';
    echo '<p>' . $cd['auteur'] . '</p>';
    echo '<p>' . $cd['prix'] . ' $</p>';
    echo '<form method="post" action="validerCommande.html">
          <input type="hidden" name="idCd" value="'.$cd['id'].'">
          <input class="button" type="submit" name="Ajouter au panier" value="Finaliser la commande">
        </form>';
    echo '<form method="post" action="suppressionCommande.php">
          <input type="hidden" name="idCd" value="'.$cd['id'].'">
          <input class="button" type="submit" name="supprimer du panier" value="supprimer la commande">
        </form>';
  }  
} 
else {
  // Si le panier est vide ou n'est pas défini alors
  echo '<p>Le panier ne contient aucun cd. Il est temps de le remplir !.</p>';
}
?>
  </main>
  <!-- Charger jQuery et Bootstrap (requis par Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>

<!-- Charger votre script JavaScript personnalisé ici -->
<script src="script.js"></script>
</body>
</html>