<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>page panier</title>
</head>
<body>
	<?php
session_start();

//echo "Bienvenue dans panier.php".'</br>';
//echo $_POST['idCd'];

// Démarrer la session PHP
session_start();

// Récupéreration de l'id du cd envoyé dans la requête POST dans ma page recherche ou index
$idCd = $_POST['idCd'];
// On vérifie si le panier de l'utilisateur n'est pas déjà défini dans la variable de session
if (!isset($_SESSION['lePanier'])) {
  // Si le panier n'est pas défini, on le créer en tant que array vide
  $_SESSION['lePanier'] = array();
}

// On ajoute le CD au panier en utilisant son id se trouvant dans la bd comme clé et la quantité comme valeur
$_SESSION['lePanier'][$idCd] = 1;

// Redirection de l'utilisateur vers la page lePanier.php
header('Location: lePanier.php');

  ?>

</body>
</html>

