<!DOCTYPE html>
<?php 
include_once './racine.php'; 
include_once RACINE . '/service/EtudiantService.php'; 
?> 
<html lang="fr"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un nouvel étudiant</title> 
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head> 
<body> 
    <form method="POST" action="controller/addEtudiant.php" enctype="multipart/form-data"> 
        <fieldset> 
            <legend>Ajouter un nouvel étudiant</legend> 
            <table> 
                <tr> 
                    <td><label for="nom">Nom :</label></td> 
                    <td><input type="text" id="nom" name="nom" required /></td> 
                </tr> 
                <tr> 
                    <td><label for="prenom">Prénom :</label></td> 
                    <td><input type="text" id="prenom" name="prenom" required /></td> 
                </tr> 
                <tr> 
                    <td><label for="ville">Ville :</label></td> 
                    <td> 
                        <select id="ville" name="ville" required> 
                            <option value="Tanger">Tanger</option> 
                            <option value="Rabat">Rabat</option> 
                            <option value="El jadida">El jadida</option> 
                            <option value="El jadida">Casablanca</option> 
                        </select> 
                    </td> 
                </tr> 
                <tr> 
                    <td>Sexe :</td> 
                    <td> 
                        <label><input type="radio" name="sexe" value="homme" required /> M</label> 
                        <label><input type="radio" name="sexe" value="femme" /> F</label> 
                    </td> 
                </tr> 
                <tr> 
                    <td><label for="image">Image :</label></td>
                    <td><input type="file" id="image" name="image" accept="image/*" required /></td>
                </tr>
                <tr> 
                    <td></td> 
                    <td> 
                        <input type="submit" value="Envoyer" /> 
                        <input type="reset" value="Effacer" /> 
                    </td> 
                </tr> 
            </table> 
        </fieldset> 
    </form> 

    <table> 
        <thead> 
            <tr> 
                <th>ID</th> 
                <th>Nom</th> 
                <th>Prénom</th> 
                <th>Ville</th> 
                <th>Sexe</th> 
                <th>Image</th> 
                <th>Actions</th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php 
            $es = new EtudiantService(); 
            foreach ($es->findAll() as $e): 
            ?> 
            <tr> 
                <td><?php echo htmlspecialchars($e->getId()); ?></td> 
                <td><?php echo htmlspecialchars($e->getNom()); ?></td> 
                <td><?php echo htmlspecialchars($e->getPrenom()); ?></td> 
                <td><?php echo htmlspecialchars($e->getVille()); ?></td> 
                <td><?php echo htmlspecialchars($e->getSexe()); ?></td> 
                <td>
                    <?php if ($e->getImage()): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($e->getImage()); ?>" alt="Image" style="width: 50px; height: 50px;"/>
                    <?php else: ?>
                        <p>Aucune image</p>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="controller/deleteEtudiant.php?id=<?php echo urlencode($e->getId()); ?>">Supprimer</a> | 
                   <a href="controller/updateEtudiant.php?id=<?php echo urlencode($e->getId()); ?>">Modifier</a>

                </td> 
            </tr> 
            <?php endforeach; ?> 
        </tbody> 
    </table> 
</body> 
</html>
