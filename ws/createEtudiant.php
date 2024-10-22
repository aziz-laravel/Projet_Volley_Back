<?php 
include_once '../racine.php'; 
include_once RACINE . '/service/EtudiantService.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $es = new EtudiantService();
    
    // Receive the base64 image
    $imageData = isset($_POST['image']) ? $_POST['image'] : null; // Use "image" to match the database

    if ($imageData) {
        $imageData = base64_decode($imageData); // Decode base64 image data
        $etudiant = new Etudiant(null, $_POST['nom'], $_POST['prenom'], $_POST['ville'], $_POST['sexe'], $imageData);
        $es->create($etudiant);
        
        header('Content-type: application/json');
        echo json_encode(["status" => "success", "message" => "Etudiant ajouté avec succès"]);
    } else {
        header('Content-type: application/json');
        echo json_encode(["status" => "error", "message" => "Image non fournie"]);
    }
} 
?>