<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style_service.css?v=1.0" rel="stylesheet" type="text/css">
    <title>Ajouter un service</title>
</head>
<body>
    <ul class="nav-links">
        <li><a href="index.php">Accueil</a></li>
        <li class="center"><a href="inserer_employe.php">Gestion Employé</a></li>
        <li class="upward"><a href="inserer_salle.php">Gestion Salle</a></li>
        <li class="forward"><a href="inserer_service.php">Gestion Service</a></li>
    </ul>
    <fieldset>
        <legend>Ajouter un service</legend>
        <form action="inserer_service.php" method="POST">
            <label for="libelle_service">Service</label>
            <input type="text" id="libelle_service" name="libelle_service" required><br>
            
            <input type="submit" value="Enregistrer">
        </form>
    </fieldset>

    <a href="index.php" class="btn-back-home">Retour à l'accueil</a>

    <?php
    // Déclaration des variables pour le message et le type d'alerte
    $message = '';
    $alert_type = '';

    // Traitement du formulaire (lorsque le formulaire est soumis)
    if (isset($_POST['libelle_service'])) {
        $libelle_service = $_POST['libelle_service'];

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
            $libelle_service = $db->quote($libelle_service);

            $requete = "INSERT INTO `service` (`LIBELLE_SERVICE`) 
                        VALUES ($libelle_service);";

            // Exécution de la requête
            $res = $db->query($requete);

            if ($res === false) {
                $message = "Erreur lors de l'ajout du service.";
                $alert_type = "error";
            } else {
                $message = "Service ajouté avec succès!";
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
