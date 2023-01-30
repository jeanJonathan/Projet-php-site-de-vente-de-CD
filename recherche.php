<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <!-- Description du contenue du site -->
  <meta name="description" content="Vente en ligne de CD de tous les annimes" />
  <!-- pour indiquer aux navigateurs comment ajuster la mise en page de ,cette page sur les appareils mobiles -->
  <!-- pour indiquer les mots-clés associés à ma page  -->
  <meta name="keywords" content="CD, musique, vente en ligne" />
  <title>page de recherche</title>
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
      <!-- Formulaire de recherche -->
      <!-- pour le formulaire method="get" action="#" role="search" -->
      <form method="get" action="recherche.php" class="site-search" >
        <input class="search-input" type="text" name="search-bar" placeholder="Rechercher titre ou auteur ex: One piece" aria-label="Que recherchez-vous ?" id="search-bar">
      </form>
<!--       <a href="panier.php" class="">
      <img width="30" height="30" src="https://cdn-icons-png.flaticon.com/512/118/118089.png" alt="Panier">
    </a> -->
    </div>
  </header>
<?php
$con = mysqli_connect('localhost','root','','projetphp');
if (!$con) {
  die('Erreur de connexion: ' . mysqli_error($con));
}
mysqli_select_db($con,"cd");

// Récupération de la valeur de la chaîne de requête "q"
$searchTerm = $_GET['search-bar'];

// Construction de la requête SQL de recherche
// %$searchTerm% pour rechercher tous les enregistrements dont le titre contient le terme de recherche à n'importe quel endroit
$sql = "SELECT * FROM cd WHERE titre LIKE '%$searchTerm%' OR auteur LIKE '%$searchTerm%'";

$result = mysqli_query($con, $sql);

    ?>
  <main class="site-main">
    <section class="cd-section">
      <div class="cd-image"> 
        <figure>

            <?php
            $result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0 && !empty($searchTerm) && isset($searchTerm)) {

// On parcours des résultats de la requête
    while($row = $result->fetch_assoc()) {
             echo '<img src="'.$row['cheminVignette'].'">'.'<form method="post" action="panier.php">
          <input type="hidden" name="idCd" value="'.$row['id'].'">
          <input class="button" type="submit" name="Ajouter au panier" value="Ajouter au panier">
        </form>';
             }
}
          ?>

        </figure>
      </div>
      <!-- Bouton d'ajout au panier -->
      <div class="cd-cta-section">  
        <hr>
        <!-- Bouton d'ajout au panier -->
        <!-- <div class="cd-cta-button">
          <button class="button">Ajouter au panier</button>
        </div>
 -->      </div>

    </section>
    <!-- Section des détails du CD -->
    <section class="cd-details-section">
      <!-- Titre de la section -->
      <h2 class="cd-details-title"><?php
        $result = mysqli_query($con, $sql);
        // On vérifie le nombre de résultats
if (mysqli_num_rows($result) < 2 && !empty($searchTerm) && isset($searchTerm)) {

// On parcours des résultats de la requête
    while($row = $result->fetch_assoc()) {
      // On ajoute des informations du CD au tableau HTML
      echo $row['titre'];
  }
}
else{

  while($row = $result->fetch_assoc()) {
      // On ajoute des informations du CD au tableau HTML
      echo $row['titre'].',';
  }
}
          ?></h2>
      <div class="cd-details-section">
        <h3 class="cd-details-label">Realisateur(s) :</h3>
        <p class="cd-details-text"><?php
        $result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) < 2 && !empty($searchTerm) && isset($searchTerm)) {
    while($row = $result->fetch_assoc()) {
      echo $row['auteur'];
  }
}
else{
        echo "Les auteurs de ces manga ci joint sont respectivement ";
  while($row = $result->fetch_assoc()) {
      echo $row['auteur'].',';
  }
}
          ?></p>
      </div>
      <div class="cd-details-section">
        <h3 class="cd-details-label">Genre(s) :</h3>
        <p class="cd-details-text"><?php
        $result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) < 2 && !empty($searchTerm) && isset($searchTerm)) {
    while($row = $result->fetch_assoc()) {
      echo $row['genre'];
  }
}
else{
        echo "Les genres de ces manga ci joint sont respectivement ";
  while($row = $result->fetch_assoc()) {
      echo $row['genre'].',';
  }

}
 ?> </p>
      </div>
      <div class="cd-details-section">
        <h3 class="cd-details-label">Prix :</h3>
        <p class="cd-details-text"><?php
        $result = mysqli_query($con, $sql);
        // On vérifie le nombre de résultats
if (mysqli_num_rows($result) < 2 && !empty($searchTerm) && isset($searchTerm)) {
    while($row = $result->fetch_assoc()) {
      echo $row['prix'].'$';
  }
}
else{
        echo "Les prix de ces manga ci joint sont respectivement ";
  while($row = $result->fetch_assoc()) {
      echo $row['prix'].'$,';
  }

}
 ?></p>
      </div>
    </section>
    </div>    
  </main>
   <!-- Pied de page -->
  <footer class="site-footer">
    <div class="container">
      <div class="site-footer-inner">
        <div class="footer-section">
          <h3 class="footer-section-title">A propos</h3>
          <ul class="footer-section-list">
            <li><a href="#">Qui sommes-nous</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
        <div class="footer-section">
          <!-- Titre de la section -->
          <h3 class="footer-section-title">Aide</h3>
          <!-- Liste des liens -->
          <ul class="footer-section-list">
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Livraison</a></li>
            <li><a href="#">Retours</a></li>
          </ul>
        </div>
        <div class="footer-section">
          <h3 class="footer-section-title">Informations</h3>
          <ul class="footer-section-list">
            <li><a href="#">Mentions légales</a></li>
            <li><a href="#">Politique de confidentialité</a></li>
            <li><a href="#">Conditions d'utilisation</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="site-copyright">
      <p>Copyright © 2022 Vente de CD. Tous droits réservés. - Projet Php</p>
    </div>
  </footer>

  <!-- Chargement de jQuery et Bootstrap) -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script> -->

<!-- Chargement du script JavaScript personnalisé ici -->
<script src="script.js"></script>
 
<?php
mysqli_close($con);

          ?>
</body>
</html>