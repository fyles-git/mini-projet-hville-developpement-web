<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style_salle.css?v=1.0" rel="stylesheet" type="text/css">
    <title>Ajouter une salle</title>
</head>
<body>
    <ul class="nav-links">
        <li><a href="index.php">Accueil</a></li>
        <li class="center"><a href="inserer_employe.php">Gestion Employé</a></li>
        <li class="upward"><a href="inserer_salle.php">Gestion Salle</a></li>
        <li class="forward"><a href="inserer_service.php">Gestion Service</a></li>
    </ul>
    <!-- Formulaire pour ajouter une salle -->
    <fieldset>
        <legend>Ajouter une salle</legend>
        <form action="inserer_salle.php" method="POST">
            <label for="type_salle">Type Salle</label>
            <select id="type_salle" name="type_salle" required>
                <option value="M">Chambre médicale</option>
                <option value="O">Bloc opératoire</option>
                <option value="B">Bureau</option>
            </select><br>
            
            <label for="temp_salle">Température</label>
            <input type="number" id="temp_salle" name="temp_salle" required><br>
            
            <input type="submit" value="Enregistrer">
        </form>
    </fieldset>

    <a href="index.php" class="btn-back-home">Retour à l'accueil</a>

    <?php
    // Déclaration des variables pour le message et le type d'alerte
    $message = '';
    $alert_type = '';

    // Traitement du formulaire (lorsque le formulaire est soumis)
    if (isset($_POST['type_salle'], $_POST['temp_salle'])) {
        $type_salle = $_POST['type_salle'];
        $temp_salle = (int)$_POST['temp_salle'];

        $User = "AdminHville";
        $Passwd = "P@ssword";
        $dsn = "mysql:host=localhost;dbname=hville;charset=utf8";

        try {
            $db = new PDO($dsn, $User, $Passwd);
        } catch (PDOException $e) {
            $message = "Erreur de connexion : " . $e->getMessage();
            $alert_type = "error";
        }

        if (!$message) {
            $type_salle = $db->quote($type_salle);

            $requete = "INSERT INTO `salle` (`TYPE_SALLE`, `TEMP_SALLE`) 
                        VALUES ($type_salle, $temp_salle);";

            // Exécution de la requête
            $res = $db->query($requete);

            if ($res === false) {
                $message = "Erreur lors de l'ajout de la salle.";
                $alert_type = "error";
            } else {
                $message = "Salle ajoutée avec succès!";
                $alert_type = "success";
            }
        }
    }
    ?>

    <!-- Alerte -->
    <div id="alert" class="alert" style="display:none;">
        <span id="alert-msg"></span>
        <span class="close-btn" onclick="closeAlert()">×</span>
    </div>

    <script>
        // Fonction pour afficher l'alerte
        function showAlert(message, type) {
            var alertDiv = document.getElementById('alert');
            var alertMsg = document.getElementById('alert-msg');
            var alertClass = type === 'success' ? 'success' : 'error';

            alertMsg.innerText = message;
            alertDiv.className = 'alert ' + alertClass;
            alertDiv.style.display = 'block';
        }

        // Fonction pour fermer l'alerte
        function closeAlert() {
            document.getElementById('alert').style.display = 'none';
        }

        // Fonction pour injecter le message PHP dans le script JavaScript
        window.onload = function() {
            // Récupérer les messages d'alerte et leur type
            var message = "<?php echo isset($message) ? addslashes($message) : ''; ?>";
            var alert_type = "<?php echo isset($alert_type) ? $alert_type : ''; ?>";

            // Si un message est défini, afficher l'alerte
            if (message) {
                showAlert(message, alert_type);
            }
        }
    </script>
</body>
</html>
