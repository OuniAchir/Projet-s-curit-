
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projet_cyber";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connexion errors: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['token']) && hash_equals($_SESSION['token'], $_POST['token'])) {
        if (isset($_POST["ok"])) {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST["password"];

            if (!empty($email) && !empty($password)) {
                $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['password'])) {
                    // Utilisateur connecté
                    echo htmlentities("Connected");
                    exit();
                } else {
                    // Identifiants incorrects
                    echo htmlentities("Incorrect inputs");
                    exit();
                }
            }
        }

        if (isset($_POST["Sign up"])) {
            header("Location: Inscription.php");
            exit();
        }

        if (isset($_POST['reset'])) {
            $email = $password = '';
            //echo 'Formulaire réinitialisé!';
        }
    } else {
        die("Erreur de sécurité CSRF.");
    }
}
?>