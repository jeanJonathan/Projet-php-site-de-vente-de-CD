<!DOCTYPE html>
<html lang="fr">
<head>
  <!-- pour indiquer l'encodage de caractères de ma page -->
  <meta charset="UTF-8" />
  <!-- pour décrire de manière concise le contenu de ma page : -->
  <meta name="description" content="Vente en ligne de CD de tous les annimes" />
  <!-- pour indiquer aux navigateurs comment ajuster la mise en page de ,cette page sur les appareils mobiles -->
  <!-- pour indiquer les mots-clés associés à ma page  -->
  <meta name="keywords" content="CD, musique, vente en ligne" />
  <!-- Le probleme se situe dans le html -->
  <title>Finaliser commande</title>
  <link rel="stylesheet" type="text/css" href="style.css"> <!-- Charger le framework Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
  <!-- Contenu principal du site -->
    <strong><h1>Finalisation de votre commande </h1></strong>
  <main class="site-main">
<?php

// Démarrer la session PHP
session_start();

// Récupérer les informations de paiement envoyées par le formulaire
$card_number = $_POST['card_number'];
$expiration_date = $_POST['expiration_date'];
$cvv = $_POST['cvv'];

// Vérification de la saisie des 16 chiffres et vérifier que le dernier est identique au premier
if (!(strlen($card_number) == 16 && substr($card_number, -4) == substr($card_number, -8, 4))) {
  // Si les informations de carte de crédit sont incorrectes, afficher un message d'erreur et arrêter le script
  echo 'Les informations de la carte bancaire sont incorrectes.';
  /*On s'arrete avec l'instruction exit dans ce cas*/
  exit;
}
// Vérifier que la date d'expiration est supérieure à la date du jour + 3 mois
$today = new DateTime();
$expiration_date = DateTime::createFromFormat('m/Y', $expiration_date);
if ($expiration_date <= $today->modify('+3 months')) {
  // Si la date d'expiration est incorrecte, afficher un message d'erreur et arrêter le script
  echo 'La date d expiration est incorrecte.';
  exit;
}
else{
  // Suppression du panier de la variable de session
  unset($_SESSION['lePanier']);

  //Afficher un message de confirmation de commande
  echo 'Votre commande a été enregistrée avec succès !';
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