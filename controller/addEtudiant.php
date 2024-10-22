<?php 
include_once '../racine.php'; 
include_once RACINE . '/service/EtudiantService.php'; 

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $es = new EtudiantService();
    
    // Check if a file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']); // Get the image data
        
        // Create a new Etudiant object with the image data
        $etudiant = new Etudiant(null, $_POST['nom'], $_POST['prenom'], $_POST['ville'], $_POST['sexe'], $imageData);
        
        // Insert the new Etudiant into the database
        $es->create($etudiant);
    }
    
    // Redirect back to the index page
    header("location:../index.php"); 
}
?>
