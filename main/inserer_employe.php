<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style_employe.css?v=1.0" rel="stylesheet" type="text/css">
    <title>Ajouter un Employé</title>
</head>
<body>
    <ul class="nav-links">
        <li><a href="index.php">Accueil</a></li>
        <li class="center"><a href="inserer_employe.php">Gestion Employé</a></li>
        <li class="upward"><a href="inserer_salle.php">Gestion Salle</a></li>
        <li class="forward"><a href="inserer_service.php">Gestion Service</a></li>
    </ul>
    <fieldset>
        <legend>Ajouter un employé</legend>
        <form action="inserer_employe.php" method="POST">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" required><br>
            
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" required><br>
            
            <label for="id_service">Service</label>
            <select id="id_service" name="id_service" required>
                <option value="1">Service Urologie</option>
                <option value="2">Service Gastroentérologie</option>
                <option value="3">Service Chirurgie</option>
                <option value="4">Service Obstétrique</option>
                <option value="5">Service Pédiatrie</option>
                <option value="6">Service Cardiologie</option>
            </select><br>
            
            <label for="type_employe">Type Employé</label>
            <select id="type_employe" name="type_employe" required>
                <option value="A">Aide soignant</option>
                <option value="I">Infirmier</option>
                <option value="C">Chef de service</option>
            </select><br>
            
            <input type="submit" value="Enregistrer">
        </form>
    </fieldset>

    <a href="index.php" class="btn-back-home">Retour à l'accueil</a>

    <?php
    // Initialiser message et alerte
    $message = '';
    $alert_type = '';

    // Vérifier si le formulaire a été soumis
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['id_service'], $_POST['type_employe'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $id_service = (int)$_POST['id_service'];
        $type_employe = $_POST['type_employe'];

        // Informations de connexion à la base de données
        $User = "AdminHville";
        $Passwd = "P@ssword";
        $dsn = "mysql:host=localhost;dbname=hville;charset=utf8";

        try {
            $db = new PDO($dsn, $User, $Passwd);
        } catch (PDOException $e) {
            echo "<p>Erreur de connexion : " . $e->getMessage() . "</p>";
            exit;
        }

        // Préparer et exécuter la requête d'insertion
        $requete = $db->prepare("INSERT INTO `employe` (`ID_SERVICE`, `NOM_EMPLOYE`, `PRENOM_EMPLOYE`, `TYPE_EMPLOYE`) 
                                 VALUES (:id_service, :nom, :prenom, :type_employe)");
        $res = $requete->execute([
            ':id_service' => $id_service,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':type_employe' => $type_employe,
        ]);

        if ($res === false) {
            $message = "Insertion échouée.";
            $alert_type = "error";
        } else {
            $message = "Employé ajouté avec succès.";
            $alert_type = "success";
        }
    }
    ?>

    <script>
        window.onload = function() {
            var message = "<?php echo $message; ?>";
            var alert_type = "<?php echo $alert_type; ?>";

            if (message) {
                var alertBox = document.createElement('div');
                alertBox.classList.add('alert');
                if (alert_type === 'success') {
                    alertBox.classList.add('success');
                }
                alertBox.innerHTML = message + '<span class="close-btn" onclick="closeAlert()">×</span>';
                document.body.appendChild(alertBox);
                alertBox.style.display = 'block';
            }
        }

        function closeAlert() {
            var alertBox = event.target.parentElement;
            alertBox.style.display = 'none';
        }
    </script>
</body>
</html>
