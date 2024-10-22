<?php 
 
include_once RACINE . '/classes/Etudiant.php'; 
include_once RACINE . '/connexion/Connexion.php'; 
include_once RACINE . '/dao/IDao.php'; 
 
class EtudiantService implements IDao { 
 
    private $connexion; 
 
    function __construct() { 
        $this->connexion = new Connexion(); 
    } 
 
    
    
 
    #[Override]
    public function delete($o) { 
        $query = "DELETE FROM etudiant WHERE id = :id"; 
        $req = $this->connexion->getConnexion()->prepare($query); 
        $req->bindParam(':id', $o->getId());
        $req->execute() or die('Erreur SQL'); 
    }
    
    
    public function findAllApi() {
        $query = "select * from etudiant";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
       }
       
       #[Override]
       public function create($o) { 
    $query = "INSERT INTO etudiant (nom, prenom, ville, sexe, image) VALUES (:nom, :prenom, :ville, :sexe, :image);"; 
    $req = $this->connexion->getConnexion()->prepare($query); 

    
    $nom = $o->getNom();
    $prenom = $o->getPrenom();
    $ville = $o->getVille();
    $sexe = $o->getSexe();
    $image = $o->getImage();

    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':ville', $ville);
    $req->bindParam(':sexe', $sexe);
    $req->bindParam(':image', $image, PDO::PARAM_LOB); 

    $req->execute() or die('Erreur SQL'); 
}

    #[Override]
    public function findAll() { 
        $etds = array(); 
        $query = "SELECT * FROM etudiant"; 
        $req = $this->connexion->getConnexion()->prepare($query); 
        $req->execute(); 
        while ($e = $req->fetch(PDO::FETCH_OBJ)) { 
            $etds[] = new Etudiant($e->id, $e->nom, $e->prenom, $e->ville, $e->sexe, $e->image); 
        } 
        return $etds; 
    }
    
 
    #[Override]
    public function findById($id) {
        $query = "SELECT * FROM etudiant WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->bindParam(':id', $id);
        $req->execute();
    
        // Fetch the result
        $result = $req->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            // Create the Etudiant object with all necessary fields
            return new Etudiant($result['id'], $result['nom'], $result['prenom'], $result['ville'], $result['sexe'], $result['image']);
        }
        return null; // or handle the case when the etudiant is not found
    }
    

    
    
 
    #[Override]
    public function update($o) { 
        $query = "UPDATE etudiant SET nom = :nom, prenom = :prenom, ville = :ville, sexe = :sexe, image = :image WHERE id = :id"; 
        $req = $this->connexion->getConnexion()->prepare($query); 
        $req->bindParam(':nom', $o->getNom());
        $req->bindParam(':prenom', $o->getPrenom());
        $req->bindParam(':ville', $o->getVille());
        $req->bindParam(':sexe', $o->getSexe());
        $req->bindParam(':id', $o->getId());

        // Bind the image; use PDO::PARAM_LOB only if you are sure the image is a BLOB
        $req->bindParam(':image', $o->getImage(), PDO::PARAM_LOB); 
        $req->execute() or die('Erreur SQL'); 
    }
    
} 
 
