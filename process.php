<?php
if ($_POST) {
// Chemin vers le fichier JSON
    $chemin_fichier_json = 'data.json';

    $email = $_POST['email'];
    $password = $_POST['password'];
// Récupérer les valeurs du formulaire
    switch ($_POST['etat']) {
        case 'inscription':

// Récupérer le contenu du fichier JSON
            $json_contenu = file_get_contents($chemin_fichier_json);
// Décoder le JSON en une structure de données PHP
            $data = json_decode($json_contenu, true);

// Vérifier si la conversion a réussi
            if ($data === null) {
                echo "Erreur de lecture du fichier JSON";
            } else {
                $trouve = false;
                foreach ($data as $element) {
                    if ($element['id'] === $email) {
                        $trouve = true;
                        break;
                    }
                }
                if ($trouve) {
                    echo "Problème d'inscription : Utilisateur existe déjà";
                } else {
                    // Ajouter une nouvelle entrée au tableau
                    $nouvelle_entree = array("id" => $email, "mdp" => $password);
                    array_push($data, $nouvelle_entree);

                    // Encoder le tableau mis à jour en JSON
                    $nouveau_json = json_encode($data, JSON_PRETTY_PRINT);

                    // Écrire les données mises à jour dans le fichier JSON
                    if (file_put_contents($chemin_fichier_json, $nouveau_json)) {
                        echo "Vous êtes inscrit avec succès";
                    } else {
                        echo "Erreur lors de l'écriture dans le fichier";
                    }
                }

            }
            break;
        case 'connexion':
            $json_contenu = file_get_contents($chemin_fichier_json);
            $data = json_decode($json_contenu, true);
// Vérifier si la conversion a réussi
            if ($data === null) {
                echo "Erreur de lecture du fichier JSON";
            } else {
                // Vérifier si l'email et le mot de passe existent déjà
                $trouve = false;
                foreach ($data as $element) {
                    if ($element['id'] === $email && $element['mdp'] === $password) {
                        $trouve = true;
                        break;
                    }
                }
                if ($trouve) {
                    echo "Connexion établie";
                } else {
                    echo "Problème de connexion";
                }
            }
            break;
    }
}
?>
