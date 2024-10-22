<?php
include_once '../racine.php'; 
include_once '../classes/Etudiant.php';
include_once '../connexion/Connexion.php';
include_once '../service/EtudiantService.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $ville = $_POST['ville'];
    $sexe = $_POST['sexe'];
    $image = base64_decode($_POST['image']); // Decode the image from Base64

    // Create Etudiant object and update
    $etudiantService = new EtudiantService();
    $etudiant = new Etudiant($id, $nom, $prenom, $ville, $sexe, $image);
    $etudiantService->update($etudiant);
    
    echo "Étudiant mis à jour avec succès.";
}
