<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'connexion.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "GET"){
	// Route : http://localhost/php/01_Demo/13_apiRestPHP/

	 // Préparation de la requete
	 $querrySql="SELECT * FROM personne";
	 $prepQuerry=$pdo->prepare($querrySql);
	 // Exécuter la requete
	 $prepQuerry->execute();
	 // Récupérer les données retournées
	 $tabPersonne = $prepQuerry->fetchAll(PDO::FETCH_ASSOC);

	 // Encode en JSON
	echo json_encode($tabPersonne);
}
else if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	// Route : http://localhost/php/01_Demo/13_apiRestPHP/

	$body = file_get_contents('php://input');
	$objet = json_decode($body);
	// $objet->nom;
	// $objet->prenom;
	$tab["nom"] = $objet->nom;
	$tab["prenom"] = $objet->prenom;
	//$tab["id"] =56; -> plus besoin l'id est en auto incrementation
	$tab["info"] ="Ajouter";
	echo json_encode($tab);

	// preparation requete
	$prepared_sql="INSERT INTO personne VALUES(null,:nom,:prenom)";
	$prepared_query=$pdo->prepare($prepared_sql);
	 // bind de la requete
    $prepared_query->bindParam(":nom",$tab["nom"],PDO::PARAM_STR);
	$prepared_query->bindParam(":prenom",$tab["prenom"],PDO::PARAM_STR);
	// excecute requete
	$prepared_query->execute();
}
else if ($_SERVER["REQUEST_METHOD"] == "DELETE")
{
		// Route : http://localhost/php/01_Demo/13_apiRestPHP/personne/[id]
		//var_dump($_SERVER['REDIRECT_URL']);
		$tab["info"] = "delete";
		$tab["id"] = $_GET["id"];
		echo json_encode($tab);

		// préparation requete
		$prepared_sql="DELETE FROM personne WHERE id=:id";
		$prepared_query = $pdo->prepare($prepared_sql);
		$prepared_query->bindValue(':id', $tab["id"],PDO::PARAM_INT);
		// execution requete
		$prepared_query->execute();
	
}
else if ($_SERVER["REQUEST_METHOD"] == "PUT")
{
	http://localhost/php/01_Demo/13_apiRestPHP/personne/[id]
	$body = file_get_contents('php://input');
	$objet = json_decode($body);
	// $objet->nom;
	// $objet->prenom;
	$tab["nom"] = $objet->nom;
	$tab["prenom"] = $objet->prenom;
	$tab["id"] = $_GET["id"];
	$tab["info"] ="Modifier Update";
	echo json_encode($tab);

	// Préparation de la requete
	$querrySql = "UPDATE personne SET nom=:nom, prenom=:prenom WHERE id=:id";
	$prepQuerry = $pdo->prepare($querrySql);
	// bind requete
	$prepQuerry->bindValue(':nom', $tab["nom"], PDO::PARAM_STR);
	$prepQuerry->bindValue(':prenom', $tab["prenom"], PDO::PARAM_STR);
	$prepQuerry->bindValue(':id', $tab["id"], PDO::PARAM_INT);
	// Exécuter la requete
	$prepQuerry->execute();
}
