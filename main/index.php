<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=1.0">
    <title>Gestion Hville</title>
</head>
<body>
    <ul class="nav-links">
        <li><a href="#">Accueil</a></li>
        <li class="center"><a href="inserer_employe.php">Gestion Employé</a></li>
        <li class="upward"><a href="inserer_salle.php">Gestion Salle</a></li>
        <li class="forward"><a href="inserer_service.php">Gestion Service</a></li>
    </ul>
    <main>
        <!-- Conteneur principal pour les sections -->
        <div class="sections-container">
            <!-- Première ligne : Liste des employés et Liste des salles -->
            <div class="top-section">
                <div class="section">
                    <h2>Liste des employés 🥼</h2>
                    <?php
                    /* Connexion à la base de données */
                    $Host="localhost";
                    $User = "AdminHville";
                    $Passwd="P@ssword";
                    $BD="hville";
                    $connexion= mysqli_connect($Host,$User,$Passwd,$BD);

                    // Ajout de l'encodage pour afficher les accents
                    mysqli_set_charset($connexion, "utf8");

                    // Requête modifiée pour récupérer les employés avec le libellé du type d'employé (sans ID Service)
                    $requete = "
                        SELECT t.LIBELLE_EMPLOYE, e.nom_employe, e.prenom_employe
                        FROM employe e
                        INNER JOIN type_employe t ON e.type_employe = t.TYPE_EMPLOYE;
                    ";

                    // Exécution de la requête
                    $listemployes = mysqli_query($connexion, $requete);

                    // Affichage du tableau des employés
                    echo "<table border=\"1\"><tr><th>Postes</th><th>Nom</th><th>Prénom</th></tr>";

                    while ($ligne = mysqli_fetch_row($listemployes)) {
                        echo "<tr><td>$ligne[0]</td><td>$ligne[1]</td><td>$ligne[2]</td></tr>";
                    }

                    echo "</table>";
                    ?>
                </div>

                <div class="section">
                    <h2>Liste des salles 🚪</h2>
                    <?php
                    // Requête modifiée pour récupérer les salles avec le libellé du type de salle
                    $requete_salle = "
                        SELECT ts.LIBELLE_SALLE, s.temp_salle 
                        FROM salle s
                        INNER JOIN type_salle ts ON s.TYPE_SALLE = ts.TYPE_SALLE;
                    ";

                    // Exécution de la requête
                    $listesalles = mysqli_query($connexion, $requete_salle);

                    // Affichage du tableau des salles
                    echo "<table border=\"1\"><th>Catégories</th><th>Température (°C)</th></tr>";

                    while ($ligne_salle = mysqli_fetch_row($listesalles)) {
                        echo "<tr><td>$ligne_salle[0]</td><td>$ligne_salle[1]</td</tr>";
                    }

                    echo "</table>";
                    ?>
                </div>
            </div>

            <!-- Deuxième ligne : Liste des services et Services et quantité chambre -->
            <div class="bottom-section">
                <div class="section">
                    <h2>Liste des services 🩺</h2>
                    <?php
                    /* Requête pour récupérer les services */
                    $requete_service = "SELECT `libelle_service` FROM `service`;";
                    $listeservice = mysqli_query($connexion, $requete_service);

                    // Affichage du tableau des services
                    echo "<table border=\"1\"><tr><th>Services</th></tr>";

                    while ($ligne_service = mysqli_fetch_row($listeservice)) {
                        echo "<tr><td>$ligne_service[0]</td></tr>";
                    }

                    echo "</table>";
                    ?>
                </div>

                <div class="section">
                    <h2>Quantité de chambres 🛏️</h2>
                    <?php
                    // Requête pour récupérer le libellé du service et la quantité de chambres
                    $requete_chambre = "
                        SELECT s.libelle_service, c.qte_chambre
                        FROM service s
                        INNER JOIN compose c ON s.id_service = c.id_service;
                    ";

                    // Exécution de la requête
                    $listeservices_chambres = mysqli_query($connexion, $requete_chambre);

                    // Affichage du tableau des services et quantités de chambres
                    echo "<table border=\"1\"><tr><th>Services</th><th>Quantité de chambres</th></tr>";

                    while ($ligne_chambre = mysqli_fetch_row($listeservices_chambres)) {
                        echo "<tr><td>$ligne_chambre[0]</td><td>$ligne_chambre[1]</td></tr>";
                    }

                    echo "</table>";
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
