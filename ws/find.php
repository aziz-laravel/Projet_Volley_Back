<?php
include_once '../racine.php';
include_once RACINE . '/service/EtudiantService.php';

$es = new EtudiantService();
$etudiants = $es->findAll();
$response = [];

foreach ($etudiants as $etudiant) {
    $imageData = base64_encode($etudiant->getImage()); 
    $response[] = [
        "id" => $etudiant->getId(),
        "nom" => $etudiant->getNom(),
        "prenom" => $etudiant->getPrenom(),
        "ville" => $etudiant->getVille(),
        "sexe" => $etudiant->getSexe(),
        "image" => $imageData 
    ];
}

header('Content-type: application/json');
echo json_encode($response);
