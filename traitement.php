<?php
session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "devoir_securite";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if (isset($_POST['token']) && hash_equals($_SESSION['token'], $_POST['token'])) {
    if (isset($_POST['ok'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING);
        $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
        $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
        $password = $_POST['password']; 
        $confirme = $_POST['confirme'];

        if ($password !== $confirme) {
            echo htmlentities('Les mots de passe ne correspondent pas. Veuillez réessayer.');
        } else {
            $checkEmailQuery = $conn->prepare("SELECT COUNT(*) AS count FROM users WHERE email = :email");
            $checkEmailQuery->execute([':email' => $email]);
            $emailExists = $checkEmailQuery->fetch(PDO::FETCH_ASSOC)['count'];

            $checkPseudoQuery = $conn->prepare("SELECT COUNT(*) AS count FROM users WHERE pseudo = :pseudo");
            $checkPseudoQuery->execute([':pseudo' => $pseudo]);
            $pseudoExists = $checkPseudoQuery->fetch(PDO::FETCH_ASSOC)['count'];

            if ($emailExists > 0) {
                echo htmlentities('E-mail existe déjà. Veuillez en choisir un autre.');
            } elseif ($pseudoExists > 0) {
                echo htmlentities('Le pseudo existe déjà. Veuillez en choisir un autre.');
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $insertQuery = $conn->prepare("INSERT INTO users (pseudo, nom, prenom, email, password) VALUES (:pseudo, :nom, :prenom, :email, :password)");
                $insertQuery->execute([
                    ':pseudo' => $pseudo,
                    ':nom' => $nom,
                    ':prenom' => $prenom,
                    ':email' => $email,
                    ':password' => $hashedPassword
                ]);
                header("Location: connexion.php");
                exit();
            }
        }
    } elseif (isset($_POST['reset'])) {
                $pseudo = $nom = $prenom = $email = $password = '';
                //echo 'Formulaire réinitialisé!';
    }
}else {
    die("Erreur de sécurité CSRF.");
}
?>
